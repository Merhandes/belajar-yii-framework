<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use app\models\LoginForm;
use app\models\TestModel;
use Psy\VarDumper\Dumper;
use app\models\ContactForm;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

class SiteController extends Controller
{
    public $enableCsrfValidation = false;
    // public function beforeAction($action){
    //     return parent::beforeAction($action);
    // }
    public $layout = 'main';
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

    // public function beforeAction($action)
    // {
        // echo '<pre>';
        // var_dump($action);
        // echo '</pre>';
        // if($action->id === 'index'){
        //     $this->layout = 'admin';
        //     $this->enableCsrfValidation = false;
        // }
        // return parent::beforeAction($action);
    // }

    // public function afterAction($action, $result){
    //     echo '<pre>';
    //     var_dump($result);
    //     echo '</pre>';
    //     return parent::afterAction($action, $result);
    // }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        // Yii::$app->test->hello();
        // echo '<pre>';
        // var_dump(Yii::$app->test);
        // echo '</pre>';
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $this->layout = 'login';
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

    public function actionTest()
    {
        $test = new TestModel();

        $post = [
            'name' => 'John',
            'surname' => 'Doe',
            'email' => 'john@example.com',
            'myAge' => 30,
        ];
        $test->attributes = $post;

 

        // foreach ($test as $attr => $value){
        //     echo $attr.' '.$test->getAttributeLabel($attr) . '=' . $value . '<br>';        
        // }
        if($test->validate()){
            echo 'OK';
        }else{
            echo '<pre>';
            var_dump($test->errors);
            echo '</pre>';
            echo "Error";
        }

        // echo $test['surname'];
        // echo '<pre>';
        // var_dump($test->getAttributeLabel('surname'));
        // echo '</pre>';
    }

    public function actionHello($message){
        return $this->render('hello', [
            'msg' => $message
        ]);
    }

    public function actionRequest(){
        // echo $id;
        // echo '<pre>';
        // var_dump(Yii::$app->request->get());
        // echo '</pre>';
        // Yii::$app->request->get()
        // $id = isset($_GET['id']) ? $_GET['id'] : null;
        // $id = Yii::$app->request->get('id', 50);
        // $get = Yii::$app->request->post('name', 'Thecodeholic');
        // echo Yii::$app->request->pathInfo;
        // echo '<pre>';
        // var_dump($get);
        // echo '</pre>';
        // echo '<pre>';
        // var_dump(Yii::$app->request->getBodyParams());
        // echo '</pre>';
        $req = Yii::$app->request;

        echo '<pre>';
        var_dump($_SERVER['REMOTE_ADDR']);
        echo '</pre>';
    }

    public function actionResponse(){
        // return Yii::$app->response->redirect('about', 301)->send();
        return Yii::$app->response->sendStreamAsFile('Hello World', 'test.txt');
        // Yii::$app->response->format = Response::FORMAT_JSON;
        // Yii::$app->response->data = [
        //     'name' => 'Zura',
        //     'surname' => 'Somthing'
        // ];
        // return [
        //     'name' => 'Zura',
        //     'surname' => 'Somthing'
        // ];
        // throw new ServerErrorHttpException();
        // $response = Yii::$app->response;
        // $response->statusCode = 500;
        // $response->content = 'Hello From Thecodeholic';
    }
}
