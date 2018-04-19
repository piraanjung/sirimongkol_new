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
        <div class="sidebar" data-color="purple" data-image="<?=Html::img('@web/images/sidebar-3.jpg')?>">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

        Tip 2: you can also add an image using data-image tag
    -->
            <div class="logo">
                <a href="#" class="simple-text">
                    ความคืบหน้าโครงการ
                </a>
            </div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <?php
                            $projects = \app\models\Project::find()->all();
                            foreach($projects as $project){ 
                    ?>
                    <li>
                        <?=Html::a('<i class="material-icons">dashboard</i>
                            <p>'.$project['projectname'].'</p>','#');?>
                            
                        </a>
                    </li>
                    <?php } ?>
                
                </ul>
            </div>
        <div class="sidebar-background" ></div></div>
        <div class="main-panel">
            <nav class="navbar navbar-transparent navbar-absolute">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        
                        <!-- <a class="navbar-brand" href="#"> <?=$project['projectname'];?></a>     -->
                    </div>
                    <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <?= Breadcrumbs::widget([
                                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                                ]);
                            ?>
                        </li>
                    </ul>
                
                    </div>
                </div>
            </nav>
            <div class="content">
                <div class="container-fluid">
                    <?=$content;?>
                </div>
            </div>
            
            <div class="fixed-plugin">
                <div class="dropdown">
                    <a href="#" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-cog fa-2x"> </i>
                    </a>
                    <ul class="dropdown-menu">
                        <li style="width:100%">

                        <div class="card card-profile">
                                <div class="card-avatar">
                                    <a href="#pablo">
                                        <?=Html::img("@web/images/marc.jpg");?>
                                    </a>
                                </div>
                                <div class="content">
                                    <h6 class="category text-gray">ผู้บริหาร</h6>
                                    <h4 class="card-title">
                                        <?php 
                                            $user = \app\models\Profile::find()
                                                ->where(['user_id' => Yii::$app->user->identity->id])->one();
                                            echo $user['name'];
                                        ?>
                                    </h4>
                                    <p class="card-content">
                                        <!-- Don't be scared of the truth because we need to restart the human foundation in truth And I love you like Kanye loves Kanye I love Rick Owens’ bed design but the back is... -->
                                    </p>
                                    <?=Html::a('Profile', ['user/settings/profile'],[
                                        'class'=>'btn btn-primary btn-round',
                                        'data'=>['method' => 'post','user_id' => Yii::$app->user->identity->id]
                                    ]);?>
                                    <?=Html::a('Log out', ['user/security/logout'],[
                                        'class'=>'btn btn-danger btn-round',
                                        'data'=>['method' => 'post']
                                    ]);?>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
