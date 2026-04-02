@props(['paginator'])

@if ($paginator->hasPages())
    <div class="mt-12 flex justify-center">
        <nav class="inline-flex gap-2 lg:gap-3 p-2 lg:p-3 bg-white rounded-2xl lg:rounded-3xl shadow-xl border border-slate-50">
            @if ($paginator->onFirstPage())
                <span class="w-10 lg:w-12 h-10 lg:h-12 flex items-center justify-center bg-slate-50 rounded-xl lg:rounded-2xl text-slate-400">
                    <i class="bi bi-chevron-left"></i>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                    class="w-10 lg:w-12 h-10 lg:h-12 flex items-center justify-center bg-slate-50 rounded-xl lg:rounded-2xl text-slate-400 hover:bg-[#fbbf24] hover:text-[#00326B] transition-all">
                    <i class="bi bi-chevron-left"></i>
                </a>
            @endif

            @foreach (range(1, $paginator->lastPage()) as $page)
                @php
                    $isActive = $paginator->currentPage() === $page;
                @endphp
                <a href="{{ $paginator->url($page) }}"
                    class="w-10 lg:w-12 h-10 lg:h-12 flex items-center justify-center rounded-xl lg:rounded-2xl font-black text-xs lg:text-sm transition-all {{ $isActive ? 'bg-[#00326B] text-white shadow-lg' : 'bg-slate-50 text-[#00326B] hover:bg-slate-100' }}">
                    {{ $page }}
                </a>
            @endforeach

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                    class="w-10 lg:w-12 h-10 lg:h-12 flex items-center justify-center bg-slate-50 rounded-xl lg:rounded-2xl text-slate-400 hover:bg-[#fbbf24] hover:text-[#00326B] transition-all">
                    <i class="bi bi-chevron-right"></i>
                </a>
            @else
                <span class="w-10 lg:w-12 h-10 lg:h-12 flex items-center justify-center bg-slate-50 rounded-xl lg:rounded-2xl text-slate-400">
                    <i class="bi bi-chevron-right"></i>
                </span>
            @endif
        </nav>
    </div>
@endif
