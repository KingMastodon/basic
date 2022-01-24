   
<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
?>
<h1><?= Html::encode($this->title) ?></h1>
<?= DetailView::widget([
        'model' => $model,
        'attributes' => [            
            'name'            
        ],
    ]) ?>

<?= Html::img($model->getImage());?>
                    
                