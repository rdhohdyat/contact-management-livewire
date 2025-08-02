<div
    class="animate-fade-in bg-gray-800 bg-opacity-80 p-8 rounded-xl shadow-custom border border-gray-700 backdrop-blur-sm w-full max-w-md">
    <div class="text-center mb-8">
        <div class="inline-block p-3 bg-gradient rounded-full mb-4">
            <i class="fas fa-address-book text-3xl text-white"></i>
        </div>
        <h1 class="text-3xl font-bold text-white">Contact Management</h1>
        <p class="text-gray-300 mt-2">Sign in to your account</p>
    </div>

    <form wire:submit.prevent="login">
        <div class="mb-5">
            <label for="username" class="block text-gray-300 text-sm font-medium mb-2">Username</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-user text-gray-500"></i>
                </div>
                <input wire:model="username" type="text" id="username" name="username"
                    class="{{ $errors->has('username') ? 'input-error' : 'input' }}" placeholder="Enter your username">
            </div>
            @error('username')
                <span class="input-error-text">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-6">
            <label for="password" class="block text-gray-300 text-sm font-medium mb-2">Password</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-lock text-gray-500"></i>
                </div>
                <input wire:model="password" type="password" id="password" name="password"
                    class="{{ $errors->has('password') ? 'input-error' : 'input' }}" placeholder="Enter your password">
            </div>
            @error('password')
                <span class="input-error-text">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-6">
            <button type="submit" wire:loading.attr="disabled"
                class="w-full bg-gradient text-white py-3 px-4 rounded-lg hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition-all duration-200 font-medium shadow-lg transform hover:-translate-y-0.5">

                <span wire:loading.remove>
                    <i class="fas fa-sign-in-alt mr-2"></i>
                    Sign In
                </span>

                <span wire:loading>
                    <i class="fas fa-spinner fa-spin mr-2"></i> Memproses...
                </span>
            </button>
        </div>

        <div class="text-center text-sm text-gray-400">
            Don't have an account?
            <a wire:navigate href="{{ route('register') }}"
                class="text-blue-400 hover:text-blue-300 font-medium transition-colors duration-200">Sign up</a>
        </div>
    </form>
</div>