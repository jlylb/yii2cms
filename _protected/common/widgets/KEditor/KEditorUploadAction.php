<?php
namespace common\widgets\KEditor;

use yii\helpers\Json;
use yii\web\UploadedFile;
use yii\base\Action;

class KEditorUploadAction extends Action{
	
	public function run(){
		$dir=isset($_GET['dir'])?trim($_GET['dir']):'file';
		$ext_arr = array(
			'image' => array('gif', 'jpg', 'jpeg', 'png', 'bmp'),
			'flash' => array('swf', 'flv'),
			'media' => array('swf', 'flv', 'mp3', 'wav', 'wma', 'wmv', 'mid', 'avi', 'mpg', 'asf', 'rm', 'rmvb'),
			'file' => array('doc', 'docx', 'xls', 'xlsx', 'ppt', 'htm', 'html', 'txt', 'zip', 'rar', 'gz', 'bz2'),
		);
		if(empty($ext_arr[$dir])){
			echo Json::encode(array('error'=>1,'message'=>'目录名不正确。'));
			exit;
		}
		$originalurl='';
		$filename='';
		$date=date('Ymd');
		$id=0;
		$max_size=2097152; //2MBs
		
		$upload_image=UploadedFile::getInstanceByName('imgFile');
        
        var_dump(is_object($upload_image));
        var_dump(get_class($upload_image)==='UploadedFile');
        
		$upload_dir=KEditor::getUploadPath().'/'.$dir;
		if(!file_exists($upload_dir)) mkdir($upload_dir);
		$upload_dir=$upload_dir.'/'.$date;
		if(!file_exists($upload_dir)) mkdir($upload_dir);
		
		$upload_url=KEditor::getUploadUrl().'/'.$dir.'/'.$date;
		
        if(is_object($upload_image)){
			if($upload_image->size > $max_size){
				echo Json::encode(array('error'=>1,'message'=>'上传文件大小超过限制。'));
				exit;
			}
			//新文件名
           	$filename=date("YmdHis").'_'.rand(10000, 99999);
           	$ext=$upload_image->getExtension();
			if(in_array($ext, $ext_arr[$dir]) === false){
				echo Json::encode(array('error'=>1,'message'=>"上传文件扩展名是不允许的扩展名。\n只允许".implode(',',$ext_arr[$dir]).'格式。'));
				exit;
			}
           	$uploadfile=$upload_dir.'/'.$filename.'.'.$ext;
           	$originalurl=$upload_url.'/'.$filename.'.'.$ext;
			
			$upload_image->saveAs($uploadfile);
			echo Json::encode(array('error'=>0,'url'=>$originalurl));
		}else{
			echo Json::encode(array('error'=>1,'message'=>'未知错误'));
		}
	}
}
