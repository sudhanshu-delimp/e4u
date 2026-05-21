<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\AttemptLogin\AttemptLoginRepository;
use App\Repositories\Escort\AvailabilityInterface;
use App\Repositories\Service\ServiceInterface;
use App\Repositories\User\UserInterface;
use Exception;
use Illuminate\Support\Facades\Auth;

class ImpersonateController extends Controller
{
    protected $availability;
    protected $service;
    protected $user;
    protected $attemptlogin;
    protected $account;

    public function __construct(AttemptLoginRepository $attemptlogin, UserInterface $user, AvailabilityInterface $availability, ServiceInterface $service)
    {
        $this->availability = $availability;
        $this->service = $service;
        $this->user = $user;
        $this->attemptlogin = $attemptlogin;

        $this->middleware(function ($request, $next) {
            $this->account = auth()->user();
            return $next($request);
        });
    }

    /**
     * Back from child to parent account
     */
    public function backToParent()
    {
        try {
            if (!session()->has('parent_agent_id')) {
                //abort(403, 'No parent session found');
                return redirect()->back()->with('error', 'No parent session found.');
            }

            $parentUser = User::find(session('parent_agent_id'));

            if (!$parentUser) {
                Auth::logout();
                session()->flush();
                return redirect('/agent-login');
            }

            Auth::login($parentUser);

            session()->forget([
                'parent_agent_id',
                'is_impersonated'
            ]);

            return redirect('/agent-dashboard')->with('success', 'Successfully back to the agent account');
        } catch (Exception $e) {
            // abort(403, 'No parent session found');
            return redirect()->back()->with('error', 'Something went wrong while backt to the agent account.');
        }
    }

    /**
     * Switch from Agent to Escort or Massage Center account
     */
    public function switchLogin($id)
    {
        try {
            $loggedInUser = Auth::user();

            if ($loggedInUser->is_child == 1) {
                abort(403, 'Child account cannot switch users');
            }

            if ($loggedInUser->type != 5) {
                //abort(403, 'Unauthorized');
                return redirect()->back()->with('error', 'Unauthorized access not allowed.');
            }

            $childUser = User::where('id', $id)
                ->where('assigned_agent_id', $loggedInUser->id)
                //->where('is_child', 1)
                ->first();

            if (!$childUser) {
                abort(404, 'Child account not found');
                return redirect()->back()->with('error', 'Unauthorized access not allowed.');
            }

            session([
                'parent_agent_id' => $loggedInUser->id,
                'switch_for' => 'agent_to_massage',
                'is_impersonated' => true
            ]);

            Auth::login($childUser);

            if (($childUser->type == 3)) {
                return redirect('/escort-dashboard')->with('success', "Successfully switch to the escort account");
            } else {
                return redirect('/center-dashboard')->with('success', "Successfully switch to the massage center account");
            }
        } catch (Exception $e) {
            abort(403, 'No parent session found');
            return redirect()->back()->with('error', 'Something went wrong while switching accounts.');
        }
    }
}
