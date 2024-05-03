<?php

namespace App\Livewire;

use Livewire\Component;

class EcuSorter extends Component
{
    public $sortBy = '';
    public $sortOrder = '';
    protected $queryString = [
        'sortBy' => ['except' => '', 'as' => 'sort-by'],
        'sortOrder' => ['except' => '', 'as' => 'sort-order']
    ];

    public function updatedSortBy()
    {
        $this->dispatch('set-sort-data', sortBy: $this->sortBy, sortOrder: $this->sortOrder);
    }

    public function updatedSortOrder()
    {
        $this->dispatch('set-sort-data', sortBy: $this->sortBy, sortOrder: $this->sortOrder);
    }
    public function render()
    {
        return view('livewire.ecu-sorter');
    }
}
