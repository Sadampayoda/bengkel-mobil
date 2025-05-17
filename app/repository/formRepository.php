<?php

namespace App\Repository;

use App\Interface\FormInterface;

include __DIR__.'/../interface/formInterface.php';

class FormRepository implements FormInterface
{
    protected $name ,$method, $enctype, $onclick;
    public function __construct($name = 'form',$method = 'GET',$enctype = '',$onclick)
    {
        $this->name = $name;
        $this->method = $method;
        $this->enctype = $enctype;
        $this->onclick = $onclick;
    }

    public function setForm()
    {
        return $this->name;
    }

    public function setInput(array $input)
    {
        return $input;
    }
    
    public function setMethod()
    {

        return $this->method;
    }

    public function setEnctype()
    {
        return $this->enctype;
    }

    public function onClick()
    {
        return $this->onclick;
    }


    

    public function validate(){}
}