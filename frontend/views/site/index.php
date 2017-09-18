<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\customer\CustomerSearch;

/* @var $this yii\web\View */
/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $searchModel CustomerSearch */

$this->title = 'My Yii Application';
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'firstName',
            'lastName',
            [
                'format' => 'raw',
                'header' => 'Phones',
                'value' => function ($customerSearch) {

                    return implode('<br>', $customerSearch->phones ?: []);
                }
            ],
        ],
    ]); ?>
</div>
