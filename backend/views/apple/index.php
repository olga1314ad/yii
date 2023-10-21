<?php

use app\models\Apple;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\AppleSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Apples';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="apple-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Apple', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php $form = \yii\widgets\ActiveForm::begin([
            'id' => 'apple_form',
            'method' => 'post'
    ]);?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            'id',
            [
                'value'=>function (Apple $model) {
                    return $model->color->name;
                }
             ],
            [
                'label' => 'Appeared at',
                'value'=>function (Apple $model) {
                    return date('d-m-Y H:i:s', $model->created_at, );
                }
            ],
            [
                'label' => 'Fell down at',
                'value'=>function (Apple $model) {
                    if ($model->fallen_at) {
                        return date('d-m-Y H:i:s', $model->fallen_at, );
                    }
                    return '';
                }
            ],
            [
                'label' => 'Status',
                'value'=>function (Apple $model) {
                    switch ($model->status) {
                        case 1:
                            return "fallen";
                        case 2:
                            return "spoiled";
                        default:
                            return 'on the three';
                    }
                }
            ],
           [
                'format' => 'raw',
                'value' => function($model) use ($form) {
                    if($model->status != Apple::SPOILED){
                        return $form->field($model, 'eaten[' .$model->id .']')
                            ->textInput(array('value' => $model->eaten, 'type' => 'number', 'min' => $model->eaten, 'max' => 100));
                    }
                    return $form->field($model, 'eaten[' .$model->id .']')
                        ->textInput(array('value' => $model->eaten, 'disabled' => true, 'title' => 'spoiled apples can not be eaten'));
                }
            ],
            //'condition',
            //'deleted_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Apple $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>
    <?php echo Html::submitButton('Change', ['class' => 'btn btn-primary', 'name' => 'apple_button']);?>
    <?php \yii\widgets\ActiveForm::end();?>

    <?php Pjax::end(); ?>

</div>
