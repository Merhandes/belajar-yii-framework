<?php
namespace app\controllers;

//my-article//hello-world
//my-article ->
class MyArticleController extends \yii\web\controller{
    // public $defaultAction = 'hello-world';
    // hello-world
    // Hello-World
    public function actionHelloWorld($id = 14, $message='test'){
        echo "Hello World ".$id.' '.$message;
    }

    public function actionHi(){
        echo "Hi";
    }
}
?>