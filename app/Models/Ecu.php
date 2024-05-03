<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class Ecu extends Model
{
    use HasFactory;

    protected $fillable = [
        "id",
        "dump_id",
        "ecu",
        "attribute",
        "value"
    ];

    public function scopeSearchInAttributes(Builder $query, $search)
    {
        return $query->where('ecu', 'like', '%' . $search . '%')
            ->orWhere('id', 'like', '%' . $search . '%')
            ->orWhere('dump_id', 'like', '%' . $search . '%')
            ->orWhere('attribute', 'like', '%' . $search . '%')
            ->orWhere('value', 'like', '%' . $search . '%');
    }

    public function scopeGetUniqueEcus(Builder $query, $search)
    {
        return $query->searchInAttributes($search)
            ->select('ecu', DB::raw('COUNT(DISTINCT dump_id) as unique_dumps_count'))
            ->groupBy('ecu')
            ->get();
    }

    public function scopeGetEcusWithDumps(Builder $query, $search)
    {
        return $query->select('ecu', 'dump_id', DB::raw('COUNT(*) as count'))
            ->searchInAttributes($search)
            ->groupBy('dump_id', 'ecu')
            ->get();
    }

    public function scopeGetEcuDumps(Builder $query, $search, $ecu)
    {
        return $query->select('ecu', 'dump_id', DB::raw('COUNT(*) as count'))
            ->searchInAttributes($search)
            ->where('ecu', $ecu)
            ->groupBy('dump_id')
            ->get();
    }

    public function scopeGetEcuDumpAttributes(Builder $query, $search, $ecu, $dumpId)
    {
        return $query->select('ecu', 'dump_id', 'attribute', 'value')
            ->searchInAttributes($search)
            ->where('ecu', $ecu)
            ->where('dump_id', $dumpId)
            ->get();
    }

    public function scopeWithSort(Builder $query, $sortBy, $sortOrder)
    {
        if ($sortBy && $sortOrder)
            return $query->orderBy($sortBy, $sortOrder);
        return $query;
    }
}
