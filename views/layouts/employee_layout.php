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
                    จ่ายเงินงวดงาน
                </a>
            </div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li>
                        <?=Html::a('<i class="material-icons">dashboard</i>
                            <p>จ่ายเงินงวดงานรายช่าง</p>',['employee/instalment/index']);?>
                            
                    </li>
                    <!-- <li>
                        <a href="./user.html">
                            <i class="material-icons">person</i>
                            <p>User Profile</p>
                        </a>
                    </li>
                    <li>
                        <a href="./table.html">
                            <i class="material-icons">content_paste</i>
                            <p>Table List</p>
                        </a>
                    </li>
                    <li class="active">
                        <a href="./typography.html">
                            <i class="material-icons">library_books</i>
                            <p>Typography</p>
                        </a>
                    </li>
                    <li>
                        <a href="./icons.html">
                            <i class="material-icons">bubble_chart</i>
                            <p>Icons</p>
                        </a>
                    </li>
                    <li>
                        <a href="./maps.html">
                            <i class="material-icons">location_on</i>
                            <p>Maps</p>
                        </a>
                    </li>
                    <li>
                        <a href="./notifications.html">
                            <i class="material-icons text-gray">notifications</i>
                            <p>Notifications</p>
                        </a>
                    </li>
                    <li class="active-pro">
                        <a href="upgrade.html">
                            <i class="material-icons">unarchive</i>
                            <p>Upgrade to PRO</p>
                        </a>
                    </li> -->
                </ul>
            </div>
        <div class="sidebar-background"></div></div>
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
                        <a class="navbar-brand" href="#"> โครงการ สิริมงคล 6 </a>

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
                        <!-- <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="#pablo" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="material-icons">dashboard</i>
                                    <p class="hidden-lg hidden-md">Dashboard</p>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="material-icons">notifications</i>
                                    <span class="notification">5</span>
                                    <p class="hidden-lg hidden-md">Notifications</p>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="#">Mike John responded to your email</a>
                                    </li>
                                    <li>
                                        <a href="#">You have 5 new tasks</a>
                                    </li>
                                    <li>
                                        <a href="#">You're now friend with Andrew</a>
                                    </li>
                                    <li>
                                        <a href="#">Another Notification</a>
                                    </li>
                                    <li>
                                        <a href="#">Another One</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#pablo" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="material-icons">person</i>
                                    <p class="hidden-lg hidden-md">Profile</p>
                                </a>
                            </li>
                        </ul> -->
                        <!-- <form class="navbar-form navbar-right" role="search">
                            <div class="form-group is-empty">
                                <input type="text" class="form-control" placeholder="Search">
                                <span class="material-input"></span>
                            <span class="material-input"></span></div>
                            <button type="submit" class="btn btn-white btn-round btn-just-icon">
                                <i class="material-icons">search</i>
                                <div class="ripple-container"></div>
                            </button>
                        </form> -->
                    </div>
                </div>
            </nav>
            <div class="content">
                <div class="container-fluid">
                    <?=$content;?>
                </div>
            </div>
            <!-- <footer class="footer">
                <div class="container-fluid">
                    <nav class="pull-left">
                        <ul>
                            <li>
                                <a href="#">
                                    Home
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Company
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Portfolio
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Blog
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <p class="copyright pull-right">
                        ©
                        <script type="text/javascript" async="" src="http://www.google-analytics.com/ga.js"></script><script>
                            document.write(new Date().getFullYear())
                        </script>2018
                        <a href="http://www.creative-tim.com">Creative Tim</a>, made with love for a better web
                    </p>
                </div>
            </footer> -->
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
