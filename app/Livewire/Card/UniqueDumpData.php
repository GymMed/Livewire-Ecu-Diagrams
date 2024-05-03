<?php

namespace App\Livewire\Card;

use Livewire\Component;
use App\Models\Ecu;

class UniqueDumpData extends Component
{
    public $providedEcu;
    public $providedDump;
    public $search;
    public $dumpAttributes = [];
    public function getEcuDumpAttributesReport()
    {
        $this->dumpAttributes = Ecu::getEcuDumpAttributes($this->search, $this->providedEcu['ecu'], $this->providedDump['dump_id']);
    }
    public function render()
    {
        return view('livewire.card.unique-dump-data');
    }
}
