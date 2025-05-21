<?php

namespace App\Repository;

use App\Interface\FormInterface;

include __DIR__.'/../interface/formInterface.php';

class FormRepository implements FormInterface
{
    protected $name ,$method, $enctype, $onclick, $detail;
    public function __construct($name = 'form',$method = 'GET',$enctype = '',$onclick,$detail = false)
    {
        $this->name = $name;
        $this->method = $method;
        $this->enctype = $enctype;
        $this->onclick = $onclick;
        $this->detail = $detail;
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

    public function detail()
    {
        return $this->detail;
    }



    

    public function validate(){}
}