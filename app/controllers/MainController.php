<?php

namespace app\controllers;

use wfs\Controller;
use wfs\View;
use app\models\Users;

class MainController extends Controller {
       
    public $template = 'base.php';
    
    public function actionIndex() {
        
        $user = Users::findOne(1);
        //print_r($user);
        
        $users = Users::find()->joinLeft('rights')
                ->select('name')->where('id = 1')->all();
        
        print_r($users);
        
        $this->page = 'main.php';
        $this->render([], $this->is_ajax);
        
    }
    
    public function actionAdmin() {
        
        $this->page = 'admin.php';
        $this->render([], $this->is_ajax);
        
    }
    
}