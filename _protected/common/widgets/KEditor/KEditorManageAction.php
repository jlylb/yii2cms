<?php
namespace common\widgets\KEditor;
use yii;
use yii\web\Response;

class KEditorManageAction extends BaseAction{

    public function init()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        Yii::$app->request->enableCsrfValidation = false;
    }

	public function run(){

        $dir=\Yii::$app->getRequest()->get('dir','image');
        $path=\Yii::$app->getRequest()->get('path','');

        $dirs=$this->getAllowExts();

        if(!$this->checkDirectory($dir,$dirs)){
            return ['error'=>1,'message'=>'目录名不正确。'];
        }
		//图片扩展名
		$imageExt = array('gif', 'jpg', 'jpeg', 'png', 'bmp');

		//遍历目录取得文件信息
		$fileList = array();
        if(!$path||$path=='.'){
            $currentPath=$dir.'/';
        }else{
            $currentPath=$path;
        }
        $storage=$this->getFileStorage();
        $files=$storage->getFilesystem()->listContents($currentPath);

		$i=0;
		foreach($files as $file){

			if($file['type']=='dir'){
                $fileList[$i]['is_dir'] = true; //是否文件夹
                $fileList[$i]['has_file'] = count($storage->getFilesystem()->listContents($file['path'])); //文件夹是否包含文件
                $fileList[$i]['filesize'] = 0; //文件大小
                $fileList[$i]['is_photo'] = false; //是否图片
                $fileList[$i]['filetype'] = ''; //文件类别，用扩展名判断
			}else{
                $fileList[$i]['is_dir'] = false;
                $fileList[$i]['has_file'] = false;
                $fileList[$i]['filesize'] = $file['size'];
                $fileList[$i]['dir_path'] = '';
				$fileExt = $file['extension'];
                $fileList[$i]['is_photo'] = in_array($fileExt, $imageExt);
                $fileList[$i]['filetype'] = $fileExt;
			}
            $fileList[$i]['filename'] =  $file['basename']; //文件名，包含扩展名
            $fileList[$i]['datetime'] = date('Y-m-d H:i:s', $file['timestamp']);
			$i++;
		}
		
		usort($fileList, array($this,'cmp_func'));

		$result = array();
		//相对于根目录的上一级目录
		$result['moveup_dir_path'] = dirname($currentPath);
		//相对于根目录的当前目录
		$result['current_dir_path'] = $currentPath;
		//当前目录的URL
		$result['current_url'] = $storage->baseUrl.'/'.$currentPath;
		//文件数
		$result['total_count'] = count($fileList);
		//文件列表数组
		$result['file_list'] = $fileList;

        return $result;

	}
	
	//排序
	public function cmp_func($a, $b) {
        $order=\Yii::$app->getRequest()->get('order','name');
		if ($a['is_dir'] && !$b['is_dir']) {
			return -1;
		} else if (!$a['is_dir'] && $b['is_dir']) {
			return 1;
		} else {
			if ($order == 'size') {
				if ($a['filesize'] > $b['filesize']) {
					return 1;
				} else if ($a['filesize'] < $b['filesize']) {
					return -1;
				} else {
					return 0;
				}
			} else if ($order == 'type') {
				return strcmp($a['filetype'], $b['filetype']);
			} else {
				return strcmp($a['filename'], $b['filename']);
			}
		}
	}
}
?>