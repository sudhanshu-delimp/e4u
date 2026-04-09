<div class="dropdown no-arrow">
    <a class="dropdown-toggle" href="#" role="button"
       id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
       aria-expanded="false">
       <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
    </a>
    <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
       aria-labelledby="dropdownMenuLink">
       <div class="custom-tooltip-container">
         <a class="dropdown-item align-item-custom toggle-massage-notification" href="#" title="Click to disable notification"></a>
         @if(!$item->cancelled_at || now()->lte($item->end_date))
         <a class="dropdown-item align-item-custom" data-toggle="modal" data-target="#confirm" href=""  data-discount_id="{{$item->id}}"> <i class="fa fa-times" aria-hidden="true"></i> Cancel</a>
         <div class="dropdown-divider"></div>
         @endif
         <a class="dropdown-item align-item-custom" href="#" data-toggle="modal" data-target="#discount_history" data-user_id="{{$item->user_id}}"> <i class="fa fa-history" aria-hidden="true"></i>History</a>
         <div class="dropdown-divider"></div>
         <a class="dropdown-item align-item-custom" href="#" data-toggle="modal" data-target="#renew_discount" data-discount_id="{{$item->id}}"  data-user_id="{{$item->user_id}}" data-discount_value="{{$item->value}}"> <i class="fa fa-sync" aria-hidden="true"></i>Renew</a>
       </div>
    </div>
 </div>