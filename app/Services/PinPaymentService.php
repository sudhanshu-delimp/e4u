<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;
use App\Models\PaymentHistory;
use App\Traits\DataTablePagination;

class PinPaymentService
{
    use DataTablePagination;
    public function charge($token, $amount, $email = null, $description = null)
    {
        try {
            $response = Http::withBasicAuth(
                config('app.payment.secret_key'),
                ''
            )->asForm()->post('https://test-api.pinpayments.com/1/charges', [
                'amount' => $amount*100,
                'currency' => 'AUD',
                'description' => $description ?? 'E4U Service',
                'email' => $email ?? 'customer@example.com',
                'card_token' => $token
            ]);

            $response->throw();

            return [
                'status' => true,
                'data' => $response->json()
            ];

        } catch (RequestException $e) {

            return [
                'status' => false,
                'error' => $e->response->json()
            ];

        } catch (\Exception $e) {

            return [
                'status' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    public function paginatedList($start, $limit, $order_key, $dir, $columns, $search = null, $user = null)
    {
        $order_field = $columns[$order_key]['name'];
        $searchables = $this->getSearchableFieldsName($columns);
        $query = PaymentHistory::query();
        if(!empty($user)){
            $query->where('user_id',$user->id);
        } 
        if($search) {
            $query->where(function ($q) use ($searchables, $search) {
                foreach ($searchables as $column) {
                    $q->orWhere($column, 'LIKE', "%{$search}%");
                }
            });
        }
        $count =  $query->count();
        $query->orderBy($order_field, $dir);
        $mainQuery = $query->offset($start)->limit($limit);
        return [$mainQuery->get(), $count, [$query->toSql(),$searchables]];
    }

    public function modifyRecords($result){
        foreach($result as $key => $item) {
            $item->completed_by_member_id = $item->completedByUser->member_id;
            $item->transaction_at = convert_aus_date_time_format($item->created_at);
            $item->type = ucfirst($item->type);
            $item->amount = 'AU$'.$item->amount;
            $action = '<div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
            </a>
            <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">';
            $action .= '<a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-toggle="modal" data-item="'.encrypt($item->id).'" data-target="#view-listing" > <i class="fa fa-eye"></i> View </a>';
            $action .= '</div></div>';
            $item->action = $action;
        }
        return $result;
    }
}