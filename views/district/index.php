<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel dungphanxuan\vnlocation\models\DistrictSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Quận/Huyện';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="district-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="pull-right">
        <p>
            <?php echo Html::a('<i class="fa fa-plus-circle" aria-hidden="true"></i> Create District', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    </div>

    <?php Pjax::begin(['id' => 'datas', 'timeout' => 3000, 'scrollTo' => 0]); ?>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => [

            [
                'attribute'      => 'id',
                'format'         => 'raw',
                'headerOptions'  => ['style' => 'text-align:center'],
                'contentOptions' => ['style' => 'width:7%;text-align:center'],
            ],
            [
                'attribute' => 'city_id',
                'value'     => function ($model) {
                    return $model->city ? $model->city->name : null;
                },
                'filter'    => \yii\helpers\ArrayHelper::map(\dungphanxuan\vnlocation\models\City::find()->all(), 'id', 'name')
            ],
            'name',
            //'slug',
            'full_name',
            // 'short_name',
            'code',
            [
                'attribute'      => 'total_ward',
                'format'         => 'raw',
                'headerOptions'  => ['style' => 'text-align:center'],
                'contentOptions' => ['style' => 'width:15%;text-align:center'],
                'value'          => function ($model) {
                    return Html::a($model->total, [
                        '/go/ward/index',
                        'district_id' => $model->id
                    ], ['class' => 'alink', 'target' => '_blank', 'data-pjax' => 0]);

                },
            ],
            // 'code_ghn',
            // 'code_vtp',
            // 'code_kerry',
            // 'code_spl',
            // 'kind_from',
            // 'kind_to',
            // 'allow',
            // 'priority',
            // 'image_base_url:url',
            // 'image_path',
            // 'lat',
            // 'lng',
            // 'status',
            // 'created_at',
            // 'updated_at',

            ['class' => 'dungphanxuan\vnlocation\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
