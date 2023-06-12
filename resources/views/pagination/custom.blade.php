<div class="custom-pagination">
    <ul class="pagination">
        {{-- Botão Anterior --}}
        @if ($paginator->onFirstPage())
            <li class="disabled" aria-disabled="true">
                <span aria-hidden="true">Anterior</span>
            </li>
        @else
            <li>
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev">Anterior</a>
            </li>
        @endif

        {{-- Números de Página --}}
        @foreach ($elements as $element)
            {{-- "Três Pontos" --}}
            @if (is_string($element))
                <li class="number disabled" aria-disabled="true"><span>{{ $element }}</span></li>
            @endif

            {{-- Links de Página Atual --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="number active" aria-current="page"><span>{{ $page }}</span></li>
                    @else
                        <li class="number" ><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Botão Próximo --}}
        @if ($paginator->hasMorePages())
            <li>
                <a href="{{ $paginator->nextPageUrl() }}" rel="next">Próximo</a>
            </li>
        @else
            <li class="disabled" aria-disabled="true">
                <span aria-hidden="true">Próximo</span>
            </li>
        @endif
    </ul>
</div>
