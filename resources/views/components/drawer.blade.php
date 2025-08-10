<div x-data="{
    isOpen: false,
    drawerDirection: 'right',
    drawerTitle: '',
    isVisible: false,
    transformClass: '',

    openDrawer(direction = 'right', title = '') {
        this.drawerDirection = direction;
        this.drawerTitle = title;
        document.body.style.overflow = 'hidden';
        this.transformClass = this.getEnterTransform();
        this.isOpen = true;

        this.$nextTick(() => {
            requestAnimationFrame(() => {
                this.isVisible = true;
                this.transformClass = '';
            });
        });
    },

    closeDrawer() {
        this.isVisible = false;
        this.transformClass = this.getEnterTransform();

        setTimeout(() => {
            this.isOpen = false;
            document.body.style.overflow = 'auto';
            this.transformClass = '';
        }, 300);
    },

    getDrawerClasses() {
        const base = 'fixed bg-gray-800 shadow-2xl border border-gray-700 drawer-transition';
        switch (this.drawerDirection) {
            case 'left': return `${base} left-0 top-0 h-full border-r`;
            case 'right': return `${base} right-0 top-0 h-full border-l`;
            case 'top': return `${base} top-0 left-0 w-full border-b`;
            case 'bottom': return `${base} bottom-0 left-0 w-full border-t`;
            default: return `${base} right-0 top-0 h-full border-l`;
        }
    },

    getEnterTransform() {
        switch (this.drawerDirection) {
            case 'left': return 'transform -translate-x-full';
            case 'right': return 'transform translate-x-full';
            case 'top': return 'transform -translate-y-full';
            case 'bottom': return 'transform translate-y-full';
            default: return 'transform translate-x-full';
        }
    }
}" @keydown.escape.window="isOpen && closeDrawer()"
    @open-drawer.window="openDrawer($event.detail.direction, $event.detail.title)">

    <!-- Backdrop -->
    <div x-show="isOpen" x-cloak x-transition.opacity.duration.300
        class="fixed inset-0 z-40 bg-black/40 backdrop-blur-sm" @click="closeDrawer()">
    </div>

    <!-- Drawer -->
    <div x-show="isOpen" x-cloak
        :class="getDrawerClasses() + ' z-50 transform transition-transform duration-300 ease-out ' + transformClass + (drawerDirection === 'top' || drawerDirection === 'bottom' ? ' w-full' : ' w-full sm:max-w-sm md:max-w-md lg:max-w-lg xl:max-w-xl')"
        :style="isVisible ? 'transform: translateX(0) translateY(0);' : ''">

        <!-- Header -->
        <div class="flex items-center justify-between p-4 pb-3 border-b border-gray-700 sticky top-0 z-10 bg-gray-800">
            <h3 class="text-lg font-semibold text-white" x-text="drawerTitle || 'Drawer'"></h3>
            <button @click="closeDrawer()"
                class="text-gray-400 hover:text-gray-300 hover:bg-gray-800 rounded w-8 h-8 flex items-center justify-center">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Content -->
        <div class="drawer-content flex-1 overflow-y-auto p-4 drawer-scroll">
            {{ $slot }}
        </div>
    </div>
</div>

<style>
    [x-cloak] {
        display: none !important;
    }

    .drawer-transition {
        will-change: transform;
    }

    .drawer-scroll {
        scrollbar-width: thin;
        scrollbar-color: #6b7280 #374151;
        scroll-behavior: smooth;
    }

    .drawer-scroll::-webkit-scrollbar {
        width: 6px;
    }

    .drawer-scroll::-webkit-scrollbar-track {
        background: #374151;
    }

    .drawer-scroll::-webkit-scrollbar-thumb {
        background: #6b7280;
        border-radius: 3px;
    }

    .drawer-scroll::-webkit-scrollbar-thumb:hover {
        background: #9ca3af;
    }
</style>

<script>
    window.openDrawer = function (direction = 'right', title = '') {
        window.dispatchEvent(new CustomEvent('open-drawer', {
            detail: { direction, title }
        }));
    };

    window.closeDrawer = function () {
        const el = document.querySelector('[x-data*="isOpen"]');
        if (el) el._x_dataStack[0].closeDrawer();
    };
</script>