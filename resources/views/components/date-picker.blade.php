@props(['label' => 'Tanggal', 'name' => 'tanggal', 'value' => null])

<div x-data="{
    show: false,
    selectedDate: '{{ $value ?? '' }}',
    formatted: '',
    init() {
        if (this.selectedDate) {
            const d = new Date(this.selectedDate);
            this.formatted = this.formatDate(d);
        }
    },
    formatDate(date) {
        return date.toLocaleDateString('id-ID', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
    },
    pickDate(date) {
        this.selectedDate = date.toISOString().slice(0, 10);
        this.formatted = this.formatDate(date);
        this.show = false;
    }
}" x-init="init()" class="relative w-full">
    <label class="block text-sm text-white mb-1">{{ $label }}</label>

    <!-- Hidden input for form submission -->
    <input type="hidden" name="{{ $name }}" :value="selectedDate">

    <!-- Display input -->
    <div @click="show = !show" class="w-full px-4 py-2 bg-gray-800 border border-gray-600 rounded-md text-white cursor-pointer select-none">
        <span x-text="formatted || 'Pilih tanggal...'"></span>
    </div>

    <!-- Calendar -->
    <div x-show="show" x-cloak class="absolute mt-2 z-50 bg-gray-800 text-white rounded-md border border-gray-600 p-4 w-72 shadow-lg">
        <template x-for="week in [0,1,2,3,4,5]" :key="week">
            <div class="flex justify-between mb-1">
                <template x-for="day in 7" :key="day">
                    <div class="w-8 h-8 text-sm text-center leading-8 rounded hover:bg-gray-700 cursor-pointer"
                        :class="{
                            'bg-green-600 text-white': new Date().toISOString().slice(0,10) === (new Date(currentYear, currentMonth, (week * 7 + day - offsetStart + 1)).toISOString().slice(0,10))
                        }"
                        x-text="(() => {
                            const d = week * 7 + day - offsetStart + 1;
                            return (d > 0 && d <= daysInMonth) ? d : '';
                        })()"
                        @click="() => {
                            const dayNum = week * 7 + day - offsetStart + 1;
                            if (dayNum > 0 && dayNum <= daysInMonth) {
                                pickDate(new Date(currentYear, currentMonth, dayNum));
                            }
                        }">
                    </div>
                </template>
            </div>
        </template>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('datePicker', () => ({
                currentYear: new Date().getFullYear(),
                currentMonth: new Date().getMonth(),
                get daysInMonth() {
                    return new Date(this.currentYear, this.currentMonth + 1, 0).getDate();
                },
                get offsetStart() {
                    return new Date(this.currentYear, this.currentMonth, 1).getDay();
                },
            }));
        });
    </script>
</div>
