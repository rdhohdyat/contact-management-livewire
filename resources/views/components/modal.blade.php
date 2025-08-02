<div x-data="{ 
    isOpen: false, 
    modalType: '',
    modalTitle: '',
    modalMessage: '',
    modalIcon: '',
    modalIconColor: '',
    confirmCallback: null,
    
    openModal(type, title = '', message = '', icon = '', iconColor = '', callback = null) {
        this.modalType = type;
        this.modalTitle = title;
        this.modalMessage = message;
        this.modalIcon = icon;
        this.modalIconColor = iconColor;
        this.confirmCallback = callback;
        this.isOpen = true;
        document.body.style.overflow = 'hidden';
    },
    
    closeModal() {
        this.isOpen = false;
        this.modalType = '';
        document.body.style.overflow = 'auto';
    },
    
    handleConfirm() {
        if (this.confirmCallback && typeof this.confirmCallback === 'function') {
            this.confirmCallback();
        }
        this.closeModal();
    }
}" @keydown.escape.window="isOpen && closeModal()"
    @open-modal.window="openModal($event.detail.type, $event.detail.title, $event.detail.message, $event.detail.icon, $event.detail.iconColor, $event.detail.callback)">

    <audio id="successSound" src="{{ asset('sounds/success.mp3') }}" preload="auto"></audio>
    <audio id="confirmSound" src="{{ asset('sounds/confirm.mp3') }}" preload="auto"></audio>
    <audio id="errorSound" src="{{ asset('sounds/error.mp3') }}" preload="auto"></audio>

    <!-- Modal Backdrop & Container -->
    <div x-show="isOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/40 backdrop-blur-sm"
        @click.self="closeModal()">

        <div x-show="isOpen" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform scale-90"
            x-transition:enter-end="opacity-100 transform scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-90"
            class="bg-gray-800 rounded-xl shadow-xl w-full max-w-md transition-all" @click.stop>

            <!-- Confirmation/Alert Modal -->
            <div x-show="modalType === 'confirm' || modalType === 'alert'">
                <div class="p-6 text-center">
                    <div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4"
                        :class="modalIconColor">
                        <i :class="modalIcon + ' text-2xl text-white'"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-2" x-text="modalTitle"></h3>
                    <p class="text-gray-300 mb-6" x-text="modalMessage"></p>
                    <div class="flex space-x-3 justify-center">
                        <template x-if="modalType === 'confirm'">
                            <div class="flex space-x-3">
                                <button @click="closeModal()"
                                    class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 transition-all duration-200 font-medium">
                                    Cancel
                                </button>
                                <button @click="handleConfirm()"
                                    class="px-4 py-2 bg-gradient-to-r from-red-600 to-red-500 text-white rounded-lg hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-red-500 transition-all duration-200 font-medium">
                                    Confirm
                                </button>
                            </div>
                        </template>
                        <template x-if="modalType === 'alert'">
                            <button @click="handleConfirm()"
                                class="px-6 py-2 bg-gradient text-white rounded-lg hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200 font-medium">
                                OK
                            </button>
                        </template>
                    </div>
                </div>
            </div>
            <!-- Custom Content Modal -->
            <div x-show="modalType === 'custom'">
                <div class="flex items-center justify-between mb-4 border-b border-gray-700 p-6">
                    <h3 class="text-xl font-semibold text-white" x-text="modalTitle"></h3>
                    <button @click="closeModal()"
                        class="inline-flex items-center justify-center rounded-md text-gray-400 hover:border border-gray-700 hover:text-gray-300 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-gray-700 w-8 h-8 transition-all duration-200">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="p-6">
                    <div class="modal-content">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    window.openConfirmModal = function (title, message, callback) {
        window.dispatchEvent(new CustomEvent('open-modal', {
            detail: {
                type: 'confirm',
                title: title,
                message: message,
                icon: 'fas fa-exclamation-triangle',
                iconColor: 'bg-red-500',
                callback: callback
            }
        }));
    };

    window.openModal = function (title, message, callback) {
        window.dispatchEvent(new CustomEvent('open-modal', {
            detail: {
                type: 'custom',
                title: title,
                message: message
            }
        }));
    };

    window.openAlertModal = function (title, message, type = 'info', callback = null) {
        let icon = 'fas fa-info-circle';
        let iconColor = 'bg-blue-500';

        switch (type) {
            case 'success':
                icon = 'fas fa-check-circle';
                iconColor = 'bg-green-500';
                break;
            case 'error':
                icon = 'fas fa-times-circle';
                iconColor = 'bg-red-500';
                break;
            case 'warning':
                icon = 'fas fa-exclamation-triangle';
                iconColor = 'bg-yellow-500';
                break;
        }

        window.dispatchEvent(new CustomEvent('open-modal', {
            detail: {
                type: 'alert',
                title: title,
                message: message,
                icon: icon,
                iconColor: iconColor,
                callback: callback
            }
        }));
    };
</script>