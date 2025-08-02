@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-center">
        {{-- Mobile View --}}
        <div class="flex justify-between flex-1 sm:hidden">
            @if ($paginator->onFirstPage())
                <span class="px-4 py-2 bg-gray-600 text-gray-500 rounded-lg cursor-not-allowed flex items-center">
                    <i class="fas fa-chevron-left mr-2"></i> {{ __('pagination.previous') }}
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="px-4 py-2 bg-gray-700 text-gray-300 rounded-lg hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition-all duration-200 flex items-center">
                    <i class="fas fa-chevron-left mr-2"></i> {{ __('pagination.previous') }}
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="px-4 py-2 bg-gray-700 text-gray-300 rounded-lg hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition-all duration-200 flex items-center ml-3">
                    {{ __('pagination.next') }} <i class="fas fa-chevron-right ml-2"></i>
                </a>
            @else
                <span class="px-4 py-2 bg-gray-600 text-gray-500 rounded-lg cursor-not-allowed flex items-center ml-3">
                    {{ __('pagination.next') }} <i class="fas fa-chevron-right ml-2"></i>
                </span>
            @endif
        </div>

        {{-- Desktop View --}}
        <div class="hidden sm:flex sm:flex-col sm:items-center sm:justify-center">
            {{-- Results Info --}}
            <div class="mb-4">
                <p class="text-sm text-gray-300 leading-5">
                    {{ __('Showing') }}
                    @if ($paginator->firstItem())
                        <span class="font-medium text-white">{{ $paginator->firstItem() }}</span>
                        {{ __('to') }}
                        <span class="font-medium text-white">{{ $paginator->lastItem() }}</span>
                    @else
                        {{ $paginator->count() }}
                    @endif
                    {{ __('of') }}
                    <span class="font-medium text-white">{{ $paginator->total() }}</span>
                    {{ __('results') }}
                </p>
            </div>

            {{-- Pagination Links --}}
            <div class="flex items-center space-x-3 bg-gray-800 bg-opacity-80 rounded-xl shadow-custom border border-gray-700 p-3 animate-fade-in">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}" class="px-4 py-2 bg-gray-600 text-gray-500 rounded-lg cursor-not-allowed flex items-center">
                        <i class="fas fa-chevron-left mr-2"></i> Previous
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="px-4 py-2 bg-gray-700 text-gray-300 rounded-lg hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition-all duration-200 flex items-center" aria-label="{{ __('pagination.previous') }}">
                        <i class="fas fa-chevron-left mr-2"></i> Previous
                    </a>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <span aria-disabled="true" class="px-4 py-2 text-gray-500">
                            {{ $element }}
                        </span>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span aria-current="page" class="px-4 py-2 bg-gradient text-white rounded-lg hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition-all duration-200 font-medium shadow-md">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}" class="px-4 py-2 bg-gray-700 text-gray-300 rounded-lg hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition-all duration-200" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="px-4 py-2 bg-gray-700 text-gray-300 rounded-lg hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition-all duration-200 flex items-center" aria-label="{{ __('pagination.next') }}">
                        Next <i class="fas fa-chevron-right ml-2"></i>
                    </a>
                @else
                    <span aria-disabled="true" aria-label="{{ __('pagination.next') }}" class="px-4 py-2 bg-gray-600 text-gray-500 rounded-lg cursor-not-allowed flex items-center">
                        Next <i class="fas fa-chevron-right ml-2"></i>
                    </span>
                @endif
            </div>
        </div>
    </nav>
@endif