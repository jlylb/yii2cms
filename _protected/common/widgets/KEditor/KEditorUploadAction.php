<?php
namespace common\widgets\KEditor;

use yii\web\UploadedFile;
use yii\web\Response;
use yii\base\DynamicModel;

class KEditorUploadAction extends BaseAction{


    public $fileparam='imgFile';

    //上传最大文件
    public $maxSize;


    public function init()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        \Yii::$app->request->enableCsrfValidation = false;
    }

    public function run()
    {
        $dir=\Yii::$app->getRequest()->get('dir','file');

		$dirs=$this->getAllowExts();

        if(!$this->checkDirectory($dir,$dirs)){
			return ['error'=>1,'message'=>'目录名不正确。'];
		}

        $uploadedFile = UploadedFile::getInstanceByName($this->fileparam);

        if(!$this->checkExt($uploadedFile->getExtension(),$dirs[$dir])){
            return ['error'=>1,'message'=>"上传文件扩展名是不允许的扩展名。\n只允许".implode(',',$dirs[$dir]).'格式。'];
        }

        $output = [];
        if ($uploadedFile->error === UPLOAD_ERR_OK) {
            $validationModel = DynamicModel::validateData(['file' => $uploadedFile], []);
            if (!$validationModel->hasErrors()) {
                $storage=$this->getFileStorage();
                $storage->directory=$dir;
                $path = $storage ->save($uploadedFile);
                $output = ['error'=>0,'url'=>$storage->getUploadUrl() . '/' . $path];

            } else {
                $output['error'] = 1;
                $output['message'] = $validationModel->errors;
            }
        } else {
            $output['error'] = 1;
            $output['message'] = $this->resolveErrorMessage($uploadedFile->error);
        }
        return $output;
    }



    protected function resolveErrorMessage($value)
    {
        switch ($value) {
            case UPLOAD_ERR_OK:
                return false;
                break;
            case UPLOAD_ERR_INI_SIZE:
                $message = 'The uploaded file exceeds the upload_max_filesize directive in php.ini.';
                break;
            case UPLOAD_ERR_FORM_SIZE:
                $message = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.';
                break;
            case UPLOAD_ERR_PARTIAL:
                $message = 'The uploaded file was only partially uploaded.';
                break;
            case UPLOAD_ERR_NO_FILE:
                $message = 'No file was uploaded.';
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                $message = 'Missing a temporary folder.';
                break;
            case UPLOAD_ERR_CANT_WRITE:
                $message = 'Failed to write file to disk.';
                break;
            case UPLOAD_ERR_EXTENSION:
                $message = 'A PHP extension stopped the file upload.';
                break;
            default:
                return null;
                break;
        }
        return $message;
    }
}
