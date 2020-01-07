<?php
namespace App\DTO;

class Ser{

    protected $id;
    protected $name;
    protected $class;

   function  _constructor($id, $name, $class = null){
        $this->id = $id;
        $this->name = $name;
        $this->class = $class;
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getName(){
        return $this->name;
    }

    public function setName($id){
        $this->name = $name;
    }

    public function getClass(){
        return $this->class;
    }

    public function setClass($class){
        $this->class = $class;
    }


}



?>