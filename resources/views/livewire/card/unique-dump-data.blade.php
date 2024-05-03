<div 
    x-data="{
        showAttributes: false,
        ecu: $wire.entangle('providedEcu'),
        dump: $wire.entangle('providedDump'),
        dumpAttributes: $wire.entangle('dumpAttributes'),
    }"
    class="flex flex-col gap-2 p-2"
>
    <div
        :class="{'border border-orange-500': showAttributes}"
        class="flex gap-2 p-2 cursor-pointer hover:bg-gradient-to-br hover:from-orange-500 hover:to-orange-700 hover:text-white hover:shadow rounded"
        @click="showAttributes = !showAttributes;
        dumpAttributes && dumpAttributes.length < 1 ? $wire.getEcuDumpAttributesReport() : '';"
    >
        {{ $providedDump['dump_id'] }}
        =>
        {{ $providedDump['count'] }} Attributes
    </div>

    <div
        x-show="showAttributes"
        x-collapse
        class="flex flex-col gap-2"
    >
        @foreach ($dumpAttributes as $dumpAttribute)
            <div class="py-2 pr-2 pl-8">{{ $dumpAttribute['attribute'] }} => {{ $dumpAttribute['value'] }}</div>
        @endforeach
    </div>
</div>