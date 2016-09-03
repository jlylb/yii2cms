<?php
/**
 * Created by PhpStorm.
 * User: CPR061
 * Date: 2016/9/3
 * Time: 13:12
 */

namespace upload\components;

use trntv\filekit\Storage;
use trntv\filekit\File;


class FileStorage extends  Storage{

    public $directory;

    public function save($file, $preserveFileName = false, $overwrite = false)
    {
        $fileObj = File::create($file);
        $rulePath = $this->generatePathRule();
        if ($preserveFileName === false) {
            do {
                $filename = implode('.', [
                    \Yii::$app->security->generateRandomString(),
                    $fileObj->getExtension()
                ]);
                $path = implode('/', [$rulePath, $filename]);
            } while ($this->getFilesystem()->has($path));
        } else {
            $filename = $fileObj->getPathInfo('filename');
            $path = implode('/', [$rulePath, $filename]);
        }

        $this->beforeSave($fileObj->getPath(), $this->getFilesystem());

        $stream = fopen($fileObj->getPath(), 'r+');
        if ($overwrite) {
            $success = $this->getFilesystem()->putStream($path, $stream);
        } else {
            $success = $this->getFilesystem()->writeStream($path, $stream);
        }
        fclose($stream);

        if ($success) {
            $this->afterSave($path, $this->getFilesystem());
            return $path;
        }

        return false;
    }

    //生成路径
    public function generatePathRule()
    {
        return $this->directory.'/'.date('Ymd');
    }


    //获取url访问路径
    public  function getUploadUrl() {
        if (! preg_match("/(\/\/|http|https)/", $this->baseUrl)) {
            return \Yii::$app->getRequest()->getHostInfo() . $this->baseUrl;
        }
        return $this->baseUrl.'/'.$this->generatePathRule();
    }

} 