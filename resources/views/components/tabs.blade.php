@props(['tabs'])

<div x-data="{ activeTab: '{{ $tabs[0]['key'] ?? '' }}' }">
    <div class="flex border-b border-gray-700 mb-4">
        @foreach ($tabs as $tab)
            <button @click="activeTab = '{{ $tab['key'] }}'" :class="activeTab === '{{ $tab['key'] }}'
                        ? 'border-b-2 border-green-500 text-white'
                        : 'text-gray-400 hover:text-white'" class="px-4 py-2 max-h-[40px] text-sm font-medium transition-all">
                {{ $tab['label'] }}
            </button>
        @endforeach
    </div>

    @foreach ($tabs as $tab)
        <div class="text-white" x-show="activeTab === '{{ $tab['key'] }}'" x-cloak>
            {{ ${$tab['key']} ?? '' }}
        </div>
    @endforeach
</div>