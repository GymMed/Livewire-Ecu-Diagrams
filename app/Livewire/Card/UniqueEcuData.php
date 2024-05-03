<?php

namespace App\Livewire\Card;

use Livewire\Component;
use App\Models\Ecu;

class UniqueEcuData extends Component
{
    public $providedEcu;
    public $ecuDumps = [];
    public $search;

    public function getEcuDumpsReport()
    {
        $this->ecuDumps = Ecu::getEcuDumps($this->search, $this->providedEcu['ecu']);
    }

    public function render()
    {
        return view('livewire.card.unique-ecu-data');
    }
}
