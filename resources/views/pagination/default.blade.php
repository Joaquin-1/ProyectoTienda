@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="mt-4 mx-8 relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-green-200 border-gray-300 cursor-default leading-5 rounded-md" aria-disabled="true" aria-label="pagination navigation previous">
                {!! __('&laquo; Previous') !!}
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="mt-4 mx-8 relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-700 bg-green-200 border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150" aria-label="pagination navigation previous">
                {!! __('&laquo; Previous') !!}
            </a>
        @endif

        {{-- Pagination Elements --}}
        <div class="flex">
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md" aria-disabled="true">
                        {{ $element }}
                    </span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span aria-current="page" class="mx-2 mt-4 relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-orange-200 border border-gray-300 cursor-default leading-5 rounded-md">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" class="mx-2 mt-4 relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="mt-4 mx-8 relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-700 bg-green-200 border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150" aria-label="pagination navigation next">
                {!! __('Next &raquo;') !!}
            </a>
        @else
            <span class="mt-4 mx-8 relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-green-200 border border-gray-300 cursor-default leading-5 rounded-md" aria-disabled="true" aria-label="pagination navigation next">
                {!! __('Next &raquo;') !!}
            </span>
        @endif
    </nav>
@endif
