<div 
    x-data="uniqueEcusChartData(@this);"
    x-init="createChart();"
    x-on:change-chart-type.window="changeChartTypeEvent"
    x-on:change-chart-data.window="changeChartDataEvent"
>
    <canvas id="uniqueEcusChart" class="lg:w-[26rem] lg:h-[26rem] md:w-[32rem] md:h-[32rem] sm:w-full sm:h-full max-sm:w-[400px] max-sm:h-[400px]"></canvas>
</div>

@once
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            function randomNumberInRange(min, max) {
                //inclusive
                return Math.floor(Math.random() * (max - min + 1) + min);
            }

            function getRandomColor(alphaChannel = 1) {
                return `rgba(${randomNumberInRange(0, 255)}, ${randomNumberInRange(0, 255)}, ${randomNumberInRange(0, 255)}, ${alphaChannel})`;
            }
        </script>
    @endpush
@endonce

@push('scripts')
<script>
    function uniqueEcusChartData(livewireComponent) {
        return {
            type: livewireComponent.entangle('chartType'),
            data: livewireComponent.entangle('data'),
            labels: livewireComponent.entangle('labels'),
            changeChartDataEvent(event) {
                this.data = event.detail.data;
                this.labels = event.detail.labels.map((label) => {
                    if(typeof label === 'string')
                        return label;
                    return `${label}`;
                });
                this.createChart();
            },
            changeChartTypeEvent(event) {
                this.changeType(event.detail.type);
                this.createChart();
            },
            changeType(type) {
                switch(type)
                {
                    case 'line':
                    case 'polarArea':
                    case 'doughnut':
                    case 'pie':
                    case 'bar':{
                        this.type = type;
                        break;
                    }
                    default:
                        break;
                }
            },
            createChart()
            {
                const colors = @json($data).map((dataset) => {
                        return getRandomColor(0.2); 
                });

                const borderColors = @json($data).map((dataset) => {
                        return getRandomColor(); 
                });

                if(window.uniqueEcusChartObject)
                {
                    window.uniqueEcusChartObject.destroy();
                }

                window.uniqueEcusChartObject = new Chart(
                    document.getElementById('uniqueEcusChart'), {
                        type: this.type,
                        data: {
                                labels: this.labels,
                                datasets: [
                                {
                                    label: 'Unique ECUs Dataset',
                                    data: this.data,
                                    backgroundColor: colors,
                                    borderColor: borderColors,
                                    borderWidth: 1
                                }
                            ]
                        },
                        options: {
                            plugins: {
                                legend: {
                                    position: 'bottom'
                                }
                            },
                            responsive: true,
                            scales: {
                                x: {
                                    stacked: true,
                                },
                                y: {
                                    stacked: true
                                }
                            }
                        }
                    }
                );
            }
        };
    }
</script>
@endpush
