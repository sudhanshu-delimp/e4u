     
     <nav aria-label="Page navigation" class="custom-pagination">
         <ul class="list-unstyled">

             {{-- First Page --}}
             <li class="mx-1 {{ $paginator->onFirstPage() ? 'disabled' : '' }}">
                 <a href="{{ $paginator->onFirstPage() ? '#' : $paginator->url(1) }}"
                     style="{{ $paginator->onFirstPage() ? 'pointer-events:none; opacity:0.5;' : '' }}">
                     <i class="fa fa-angle-double-left"></i> First
                 </a>
             </li>

             {{-- Previous Page --}}
             <li class="mx-1 {{ $paginator->onFirstPage() ? 'disabled' : '' }}">
                 <a href="{{ $paginator->onFirstPage() ? '#' : $paginator->previousPageUrl() }}"
                     style="{{ $paginator->onFirstPage() ? 'pointer-events:none; opacity:0.5;' : '' }}">
                     <i class="fa fa-angle-left"></i> Previous
                 </a>
             </li>

             {{-- Page Number Logic --}}
             @php
                 $total = $paginator->lastPage();
                 $current = $paginator->currentPage();

                 // Show up to 3 pages before and after current
                 $start = max(1, $current - 2);
                 $end = min($total, $current + 2);
             @endphp

             {{-- Left Ellipsis (jump back 5 pages) --}}
             @if ($start > 1)
                 @php $jumpBack = max(1, $current - 5); @endphp
                 <li class="mx-1">
                     <a href="{{ $paginator->url($jumpBack) }}" title="Jump back 5 pages">...</a>
                 </li>
             @endif

             {{-- Page Numbers --}}
             @for ($i = $start; $i <= $end; $i++)
                 <li class="mx-1">
                     <a href="{{ $paginator->url($i) }}"
                         style="background-color: {{ $i == $paginator->currentPage() ? '#F2F2F2' : '#0C223d' }}; font-weight: {{ $i == $paginator->currentPage() ? 'bold' : 'normal' }}; color: {{ $i == $paginator->currentPage() ? '#ff3c5f' : '#fff' }};">
                         {{ $i }}
                     </a>
                 </li>
             @endfor

             {{-- Right Ellipsis (jump forward 5 pages) --}}
             @if ($end < $total)
                 @php $jumpForward = min($total, $current + 5); @endphp
                 <li class="mx-1">
                     <a href="{{ $paginator->url($jumpForward) }}" title="Jump forward 5 pages">...</a>
                 </li>
             @endif

             {{-- Next Page --}}
             <li class="mx-1 {{ !$paginator->hasMorePages() ? 'disabled' : '' }}">
                 <a href="{{ $paginator->hasMorePages() ? $paginator->nextPageUrl() : '#' }}"
                     style="{{ !$paginator->hasMorePages() ? 'pointer-events:none; opacity:0.5;' : '' }}">
                     Next <i class="fa fa-angle-right"></i>
                 </a>
             </li>

             {{-- Last Page --}}
             <li class="mx-1 {{ $current == $total ? 'disabled' : '' }}">
                 <a href="{{ $current == $total ? '#' : $paginator->url($total) }}"
                     style="{{ $current == $total ? 'pointer-events:none; opacity:0.5;' : '' }}">
                     Last <i class="fa fa-angle-double-right"></i>
                 </a>
             </li>

         </ul>
         {{-- Page Info Below --}}
         <div class="text-center mt-2 mb-5 col-sm-12" style="color: #ff3c5f; font-weight: 400;">
             Page {{ $paginator->currentPage() }} of {{ $paginator->lastPage() }} |
             Showing {{ $paginator->firstItem() ?? 0 }} to {{ $paginator->lastItem() ?? 0 }} of
             {{ $paginator->total() }} Listings
         </div>

     </nav>
