<?php
namespace app\controllers;

use yii\web\Controller; // Correct capitalization

class PageController extends controller {
    public function actionAbout($id) {
        $this->view->params['sharedVariable'] = 'I am shared';
        return $this->render('about',[
            'a' => $id,
            'b' => 2
        ]);
        // return $this->renderContent('<h1>Hello World</h1>');
        // return $this->renderPartial('about');
        // return $this->renderFile('about');
        // return $this -> renderAjax('about');
    }
}
?>
