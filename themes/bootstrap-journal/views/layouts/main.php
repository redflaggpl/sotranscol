<!DOCTYPE html>
<html lang="<?php echo Yii::app()->language;?>">
  <head>
    <meta charset="<?php echo Yii::app()->charset;?>">
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap-responsive.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/main.css" />
  
    <link rel="shortcut icon" href="<?php echo Yii::app()->theme->baseUrl;?>/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo Yii::app()->theme->baseUrl;?>/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo Yii::app()->theme->baseUrl;?>/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo Yii::app()->theme->baseUrl;?>/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?php echo Yii::app()->theme->baseUrl;?>/ico/apple-touch-icon-57-precomposed.png">
  
  </head>

  <body>
<?php $this->widget('bootstrap.widgets.TbNavbar', array(
    'type'=>'inverse', // null or 'inverse'
    'fluid'=>true, 
    'brand'=>Yii::app()->name,
    'brandUrl'=>'#',
    'collapse'=>true, // requires bootstrap-responsive.css
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'items'=>Yii::app()->tii->builtMenu(),
        ),
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'htmlOptions'=>array('class'=>'pull-right'),
            'encodeLabel'=>false,
            'items'=>array(
                array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
                array('label'=>Yii::t('GTranslate.app','Language'), 'url'=>'#', 'items'=>Yii::app()->translate->builtMenu()),
            ),
        ),
    )
  )); 
?>

    <div class="container-fluid">
      <div class="row-fluid visible-desktop"><div class="span12" style="height:60px"></div></div>
  
      <?php if(isset($this->breadcrumbs)):?>
        <?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
          'links'=>$this->breadcrumbs,
        )); ?><!-- breadcrumbs -->
      <?php endif?>
      <?php $this->widget('bootstrap.widgets.TbAlert', array(
          'block'=>true, // display a larger alert block?
          'fade'=>true, // use transitions?
          'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
          'alerts'=>array( // configurations per alert type
              'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
              'info'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
              'warning'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
              'error'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
          ),
        )
      ); ?>
      <?php echo $content; ?>
      
    </div><!--/.fluid-container-->
      <footer class="footer">
      <div class="container" style="padding-left: 20px;padding-right: 20px">
        <p class="pull-right"><a href="#">Back to top</a></p>
        <p>Copyright &copy; <?php echo date('Y'); ?> by My Company. 
          All Rights Reserved.</p>
        <ul class="footer-links">
          <li><?php echo Yii::powered(); ?></li>
        </ul>
      </div>
    </footer>

  </body>
</html>
