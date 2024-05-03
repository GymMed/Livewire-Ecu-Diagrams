<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Services\EcusExcelReaderService;

class EcusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        try {
            $excelPath = base_path('data/dump.xlsx');
            EcusExcelReaderService::readExcel($excelPath);
        } catch (\Exception $e) {
            echo "\n\033[31mCaught Exception: " . $e->getMessage() . "\033[0m" . PHP_EOL . "\n";
            return;
        }
    }
}
