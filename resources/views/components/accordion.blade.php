@props(['title'])

<div x-data="{ open: false }" class="border border-gray-700 rounded-md overflow-hidden">
    <!-- Header -->
    <button @click="open = !open"
        class="w-full text-left px-4 py-3 bg-gray-800 hover:bg-gray-700 transition-all flex items-center justify-between">
        <span class="text-white font-medium">{{ $title }}</span>
        <svg :class="open ? 'rotate-180' : ''" class="w-5 h-5 text-gray-300 transition-transform duration-300"
            fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
        </svg>
    </button>

    <!-- Content -->
    <div x-show="open" x-collapse x-cloak class="px-4 py-3 text-white bg-gray-800 border-t border-gray-700">
        {{ $slot }}
    </div>
</div>
