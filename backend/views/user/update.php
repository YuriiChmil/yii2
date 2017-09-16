<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
/* @var $userForm backend\models\UserEditForm | \backend\models\UserCreateForm */
$this->title = Yii::t('app', 'Update User: {nameAttribute}', [
    'nameAttribute' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="user-update">

    <h1><?= Html::encode($this->title) ?></h1>


    <div class="user-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($userForm, 'userName')->textInput() ?>
        <?= $form->field($userForm, 'email')->textInput() ?>
        <?= $form->field($userForm, 'status')->dropDownList(\backend\models\User::statusList()) ?>
        <?= $form->field($userForm, 'password')->passwordInput() ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>


</div>
