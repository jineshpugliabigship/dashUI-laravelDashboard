<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterCourierRates extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'MasterCourierRates'; // Specify table name if different from convention

    protected $primaryKey = 'MasterCourierPackageId'; // Specify the primary key

    public $timestamps = true; // Enable timestamps

    protected $fillable = [
        'MasterCourierPackageId',
        'MasterRateTypeId',
        'MasterCourierShipmentType',
        'zone_A',
        'zone_B',
        'zone_C',
        'zone_D',
        'zone_E',
        'zone_F',
        'zone_G',
        'zone_H',
        'zone_I',
        'zone_J',
        'zone_K',
        'zone_L',
        'zone_M',
        'zone_N',
        'zone_O',
        'zone_P',
        'zone_Q',
        'zone_R',
        'zone_S',
        'zone_T',
        'zone_U',
        'zone_V',
        'zone_W',
        'zone_X',
        'zone_Y',
        'zone_Z',
        // 'zone_ME1',
        // 'zone_ME2',
        // 'zone_ME3',
        // 'zone_ME4',
        // 'zone_ME5',
        // 'zone_Qatar',
        // 'zone_Oman',
        // 'zone_AK',
        // 'zone_AL',
        // 'zone_AM',
        // 'zone_AN',
        // 'zone_AO',
        // 'zone_AP',
        // 'zone_AQ',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $dates = ['deleted_at']; // Enable soft delete timestamps
}
