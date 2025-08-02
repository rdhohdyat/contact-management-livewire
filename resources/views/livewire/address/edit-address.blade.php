<div>
    <div class="flex flex-col gap-4  mb-6 max-w-2xl mx-auto">
        <a href="{{ route('detail-contact', $contactId) }}"
            class="text-blue-400 hover:text-blue-300 mr-4 flex items-center transition-colors duration-200">
            <i class="fas fa-arrow-left mr-2"></i> Back to Contact Details
        </a>
        <h1 class="text-2xl font-bold text-white flex items-center">
            <i class="fas fa-plus-circle text-blue-400 mr-3"></i> Add New Address
        </h1>
    </div>

    <div
        class="bg-gray-800 bg-opacity-80 rounded-xl shadow-custom border border-gray-700 overflow-hidden max-w-2xl mx-auto animate-fade-in">
        <div class="p-8">
            <!-- Contact Information -->
            <div class="mb-6 pb-6 border-b border-gray-700">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center mr-4 shadow-md">
                        <i class="fas fa-user text-white"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold text-white">{{ $contact->first_name }}
                            {{ $contact->last_name }}
                        </h2>
                        <p class="text-gray-300 text-sm">{{ $contact->email }} • {{ $contact->phone }}</p>
                    </div>
                </div>
            </div>

            <form wire:submit.prevent>
                <div class="mb-5">
                    <label for="street" class="block text-gray-300 text-sm font-medium mb-2">Street</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-road text-gray-500"></i>
                        </div>
                        <input wire:model="street" type="text" id="street" name="street"
                            class="{{ $errors->has('street') ? 'input-error' : 'input' }}"
                            placeholder="Enter street address">
                    </div>
                    @error('street')
                        <span class="input-error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                    <div>
                        <label for="city" class="block text-gray-300 text-sm font-medium mb-2">City</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-city text-gray-500"></i>
                            </div>
                            <input wire:model="city" type="text" id="city" name="city"
                                class="{{ $errors->has('city') ? 'input-error' : 'input' }}" placeholder="Enter city">
                        </div>
                        @error('city')
                            <span class="input-error-text">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="province"
                            class="block text-gray-300 text-sm font-medium mb-2">Province/State</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-map text-gray-500"></i>
                            </div>
                            <input wire:model="province" type="text" id="province" name="province"
                                class="{{ $errors->has('province') ? 'input-error' : 'input' }}"
                                placeholder="Enter province or state">
                        </div>
                        @error('province')
                            <span class="input-error-text">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-6">
                    <div>
                        <label for="country" class="block text-gray-300 text-sm font-medium mb-2">Country</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-flag text-gray-500"></i>
                            </div>
                            <input wire:model="country" type="text" id="country" name="country"
                                class="{{ $errors->has('country') ? 'input-error' : 'input' }}"
                                placeholder="Enter country">
                        </div>
                        @error('country')
                            <span class="input-error-text">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="postal_code" class="block text-gray-300 text-sm font-medium mb-2">Postal
                            Code</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-mail-bulk text-gray-500"></i>
                            </div>
                            <input wire:model="postal_code" type="text" id="postal_code" name="postal_code"
                                class="{{ $errors->has('postal_code') ? 'input-error' : 'input' }}"
                                placeholder="Enter postal code">
                        </div>
                        @error('postal_code')
                            <span class="input-error-text">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end space-x-4">
                    <a wire:navigate href="{{ route('detail-contact', ['id' => $contactId]) }}"
                        class="px-5 py-3 bg-gray-700 text-white rounded-lg hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition-all duration-200 flex items-center shadow-md">
                        <i class="fas fa-times mr-2"></i> Cancel
                    </a>
                    <button type="button" onclick="confirmEdit()" wire:loading.attr="disabled"
                        class="px-5 py-3 bg-gradient text-white rounded-lg hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition-all duration-200 font-medium shadow-lg transform hover:-translate-y-0.5 flex items-center">

                        <span wire:loading.remove>
                            <i class="fas fa-plus-circle mr-2"></i> Save Changes
                        </span>

                        <span wire:loading>
                            <i class="fas fa-spinner fa-spin mr-2"></i> Memproses...
                        </span>
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
            'Apakah Anda yakin ingin menyimpan perubahan data alamat ini?',
            () => {
                Livewire.dispatch('triggerSubmitEdit');
            }
        );
    }
</script>