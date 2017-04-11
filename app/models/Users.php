<?php

namespace app\models;

use wfs\Model;
use app\models\Rights;

Class Users Extends Model {

    public function getRights() {
        return $this->hasOne(Rights::className(), ['user_id' => 'id']);        
    }
     
}
