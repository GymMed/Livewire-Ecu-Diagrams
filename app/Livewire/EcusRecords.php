<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Ecu;
use Illuminate\Support\Facades\Log;

class EcusRecords extends Component
{
    use WithPagination;

    public $search = '';
    public $page = 1;
    public $sortBy;
    public $sortOrder;
    protected $listeners = [
        'set-ecu-search' => 'setEcuSearch',
        'set-sort-data' => 'setSortData',
    ];
    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    public function setSortData($sortBy, $sortOrder)
    {
        $this->sortBy = $sortBy;
        $this->sortOrder = $sortOrder;
    }

    public function setEcuSearch($newSearch)
    {
        $this->search = $newSearch;
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function render()
    {

        return view('livewire.ecus-records', [
            'ecus' => Ecu::searchInAttributes($this->search)
                ->withSort($this->sortBy, $this->sortOrder)
                ->paginate(10),
        ]);
    }
}
