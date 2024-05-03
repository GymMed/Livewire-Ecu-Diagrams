<div 
    x-data="EcusReportModalData();"
    class="flex flex-col gap-3"
>
    <div class="font-semibold text-2xl text-center">Data Collected</div>
    <div>Total records: 
        <span class="font-semibold">{{ $report['totalRecords'] }}</span>
    </div>
    <div>Total unique ecu models: 
        <span class="font-semibold">{{ count($report['uniqueEcuModels']) }}</span>
    </div>

    <div 
        x-show="showUniqueEcus"
        x-collapse
        class="p-2 shadow-inner bg-gray-100 rounded"
    >
        @foreach ($uniqueEcus as $key => $currentEcu)
            @livewire('card.unique-ecu-data', [  
                'providedEcu' => $currentEcu->toArray(),
                'search' => $search,
                key('unique-ecu' . $currentEcu->ecu . $search )
            ])
        @endforeach
    </div>

    <x-general.button 
        class="w-fit"
        @click="showUniqueEcus = !showUniqueEcus;"
    >
        <div class="py-1 px-4 hover:scale-105">Show Unique Ecus Data</div>
    </x-general.button>

    <div>Total dumps: 
        <span class="font-semibold">{{ $report['totalDumps'] }}</span>
    </div>

    <div>
        Search word used:
        <span class="font-semibold">{{ $search }}</span>
    </div>
</div>

@push('scripts')
    <script>
        function EcusReportModalData() {
            return {
                showUniqueEcus: false,
            };
        }
    </script>
@endpush