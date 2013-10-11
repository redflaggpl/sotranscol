<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>
<div class="row-fluid">
	<div class="span4">&nbsp;</div>
	<div class="span4">
		<?php
		$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		    'id'=>'login-form',
		    'type'=>'vertical',
		    'enableClientValidation'=>true,
			'clientOptions'=>array(
				'validateOnSubmit'=>true,
			),
			'htmlOptions'=>array('class'=>'well'),
		)); ?>
		<h1>Login</h1>
		<?php echo $form->errorSummary($model); ?>
		<p>Please fill out the following form with your login credentials:</p>
		    <?php echo $form->textFieldRow($model, 'username',array('class'=>'span12')); ?>
		    <?php echo $form->passwordFieldRow($model, 'password',array('class'=>'span12',"hint"=>"
			Si nunca ha cambiado su contraseña ingrese: <br> <kbd>su documento</kbd>/<kbd>su documento</kbd>."));?>
		    <?php echo $form->checkBoxRow($model, 'rememberMe'); ?>
		<div class="row-fluid">
			<div class="span12" style="padding-top: 10px">
		    	<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Login','size'=>'large')); ?>
			</div>
		</div>
		 
		<?php $this->endWidget(); ?>
	</div><!-- content -->
	<div class="span4">&nbsp;</div>
</div><!-- content -->
