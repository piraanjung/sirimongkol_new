<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

// AppAsset::register($this);

if (class_exists('ramosisw\CImaterial\web\MaterialAsset')) {
    ramosisw\CImaterial\web\MaterialAsset::register($this);
    
}
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style>
    .fixed-plugin {
    top: 50px;
}
.form-group label.control-label{
    font-size:15px !important
}
.payee_sum {
    background: #26c6da;
    color: #FFFFFF;
}
.fixed-plugin {
    position: fixed;
    /* top: 180px; */
    right: 0;
    width: 64px;
    background: rgba(0, 0, 0, .3);
    z-index: 1031;
    border-radius: 8px 0 0 8px;
    text-align: center;
}
.fixed-plugin .fa-cog {
    color: #FFFFFF;
    padding: 10px;
    border-radius: 0 0 6px 6px;
    width: auto;
}
.fixed-plugin .dropdown .dropdown-menu {
    -webkit-transform: translateY(-15%);
    -moz-transform: translateY(-15%);
    -o-transform: translateY(-15%);
    -ms-transform: translateY(-15%);
    transform: translateY(-15%);
    top: 27px;
    opacity: 0;
    transform-origin: 0 0;
}
.fixed-plugin .dropdown-menu {
    right: 80px;
    left: auto;
    width: 290px;
    border-radius: 10px;
    padding: 0 10px;
}
.fixed-plugin li.header-title {
    height: 30px;
    line-height: 25px;
    font-size: 12px;
    font-weight: 600;
    text-align: center;
    text-transform: uppercase;
}

.title{
    text-align:right;
}

.fixed-plugin li.adjustments-line, .fixed-plugin li.header-title, .fixed-plugin li.button-container {
    width: 100%;
    height: 50px;
    min-height: inherit;
}
.fixed-plugin .dropdown-menu li {
    display: block;
    padding: 5px 2px;
    width: 25%;
    float: left;
}


.fixed-plugin .dropdown.open .dropdown-menu {
    opacity: 1;
    -webkit-transform: translateY(-13%);
    -moz-transform: translateY(-13%);
    -o-transform: translateY(-13%);
    -ms-transform: translateY(-13%);
    transform: translateY(-13%);
    transform-origin: 0 0;
}
.card{
  box-shadow:none !important;
}
.nav .open>a, .nav .open>a:focus, .nav .open>a:hover {
    background-color: #ab47bc;
    border-color: #337ab7;
}
.card [data-background-color] a{
    color:#000000;
}
body,h1, h2,h3,h4 ,h5{
    font-family: 'Kanit', sans-serif;
}
    </style>
    <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">

</head>
<body>
<?php $this->beginBody() ?>

  <div class="wrapper">
     
           
                    <?=$content;?>
            
           
    </div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
