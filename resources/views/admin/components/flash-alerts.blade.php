@php
    $flashTypes = [
        'success' => ['bg' => 'bg-emerald-50', 'border' => 'border-emerald-200', 'text' => 'text-emerald-700', 'icon' => 'bi-check-circle'],
        'error'   => ['bg' => 'bg-rose-50', 'border' => 'border-rose-200', 'text' => 'text-rose-700', 'icon' => 'bi-x-circle'],
        'warning' => ['bg' => 'bg-amber-50', 'border' => 'border-amber-200', 'text' => 'text-amber-700', 'icon' => 'bi-exclamation-circle'],
        'info'    => ['bg' => 'bg-sky-50', 'border' => 'border-sky-200', 'text' => 'text-sky-700', 'icon' => 'bi-info-circle'],
    ];

    $message = null;
    $type = null;

    foreach ($flashTypes as $key => $_) {
        if (session()->has($key)) {
            $type = $key;
            $message = session($key);
            break;
        }
    }
@endphp

@if($message && $type)
    <div
        class="{{ $flashTypes[$type]['bg'] }} {{ $flashTypes[$type]['border'] }} border rounded-2xl px-4 py-3 text-sm {{ $flashTypes[$type]['text'] }} shadow-sm flex items-center gap-3"
        role="alert"
        data-flash
    >
        <i class="bi {{ $flashTypes[$type]['icon'] }} text-lg"></i>
        <span>{{ $message }}</span>
        <button type="button"
                class="ml-auto text-xs uppercase tracking-wider text-slate-500 hover:text-slate-700"
                onclick="this.closest('[data-flash]').style.display = 'none'">
            Tutup
        </button>
    </div>
@endif

@if($message && $type)
    <script>
        setTimeout(() => {
            const el = document.querySelector('[data-flash]');
            if (el) {
                el.style.transition = 'opacity .3s ease';
                el.style.opacity = '0';
                setTimeout(() => el.remove(), 300);
            }
        }, 3600);
    </script>
@endif
