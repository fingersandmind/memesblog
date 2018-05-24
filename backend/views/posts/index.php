<?php
use yii\helpers\Html;

?>
<div align="center"><?php echo Html::img('@web/UploadedFile/memes2.jpg'); ?></div> <br><br>
<div>
    <?php if(Yii::$app->user->isGuest): ?>
        <span class="pull-right">Please <?= Html::a('login',['/site/login'])?> to create a post.</span>
    <?php else: ?>
        <?= Html::a('Create Post',['/posts/create'],
            ['class'=>'btn btn-primary btn-lg pull-right']); ?>
    <?php endif; ?>
</div>



<?php foreach($recentPosts as $post): ?>
<br><br><br><br>

<div class="panel panel-info">
    <div class="panel"> <h3><?= $post->user->fullname ?></h3> </div>
        <div class="panel-body">
            <?= Html::a("<strong>$post->title</strong>",['/posts/view',
                'id'=>$post->id]); ?>
            <span class="pull-right"> 
                <small><?= date('F d, Y g:i a', strtotime($post->created_at)) ?></small>
            </span>
        </div>
    <div class="panel-body">
        <?= $post->body ?>
    </div>
        <div class="panel-body">
            <?php echo Html::a(Html::img('@web/UploadedFile/'.$post->posts_images),['posts/view','id' => $post->id]) ?>
        </div>
</div>
<?php endforeach; ?>