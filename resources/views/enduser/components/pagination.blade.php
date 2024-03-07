@if($pagination -> hasPages())
    <div class="paginatoin-area">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <ul class="pagination-box">
                    <li class="page-item @if( $pagination -> onFirstPage()) disabled @endif">
                        <a class="page-link" href="{{ $pagination -> previousPageUrl() }}">Trước</a>
                    </li>
                    @for($i = 1; $i <= $pagination -> lastPage(); ++$i)
                        <li class="@if($i == $pagination -> currentPage()) active @endif">
                            <a href="{{ $pagination -> url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor
                    <li class="page-item @if( $pagination -> currentPage() == $pagination -> lastPage()) disabled @endif">
                        <a class="page-link" href="{{ $pagination -> nextPageUrl() }}">Sau</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endif
