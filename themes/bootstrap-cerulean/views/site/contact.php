<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

$this->pageTitle=Yii::app()->name . ' - Contact Us';
$this->breadcrumbs=array(
	'Contact',
);
?>


<?php if(Yii::app()->user->hasFlash('contact')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('contact'); ?>
</div>

<?php else: ?>
<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'contact-form',
    'type'=>'horizontal',
    'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
 <?php echo $form->errorSummary($model); ?>
<fieldset>
	<legend>Contact Us <small>If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.</small></legend>
 	<p>Fields with <span class="required">*</span> are required.</p>
 
    <?php echo $form->textFieldRow($model, 'name'); ?>
    <?php echo $form->textFieldRow($model, 'email'); #array('prepend'=>'@') ?>
    <?php echo $form->textFieldRow($model,'subject',array('size'=>60,'maxlength'=>128)); ?>
    <?php echo $form->textAreaRow($model, 'body',array('rows'=>4)); ?>


	<?php if(CCaptcha::checkRequirements()): ?>
		<div>
			<?php $this->widget('CCaptcha'); ?>
	    	<?php echo $form->textFieldRow($model, 'verifyCode',array('hint'=>'Please enter the letters as they are shown in the image above.
		<br/>Letters are not case-sensitive.')); ?>
		</div>
	<?php endif; ?>
    
   
</fieldset>
 
<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Submit')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>'Reset')); ?>
</div>
 
<?php $this->endWidget(); ?>
<?php endif; ?>