<?php

namespace App\Model;


use App\Config\Model;


include_once __DIR__ . '/../config/model.php';

class Mekanik extends Model
{
    protected $table = 'mekaniks';

    protected $enum = [
        'active' => [
            1 => 'Aktif',
            0 => 'Tidak Aktif'
        ],
    ];

    protected $timestamps = 'Y-m-d';

    protected $columnTimestamps = 'tanggal';

    
}
