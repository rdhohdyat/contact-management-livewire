@props(['label' => 'Upload File'])

<div x-data="{
    files: [],
    handleFileChange(event) {
        const selectedFiles = event.target.files;
        this.files = [];

        for (let i = 0; i < selectedFiles.length; i++) {
            const file = selectedFiles[i];
            const reader = new FileReader();

            reader.onload = (e) => {
                this.files.push({
                    name: file.name,
                    size: (file.size / 1024).toFixed(1) + ' KB',
                    type: file.type,
                    url: e.target.result,
                });
            };

            reader.readAsDataURL(file);
        }
    },
    removeFile(index) {
        this.files.splice(index, 1);
    }
}">
    <label class="block text-sm text-white mb-2">{{ $label }}</label>

    <label
        class="flex items-center justify-center w-full px-4 py-8 border-2 border-dashed border-gray-600 rounded-md cursor-pointer bg-gray-800 hover:border-green-500 transition-all">
        <span class="text-gray-400 text-sm">Klik untuk pilih file atau drag ke sini</span>
        <input type="file" name="file" class="hidden" multiple @change="handleFileChange">
    </label>

    <template x-if="files.length > 0">
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 mt-4">
            <template x-for="(file, index) in files" :key="index">
                <div class="relative bg-gray-900 p-2 rounded shadow-sm">
                    <button type="button" @click="removeFile(index)"
                        class="absolute top-1 right-1 text-red-400 hover:text-red-600 text-xs">
                        ✕
                    </button>

                    <div class="text-xs text-white truncate" x-text="file.name"></div>
                    <div class="text-gray-400 text-xs mb-1" x-text="file.size"></div>

                    <template x-if="file.type.startsWith('image/')">
                        <img :src="file.url" alt="Preview" class="rounded w-full h-32 border border-gray-700">
                    </template>
                </div>
            </template>
        </div>
    </template>
</div>
