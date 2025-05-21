<?php

namespace App\Model;


use App\Config\Model;


include_once __DIR__ . '/../config/model.php';

class User extends Model
{
    protected $table = 'users';
}
