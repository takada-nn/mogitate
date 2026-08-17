@if ($paginator->hasPages())
    <nav>
        <ul>
            {{-- 前のページ --}}
            @if ($paginator->onFirstPage())
                <li>
                    <span class="disabled">&lt;</span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}">&lt;</a>
                </li>
            @endif

            {{-- ページ番号 --}}
            @foreach ($elements as $element)
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li>
                                <span class="current">{{ $page }}</span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- 次のページ --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}">&gt;</a>
                </li>
            @else
                <li>
                    <span>&gt;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif