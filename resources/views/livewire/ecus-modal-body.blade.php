<div 
    x-data="ecusModalBodyData(@this);"
    x-init="init();"
    class="flex flex-col gap-3"
>
    <div class="flex justify-end">
        <button
            type="button"
            class="w-min rounded bg-gradient-to-br from-blue-500 to-blue-700 focus:ring
            focus:ring-offset-2 focus:ring-blue-500 text-white font-semibold"
            @click="showOptions = !showOptions"
        >
            <div class="py-1 pl-2 pr-4 hover:scale-105 flex gap-1 items-center justify-center">
                <x-general.icons.gear />    
                Settings
            </div>
        </button>
    </div>

    <div 
        x-show="showOptions"
        x-collapse
        class="flex flex-col gap-3"
    >
        <div class="flex flex-wrap items-center justify-between">
            <div>Select Chart Type:</div>
            <div class="flex gap-2">
                <div class="flex flex-wrap gap-3">
                    <x-general.inputs.full-radio-input
                        name="radioType"
                        id="barType"
                        title="Bar"
                        value="bar"
                        x-model="chartType"
                    />
                    <x-general.inputs.full-radio-input
                        name="radioType"
                        id="pieType"
                        title="Pie"
                        value="pie"
                        x-model="chartType"
                    />
                    <x-general.inputs.full-radio-input
                        name="radioType"
                        id="doughnutType"
                        title="Doughnut"
                        value="doughnut"
                        x-model="chartType"
                    />
                    <x-general.inputs.full-radio-input
                        name="radioType"
                        id="polarAreaType"
                        title="Polar Area"
                        value="polarArea"
                        x-model="chartType"
                    />
                    <x-general.inputs.full-radio-input
                        name="radioType"
                        id="lineType"
                        title="Line"
                        value="line"
                        x-model="chartType"
                    />
                </div>
            </div>
        </div>

        <div class="flex flex-wrap items-center justify-between">
            <div>Select Data:</div>
            <div class="flex gap-2">
                <div class="flex flex-wrap gap-3">
                    <x-general.inputs.full-radio-input
                        name="radioChartData"
                        id="uniqueEcusTypesData"
                        title="Unique Ecus Types"
                        value="uniqueEcus"
                        x-model="dataType"
                    />
                    <x-general.inputs.full-radio-input
                        name="radioChartData"
                        id="EcuDumpsData"
                        title="Ecu Type Dumps Data"
                        value="ecuDumps"
                        x-model="dataType"
                    />
                </div>
            </div>
        </div>

        <div x-show="dataType === 'ecuDumps'" class="flex flex-wrap justify-between items-center p-1">
            <label for="ecuSelector">Select Ecu:</label>
            <x-general.inputs.select
                name="ecuSelector"
                id="ecuSelector"
                wire:model="ecuSelection"
                x-on:change="$dispatch('set-ecu-selection', {newEcuSelection: $event.target.value});"
            >
            @if($labels && count($labels) > 0)
                @foreach ($labels as $label)
                    <option wire:key="label-{{ $label }}" :value="'{{ $label }}'">{{ $label }}</option> 
                @endforeach
            @endif
            </x-general.inputs.select>
        </div>
    </div>

    @livewire('diagrams.unique-ecus', [
        'labels' => $labels,
        'data' => $data,
        key('unique-ecus-' . $search)
    ])
</div>

@push('scripts')
<script>
    function ecusModalBodyData(livewireComponent) {
        return {
            showOptions: false,
            chartType: 'bar',
            dataType: livewireComponent.entangle('dataType'), 
            labels: livewireComponent.entangle('labels'), 
            ecuOptions: [],
            init() {
                this.setEcuOptions(this.labels);
                this.$watch('chartType', value => this.$dispatch('change-chart-type', { type: this.chartType }));
                this.$watch('labels', value => this.setEcuOptions(value) );
                this.$watch('dataType', value => {
                        this.$dispatch('set-ecu-data-type', { 
                            dataType: this.dataType, 
                        });
                    }
                );
                // this.$watch('selectedOption', value => this.$dispatch('set-ecu-selection', { newEcuSelection: value }));
            },
            setEcuOptions(labels) {
                if(!labels || !Array.isArray(labels) || labels.length < 1)
                    return;

                this.ecuOptions = labels.map((label) => {
                    return { value: label, text: label };
                });
            }
        };
    }
</script>
@endpush
