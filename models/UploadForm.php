<?php
namespace app\models;
use Yii;
use app\models\WriteUploadFileData;
use yii\web\UploadedFile;
use yii\helpers\Inflector;

class UploadForm extends WriteUploadFileData
{
    /**
     * @var UploadedFile[]
     */
    public $imageFiles;

    public function rules()
    {
        return [
            [['imageFiles'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg', 'maxFiles' => 5],
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) { 
            foreach ($this->imageFiles as $file) {
                //сюда strlower и проч
                $fileBaseName = strtolower(Inflector::transliterate($file->baseName));
                if(file_exists(Yii::getAlias('@app').'/web/uploads/' . $fileBaseName . '.' . $file->extension)){
                    $fileBaseName = $fileBaseName. date('-y-m-d-H-i-s');
                }
                $file->saveAs(Yii::getAlias('@app').'/web/uploads/' . $fileBaseName . '.' . $file->extension);
                $this->WriteUploadFileData($fileBaseName . '.' . $file->extension);                
                echo '<pre>';
                var_dump($fileBaseName);
                var_dump(mb_detect_encoding($file->baseName));
                echo '</pre>';

            }
            return true;
        } else {
            return false;
        }
    }
    public function WriteUploadFileData($filename){
        $modelDb = new WriteUploadFileData;
        $modelDb->id = NULL;
        $modelDb->isNewRecord = true;
        $modelDb->name = $filename;
        if ($modelDb->validate()){
            $modelDb->save(false);
        }
       
        return;
    }

}
