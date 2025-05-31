<?php

namespace App\Controller;

use App\Model\User;

include_once __DIR__.'/../model/User.php';


class PenggunaController {

    protected $model;
    public function __construct()
    {
        $this->model = new User();
    }
    
    public function index()
    {
        if(isset($_GET['search']))
        {
            return $this->model->all()
            ->where('name','LIKE','%'.$_GET['search'].'%')->get();
        }
        return $this->model->all()->get();
    }

    public function store($request)
    {
        $request['password'] = password_hash($request['password'], PASSWORD_DEFAULT);
        $jenis = $this->model->create($request);
    }

    public function show($id)
    {
        if(!$id)
        {
            return null;
        }
        $row = $this->model->all()->where('id',' = ',$id)->get();
        return $row[0] ?? null;
    }

    public function update($request,$id)
    {
        if(!$request['password'])
        {
            unset($request['password']);
        }else{
            $request['password'] = password_hash($request['password'], PASSWORD_DEFAULT);
        }
        $update = $this->model->update($request,['id' => $id]);
        return $update ?? null;
    }

    public function destroy($id)
    {
        $delete = $this->model->delete('id',$id);
        return $delete ?? null;
    }
}