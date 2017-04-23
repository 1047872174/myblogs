<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tags')->textarea(['rows' => 6]) ?>

    <?php
        //one
//        $obj = \common\models\Poststatus::find()->all();
//        $allstatus = \yii\helpers\ArrayHelper::map($obj,'id','name');
        //two
//        $array = Yii::$app->db->createCommand('select id,name from poststatus')->queryAll();
//        $allstatus = \yii\helpers\ArrayHelper::map($array,'id','name');
        //three
//        $allstatus = (new \yii\db\Query())
//            ->select(['name','id'])
//            ->from('poststatus')
//            ->indexBy('id')
//            ->column();
        //four
        $allstatus = \common\models\Poststatus::find()
            ->select(['name','id'])
            ->indexBy('id')
            ->column();
        $allauthor = \common\models\Adminuser::find()
            ->select(['nickname','id'])
            ->indexBy('id')
            ->column();

    ?>
    <?= $form->field($model, 'status')->dropDownList($allstatus) ?>


    <?= $form->field($model, 'author_id')->dropDownList($allauthor) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
