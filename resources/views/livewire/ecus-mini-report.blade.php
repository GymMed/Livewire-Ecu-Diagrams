<div>
    <div>Total records: 
        <span class="font-semibold">{{ $report['totalRecords'] }}</span>
    </div>
    <div>Total unique ecu models: 
        <span class="font-semibold">{{ count($report['uniqueEcuModels']) }}</span>
    </div>
    <div>Total dumps: 
        <span class="font-semibold">{{ $report['totalDumps'] }}</span>
    </div>
</div>
