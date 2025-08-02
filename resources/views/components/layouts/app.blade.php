<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite('resources/css/app.css')
    @livewireStyles
</head>

<body class="bg-gradient-to-br from-gray-900 to-gray-800 min-h-screen flex flex-col hide-scrollbar">
    <!-- Global modal -->
    <x-modal>
        @yield('modalContent')
    </x-modal>

    <header class="bg-gradient shadow-lg">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a wire:navigate href="{{ route('dashboard') }}"
                class="flex items-center hover:opacity-90 transition-opacity duration-200">
                <i class="fas fa-address-book text-white text-2xl mr-3"></i>
                <div class="text-white font-bold text-xl">Contact Management</div>
            </a>
            <nav>
                <ul class="flex space-x-6">
                    <li>
                        <a wire:navigate href="{{ route('profile') }}"
                            class="text-gray-100 hover:text-white flex items-center transition-colors duration-200">
                            <i class="fas fa-user-circle mr-2"></i>
                            <span>Profile</span>
                        </a>
                    </li>
                    <li>
                        <x-logout-button />
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="container mx-auto px-4 py-8 flex-grow">
        {{ $slot }}

        <div class="mt-10 mb-6 text-center text-gray-400 text-sm animate-fade-in">
            <p>© 2025 Contact Management. All rights reserved.</p>
        </div>
    </main>

    @livewireScripts
    <script>
        window.addEventListener('show-alert', function (event) {
            const { title, message, type, redirect } = event.detail[0];

            window.openAlertModal(
                title,
                message,
                type,
                () => {
                    if (redirect) {
                        window.location.href = redirect;
                    }
                }
            );
        });

        function playSound(audioId) {
            const audio = document.getElementById(audioId);
            if (audio) {
                audio.pause();
                audio.currentTime = 0;
                audio.play().catch(() => { });
            }
        }

        Livewire.on('play-success-sound', () => playSound('successSound'));
        Livewire.on('play-confirm-sound', () => playSound('confirmSound'));
        Livewire.on('play-error-sound', () => playSound('errorSound'));
    </script>
</body>

</html>