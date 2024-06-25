<?php

namespace Model;
use Model\ActiveRecord;

class Project extends ActiveRecord
{
    protected static $tabla = 'projects';
    protected static $columnasDB = ['id', 'project', 'url', 'user_id'];


    public $id;
    public $project;
    public $url;
    public $user_id;




    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->project = $args['project'] ?? null;
        $this->url = $args['url'] ?? null;
        $this->user_id = $args['user_id'] ?? null;
    }

    public function validate(){

        if(!$this->project){
            self::$alertas['error'][] = 'El nombre del proyecto es obligatorio';
        }

        return self::$alertas;

    }
    
    public function generateURL(){
        $this->url = md5(uniqid());

    }


}


