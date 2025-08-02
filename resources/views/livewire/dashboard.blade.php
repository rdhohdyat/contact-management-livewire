<div>
    <div class="flex items-center justify-between mb-6">
        <div>
            <i class="fas fa-users text-blue-400 text-2xl mr-3"></i>
            <h1 class="text-2xl font-bold text-white">My Contacts</h1>
        </div>
    </div>

    <div class="bg-gray-800 bg-opacity-80 rounded-xl shadow-custom border border-gray-700 p-6 mb-8 animate-fade-in"
        x-data="{ isOpen: true }">
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center">
                <i class="fas fa-search text-blue-400 mr-3"></i>
                <h2 class="text-xl font-semibold text-white">Search Contacts</h2>
            </div>
            <div class="flex items-center space-x-2">
                <button type="button" @click="isOpen = !isOpen"
                    class="text-gray-300 hover:text-white hover:bg-gray-700 p-2 rounded-full focus:outline-none transition-all duration-200">
                    <i class="fas text-lg transition-transform duration-200"
                        :class="isOpen ? 'fa-chevron-up' : 'fa-chevron-down'" x-transition></i>
                </button>
            </div>
        </div>
        <div x-show="isOpen" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform -translate-y-2"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform translate-y-0"
            x-transition:leave-end="opacity-0 transform -translate-y-2" class="mt-4">
            <form wire:submit.prevent="search">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    <div>
                        <label for="search_name" class="block text-gray-300 text-sm font-medium mb-2">Name</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-user text-gray-500"></i>
                            </div>
                            <input type="text" id="search_name" wire:model.defer="search_name"
                                class="w-full pl-10 pr-3 py-3 bg-gray-700 bg-opacity-50 border border-gray-600 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                placeholder="Search by name">
                        </div>
                    </div>
                    <div>
                        <label for="search_email" class="block text-gray-300 text-sm font-medium mb-2">Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-500"></i>
                            </div>
                            <input type="text" id="search_email" wire:model.defer="search_email"
                                class="w-full pl-10 pr-3 py-3 bg-gray-700 bg-opacity-50 border border-gray-600 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                placeholder="Search by email">
                        </div>
                    </div>
                    <div>
                        <label for="search_phone" class="block text-gray-300 text-sm font-medium mb-2">Phone</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-phone text-gray-500"></i>
                            </div>
                            <input type="text" id="search_phone" wire:model.defer="search_phone"
                                class="w-full pl-10 pr-3 py-3 bg-gray-700 bg-opacity-50 border border-gray-600 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                placeholder="Search by phone">
                        </div>
                    </div>
                </div>
                <div class="mt-5 flex justify-between items-center">
                    <div class="text-sm text-gray-400">
                    </div>
                    <div class="flex space-x-3">
                        <button type="button" wire:click="clearFilters"
                            class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition-all duration-200 font-medium">
                            <i class="fas fa-times mr-2"></i> Clear Filters
                        </button>
                        <button type="submit"
                            class="px-5 py-3 bg-gradient text-white rounded-lg hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition-all duration-200 font-medium shadow-lg transform hover:-translate-y-0.5">
                            <i class="fas fa-search mr-2"></i> Search
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div
            class="bg-gray-800 bg-opacity-80 rounded-xl shadow-custom overflow-hidden border-2 border-dashed border-gray-700 card-hover animate-fade-in">
            <a wire:navigate href="{{ route('create-contact') }}" class="block p-6 h-full">
                <div class="flex flex-col items-center justify-center h-full text-center">
                    <div
                        class="w-20 h-20 bg-gradient rounded-full flex items-center justify-center mb-5 shadow-lg transform transition-transform duration-300 hover:scale-110">
                        <i class="fas fa-user-plus text-3xl text-white"></i>
                    </div>
                    <h2 class="text-xl font-semibold text-white mb-3">Create New Contact</h2>
                    <p class="text-gray-300">Add a new contact to your list</p>
                </div>
            </a>
        </div>

        @forelse($contacts as $contact)
            <div
                class="bg-gray-800 bg-opacity-80 rounded-xl shadow-custom border border-gray-700 overflow-hidden card-hover animate-fade-in">
                <div class="p-6">
                    <a href="{{ route('detail-contact', ['id' => $contact->id]) }}"
                        class="block cursor-pointer hover:bg-gray-700 rounded-lg transition-all duration-200 p-3">
                        <div class="flex items-center mb-3">
                            <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center mr-3 shadow-md">
                                <i class="fas fa-user text-white"></i>
                            </div>
                            <h2 class="text-xl font-semibold text-white hover:text-blue-300 transition-colors duration-200">
                                {{ $contact->first_name }} {{ $contact->last_name }}
                            </h2>
                        </div>
                        <div class="space-y-3 text-gray-300 ml-2">
                            <p class="flex items-center">
                                <i class="fas fa-user-tag text-gray-500 w-6"></i>
                                <span class="font-medium w-24">First Name:</span>
                                <span>{{$contact->first_name}}</span>
                            </p>
                            <p class="flex items-center">
                                <i class="fas fa-user-tag text-gray-500 w-6"></i>
                                <span class="font-medium w-24">Last Name:</span>
                                <span>{{$contact->last_name}}</span>
                            </p>
                            <p class="flex items-center">
                                <i class="fas fa-envelope text-gray-500 w-6"></i>
                                <span class="font-medium w-24">Email:</span>
                                <span>{{ $contact->email }}</span>
                            </p>
                            <p class="flex items-center">
                                <i class="fas fa-phone text-gray-500 w-6"></i>
                                <span class="font-medium w-24">Phone:</span>
                                <span>{{ $contact->phone }}</span>
                            </p>
                        </div>
                    </a>
                    <div class="mt-4 flex justify-end space-x-3">
                        <a href="{{ route('edit-contact', ['id' => $contact->id]) }}"
                            class="px-4 py-2 bg-gradient text-white rounded-lg hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition-all duration-200 font-medium shadow-md flex items-center">
                            <i class="fas fa-edit mr-2"></i> Edit
                        </a>
                        <button onclick="confirmDelete({{ $contact->id }})"
                            class="px-4 py-2 bg-gradient-to-r from-red-600 to-red-500 text-white rounded-lg hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition-all duration-200 font-medium shadow-md flex items-center">
                            <i class="fas fa-trash-alt mr-2"></i> Delete
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center text-gray-400 py-12 col-span-full">
                <div class="flex justify-center mb-4">
                    <div class="bg-gray-700 rounded-full p-4">
                        <i class="fas fa-search text-3xl text-gray-500"></i>
                        <i class="fas fa-address-book text-3xl text-gray-500"></i>
                    </div>
                </div>
                <h2 class="text-lg font-semibold text-white mb-2">No Results Found</h2>
                <p class="text-gray-400 mb-4">Try adjusting your search criteria.</p>
                <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-500 transition-all duration-200">
                    Clear Filters
                </button>
                <h2 class="text-lg font-semibold text-white mb-2">Belum Ada Kontak</h2>
                <p class="text-gray-400 mb-4">Kontak yang kamu tambahkan akan muncul di sini.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-10 flex justify-center">
        @if ($contacts->hasPages())
            <div class="mt-10 flex justify-center">
                <nav
                    class="flex items-center space-x-3 bg-gray-800 bg-opacity-80 rounded-xl shadow-custom border border-gray-700 p-3 animate-fade-in">
                    {{-- Previous --}}
                    @if ($contacts->onFirstPage())
                        <span class="px-4 py-2 bg-gray-600 text-gray-500 rounded-lg cursor-not-allowed flex items-center">
                            <i class="fas fa-chevron-left mr-2"></i> Previous
                        </span>
                    @else
                        <button wire:click="previousPage"
                            class="px-4 py-2 bg-gray-700 text-gray-300 rounded-lg hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200 flex items-center">
                            <i class="fas fa-chevron-left mr-2"></i> Previous
                        </button>
                    @endif

                    {{-- Pages --}}
                    @for($i = 1; $i <= $contacts->lastPage(); $i++)
                        @if($i == $contacts->currentPage())
                            <span class="px-4 py-2 bg-gradient text-white rounded-lg font-medium shadow-md">{{ $i }}</span>
                        @else
                            <button wire:click="gotoPage({{ $i }})"
                                class="px-4 py-2 bg-gray-700 text-gray-300 rounded-lg hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200">{{ $i }}</button>
                        @endif
                    @endfor

                    {{-- Next --}}
                    @if ($contacts->hasMorePages())
                        <button wire:click="nextPage"
                            class="px-4 py-2 bg-gray-700 text-gray-300 rounded-lg hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200 flex items-center">
                            Next <i class="fas fa-chevron-right ml-2"></i>
                        </button>
                    @else
                        <span class="px-4 py-2 bg-gray-600 text-gray-500 rounded-lg cursor-not-allowed flex items-center">
                            Next <i class="fas fa-chevron-right ml-2"></i>
                        </span>
                    @endif
                </nav>
            </div>
        @endif
    </div>
</div>
<script>
    function confirmDelete(contactId) {
        Livewire.dispatch('play-confirm-sound');

        window.openConfirmModal(
            'Peringatan?',
            'Apakah Anda yakin ingin menghapus contact ini?',
            () => {
                Livewire.dispatch('deleteContact', { id: contactId });
            }
        );
    }
</script>