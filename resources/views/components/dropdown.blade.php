@props([
    'align' => 'right',
])

@php
$alignmentClasses = [
    'left' => 'origin-top-left left-0',
    'right' => 'origin-top-right right-0',
][$align] ?? 'origin-top-right right-0';
@endphp

<div x-data="{ open: false }" class="relative inline-block text-left">
    <!-- Trigger -->
    <div @click="open = !open" @click.away="open = false" @keydown.escape.window="open = false">
        {{ $trigger }}
    </div>

    <!-- Menu -->
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="absolute z-50 mt-2 w-40 rounded-md shadow-lg bg-gray-800 bordre border-gray-700 focus:outline-none"
        :class="'{{ $alignmentClasses }}'"
        style="display: none;"
    >
        <div class="py-1">
            {{ $slot }}
        </div>
    </div>
</div>
