<?php

namespace App\Imports;

use App\Models\MasterCourierRates;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class MasterCourierRatesImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        try {
            if (!empty($row['masterratetypeid'])) {
                $packageId = trim($row['mastercourierpackageid'] ?? null);
                $rateTypeId = trim($row['masterratetypeid'] ?? null);
                $shipmentType = trim($row['mastercouriershipmenttype'] ?? null);

                $record = MasterCourierRates::where([
                    'MasterCourierPackageId' => $packageId,
                    'MasterRateTypeId' => $rateTypeId,
                    'MasterCourierShipmentType' => $shipmentType,
                ])->first();

                $zones = [];
                foreach (range('A', 'Z') as $zone) {
                    $key = 'zone_' . strtolower($zone);
                    $zones['zone_' . $zone] = (!empty($row[$key]) && strtoupper($row[$key]) !== "NULL") ? $row[$key] . ".00" : "0.00";
                }

                if ($record) {

                    MasterCourierRates::where([
                        'MasterCourierPackageId' => $packageId,
                        'MasterRateTypeId' => $rateTypeId,
                        'MasterCourierShipmentType' => $shipmentType,
                    ])->update($zones);
                    Log::info('Updated Record:', $record->toArray());
                } else {
                    $record = MasterCourierRates::create(array_merge([
                        'MasterCourierPackageId' => $packageId,
                        'MasterRateTypeId' => $rateTypeId,
                        'MasterCourierShipmentType' => $shipmentType,
                    ], $zones));

                    Log::info('Inserted New Record:', $record->toArray());
                }
            }
        } catch (\Exception $e) {
            Log::error('Row Import Error: ' . $e->getMessage(), [
                'row_data' => $row,
                'trace' => $e->getTraceAsString()
            ]);
            return null;
        }
    }
}
