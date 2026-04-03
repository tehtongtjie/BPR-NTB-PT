@if ($errors->any())
    <div class="rounded-2xl border border-red-200 bg-red-50/70 px-4 py-3 text-sm text-red-700">
        <p class="font-semibold">Ada beberapa kesalahan input:</p>
        <ul class="mt-2 list-disc space-y-1 pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
