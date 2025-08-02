<div x-data="{ 
    isOpen: false, 
    drawerDirection: 'right',
    drawerTitle: '',
    drawerSize: 'md',
    isOpen: false,
    isVisible: false,
    transformClass: '',
    
    openDrawer(direction = 'right', title = '', size = 'md') {
        this.drawerDirection = direction;
        this.drawerTitle = title;
        this.drawerSize = size;
        
        document.body.style.overflow = 'hidden';

        this.transformClass = this.getEnterTransform(); // initial state
        this.isOpen = true;

        this.$nextTick(() => {
            requestAnimationFrame(() => {
                this.isVisible = true; // triggers smooth animation
                this.transformClass = ''; // back to neutral transform
            });
        });
    },

    closeDrawer() {
        this.isVisible = false;
        this.transformClass = this.getExitTransform();

        setTimeout(() => {
            this.isOpen = false;
            document.body.style.overflow = 'auto';
            this.transformClass = '';
        }, 300);
    },

    getDrawerClasses() {
        const baseClasses = 'fixed bg-gray-800 shadow-2xl border border-gray-700 drawer-transition';
        
        switch(this.drawerDirection) {
            case 'left':
                return baseClasses + ' left-0 top-0 h-full border-r';
            case 'right':
                return baseClasses + ' right-0 top-0 h-full border-l';
            case 'top':
                return baseClasses + ' top-0 left-0 w-full border-b';
            case 'bottom':
                return baseClasses + ' bottom-0 left-0 w-full border-t';
            default:
                return baseClasses + ' right-0 top-0 h-full border-l';
        }
    },
    
    getDrawerSize() {
        const isVertical = this.drawerDirection === 'left' || this.drawerDirection === 'right';
        
        if (isVertical) {
            switch(this.drawerSize) {
                case 'sm': return 'w-64';
                case 'md': return 'w-80';
                case 'lg': return 'w-96';
                case 'xl': return 'w-[32rem]';
                case '2xl': return 'w-[40rem]';
                default: return 'w-80';
            }
        } else {
            switch(this.drawerSize) {
                case 'sm': return 'h-64';
                case 'md': return 'h-80';
                case 'lg': return 'h-96';
                case 'xl': return 'h-[32rem]';
                case '2xl': return 'h-[40rem]';
                default: return 'h-80';
            }
        }
    },
    
    getEnterTransform() {
        switch(this.drawerDirection) {
            case 'left':
                return 'transform -translate-x-full';
            case 'right':
                return 'transform translate-x-full';
            case 'top':
                return 'transform -translate-y-full';
            case 'bottom':
                return 'transform translate-y-full';
            default:
                return 'transform translate-x-full';
        }
    },
    
    getExitTransform() {
        return this.getEnterTransform();
    }
}" @keydown.escape.window="isOpen && closeDrawer()"
    @open-drawer.window="openDrawer($event.detail.direction, $event.detail.title, $event.detail.size)">

    <!-- Backdrop Overlay -->
    <div x-show="isOpen" x-cloak x-transition:enter="transition-opacity duration-300 ease-in"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity duration-300 ease-out" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" class="fixed inset-0 z-40 bg-black/40 backdrop-blur-sm"
        @click="closeDrawer()">
    </div>

    <!-- Drawer Container -->
    <div x-show="isOpen" x-cloak
        :class="getDrawerClasses() + ' ' + getDrawerSize() + ' z-50 transform transition-transform duration-300 ease-out ' + transformClass"
        :style="isVisible ? 'transform: translateX(0) translateY(0);' : ''"
        >
        <!-- Header -->
        <div
            class="flex items-center justify-between p-4 pb-3 border-b border-gray-700 backdrop-blur-sm sticky top-0 z-10">
            <h3 class="text-lg font-semibold text-white" x-text="drawerTitle || 'Drawer'"></h3>
            <button @click="closeDrawer()"
                class="inline-flex items-center justify-center rounded-md text-gray-400 hover:text-gray-300 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-gray-700 w-8 h-8 transition-all duration-200">
                <span class="sr-only">Close drawer</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>

        <!-- Content Area -->
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
        transform: translateX(0);
        /* fallback */
    }

    .drawer-scroll {
        scrollbar-width: thin;
        scrollbar-color: #6b7280 #374151;
        scroll-behavior: smooth;
        overscroll-behavior: contain;
    }

    .drawer-scroll::-webkit-scrollbar {
        width: 6px;
    }

    .drawer-scroll::-webkit-scrollbar-track {
        background: #f3f4f6;
        border-radius: 3px;
    }

    .drawer-scroll::-webkit-scrollbar-track {
        background: #374151;
    }

    .drawer-scroll::-webkit-scrollbar-thumb {
        background: #d1d5db;
        border-radius: 3px;
        transition: background 0.2s ease;
    }

    .dark .drawer-scroll::-webkit-scrollbar-thumb {
        background: #6b7280;
    }

    .drawer-scroll::-webkit-scrollbar-thumb:hover {
        background: #9ca3af;
    }

    .dark .drawer-scroll::-webkit-scrollbar-thumb:hover {
        background: #9ca3af;
    }
</style>

<script>
    window.openDrawer = function (direction = 'right', title = '', size = 'md') {
        window.dispatchEvent(new CustomEvent('open-drawer', {
            detail: {
                direction: direction,
                title: title,
                size: size
            }
        }));
    };

    window.closeDrawer = function () {
        const drawerElement = document.querySelector('[x-data*="isOpen"]');
        if (drawerElement) {
            drawerElement._x_dataStack[0].closeDrawer();
        }
    };
</script>