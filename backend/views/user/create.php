<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $userForm \backend\models\UserEditForm */

$this->title = Yii::t('app', 'Create User');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

?>

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
