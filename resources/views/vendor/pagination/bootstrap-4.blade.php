@if ($paginator->hasPages())
    <ul class="pagination" role="navigation">

        <?php
            $start = $paginator->currentPage() - 1; // show 3 pagination links before current
            $end = $paginator->currentPage() + 1; // show 3 pagination links after current
            if($start < 1) {
                $start = 1; // reset start to 1
                $end += 1;
            }
            if($end >= $paginator->lastPage() ) $end = $paginator->lastPage(); // reset end to last page
        ?>

        {{-- First Page Link --}}
        @if ($paginator->currentPage() == 1)
            <li class="page-item disabled">
                <span class="page-link" style="background-color: #e9ecef">
                    <i class="fas fa-angle-double-left"></i>
                </span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->url(1) }}">
                    <i class="fas fa-angle-double-left"></i>
                </a>
            </li>
        @endif

        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span class="page-link" aria-hidden="true" style="background-color: #e9ecef">
                    <i class="fas fa-angle-left"></i>
                </span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
                    <i class="fas fa-angle-left"></i>
                </a>
            </li>
        @endif

        {{-- Pages Links --}}
        @for ($i = $start; $i <= $end; $i++)
            <li class="page-item {{ ($paginator->currentPage() == $i) ? ' active' : '' }}">
                <a class="page-link" href="{{ $paginator->url($i) }}">{{$i}}</a>
            </li>
        @endfor

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                    <i class="fas fa-angle-right"></i>
                </a>
            </li>
        @else
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span class="page-link" aria-hidden="true" style="background-color: #e9ecef">
                    <i class="fas fa-angle-right"></i>
                </span>
            </li>
        @endif

        {{-- Last Page Link --}}
        @if ($paginator->currentPage() == $paginator->lastPage())
            <li class="page-item disabled">
                <span class="page-link" style="background-color: #e9ecef">
                    <span class="fas fa-angle-double-right"></span>
                </span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}">
                    <span class="fas fa-angle-double-right"></span>
                </a>
            </li>
        @endif
    </ul>
@endif
