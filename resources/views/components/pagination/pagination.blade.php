
<div class="pagination d-flex">
    <div class="paginations d-flex">
        <a class="paginations-arrow paginations-arrow--prev" href="{{$paginator->previousPageUrl()}}"></a>



        @if ($paginator->lastPage() > 5)

            @if ($paginator->currentPage() >= 4)
                <a class="pagination__numbers" href="{{$paginator->url(1)}}">1</a>
                <div class="pagination__block-dot d-flex">
                    <span class="pagination__dot">.</span>
                    <span class="pagination__dot">.</span>
                    <span class="pagination__dot">.</span>
                </div>
            @endif

            @if ($paginator->currentPage() < 4)
                @for ($i = 1; $i < 5; $i++)
                    <a class="pagination__numbers @if($paginator->currentPage() == $i) active @endif" href="{{$paginator->url($i)}}">{{ $i }}</a>
                @endfor
            @else

                    @for ($i = $paginator->currentPage()-2; $i <= $paginator->currentPage()+2; $i++)
                        @if ($paginator->lastPage() < $i)
                            @break
                        @endif

                        <a class="pagination__numbers @if($paginator->currentPage() == $i) active @endif" href="{{$paginator->url($i)}}">{{ $i }}</a>
                    @endfor

            @endif

            @if ($paginator->lastPage() > $paginator->currentPage() + 2)
                <span class="pagination__block-dot d-flex">
                    ...
                </span>
                <a class="pagination__numbers" href="{{$paginator->url($paginator->lastPage())}}">{{$paginator->lastPage()}}</a>
            @endif

        @else
            @for ($i = 1; $i <= $paginator->lastPage(); $i++)
                <a class="pagination__numbers @if($paginator->currentPage() == $i) active @endif" href="{{$paginator->url($i)}}">{{ $i }}</a>
            @endfor
        @endif


        <a class="paginations-arrow paginations-arrow--next" href="{{$paginator->nextPageUrl()}}"></a>


    </div>
</div>
