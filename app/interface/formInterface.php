<?php

namespace App\Interface;

interface FormInterface {
    
    public function setInput(array $input);

    public function setForm();

    public function setMethod();

    public function setEnctype();

    public function onClick();

    public function validate();

    public function detail();

}