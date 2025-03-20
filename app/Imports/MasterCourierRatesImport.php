<?php

namespace App\Imports;

use App\Models\MasterCourierRates;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class MasterCourierRatesImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        try {

            if ($row['masterratetypeid'] == null) {
                return null;
            }
            $data = new MasterCourierRates([
                'MasterRateTypeId' => $row['masterratetypeid'] ?? null,
                'MasterCourierShipmentType' => $row['mastercouriershipmenttype'] ?? null,
                'zone_A' => $row['zone_a'] == "NULL" ? 0.00 : $row['zone_a'],
                'zone_B' => $row['zone_b'] == "NULL" ? 0.00 : $row['zone_b'],
                'zone_C' => $row['zone_c'] == "NULL" ? 0.00 : $row['zone_c'],
                'zone_D' => $row['zone_d'] == "NULL" ? 0.00 : $row['zone_d'],
                'zone_E' => $row['zone_e'] == "NULL" ? 0.00 : $row['zone_e'],
                'zone_F' => $row['zone_f'] == "NULL" ? 0.00 : $row['zone_f'],
                'zone_G' => $row['zone_g'] == "NULL" ? 0.00 : $row['zone_g'],
                'zone_H' => $row['zone_h'] == "NULL" ? 0.00 : $row['zone_h'],
                'zone_I' => $row['zone_i'] == "NULL" ? 0.00 : $row['zone_i'],
                'zone_J' => $row['zone_j'] == "NULL" ? 0.00 : $row['zone_j'],
                'zone_K' => $row['zone_k'] == "NULL" ? 0.00 : $row['zone_k'],
                'zone_L' => $row['zone_l'] == "NULL" ? 0.00 : $row['zone_l'],
                'zone_M' => $row['zone_m'] == "NULL" ? 0.00 : $row['zone_m'],
                'zone_N' => $row['zone_n'] == "NULL" ? 0.00 : $row['zone_n'],
                'zone_O' => $row['zone_o'] == "NULL" ? 0.00 : $row['zone_o'],
                'zone_P' => $row['zone_p'] == "NULL" ? 0.00 : $row['zone_p'],
                'zone_Q' => $row['zone_q'] == "NULL" ? 0.00 : $row['zone_q'],
                'zone_R' => $row['zone_r'] == "NULL" ? 0.00 : $row['zone_r'],
                'zone_S' => $row['zone_s'] == "NULL" ? 0.00 : $row['zone_s'],
                'zone_T' => $row['zone_t'] == "NULL" ? 0.00 : $row['zone_t'],
                'zone_U' => $row['zone_u'] == "NULL" ? 0.00 : $row['zone_u'],
                'zone_V' => $row['zone_v'] == "NULL" ? 0.00 : $row['zone_v'],
                'zone_W' => $row['zone_w'] == "NULL" ? 0.00 : $row['zone_w'],
                'zone_X' => $row['zone_x'] == "NULL" ? 0.00 : $row['zone_x'],
                'zone_Y' => $row['zone_y'] == "NULL" ? 0.00 : $row['zone_y'],
                'zone_Z' => $row['zone_z'] == "NULL" ? 0.00 : $row['zone_z'],
                'created_at' => now(),

                'updated_at' => now(),
            ]);
            // dd($data);
            $data->save();

            return $data;
        } catch (\Exception $e) {
            Log::error('Row Import Error: ' . $e->getMessage(), [
                'row_data' => $row,
                'trace' => $e->getTraceAsString()
            ]);
            return null; // Skip failed rows
        }
    }
}
