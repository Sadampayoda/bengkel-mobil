<?php 

namespace App\Interface;

interface TableInterface{
    public function title();

    public function value();

    public function entry();

    public function paginate();

    public function clickEdit();

    public function clickDelete();

    public function action();

    public function print();

}