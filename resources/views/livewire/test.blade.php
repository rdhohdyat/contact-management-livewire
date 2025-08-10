<div class="flex flex-col justify-center">
    <div>
        <h1 class="text-xl text-white font-bold mb-4">Drawer</h1>
        <div class="grid grid-cols-4 gap-4">
            <button onclick="openDrawer('right', 'My Drawer', 'xl');"
                class="px-4 py-3 bg-gradient-to-r from-green-600 to-green-500 text-white rounded-lg hover:opacity-90 transition-all duration-200">
                <i class="fas fa-arrow-right mr-2"></i>
                Right
            </button>
            <button onclick="openDrawer('left', 'My Drawer', 'xl');"
                class="px-4 py-3 bg-gradient-to-r from-green-600 to-green-500 text-white rounded-lg hover:opacity-90 transition-all duration-200">
                <i class="fas fa-arrow-left mr-2"></i>
                Left
            </button>
            <button onclick="openDrawer('top', 'My Drawer', 'xl');"
                class="px-4 py-3 bg-gradient-to-r from-green-600 to-green-500 text-white rounded-lg hover:opacity-90 transition-all duration-200">
                <i class="fas fa-arrow-up mr-2"></i>
                Top
            </button>
            <button onclick="openDrawer('bottom', 'My Drawer', 'xl');"
                class="px-4 py-3 bg-gradient-to-r from-green-600 to-green-500 text-white rounded-lg hover:opacity-90 transition-all duration-200">
                <i class="fas fa-arrow-down mr-2"></i>
                Bottom
            </button>
        </div>
    </div>

    <div>
        <h1 class="text-xl text-white font-bold mb-4 mt-8">Modal</h1>
        <div class="grid grid-cols-4 gap-4">
            <button onclick="openFormModal()"
                class="px-4 py-3 bg-gradient-to-r from-red-600 to-red-500 text-white rounded-lg hover:opacity-90 transition-all duration-200">
                Open Custom Modal
            </button>

            <button onclick="openConfirmModal()"
                class="px-4 py-3 bg-gradient-to-r from-red-600 to-red-500 text-white rounded-lg hover:opacity-90 transition-all duration-200">
                Open Confirm Modal
            </button>

            <button onclick="openAlertModal()"
                class="px-4 py-3 bg-gradient-to-r from-red-600 to-red-500 text-white rounded-lg hover:opacity-90 transition-all duration-200">
                Open Alert Modal
            </button>
        </div>

        @section('modalContent')
            <form>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                    <div>
                        <label for="first_name" class="block text-gray-300 text-sm font-medium mb-2">First Name</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-user-tag text-gray-500"></i>
                            </div>
                            <input type="text" id="first_name" name="first_name" class="input"
                                placeholder="Enter first name">
                        </div>
                    </div>
                    <div>
                        <label for="last_name" class="block text-gray-300 text-sm font-medium mb-2">Last Name</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-user-tag text-gray-500"></i>
                            </div>
                            <input type="text" id="last_name" name="last_name" class="input" placeholder="Enter last name">
                        </div>
                    </div>
                </div>

                <div class="mb-5">
                    <label for="email" class="block text-gray-300 text-sm font-medium mb-2">Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-500"></i>
                        </div>
                        <input type="email" id="email" name="email" class="input" placeholder="Enter email address">
                    </div>
                </div>

                <div class="mb-6">
                    <label for="phone" class="block text-gray-300 text-sm font-medium mb-2">Phone</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-phone text-gray-500"></i>
                        </div>
                        <input type="tel" id="phone" name="phone" class="input" placeholder="Enter phone number">
                    </div>
                </div>

                <div class="flex justify-end space-x-4">
                    <button type="button" wire:loading.attr="disabled"
                        class="px-5 py-3 bg-gradient text-white rounded-lg hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition-all duration-200 font-medium shadow-lg transform hover:-translate-y-0.5 flex items-center">
                        <span wire:loading.remove>
                            <i class="fas fa-plus-circle mr-2"></i> Create Contact
                        </span>

                        <span wire:loading>
                            <i class="fas fa-spinner fa-spin mr-2"></i> Memproses...
                        </span>
                    </button>
                </div>
            </form>
        @endsection
    </div>

    <div>
        <h1 class="text-xl text-white font-bold mb-4 mt-8">Dropdown</h1>
        <div class="">
            <table class="min-w-full divide-y divide-gray-700">
                <thead class="bg-gray-800 rounded">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-200">No</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-200">Nama</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-200">NIM
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-200">Kelas
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-200">Prodi
                        </th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-200">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-gray-800 divide-y divide-gray-700">
                    <tr>
                        <td class="px-4 py-3 text-sm text-gray-200">1</td>
                        <td class="px-4 py-3 text-sm text-gray-200">Ridho Hidayat</td>
                        <td class="px-4 py-3 text-sm text-gray-200">2255301164</td>
                        <td class="px-4 py-3 text-sm text-gray-200">TIE</td>
                        <td class="px-4 py-3 text-sm text-gray-200">Teknik Informatika</td>
                        <td class="px-4 py-3 text-sm text-gray-200">
                            <x-dropdown align="right">
                                <x-slot name="trigger">
                                    <button class="px-3 py-2 bg-gray-700 rounded hover:bg-gray-600">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                </x-slot>

                                <x-dropdown-item href="#">Edit</x-dropdown-item>
                                <x-dropdown-item href="#">Hapus</x-dropdown-item>
                            </x-dropdown>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    @php
        $faqList = [
            ['title' => 'Apa itu Patron?', 'content' => 'Patron adalah pasar tradisional online.'],
            ['title' => 'Bagaimana cara daftar?', 'content' => 'Klik tombol daftar di pojok kanan atas.'],
            ['title' => 'Apakah gratis?', 'content' => 'Ya, sepenuhnya gratis.'],
        ];
    @endphp

    <div>
        <h1 class="text-xl text-white font-bold mb-4 mt-8">Tabs</h1>
        <div>
            <x-tabs :tabs="[
        ['key' => 'informasi', 'label' => 'Informasi'],
        ['key' => 'pengaturan', 'label' => 'Pengaturan']
    ]">
                <x-slot name="informasi">
                    <p class="text-white">Ini konten tab <strong>Informasi</strong>.</p>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Consectetur at vel rem nostrum,
                        voluptates aspernatur beatae, distinctio expedita atque fuga maxime dicta! Blanditiis aperiam
                        incidunt consequuntur deserunt, officia, nihil culpa dolore amet neque veritatis odit optio
                        velit nulla. Aperiam beatae cum nulla in commodi quae voluptatibus. Eaque consequuntur dolores
                        adipisci.</p>
                </x-slot>

                <x-slot name="pengaturan">
                    <p class="text-white">Ini konten tab <strong>Pengaturan</strong>.</p>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Consectetur at vel rem nostrum,
                        voluptates aspernatur beatae, distinctio expedita atque fuga maxime dicta! Blanditiis aperiam
                        incidunt consequuntur deserunt, officia, nihil culpa dolore amet neque veritatis odit optio
                        velit nulla. Aperiam beatae cum nulla in commodi quae voluptatibus. Eaque consequuntur dolores
                        adipisci.</p>
                </x-slot>
            </x-tabs>
        </div>
    </div>

    <div>
        <h1 class="text-xl text-white font-bold mb-4 mt-8">Accordion</h1>
        <div class="space-y-4">
            @foreach ($faqList as $faq)
                <x-accordion title="{{ $faq['title'] }}">
                    {{ $faq['content'] }}
                </x-accordion>
            @endforeach
        </div>
    </div>

    <div>
        <h1 class="text-xl text-white font-bold mb-4 mt-8">File Upload</h1>
        <div class="grid grid-cols-4 gap-4">
            <x-file-upload label="Gambar Produk 1" />
            <x-file-upload label="Gambar Produk 2" />
            <x-file-upload label="Gambar Produk 3" />
            <x-file-upload label="Gambar Produk 4" />
        </div>
    </div>

    <div>
        <h1 class="text-xl text-white font-bold mb-4 mt-8">Toast</h1>
        <div class="grid grid-cols-4 gap-4">
            <button onclick="toast('Berhasil menyimpan data!', 'success')"
                class="px-4 py-3 bg-gradient-to-r from-green-600 to-green-500 text-white rounded-lg hover:opacity-90 transition-all duration-200">
                Success Toast
            </button>
            <button onclick="toast('Berhasil menyimpan data!', 'error')"
                class="px-4 py-3 bg-gradient-to-r from-red-600 to-red-500 text-white rounded-lg hover:opacity-90 transition-all duration-200">
                Success Toast
            </button>
            <button onclick="toast('Berhasil menyimpan data!', 'warning')"
                class="px-4 py-3 bg-gradient-to-r from-yellow-600 to-yellow-500 text-white rounded-lg hover:opacity-90 transition-all duration-200">
                Success Toast
            </button>
            <button onclick="toast('Berhasil menyimpan data!', 'info')"
                class="px-4 py-3 bg-gradient-to-r from-blue-600 to-blue-500 text-white rounded-lg hover:opacity-90 transition-all duration-200">
                Success Toast
            </button>

            <x-toast />
        </div>
    </div>

    <x-drawer>
        <div class="p-6">
            <div class="space-y-6">
                <!-- Konten dinamis berdasarkan jenis drawer -->
                <div x-data="{ currentDrawer: 'default' }"
                    @open-drawer.window="currentDrawer = $event.detail.title || 'default'">
                    <h1>hello wordl</h1>
                </div>
            </div>
        </div>
    </x-drawer>
</div>
<script>
    function openFormModal() {
        window.openModal(
            'Peringatan?',
            'Apakah Anda yakin ingin menghapus contact ini?',
            () => {
            }
        );
    }
</script>