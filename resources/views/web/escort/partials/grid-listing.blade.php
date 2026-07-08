     @if ($grouped->has('1'))
         <div class="space_between_row" style="display:{{ $viewType == 'grid' ? 'block' : 'none' }}">
             <div class="bod_image">
                 <div class="ec_tooltip">
                     <img src="{{ asset('images/platinum_membership.png') }}">
                     <span class="ec_type_tooltip">Platinum Members - {{ $memberTotalCount[1] }}
                         {{ $memberTotalCount[1] == 1 ? 'Listing' : 'Listings' }}</span>
                 </div>
                 {{ $memberTotalCount[1] }}
                 <span class="bordertopp">
                     {{ $memberTotalCount[1] == 1 ? 'Listing' : 'Listings' }}</span>
             </div>
             <div class="row responsive_colums_in_lg_five_col escost_list">
                 @if ($grouped->has('1'))
                     @foreach ($grouped['1'] as $escort)
                         @include('web.escort.partials.grid.platinum')
                     @endforeach
                 @endif

             </div>
         </div>
     @endif
     @if ($grouped->has('2'))
         <div class="space_between_row" style="display:{{ $viewType == 'grid' ? 'block' : 'none' }}">
             <div class="bod_image">
                 <div class="ec_tooltip">
                     <img src="{{ asset('images/gold_membership.png') }}">
                     <span class="ec_type_tooltip">
                         Gold Members - {{ $memberTotalCount[2] }}
                         {{ $memberTotalCount[2] == 1 ? 'Listing' : 'Listings' }}
                     </span>
                 </div>
                 {{ $memberTotalCount[2] }}
                 <span class="bordertopp">
                     {{ $memberTotalCount[1] == 1 ? 'Listing' : 'Listings' }}</span>
             </div>
             <div class="row responsive_colums_in_lg_five_col escost_list">
                 @if ($grouped->has('2'))
                     @foreach ($grouped['2'] as $escort)
                         @include('web.escort.partials.grid.gold')
                     @endforeach
                 @endif

             </div>
         </div>
     @endif
     @if ($grouped->has('3'))
         <div class="space_between_row" style="display:{{ $viewType == 'grid' ? 'block' : 'none' }}">
             <div class="bod_image">
                 <div class="ec_tooltip">
                     <img src="{{ asset('images/silver_membership.png') }}">
                     <span class="ec_type_tooltip">
                         Silver Members - {{ $memberTotalCount[3] }}
                         {{ $memberTotalCount[3] == 1 ? 'Listing' : 'Listings' }}
                     </span>
                 </div>
                 {{ $memberTotalCount[3] }}
                 <span class="bordertopp">
                     {{ $memberTotalCount[3] == 1 ? 'Listing' : 'Listings' }}</span>
             </div>
             <div class="row responsive_colums_in_lg_five_col escost_list">
                 @if ($grouped->has('3'))
                     @foreach ($grouped['3'] as $escort)
                         @include('web.escort.partials.grid.silver')
                     @endforeach
                 @endif

             </div>
         </div>
     @endif
     @if ($grouped->has('4'))
         <div class="space_between_row" style="display:{{ $viewType == 'grid' ? 'block' : 'none' }}">
             <div class="bod_image">
                 <div class="ec_tooltip">
                     <img src="{{ asset('assets/app/img/Group 153.png') }}">
                     <span class="ec_type_tooltip">
                         Free Members -{{ $memberTotalCount[4] }}
                         {{ $memberTotalCount[4] == 1 ? 'Listing' : 'Listings' }}
                     </span>
                 </div>
                 {{ $memberTotalCount[4] }}
                 <span class="bordertopp">
                     {{ $memberTotalCount[4] == 1 ? 'Listing' : 'Listings' }}</span>
             </div>
             <div class="row responsive_colums_in_lg_five_col escost_list">
                 @if ($grouped->has('4'))
                     @foreach ($grouped['4'] as $escort)
                         @include('web.escort.partials.grid.free')
                     @endforeach
                 @endif

             </div>
         </div>
     @endif
