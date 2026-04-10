<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\User\UserInterface;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Pricing;
use App\Models\AdvertiserDiscount;
use App\Traits\DataTablePagination;
use Exception;

class FeeDiscountController extends Controller
{
    protected $user;
    protected $account;
    protected $local_timezone;
    use DataTablePagination;
    
    public function __construct(UserInterface $user)
    {
        $this->user = $user;

        $this->middleware(function ($request, $next) {
            $this->account = auth()->user();
            $this->local_timezone = config('common.local_timezone');
            return $next($request);
        });
    }

    public function index()
    {
        return view('admin.management.fee_discount.index');
    }

    public function searchMember(Request $request)
    {
        try {
            $keyword = strtoupper($request->keyword ?? '');
            // Validate input (must start with E or M)
            if (!preg_match('/^[EM]/', $keyword)) {
                return response()->json([]);
            }

            $users = User::where('member_id', 'LIKE', $keyword . '%')
                ->where(function ($q) {
                    $q->where('member_id', 'LIKE', 'E%')
                    ->orWhere('member_id', 'LIKE', 'M%');
                })
                ->where('member_id', 'NOT LIKE', '%:%')
                ->pluck('member_id');

            return response()->json($users);

        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong. Please try again.'
            ], 500);
        }
    }

    public function getAdvertiserDetail(Request $request){
        try {
            // Validate request
            $request->validate([
                'keyword' => 'required'
            ]);

            $value = $request->keyword;

            // Fetch user by id OR member_id
            $user = User::with(['my_agent','state'])->where('id', $value)
                ->orWhere('member_id', $value)
                ->first();

            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'Advertiser not found.'
                ], 404);
            }

            return response()->json([
                'status' => true,
                'message' => 'Advertiser found.',
                'data' => $user
            ]);

        } catch (Exception $e) {

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage() 
            ], 500);
        }
    }

    public function applyFeeDiscount(Request $request){
        try {
            // Validate request
            $request->validate([
                'advertiser_id' => 'required',
                'discount' => 'required|numeric|gt:0',
                'end_date' => 'required',
            ]);

            $advertiserDetail = $this->user->find($request->advertiser_id);

            if($advertiserDetail->activeFeeDiscount){
                throw new \Exception('Active fee discount already exists', 422);
            }
            
            $start_date = Carbon::today($this->local_timezone)->startOfDay()->setTimezone('UTC');
            $end_date   = Carbon::parse($request->end_date,$this->local_timezone)->endOfDay()->setTimezone('UTC');

            AdvertiserDiscount::create([
                'user_id' => $advertiserDetail->id,
                'type' => 'percentage',
                'value' => $request->discount,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'is_active' => true
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Discount has been applied.'
            ]);

        } catch (Exception $e) {
            $statusCode = $e->getCode() ?: 500;

            if ($e instanceof \Illuminate\Validation\ValidationException) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation failed',
                    'errors' => $e->errors()
                ], 422);
            }

            return response()->json([
                'status' => false,
                'message' => $statusCode === 500 ? 'Something went wrong' : $e->getMessage(),
                'error' => $statusCode === 500 ? $e->getMessage() : null
            ], $statusCode);
        }
    }

    public function renewFeeDiscount(Request $request){
        try {
            $request->validate([
                'advertiser_id' => 'required',
                'discount' => 'required|numeric|gt:0',
                'end_date' => 'required',
            ]);
            
            $start_date = Carbon::today($this->local_timezone)->startOfDay()->setTimezone('UTC');
            $end_date   = Carbon::parse($request->end_date,$this->local_timezone)->endOfDay()->setTimezone('UTC');
            AdvertiserDiscount::where(['id'=>$request->discount_id])->update(['end_date'=>now(),'is_active'=>false]);
            AdvertiserDiscount::create([
                'user_id' => $request->advertiser_id,
                'type' => 'percentage',
                'value' => $request->discount,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'is_active' => true
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Discount has been renewed.'
            ]);

        } catch (Exception $e) {
            $statusCode = $e->getCode() ?: 500;

            if ($e instanceof \Illuminate\Validation\ValidationException) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation failed',
                    'errors' => $e->errors()
                ], 422);
            }

            return response()->json([
                'status' => false,
                'message' => $statusCode === 500 ? 'Something went wrong' : $e->getMessage(),
                'error' => $statusCode === 500 ? $e->getMessage() : null
            ], $statusCode);
        }
    }

    public function cancelFeeDiscount(Request $request){
        try {
            $request->validate([
                'discount_id' => 'required',
            ]);
            AdvertiserDiscount::where(['id'=>$request->discount_id])->update(['end_date'=>now(),'cancelled_at'=>now()]);
            return response()->json([
                'status' => true,
                'message' => 'Discount has been cancelled.'
            ]);

        } catch (Exception $e) {
            $statusCode = $e->getCode() ?: 500;

            if ($e instanceof \Illuminate\Validation\ValidationException) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation failed',
                    'errors' => $e->errors()
                ], 422);
            }

            return response()->json([
                'status' => false,
                'message' => $statusCode === 500 ? 'Something went wrong' : $e->getMessage(),
                'error' => $statusCode === 500 ? $e->getMessage() : null
            ], $statusCode);
        }
    }

    public function paginatedList($start, $limit, $order_key, $dir, $columns, $search = null, $user = null)
    {
        $order_field = $columns[$order_key]['name'];
        $searchables = $this->getSearchableFieldsName($columns);
        $query = AdvertiserDiscount::query(); 
        $query->where('is_active',1);
        if($search) {
            $query->where(function ($q) use ($searchables, $search) {
                foreach ($searchables as $column) {
                    if(!in_array($column,['member_id'])){
                        $q->orWhere($column, 'LIKE', "%{$search}%");
                    }
                    else{
                        $q->orWhereHas('user', function ($userQuery) use ($search) {
                            $userQuery->where('member_id', 'LIKE', "%{$search}%");
                        });
                    }
                    
                }
            });
        }
        $count =  $query->count();
        $query->orderBy($order_field, $dir);
        $mainQuery = $query->offset($start)->limit($limit);
        return [$mainQuery->get(), $count, [$query->toSql(),$searchables]];
    }

    public function modifyRecords($result){
        $local_timezone = config('common.local_timezone');
        foreach($result as $key => $item) {
            $userDetail = $item->user;
            $item->member_id = $userDetail->member_id;
            $item->advertiser_name = $userDetail->name;
            $item->agent_id = $userDetail->my_agent ? $userDetail->my_agent->member_id:'---';
            $existingRates = Pricing::getAdvertiserPrices($userDetail->type);
            $item->rate = '';
            if($userDetail->type==ESCORT){
                $index = ['P', 'G', 'S'];
                foreach($existingRates as $key=>$amount){
                    $discountAmount = ($item->type=='percentage')?($amount*$item->value)/100:$item->value;
                    $item->rate .=  '<div class="num_value">'.$index[$key].':<span>$ '.number_format($amount-$discountAmount,2).'</span></div>';
                }
            }
            else{
                foreach($existingRates as $key=>$amount){
                    $discountAmount = ($item->type=='percentage')?($amount*$item->value)/100:$item->value;
                    $item->rate .=  '<div class="num_value justify-content-end"><span>$ '.number_format($amount-$discountAmount,2).'</span></div>';
                }
            }
            $item->discount = ($item->type=='percentage')?$item->value.'%':$item->value;
            $item->discount_start_date = $item->start_date->format('d-m-Y');
            $item->discount_end_date = $item->end_date->format('d-m-Y');
           
            $discountStatus = now()->lte($item->end_date)?'Active':'Expired';
            $badgeClass = getStatusBadgeClass(strtolower($discountStatus));
            $item->status = "<span class='custom_badge {$badgeClass}'>{$discountStatus}</span>";
            $item->action = Pricing::getAdvertiserPrices(ESCORT);
            $item->action = view('admin.management.fee_discount.partials.action-dropdown-discount', compact('item'))->render();
        }
        return $result;
    }

    public function getFeeDiscountListing(){
        list($result, $count, $other) = $this->paginatedList(
            request()->get('start'),
            request()->get('length'),
            request()->get('order')[0]['column'],
            request()->get('order')[0]['dir'],
            request()->get('columns'),
            request()->get('search')['value'],
            $this->user
        );
        $result = $this->modifyRecords($result);
        $data = array(
            "draw"            => intval(request()->input('draw')),
            "recordsTotal"    => intval($count),
            "recordsFiltered" => intval($count),
            "other" => $other,
            "data"            => $result
        );
        return response()->json($data);
    }

    public function getAdvertiserHistory(Request $request){

        $start = $request->start;
        $limit =  $request->length;
        $advertiser_id =  $request->advertiser_id;
        $query = AdvertiserDiscount::query()->where(['user_id'=>$advertiser_id])->where('end_date', '<', now('UTC'));
        $count =  $query->count();
        $query->orderBy('end_date', 'desc');
        $mainQuery = $query->offset($start)->limit($limit);
        $result = $mainQuery->get();

        foreach($result as $key => $item) {
            $item->discount_start_date = $item->start_date->setTimezone($this->local_timezone)->format('d-m-Y');
            $item->days = $item->end_date->diffInDays($item->start_date)+1;
            $item->rate = ($item->type=='percentage')?$item->value.'%':$item->value;
            $item->spend = '<div class="num_value">$<span>'.$item->spend_amount.'</span></div>';
        }
        $data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($count),
            "recordsFiltered" => intval($count),
            "data"            => $result
        );

        return response()->json($data);
    }
    
}