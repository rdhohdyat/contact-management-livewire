<div>
    <div class="flex flex-col gap-4  mb-6 max-w-2xl mx-auto">
        <a wire:navigate href="{{ route('dashboard') }}"
            class="text-blue-400 hover:text-blue-300 mr-4 flex items-center transition-colors duration-200">
            <i class="fas fa-arrow-left mr-2"></i> Back to Contacts
        </a>
        <h1 class="text-2xl font-bold text-white flex items-center">
            <i class="fas fa-user-edit text-blue-400 mr-3"></i> Edit Contact
        </h1>
    </div>

    <div
        class="bg-gray-800 bg-opacity-80 rounded-xl shadow-custom border border-gray-700 overflow-hidden max-w-2xl mx-auto animate-fade-in">
        <div class="p-8">
            <form wire:submit.prevent>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                    <div>
                        <label for="first_name" class="block text-gray-300 text-sm font-medium mb-2">First Name</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-user-tag text-gray-500"></i>
                            </div>
                            <input wire:model="first_name" type="text" id="first_name" name="first_name"
                                class="{{ $errors->has('first_name') ? 'input-error' : 'input' }}"
                                placeholder="Enter first name">
                        </div>
                        @error('first_name')
                            <span class="input-error-text">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="last_name" class="block text-gray-300 text-sm font-medium mb-2">Last Name</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-user-tag text-gray-500"></i>
                            </div>
                            <input wire:model="last_name" type="text" id="last_name" name="last_name"
                                class="{{ $errors->has('last_name') ? 'input-error' : 'input' }}"
                                placeholder="Enter last name">
                        </div>
                        @error('last_name')
                            <span class="input-error-text">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="mb-5">
                    <label for="email" class="block text-gray-300 text-sm font-medium mb-2">Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-500"></i>
                        </div>
                        <input wire:model="email" id="email" name="email"
                            class="{{ $errors->has('email') ? 'input-error' : 'input' }}"
                            placeholder="Enter email address">
                    </div>
                    @error('email')
                        <span class="input-error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="phone" class="block text-gray-300 text-sm font-medium mb-2">Phone</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-phone text-gray-500"></i>
                        </div>
                        <input wire:model="phone" id="phone" name="phone"
                            class="{{ $errors->has('phone') ? 'input-error' : 'input' }}"
                            placeholder="Enter phone number">
                    </div>
                    @error('phone')
                        <span class="input-error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex justify-end space-x-4">
                    <a wire:navigate href="{{ route('dashboard') }}"
                        class="px-5 py-3 bg-gray-700 text-white rounded-lg hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition-all duration-200 flex items-center shadow-md">
                        <i class="fas fa-times mr-2"></i> Cancel
                    </a>
                    <button onclick="confirmEdit()" type="button"
                        class="px-5 py-3 bg-gradient text-white rounded-lg hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition-all duration-200 font-medium shadow-lg transform hover:-translate-y-0.5 flex items-center">
                        <i class="fas fa-save mr-2"></i> Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function confirmEdit() {
        Livewire.dispatch('play-confirm-sound');
        
        window.openConfirmModal(
            'Simpan Perubahan?',
            'Apakah Anda yakin ingin menyimpan perubahan data kontak ini?',
            () => {
                Livewire.dispatch('triggerSubmitEdit');
            }
        );
    }
</script>