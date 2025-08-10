@props(['href' => '#'])

<a href="{{ $href }}"
   {{ $attributes->merge(['class' => 'block px-4 py-2 text-sm text-gray-200 hover:bg-gray-700 transition-all']) }}>
    {{ $slot }}
</a>
