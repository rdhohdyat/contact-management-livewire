<div x-data="toastComponent()" x-ref="toastRoot" x-show="visible"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-y-2"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 translate-y-2"
    class="fixed top-4 left-4 right-4 lg:left-auto lg:right-4 lg:w-auto z-50"
    style="display: none;"
>
    <div
        x-bind:class="{
            'bg-green-600': type === 'success',
            'bg-red-600': type === 'error',
            'bg-yellow-500': type === 'warning',
            'bg-blue-600': type === 'info'
        }"
        class="px-4 py-3 w-full lg:w-md rounded h-[60px] shadow-lg text-white text-sm font-medium"
        x-text="message"
    ></div>
</div>

<script>
    function toastComponent() {
        return {
            visible: false,
            message: '',
            type: 'success',
            timeout: null,

            showToast(msg, kind = 'success') {
                this.message = msg;
                this.type = kind;
                this.visible = true;

                clearTimeout(this.timeout);
                this.timeout = setTimeout(() => {
                    this.visible = false;
                }, 3000);
            },

            init() {
                window.toast = (msg, kind = 'success') => this.showToast(msg, kind);
            }
        };
    }
</script>
