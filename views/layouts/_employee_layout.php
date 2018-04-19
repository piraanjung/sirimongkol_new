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
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="skin-blue sidebar-mini" style="height: auto; min-height: 100%;">
<?php $this->beginBody() ?>

<div class="wrapper" style="height: auto; min-height: 100%;">

<header class="main-header">

  <!-- Logo -->
  <a href="index2.html" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b></b></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>พนักงาน</b></span>
  </a>

  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- Messages: style can be found in dropdown.less-->

        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <?php echo Html::img('@web/adminlte/dist/img/user2-160x160.jpg',['class'=>'user-image']) ?>

            <span class="hidden-xs">พนักงาน</span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
            <?php echo Html::img('@web/adminlte/dist/img/user2-160x160.jpg',['class'=>'user-image']) ?>
              <p>
                <?php 
                    $user = \app\models\Profile::find()
                          ->where(['user_id' => Yii::$app->user->identity->id])->one();
                    echo $user['name']." - พนักงาน";
                ?>
              </p>
            </li>
            <!-- Menu Body -->
            
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left">
              <?= Html::a('Profile', ['/user/profile/show', 'id'=> Yii::$app->user->identity->id], ['class'=>'btn btn-default btn-flat']) ?>
              </div>
              <div class="pull-right">
              <?= Html::a('Sign out', ['/user/security/logout'], 
                  [
                    'class'=>'btn btn-default btn-flat',
                    'data' => [
                      'confirm' => "Are you sure you want to delete profile?",
                      'method' => 'post'
                    ]
                  ]
              ) ?>
              </div>
            </li>
          </ul>
        </li>
        <!-- Control Sidebar Toggle Button -->
        <li>
          <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
        </li>
      </ul>
    </div>

  </nav>
</header>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar" style="height: auto;">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <!-- <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"> -->
      </div>
      <div class="pull-left info">
        <!-- <p>Alexander Pierce</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
      </div>
    </div>
   
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu tree" data-widget="tree">
      <li class="header">จัดการงวดงาน</li>
      <li class="active treeview menu-open">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>งวดงาน</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li>
              <?= Html::a('<i class="fa fa-circle-o"></i>จ่ายเงินงวดงานรายช่าง', ['/employee/instalment/index']) ?>
            </li>
          </ul>
        </li>
       
    
      
    </section>
  <!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="min-height: 960px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">

    <?= Breadcrumbs::widget([
      'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
      ]);
    ?>
  </section>
  <br>

  <!-- Main content -->
  <section class="content">
  <?=$content;?>
   </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <ul>
  <li>
              <?= Html::a('Profile', ['/user/profile/show', 'id'=> Yii::$app->user->identity->id], ['class'=>'btn btn-default btn-flat']) ?>
    </li>
    <li>
              <?= Html::a('Sign out', ['/user/security/logout'], 
                  [
                    'class'=>'btn btn-default btn-flat',
                    'data' => [
                      'confirm' => "Are you sure you want to delete profile?",
                      'method' => 'post'
                    ]
                  ]
              ) ?>
            </li>
  </ul>
</aside>
<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class="control-sidebar-bg">
  
</div>

</div>
<div class="footer">
  
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
