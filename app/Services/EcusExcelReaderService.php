<?php

namespace App\Services;

use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Models\Ecu;

class EcusExcelReaderService
{
    // Allowed mime types 
    private static $excelMimes = [
        'text/xls',
        'text/xlsx',
        'application/excel',
        'application/vnd.msexcel',
        'application/vnd.ms-excel',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
    ];
    private static $chunkSize = 100;

    public function __construct()
    {
    }

    public static function readExcel($filepath)
    {
        ini_set('memory_limit', '512M');

        if (empty($filepath))
            return;

        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        $mimeType = $finfo->file($filepath);

        if (!in_array($mimeType, self::$excelMimes)) {
            Log::error("Incorrect file provided. Provided mime type: {$mimeType}");
            return;
        }

        $reader = new Xlsx();
        $spreadsheet = $reader->load($filepath);
        $worksheet = $spreadsheet->getActiveSheet();
        self::readExcelInChunks($worksheet);
    }

    public static function readExcelInChunks($worksheet)
    {
        $rowIterator = $worksheet->getRowIterator();
        //$rowIterator->setStartRow(2);
        $rowsChuckSize = 0;
        $rowsData = [];
        $timestamp = Carbon::now();

        $skipFirst = true;

        foreach ($rowIterator as $row) {
            if ($skipFirst) {
                $skipFirst = false;
                continue;
            }

            $cellValues = [];

            foreach ($row->getCellIterator() as $cell) {
                $cellValues[] = $cell->getValue();
            }

            $rowsData[] = $cellValues;
            $rowsChuckSize++;

            if ($rowsChuckSize > self::$chunkSize) {

                self::insertEcusFromRowsData($rowsData, $timestamp);

                $rowsChuckSize = 0;
                $rowsData = [];
                unset($cellValues);
            }
        }

        //leftovers
        if (count($rowsData) > 0) {
            self::insertEcusFromRowsData($rowsData, $timestamp);
            unset($rowsData);
        }
    }

    public static function insertEcusFromRowsData($rowsData, $timestamp)
    {
        $data = [];

        foreach ($rowsData as $row) {
            $data[] = self::formatEcuRowData($row, $timestamp);
        }

        echo "\n\033[32mInserting Chunk To Database Of Size: " . self::$chunkSize . ".\033[0m" . PHP_EOL;
        Ecu::insert($data);
    }

    public static function formatEcuRowData($row, $timestamp)
    {
        $id = $row[0];
        $dump_id = $row[1];
        $ecu = $row[2];
        $attribute = $row[3];
        $value = $row[4];

        return [
            'id' => $id,
            'dump_id' => $dump_id,
            'ecu' => $ecu,
            'attribute' => $attribute,
            'value' => $value,
            'created_at' => $timestamp,
            'updated_at' => $timestamp
        ];
    }
}
