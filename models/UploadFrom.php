<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /** @var UploadedFile */
    public $logfile;

    public function rules()
    {
        return [
            [['logfile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'log,txt'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            return true;
        } else {
            return false;
        }
    }
}