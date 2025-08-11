<?php
namespace app\models;

use yii\db\ActiveRecord;

class Logs extends ActiveRecord{
    public static function tablename(){
        return 'logs';
    }
}