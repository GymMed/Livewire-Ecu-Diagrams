<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Ecu;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EcusSection extends Component
{
    public $search = '';
    protected $listeners = ['set-ecu-search' => 'setEcuSearch'];

    protected $queryString = [
        'search' => ['except' => '']
    ];

    public function setEcuSearch($newSearch)
    {
        $this->search = $newSearch;
    }
    public function render()
    {
        $dumps = Ecu::searchInAttributes($this->search)->select('dump_id')->groupBy('dump_id')->get()->count();
        $uniqueEcus = Ecu::getUniqueEcus($this->search);
        $uniqueEcuModelsData = [
            'labels' => $uniqueEcus->pluck('ecu'),
            'data' => $uniqueEcus->pluck('unique_dumps_count')
        ];

        $ecuSelection = $uniqueEcuModelsData['labels'] && count($uniqueEcuModelsData['labels']) > 0 ? $uniqueEcuModelsData['labels'][0] : '';

        return view(
            'livewire.ecus-section',
            [
                'report' => [
                    'totalRecords' => Ecu::searchInAttributes($this->search)->count(),
                    'totalDumps' => $dumps,
                    'uniqueEcuModels' => $uniqueEcus,
                    'uniqueEcuModelsData' => $uniqueEcuModelsData,
                    'ecuSelection' => $ecuSelection,
                ]
            ]
        );
    }
}
