
<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;



?>
<h1>upload-form/index</h1>


<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Исходное изображение',                 
                'template' => '{imgview}',
                'buttons'=>[
                    'imgview' => function ($url,$model,$key) {
                        //return Url::toRoute([$action, 'id' => $model->id]);
                        
                        //return  Url::toRoute(['upload-form/imgview', 'id' => $model]);
                        return Html::a('upload-form/imgview', $url);
                        
                     }
                ]
            ],
            'id',
            'name',
            'created:datetime',
            [
                'attribute' => 'image',
                'format' => 'html',    
                'value' => function ($modelWrite) {                   
                    return Html::img($modelWrite->getImage(),
                        ['width' => '70px']);
                },
            ], 
        ],
    ]); ?>