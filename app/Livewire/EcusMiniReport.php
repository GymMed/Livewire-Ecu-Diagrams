<?php

namespace App\Livewire;

use Livewire\Component;

class EcusMiniReport extends Component
{
    public $report = [];

    public function mount($report)
    {
        $this->report = $report;
    }

    public function render()
    {
        return view('livewire.ecus-mini-report');
    }
}
