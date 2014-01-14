<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"></meta>
        <meta name="language" content="nl"></meta>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"></meta>
        <meta name="robots" content="index, nofollow"></meta>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/style/css/main.css"></link>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/style/css/bootstrap.min.css"></link>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/style/javascript/jquery-1.10.2.min.js" ></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/style/javascript/bootstrap.min.js" ></script>
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>
    <body>
        <div class="container">
            <?php echo $content; ?>
        </div>
    </body>
</html>