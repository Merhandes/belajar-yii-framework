<?php
$this->title = 'Page - About us';

$this->registerMetaTag(['name' => 'keywords', 'content' => 'yii2, advanced'])
?>
<br>
page footer
<div>
    <?php echo Yii::$app->view->params['sharedVariable'] ?>
     <!-- <?php echo $this->context->id ?> -->
      <!-- <?php echo '<pre>';
      var_dump($this->context);
      echo '</pre>'; ?> -->
</div>