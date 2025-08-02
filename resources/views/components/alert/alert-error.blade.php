@props(['message' => session('error')])

@if ($message)
    <div class="rounded-xl border p-4 border-red-500/30 bg-red-500/15 mb-4">
        <div class="flex items-start gap-3">
            <div class="-mt-0.5 text-red-500">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>

            <div>
                <p class="text-sm font-medium text-white/90">
                    {{ $message }}
                </p>
            </div>
        </div>
    </div>
@endif