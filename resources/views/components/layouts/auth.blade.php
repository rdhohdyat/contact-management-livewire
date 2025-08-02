<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di Contact Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite('resources/css/app.css')
    @livewireStyles
</head>

<body class="bg-gradient-to-br from-gray-900 to-gray-800 min-h-screen flex items-center justify-center p-4">
    <x-modal />

    {{ $slot }}

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