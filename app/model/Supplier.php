<?php

namespace App\Model;


use App\Config\Model;


include_once __DIR__ . '/../config/model.php';

class Supplier extends Model
{
    protected $table = 'suppliers';

    protected $enum = [
        'active' => [
            1 => 'Aktif',
            0 => 'Tidak Aktif'
        ],
    ];

    
}
