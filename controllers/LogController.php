<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;
use app\models\Logs;
use app\models\UploadForm;

class LogController extends Controller {
public function actionUpload()
{
    $model = new \yii\base\DynamicModel(['logfile']);
    $model->addRule('logfile', 'file');

    if (Yii::$app->request->isPost) {
        $model->logfile = UploadedFile::getInstance($model, 'logfile');

        if ($model->upload()) {
            if ($model->logfile) {
                $content = file_get_contents($model->logfile->tempName);
                return $this->render('upload', ['model' => $model, 'message' => 'Файл загружен']);
            }
        }
    }

    return $this->render('upload', ['model' => $model]);
}
    private function debug($model){
        if($model->validate){
            if($model->logfile){
                $content = file_get_contents($model->logfile->tempName);
            } else{
                throw new \Exception('Файл не загружен');
            }
        }
    }
    
    private function parseLog($line){
        
        $pattern = '/^(\d+\.\d+\.\d+\.\d+) - - \[(.*?)\] "GET (.*?) HTTP .*?" \d+ \d+ "(.*?)" "(.*?)"$/';

        if(preg_match($pattern, $line, $matches)) {
            $ip = $matches[1];
            $datetime = \DateTime::createFromFormat('d/M/Y:H:i:s O', $matches[2]);
            $url = $matches[3];
            $userAgent = $matches[5];

            $os = $this->getOS($userAgent);
            $arch = $this->getArch($userAgent);
            $browser = $this->getBrowser($userAgent);

            return [
                'ip' => $ip,
                'datetime' => $datetime ? $datetime->format('Y-m-d H:i:s') : null,
                'url' => $url,
                'user_agent' => $userAgent,
                'os' => $os,
                'architecture' => $arch,
                'browser' => $browser,
            ];
        }
        return false;
    }

        private function getOS($userAgent)
        {
            if(stripos($userAgent, 'Windows') !== false){
                return 'Windows';
            }elseif(stripos($userAgent, 'Macintosh') !== false){
                return 'MacOS';
            }elseif(stripos($userAgent, 'Linux') !== false){
                return 'Linux';
            }
            return 'Unknown';
        }

        private function getArch($userAgent)
        {
            if(stripos($userAgent, 'WOW64') !== false || stripos($userAgent, 'Win64') !== false){
                return '64-bit';
            }elseif(stripos($userAgent, 'i686') !== false || stripos($userAgent, 'x86') !== false){
                return '32-bit';
            }
            return 'Unknow';
        }

        private function getBrowser($userAgent)
        {
            
            if(stripos($userAgent, 'Chrome') !== false){
                return 'Chrome';
            }elseif(stripos($userAgent, 'Firefox') !== false){
                return 'FireFox';
            }elseif(stripos($userAgent, 'Safari') !== false && stripos($userAgent, 'Chrome') === false){
                return 'Safari'; 
            }elseif(stripos($userAgent, 'Edge') !== false) {
                return 'Edge'; 
            }
            return 'Other';
        }

}  