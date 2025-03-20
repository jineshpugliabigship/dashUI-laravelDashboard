<?php

namespace App\Imports;

use App\Models\MasterCourierRates;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log;

class MasterCourierRatesImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        try {
            return MasterCourierRates::create(
                [
                    'MasterRateTypeId' => $row['masterratetypeid'],
                    'MasterCourierShipmentType' => $row['mastercouriershipmenttype'],
                    'zone_A' => $row['zone_a'] ?? 0.00,
                    'zone_B' => $row['zone_b'] ?? 0.00,
                    'zone_C' => $row['zone_c'] ?? 0.00,
                    'zone_D' => $row['zone_d'] ?? 0.00,
                    'zone_E' => $row['zone_e'] ?? 0.00,
                    'zone_F' => $row['zone_f'] ?? 0.00,
                    'zone_G' => $row['zone_g'] ?? 0.00,
                    'zone_H' => $row['zone_h'] ?? 0.00,
                    'zone_I' => $row['zone_i'] ?? 0.00,
                    'zone_J' => $row['zone_j'] ?? 0.00,
                    'zone_K' => $row['zone_k'] ?? 0.00,
                    'zone_L' => $row['zone_l'] ?? 0.00,
                    'zone_M' => $row['zone_m'] ?? 0.00,
                    'zone_N' => $row['zone_n'] ?? 0.00,
                    'zone_O' => $row['zone_o'] ?? 0.00,
                    'zone_P' => $row['zone_p'] ?? 0.00,
                    'zone_Q' => $row['zone_q'] ?? 0.00,
                    'zone_R' => $row['zone_r'] ?? 0.00,
                    'zone_S' => $row['zone_s'] ?? 0.00,
                    'zone_T' => $row['zone_t'] ?? 0.00,
                    'zone_U' => $row['zone_u'] ?? 0.00,
                    'zone_V' => $row['zone_v'] ?? 0.00,
                    'zone_W' => $row['zone_w'] ?? 0.00,
                    'zone_X' => $row['zone_x'] ?? 0.00,
                    'zone_Y' => $row['zone_y'] ?? 0.00,
                    'zone_Z' => $row['zone_z'] ?? 0.00,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        } catch (\Exception $e) {
            Log::error('Row Import Error: ' . $e->getMessage() . ' | Row Data: ' . json_encode($row));
            return null; // Skip failed rows
        }
    }
}
