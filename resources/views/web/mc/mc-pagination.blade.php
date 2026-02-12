@if ($listings->hasPages())
<div class="row mt-5">
    <div class="col-lg-12">
        <nav aria-label="Page navigation" class="custom-pagination">

            <ul class="list-unstyled d-flex justify-content-center align-items-center">

                {{-- First --}}
                <li class="mx-1 {{ $listings->onFirstPage() ? 'disabled' : '' }}">
                    <a href="{{ $listings->onFirstPage() ? 'javascript:void(0)' : $listings->url(1) }}"
                       class="page-link-custom">
                        <i class="fa fa-angle-double-left"></i> First
                    </a>
                </li>

                {{-- Previous --}}
                <li class="mx-1 {{ $listings->onFirstPage() ? 'disabled' : '' }}">
                    <a href="{{ $listings->previousPageUrl() ?? 'javascript:void(0)' }}"
                       class="page-link-custom">
                        <i class="fa fa-angle-left"></i> Previous
                    </a>
                </li>

                {{-- Custom Page Numbers With Ellipsis --}}
                @php
                    $current = $listings->currentPage();
                    $last = $listings->lastPage();

                    $start = max($current - 1, 1);
                    $end = min($current + 1, $last);
                @endphp

                {{-- Show first page if needed --}}
                @if($start > 1)
                    <li class="mx-1">
                        <a href="{{ $listings->url(1) }}" class="page-link-custom">1</a>
                    </li>

                    @if($start > 2)
                        <li class="mx-1 disabled">
                            <a href="javascript:void(0)" class="page-link-custom">...</a>
                        </li>
                    @endif
                @endif

                {{-- Page Loop --}}
                @for($page = $start; $page <= $end; $page++)
                    <li class="mx-1">
                        <a href="{{ $listings->url($page) }}"
                           class="page-link-custom {{ $page == $current ? 'active-page' : '' }}">
                            {{ $page }}
                        </a>
                    </li>
                @endfor

                {{-- Show last page if needed --}}
                @if($end < $last)
                    @if($end < $last - 1)
                        <li class="mx-1 disabled">
                            <a href="javascript:void(0)" class="page-link-custom">...</a>
                        </li>
                    @endif

                    <li class="mx-1">
                        <a href="{{ $listings->url($last) }}" class="page-link-custom">
                            {{ $last }}
                        </a>
                    </li>
                @endif

                {{-- Next --}}
                <li class="mx-1 {{ !$listings->hasMorePages() ? 'disabled' : '' }}">
                    <a href="{{ $listings->nextPageUrl() ?? 'javascript:void(0)' }}"
                       class="page-link-custom">
                        Next <i class="fa fa-angle-right"></i>
                    </a>
                </li>

                {{-- Last --}}
                <li class="mx-1 {{ !$listings->hasMorePages() ? 'disabled' : '' }}">
                    <a href="{{ $listings->hasMorePages() ? $listings->url($last) : 'javascript:void(0)' }}"
                       class="page-link-custom">
                        Last <i class="fa fa-angle-double-right"></i>
                    </a>
                </li>

            </ul>

            {{-- Page Info --}}
            <div class="text-center mt-2 mb-5 col-sm-12 page-info">
                Page {{ $current }} of {{ $last }} |
                Showing {{ $listings->firstItem() }} to {{ $listings->lastItem() }}
                of {{ $listings->total() }} Listings
            </div>

        </nav>
    </div>
</div>
@endif
