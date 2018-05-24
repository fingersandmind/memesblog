<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use common\models\User;

$this->title = $post->title;

?>
<?= Html::a('Go Back',['/posts/index'],['class' => 'btn btn-primary']); ?>

<h1>
<?php if(!Yii::$app->user->isGuest): ?>
    <span class="pull-right">
        <?php if($user->role == User::ROLE_ADMIN): ?>
            <?= Html::a('Delete',['delete','id' => $post->id],['class'=>'btn btn-danger',
            'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]); ?>
        <?php endif; ?>
        <?php if($user->role == User::ROLE_EDITOR || $user->role == User::ROLE_ADMIN): ?>
            <?= Html::a('Update Post',
                ['/posts/update','id'=>$post->id],
                ['class'=>'btn btn-primary']);?>
        <?php endif; ?>
    </span>
<?php endif; ?>
    <?= $this->title ?>
</h1>
<div style="margin-top:-15px; color: #777; font-style: italic">by: <?= $post->user->username;?></div>
<hr>
<div>
    <?= $post->body; ?>
</div>
<div class="panel-body">
    <?php echo Html::img('@web/UploadedFile/'.$post->posts_images) ?>
    </div>
<div class="row">
    <div class="col-md-4">
        <?php if(Yii::$app->user->isGuest): ?>
            <br><br>
            Please <?= Html::a('login',['/site/login'])?> to make 
            a comment.
        <?php else: ?>

            <!-- <h3>Add a Comment</h3> -->
            <?php $form=ActiveForm::begin() ?>
            <div>
                <?= $form->errorSummary($comment); ?>
            </div>
            <?= $form->field($comment, 'comment')->textArea(); ?>
            <div class="form-group">
                <?= Html::submitButton('Add Comment', 
                    ['class'=>'btn btn-default']); ?>
            </div>
            <?php ActiveForm::end(); ?>

        <?php endif; ?>

    </div>
    <div class="col-md-4">
        <h2>Comments</h2>
        <?php foreach($post->comments as $comment): ?>
            <div class="alert alert-info">
                <?= $comment->user->fullname ?> said on 
                    <?= date('F d, Y g:i a', strtotime($comment->create_at)) ?> : <br>
            </div>
            <div class="word-wrap">
                <div class="row">
                    <div class="col-xs-4">
                        <?= $comment->comment ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
