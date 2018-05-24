<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
$this->title = "Update Post";

?>
<?= Html::a('Go Back',['/posts/view','id'=>$post->id],['class'=>'btn btn-primary']); ?>
<h1><?= $this->title?></h1>

<?php $form = ActiveForm::begin(); ?>

<div>
    <?= $form->errorSummary($post); ?>
</div>

<?= $form->field($post, 'title')->textInput(); ?>


<?= $form->field($post, 'posts_images')->fileInput(); ?>

<?= $form->field($post, 'body')->textArea(['rows'=>'8']); ?>

<div class="form-group">
    <?= Html::submitButton("Update Post", ['class'=>'btn btn-primary']); ?>
</div>

<?php ActiveForm::end(); ?>