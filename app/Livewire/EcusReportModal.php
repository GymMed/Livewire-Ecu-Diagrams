<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Ecu;
use Illuminate\Support\Facades\DB;

class EcusReportModal extends Component
{
    public $report = [];
    public $search;
    public $uniqueEcus;

    public function render()
    {
        $this->uniqueEcus = Ecu::getUniqueEcus($this->search);

        return view('livewire.ecus-report-modal', [
            'report' => $this->report
        ]);
    }
}
