<div 
    x-data="uniqueEcuData(@this);"
    class="flex flex-col gap-2 p-2"
>
    <div
        :class="{'border border-blue-500': showDumps}"
        class="flex gap-2 p-2 cursor-pointer hover:bg-gradient-to-br hover:from-blue-500 hover:to-blue-700 hover:text-white hover:shadow rounded"
        @click="showDumps = !showDumps;ecuDumps && ecuDumps.length < 1 ? $wire.getEcuDumpsReport() : '';"
    >
        {{ $providedEcu['ecu'] }}
        =>
        {{ $providedEcu['unique_dumps_count'] }} Dumps
    </div>

    <div
        x-show="showDumps"
        x-collapse
        class="flex flex-col gap-2"
    >
        @foreach ($ecuDumps as $ecuDump)
            @livewire('card.unique-dump-data', [  
                'providedEcu' => $providedEcu,
                'providedDump' => $ecuDump->toArray(),
                'search' => $search,
                key($providedEcu['ecu'] . '-ecu-' . $ecuDump->dump_id . '-dump-' . $search . '-search' )
            ])
        @endforeach
    </div>
</div>

@push('scripts')
    <script>
        function uniqueEcuData(livewireComponent) {
            return { 
                showDumps: false,
                ecu: livewireComponent.entangle('providedEcu'),
                ecuDumps: livewireComponent.entangle('ecuDumps')
            };
        }
    </script>
@endpush