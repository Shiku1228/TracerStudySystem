@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between">
        <div class="flex justify-between flex-1 sm:hidden">
            @if ($paginator->onFirstPage())
                <span class="relative inline-flex items-center px-1.5 py-0.5 text-xs font-medium text-[#731820] bg-[#b97940]/15 border border-[#731820]/20 cursor-default leading-5 rounded-md dark:bg-[#040405] dark:border-[#731820]">
                    {!! __('pagination.previous') !!}
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="relative inline-flex items-center px-1.5 py-0.5 text-xs font-medium text-[#040405] bg-[#c0c0c0] border border-[#731820]/20 leading-5 rounded-md hover:text-[#731820] focus:outline-none focus:ring ring-[#731820] focus:border-[#731820] active:bg-[#b97940]/15 active:text-[#040405] transition ease-in-out duration-150 dark:bg-[#040405] dark:border-[#731820] dark:text-[#c0c0c0] dark:hover:text-[#b97940]">
                    {!! __('pagination.previous') !!}
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="relative inline-flex items-center px-1.5 py-0.5 ml-3 text-xs font-medium text-[#040405] bg-[#c0c0c0] border border-[#731820]/20 leading-5 rounded-md hover:text-[#731820] focus:outline-none focus:ring ring-[#731820] focus:border-[#731820] active:bg-[#b97940]/15 active:text-[#040405] transition ease-in-out duration-150 dark:bg-[#040405] dark:border-[#731820] dark:text-[#c0c0c0] dark:hover:text-[#b97940]">
                    {!! __('pagination.next') !!}
                </a>
            @else
                <span class="relative inline-flex items-center px-1.5 py-0.5 ml-3 text-xs font-medium text-[#731820] bg-[#b97940]/15 border border-[#731820]/20 cursor-default leading-5 rounded-md dark:bg-[#040405] dark:border-[#731820]">
                    {!! __('pagination.next') !!}
                </span>
            @endif
        </div>

        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-end">
            <div>
                <span class="relative z-0 inline-flex shadow-sm rounded-md">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                            <span class="relative inline-flex items-center px-1.5 py-0.5 text-xs font-medium text-[#731820] bg-[#b97940]/15 border border-[#731820]/20 cursor-default rounded-l-md leading-5 dark:bg-[#040405] dark:border-[#731820]" aria-hidden="true">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center px-1.5 py-0.5 text-xs font-medium text-[#040405] bg-[#c0c0c0] border border-[#731820]/20 rounded-l-md leading-5 hover:text-[#731820] focus:z-10 focus:outline-none focus:ring ring-[#731820] focus:border-[#731820] active:bg-[#b97940]/15 active:text-[#040405] transition ease-in-out duration-150 dark:bg-[#040405] dark:border-[#731820] dark:text-[#c0c0c0] dark:hover:text-[#b97940]" aria-label="{{ __('pagination.previous') }}">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span class="relative inline-flex items-center px-1.5 py-0.5 text-xs font-medium text-[#040405] bg-[#c0c0c0] border border-[#731820]/20 cursor-default leading-5 dark:bg-[#040405] dark:border-[#731820] dark:text-[#c0c0c0]">{{ $element }}</span>
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page">
                                        <span class="relative inline-flex items-center px-1.5 py-0.5 text-xs font-medium text-[#c0c0c0] bg-[#731820] border border-[#731820] cursor-default leading-5 dark:bg-[#731820] dark:border-[#731820] dark:text-[#c0c0c0]">{{ $page }}</span>
                                    </span>
                                @else
                                    <a href="{{ $url }}" class="relative inline-flex items-center px-1.5 py-0.5 text-xs font-medium text-[#040405] bg-[#c0c0c0] border border-[#731820]/20 leading-5 hover:text-[#731820] focus:z-10 focus:outline-none focus:ring ring-[#731820] focus:border-[#731820] active:bg-[#b97940]/15 active:text-[#040405] transition ease-in-out duration-150 dark:bg-[#040405] dark:border-[#731820] dark:text-[#c0c0c0] dark:hover:text-[#b97940]" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="relative inline-flex items-center px-1.5 py-0.5 text-xs font-medium text-[#040405] bg-[#c0c0c0] border border-[#731820]/20 rounded-r-md leading-5 hover:text-[#731820] focus:z-10 focus:outline-none focus:ring ring-[#731820] focus:border-[#731820] active:bg-[#b97940]/15 active:text-[#040405] transition ease-in-out duration-150 dark:bg-[#040405] dark:border-[#731820] dark:text-[#c0c0c0] dark:hover:text-[#b97940]" aria-label="{{ __('pagination.next') }}">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    @else
                        <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                            <span class="relative inline-flex items-center px-1.5 py-0.5 text-xs font-medium text-[#731820] bg-[#b97940]/15 border border-[#731820]/20 cursor-default rounded-r-md leading-5 dark:bg-[#040405] dark:border-[#731820]" aria-hidden="true">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif
