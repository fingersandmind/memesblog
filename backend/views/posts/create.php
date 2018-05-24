<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;


$this->title = "Create a Post";
?>
<?= Html::a('Go Back',['posts/index'], ['class' => 'btn btn-primary']); ?>

<h1><?= $this->title;?></h1>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

<div>
    <?= $form->errorSummary($model); ?>
</div>

<?= $form->field($model, 'title')->textInput(); ?>

<?= $form->field($model, 'posts_images')->fileInput() ?>

<?= $form->field($model, 'body')->textArea(['rows' => '8']); ?>

<div class="form-group">
    <?= Html::submitButton("Create Post", ['class'=>'btn btn-primary']); ?>
</div>

<?php ActiveForm::end(); ?>