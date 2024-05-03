<div 
    x-show="showSorter"
    x-collapse
    class="flex flex-wrap gap-3 mt-2"
>
    <x-general.inputs.full-select 
        id="sortBy"
        name="sortBy"
        title="Sort By"
        wire:model.change="sortBy"
    >
        <option value="id">ID</option>
        <option value="dump_id">Dump ID</option>
        <option value="ecu">Ecu</option>
        <option value="attribute">Attribute</option>
        <option value="value">Value</option>
    </x-general.inputs.full-select>

    <x-general.inputs.full-select 
        id="sortOrder"
        name="sortOrder"
        title="Sort Order"
        wire:model.change="sortOrder"
    >
        <option value="asc">ASC</option>
        <option value="desc">DESC</option>
    </x-general.inputs.full-select>
</div>
