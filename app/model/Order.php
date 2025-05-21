<?php

namespace App\Model;


use App\Config\Model;


include_once __DIR__ . '/../config/model.php';

class Order extends Model
{
    protected $table = 'orders';

    protected $timestamps = 'Y-m-d';

    protected $columnTimestamps = 'tanggal';

    protected $enum = [
        'status' => [
            'proses' => 'proses',
            'tertentu' => 'tertunda',
            'selesai' => 'selesai',
        ],
    ];

    public function pelangganDesc()
    {
        return $this->relational('pelanggans','pelanggan_id','id');
    }

    public function mekanikDesc()
    {
        return $this->relational('mekaniks','mekanik_id','id');
    }
}
