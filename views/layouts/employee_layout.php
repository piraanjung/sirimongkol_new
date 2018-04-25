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
    AppAsset::register($this);
}
?>
    <?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">

    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
            <title>
                <?= Html::encode($this->title) ?>
            </title>
            <?php $this->head() ?>
            
            <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">

    </head>

    <body>
        <?php $this->beginBody() ?>

        <div class="wrapper">
            <div class="sidebar" data-color="blue">
                <div class="logo">
                    <a href="#" class="simple-text">
                        จ่ายเงินงวดงาน
                    </a>
                </div>
                <div class="sidebar-wrapper">
                    <ul class="nav">
                        <li>
                            <?=Html::a('<i class="material-icons">dashboard</i>
                            <p>จ่ายเงินงวดงานรายช่าง</p>',['employee/instalment/index']);?>

                        </li>
                    </ul>
                </div>
                <div class="sidebar-background"></div>
            </div>
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
                            
                            <a class="navbar-brand" href="#">
                            <i class="material-icons navbar_close">backspace</i> โครงการ สิริมงคล 6
                            <i class="material-icons navbar_open" style='display:none'>slideshow</i>
                            </a>

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
                                            <?=Html::img("@web/images/4.jpg");?>
                                        </a>
                                    </div>
                                    <div class="content">
                                        <h6 class="category text-gray">พนักงาน</h6>
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