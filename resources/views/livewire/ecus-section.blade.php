<div 
    x-data="EcusSectionData(@this);"
    class="flex flex-col gap-1"
>
    <div x-data="{ open: false }" class="flex items-center gap-3">
        <div class="w-full flex items-center">
            <div :class="{'w-full ': open, 'sm:w-32 md:w-64 ': !open}" class="transition-all duration-700 relative flex items-center justify-center">
                <input
                    type="text"
                    name="search"
                    id="search"
                    placeholder="Search . . ."
                    @focus="open = true"
                    @blur="open = false"
                    wire:model="search"
                    @keyup.enter="$dispatch('set-ecu-search', { newSearch: search });"
                    class="w-full rounded-full border border-gray-900 py-1 px-3 focus:ring focus:ring-offset-2 focus:ring-blue-500 text-blue-500 placeholder:text-blue-200"
                />
                <button type="button" class="absolute right-4"
                    @click="$dispatch('set-ecu-search', { newSearch: search });"
                >
                    <x-general.icons.search />
                </button>
            </div>
        </div>

        <x-general.modals.base-modal id="report-modal">
            <livewire:ecus-report-modal 
                :report="$report"
                :search="$search"
                wire:key="'updating-report-' + {{ $search }}"
            />
        </x-general.modals.base-modal>

        <x-general.modals.base-modal id="diagrams-modal">
            @livewire('ecus-modal-body', [
                'labels' => $report['uniqueEcuModelsData']['labels'],
                'data' => $report['uniqueEcuModelsData']['data'],
                'search' => $search, 
                'ecuSelection' => $report['ecuSelection'],
                key('updating-charts-' . $search)
            ])
        </x-general.modals.base-modal>

        <button 
            type="button" 
            class="p-1 transition-colors duration-300 dark:bg-gray-900 dark:text-white hover:bg-blue-500 hover:text-white rounded focus:ring focus:ring-offset-2 focus:ring-blue-500"
            @click="$dispatch('show-modal', { id: 'report-modal'});"
        >
            <x-general.icons.information class="w-6 h-6"/>
        </button>

        <button 
            type="button" 
            class="p-1 transition-colors duration-300 dark:bg-gray-900 dark:text-white hover:bg-blue-500 hover:text-white rounded focus:ring focus:ring-offset-2 focus:ring-blue-500"
            @click="$dispatch('show-modal', { id: 'diagrams-modal'});"
        >
            <x-general.icons.diagram class="w-6 h-6"/>
        </button>

        <button 
            type="button" 
            class="p-1 transition-colors duration-300 dark:bg-gray-900 dark:text-white hover:bg-blue-500 hover:text-white 
            rounded focus:ring focus:ring-offset-2 focus:ring-blue-500"
            @click="showSorter = !showSorter"
        >
            <x-general.icons.funnel class="w-6 h-6"/>
        </button>
    </div>

    @livewire('ecu-sorter')

    <div class="mt-4 transition-transform duration-500 flex flex-col gap-3">
        <livewire:ecus-records />
        @livewire('ecus-mini-report', ['report' => $report, key('updating-ecus-' . $search)])
    </div>
</div>

@push('scripts')
    <script>
        function EcusSectionData(livewireComponent) {
            return {
                search: livewireComponent.entangle('search'),
                showSorter: false,
            };
        } 
    </script>
@endpush