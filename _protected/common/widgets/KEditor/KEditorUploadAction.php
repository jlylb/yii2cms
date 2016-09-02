<?php
namespace common\widgets\KEditor;

use yii\web\UploadedFile;
use yii\base\Action;
use yii\web\Response;
use yii\base\DynamicModel;
use yii\helpers\FileHelper;

class KEditorUploadAction extends Action{
    use EditorTrait;

    public $fileparam='imgFile';

    public function init()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        \Yii::$app->request->enableCsrfValidation = false;
    }

    public function run()
    {
        $dir=\Yii::$app->getRequest()->get('dir','file');
		$extArr= array(
			'image' => array('gif', 'jpg', 'jpeg', 'png', 'bmp'),
			'flash' => array('swf', 'flv'),
			'media' => array('swf', 'flv', 'mp3', 'wav', 'wma', 'wmv', 'mid', 'avi', 'mpg', 'asf', 'rm', 'rmvb'),
			'file' => array('doc', 'docx', 'xls', 'xlsx', 'ppt', 'htm', 'html', 'txt', 'zip', 'rar', 'gz', 'bz2'),
		);
        if(empty($extArr[$dir])){
			return ['error'=>1,'message'=>'目录名不正确。'];
		}
        $result = [];
        $uploadedFile = UploadedFile::getInstanceByName($this->fileparam);
        $date=date('Ymd');
        $uploadDir=self::getUploadPath().'/'.$dir.'/'.$date;
        $uploadUrl=self::getUploadUrl().'/'.$dir.'/'.$date;
        FileHelper::createDirectory($uploadDir);

        //foreach ($uploadedFiles as $uploadedFile) {
            $output = [];
            if ($uploadedFile->error === UPLOAD_ERR_OK) {
                $validationModel = DynamicModel::validateData(['file' => $uploadedFile], []);
                if (!$validationModel->hasErrors()) {
                    $filename=date("YmdHis").'_'.rand(10000, 99999);
                    $ext=$uploadedFile->getExtension();
                    $allowExt=$extArr[$dir];
                    if(in_array($ext, $extArr[$dir]) === false){
                        $output = ['error'=>1,'message'=>"上传文件扩展名是不允许的扩展名。\n只允许".implode(',',$allowExt).'格式。'];
                    }else{
                        $uploadfile=$uploadDir.'/'.$filename.'.'.$ext;
                        $originalurl=$uploadUrl.'/'.$filename.'.'.$ext;

                        $uploadedFile->saveAs($uploadfile);
                        $output = ['error'=>0,'url'=>$originalurl];
                    }

                } else {
                    $output['error'] = 1;
                    $output['message'] = $validationModel->errors;
                }
            } else {
                $output['error'] = 1;
                $output['message'] = $this->resolveErrorMessage($uploadedFile->error);
            }

          //  $result[] = $output;
       // }
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
