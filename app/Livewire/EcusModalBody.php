<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Ecu;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EcusModalBody extends Component
{
    public $dataType = 'uniqueEcus';
    public $search;
    public $labels;
    public $data;
    public $ecuSelection;

    protected $listeners = [
        'set-ecu-selection' => 'setEcuSelection',
        'set-ecu-data-type' => 'setEcuDataType'
    ];

    public function setEcuDataType($dataType)
    {
        $oldDataType = $this->dataType;

        switch ($dataType) {
            case 'uniqueEcus':
            case 'ecuDumps': {
                    $this->dataType = $dataType;
                    break;
                }
            default: {
                    $this->dataType = 'uniqueEcus';
                }
        }

        $this->emitChartData();
    }

    public function setEcuSelection($newEcuSelection)
    {
        $this->ecuSelection = $newEcuSelection;
        $this->emitChartData();
    }

    public function emitChartData()
    {
        $data = '';
        $labels = '';

        if ($this->dataType === 'ecuDumps' && $this->ecuSelection) {
            $data = Ecu::getEcuDumps($this->search, $this->ecuSelection);
            $labels = $data->pluck('dump_id');
        } else {
            $data = Ecu::getUniqueEcus($this->search);
            $labels = $data->pluck('ecu');
        }

        $this->dispatch(
            'change-chart-data',
            labels: $labels,
            data: $data->pluck('count')
        );
    }
    public function render()
    {
        return view('livewire.ecus-modal-body');
    }
}
