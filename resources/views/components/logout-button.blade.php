<form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
    @csrf
</form>

<button onclick="confirmLogout()"
    class="text-gray-100 hover:text-white flex items-center transition-colors duration-200 cursor-pointer">
    <i class="fas fa-sign-out-alt mr-2"></i>
    <span>Logout</span>
</button>

<script>
    function confirmLogout() {
        Livewire.dispatch("play-confirm-sound");

        openConfirmModal(
            'Peringatan!',
            'Apakah Anda yakin ingin keluar dari aplikasi?',
            function () {
                document.getElementById('logout-form').submit();
            }
        );
    }
</script>