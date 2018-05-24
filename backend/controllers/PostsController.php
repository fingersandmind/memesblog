<?php

namespace backend\controllers;
use Yii;
use backend\models\Posts;
use backend\models\Comments;
use common\models\User;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\components\AccessRule;
use yii\web\UploadedFile;

class PostsController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'only' => ['create','update','delete'],
                'rules'=>[
                    [
                        'actions'=>['create','update'],
                        'allow' => true,
                        'roles' => ['@']
                    ],
                    [
                        'actions' => ['delete'],
                        'allow' => true,
                        'roles' => [User::ROLE_ADMIN]
                    ]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],


        ];
    }
    public function actionCreate()
    {
        $model = new Posts;
        $model->user_id = Yii::$app->user->id;

        if($model->load(Yii::$app->request->post()) ){
            $imageFile = UploadedFile::getInstance($model, 'posts_images');
            if(isset($imageFile->size)){
                $rand = rand(0,999);
                $imageFile->saveAs('UploadedFile/'.$rand.$imageFile->baseName.'.'.$imageFile->extension);
            }
            $model->posts_images = $rand.$imageFile->baseName.'.'.$imageFile->extension;
            $model->save();

            $this->redirect(['posts/view','id'=>$model->id]);
            Yii::$app->session->setFlash('A new posts has been created!');
        }

        return $this->render('create', compact('model'));
    }

    public function actionDelete($id)
    {
        $user = Yii::$app->user->identity;
        $post = Posts::findOne($id);

        if($user->role = User::ROLE_ADMIN){
            {
                // foreach($post->comments as $comment){
                //     $comment->delete();
                // }
                Yii::$app->db->createCommand()->delete('comments','post_id=:id',[':id'=>$id])->execute();
                $this->findPost($id)->delete();
                return $this->redirect(['posts/index']);
            }
        }
    }

    public function actionIndex()
    {
        $recentPosts = Posts::find()
            ->orderBy('updated_at DESC')
            ->limit(15)->all();
        return $this->render('index', compact('recentPosts'));
    }

    public function actionUpdate($id)
    {
        $user = Yii::$app->user->identity;
        $post = Posts::findOne($id);
        if($user->role > User::ROLE_EDITOR && $user->id !== $post->user_id){
            throw new \yii\web\UnauthorizedHttpException('You do not have any authorization of this post.');
        }        

        if($post->load(Yii::$app->request->post()) ) {
            $imageFile = UploadedFile::getInstance($post, 'posts_images');
            if(isset($imageFile)){
                $imageFile->saveAs('UploadedFile/'.$imageFile->baseName.'.'.$imageFile->extension);
            }
            $post->posts_images = $imageFile->baseName.'.'.$imageFile->extension;

            $post->save();
            $this->redirect(['/posts/view', 'id'=>$id]);
        }

        return $this->render('update', compact('post'));
    }

    public function actionView($id)
    {
        $user = Yii::$app->user->identity;
        $post = Posts::findOne($id);
        $comment = new Comments;
        $comment->user_id = Yii::$app->user->id;
        $comment->post_id = $id;

        if($comment->load(Yii::$app->request->post()) && $comment->save()) {
            Yii::$app->session->setFlash('info','A new comment has been added.');
            $this->redirect(['posts/view', 'id'=>$id]);
        }

        return $this->render('view',compact('post','comment','user'));
    }
    protected function findPost($id)
    {
        if (($post = Posts::findOne($id)) !== null) {
            return $post;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
