<?php

namespace App\Livewire\Diagrams;

use Livewire\Component;

class UniqueEcus extends Component
{
    public $labels = [];
    public $data = [];
    public $chartType = 'bar';
    public function render()
    {
        return view('livewire.diagrams.unique-ecus');
    }
}
