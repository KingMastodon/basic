<?php
namespace app\controllers;
use yii\data\Pagination;
use Yii;
use yii\web\Controller;
use app\models\UploadForm;
use app\models\WriteUploadFileData;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class UploadFormController extends Controller
{
    public function actionUpload()
    {
        $model = new UploadForm();
        
        if (Yii::$app->request->isPost) {
            $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
            if ($model->upload()) {
                // file is uploaded successfully
                return;
            }
        }

       return $this->render('upload', ['model' => $model]);
    }
    public function actionIndex()
    {
        $modelWrite = new WriteUploadFileData();
        $dataProvider = $modelWrite->search();

        return $this->render('index', [
            
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionImgview($id)
    {
        return $this->render('imgview', [
            'model' => $this->findModel($id),
        ]);
    }
    protected function findModel($id)
    {
        if (($model = WriteUploadFileData::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


}
