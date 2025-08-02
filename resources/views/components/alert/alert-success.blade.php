@props(['message' => session('success')])

@if ($message)
    <div class="rounded-xl border p-4 border-green-500/30 bg-green-500/15 mb-4 animate-pulse">
        <div class="flex items-start gap-3">
            <div class="-mt-0.5 text-green-500">
                <i class="fa-regular fa-circle-check"></i>
            </div>

            <div>
                <p class="text-sm font-medium text-white/90">
                    {{ $message }}
                </p>
            </div>
        </div>
    </div>
@endif