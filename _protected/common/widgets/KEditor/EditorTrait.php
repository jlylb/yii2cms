<?php
/**
 * Created by PhpStorm.
 * User: CPR061
 * Date: 2016/9/2
 * Time: 11:45
 */
namespace common\widgets\KEditor;

use yii;

Trait EditorTrait{

    //允许上传的文件后缀
    public function getAllowExts()
    {
        return [
            'image' => ['gif', 'jpg', 'jpeg', 'png', 'bmp'],
            'flash' => ['swf', 'flv'],
            'media' => ['swf', 'flv', 'mp3', 'wav', 'wma', 'wmv', 'mid', 'avi', 'mpg', 'asf', 'rm', 'rmvb'],
            'file' =>  ['doc', 'docx', 'xls', 'xlsx', 'ppt', 'htm', 'html', 'txt', 'zip', 'rar', 'gz', 'bz2'],
        ];
    }
    //检测上传目录类型
    public function checkDirectory($dir,$exts=[])
    {
        if(!$exts){
            $exts=$this->getAllowExts();
        }
        return array_key_exists($dir,$exts);
    }

    //检测文件后缀
    public function checkExt($ext,$exts)
    {
        return in_array($ext,$exts);
    }

    protected function getFileStorage()
    {

        $fileStorage = Instance::ensure($this->fileStorage, FileStorage::className());
        return $fileStorage;

    }

}