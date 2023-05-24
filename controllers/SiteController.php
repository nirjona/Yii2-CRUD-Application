<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Posts;
use yii\db\Query;
use yii\widgets\ActiveForm;




class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        // now, this function returning rendering to view home. to access this $posts in that rendered page,
        $post = Posts::find()->all();
        return $this->render('home', ['post' => $post]);
        
    }
    public function actionCreate()
    {
        $posts = new Posts();
        if($posts->load(Yii::$app->request->post()) && $posts->save()) {
            Yii::$app->getSession()->setFlash('success', 'Book created successfully.');
            return $this->redirect(['index', 'id' => $posts->id]);
        }
        return $this->render('create', ['posts' => $posts]);
    }

    public function actionUpdate($id)
    {
        $book = Posts::findOne($id);

        if(!$book) {
            throw new \yii\web\NotFoundHttpException('The requested book does not exist.');
        }
        if ($book->load(Yii::$app->request->post()) && $book->save()) {
            Yii::$app->getSession()->setFlash('message', 'Book updated successfully.');
            return $this->redirect(['index', 'id' => $book->id]);
        }
        return $this->render('update', ['book' => $book]);

    }

    public function actionDelete($id)
    {
        $book = Posts::findOne($id);
        if ($book) {
            $book->delete();
            Yii::$app->getSession()->setFlash('message', 'Book deleted successfully.');
            return $this->redirect(['index', 'id' => $book->id]);
        }
    }
    public function actionTestDatabaseConnection()
   {
    $query = new Query;
    $data = $query->select('*')->from('post')->all();
    // Output or handle the retrieved data as needed
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}

//class BookController extends Controller
//{
//    public function actionCreate()
//    {
//        $posts = new Posts();
//        if ($posts->load(Yii::$app->request->post()) && $posts->save()) {
//            Yii::$app->session->setFlash('success', 'Book created successfully.');
//            return $this->redirect([['view', 'id' => $posts->id]]);
//        }
//        return $this->render('create', ['posts' => $posts]);
//    }
//}
