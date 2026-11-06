<?php

namespace App\Http\Controllers\Escort;

use App\Http\Controllers\Controller;
use App\Models\Escort;
use App\Models\EscortPinup;
use App\Models\MassageProfile;
use App\Models\MassagePurchase;
use App\Models\MassageTimeAvailability;
use App\Models\Masseur;
use App\Models\PaymentHistory;
use App\Models\PaymentItem;
use App\Models\Purchase;
use App\Models\Tour;
use App\Models\User;
use App\Services\LogService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class AnalyticsController extends Controller
{

    public $logService;

    public function __construct(LogService $logService)
    {
        $this->logService = $logService;
    }

    /**
     * Social Media Analytics
     */
    public function index()
    {
        $userId = Auth::id();
        $views = $this->logService->getSocialMediaViews('escort', $userId);

        return view('escort.dashboard.Annalytics.social-media', compact('views'));
    }

    /**
     * Feedback Analytics
     */
    public function feedback()
    {
         $userId = Auth::id();
        $viewsCnts = $this->logService->getReviewsrecommendationsCount('escort', $userId);
    
        return view('escort.dashboard.Annalytics.feedback', compact('viewsCnts'));
    }

    /**
     * Frofile and Tours Analytics
     */
    public function profilesTours()
    {
        return view('escort.dashboard.Annalytics.profiles-tours');
    }
}
