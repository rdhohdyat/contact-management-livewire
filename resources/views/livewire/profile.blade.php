<div>
    <div class="flex items-center mb-6">
        <i class="fas fa-user-cog text-blue-400 text-2xl mr-3"></i>
        <h1 class="text-2xl font-bold text-white">My Profile</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div
            class="bg-gray-800 bg-opacity-80 rounded-xl shadow-custom border border-gray-700 overflow-hidden card-hover animate-fade-in">
            <div class="p-6">
                <div class="flex items-center mb-4">
                    <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center mr-3 shadow-md">
                        <i class="fas fa-user-edit text-white"></i>
                    </div>
                    <h2 class="text-xl font-semibold text-white">Edit Profile</h2>
                </div>
                <form wire:submit.prevent>
                    <div class="mb-5">
                        <label for="name" class="block text-gray-300 text-sm font-medium mb-2">Full Name</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-user text-gray-500"></i>
                            </div>
                            <input wire:model="name" type="text" id="name" name="name"
                                class="{{ $errors->has('name') ? 'input-error' : 'input' }}"
                                placeholder="Enter your full name">
                        </div>
                        @error('name')
                            <span class="input-error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mt-6">
                        <button onclick="confirmEditProfile()" type="button"
                            class="w-full bg-gradient text-white py-3 px-4 rounded-lg hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition-all duration-200 font-medium shadow-lg transform hover:-translate-y-0.5 flex items-center justify-center">
                            <i class="fas fa-save mr-2"></i> Update Profile
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Form 2: Edit Password -->
        <div
            class="bg-gray-800 bg-opacity-80 rounded-xl shadow-custom border border-gray-700 overflow-hidden card-hover animate-fade-in">
            <div class="p-6">
                <div class="flex items-center mb-4">
                    <div class="w-10 h-10 bg-purple-500 rounded-full flex items-center justify-center mr-3 shadow-md">
                        <i class="fas fa-key text-white"></i>
                    </div>
                    <h2 class="text-xl font-semibold text-white">Change Password</h2>
                </div>
                <form wire:submit.prevent>
                    <div class="mb-5">
                        <label for="new_password" class="block text-gray-300 text-sm font-medium mb-2">New
                            Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-500"></i>
                            </div>
                            <input wire:model="password" type="password" id="new_password" name="new_password"
                                class="{{ $errors->has('password') ? 'input-error' : 'input' }}"
                                placeholder="Enter your new password">
                        </div>
                        @error('password')
                            <span class="input-error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="confirm_password" class="block text-gray-300 text-sm font-medium mb-2">Confirm New
                            Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-check-double text-gray-500"></i>
                            </div>
                            <input wire:model="confirm_password" type="password" id="confirm_password"
                                name="confirm_password"
                                class="{{ $errors->has('confirm_password') ? 'input-error' : 'input' }}"
                                placeholder="Confirm your new password">
                        </div>
                        @error('confirm_password')
                            <span class="input-error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mt-6">
                        <button onclick="confirmEditPassword()" type="button"
                            class="w-full bg-gradient text-white py-3 px-4 rounded-lg hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition-all duration-200 font-medium shadow-lg transform hover:-translate-y-0.5 flex items-center justify-center">
                            <i class="fas fa-key mr-2"></i> Update Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function confirmEditProfile() {
        window.openConfirmModal(
            'Simpan Perubahan?',
            'Apakah Anda yakin ingin menyimpan perubahan pada profile?',
            () => {
                Livewire.dispatch('triggerUpdateProfile');
            }
        );
    }

    function confirmEditPassword() {
        window.openConfirmModal(
            'Ganti Password?',
            'Apakah Anda yakin ingin mengganti password anda?',
            () => {
                Livewire.dispatch('triggerUpdatePassword');
            }
        );
    }
</script>