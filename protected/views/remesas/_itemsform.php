<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'remesas-form',
	'enableAjaxValidation'=>false,
    //'action'=>'/index.php?r=remesas/setItem&id='.$id,
	'action'=>$this->createUrl('remesas/setItem', array('id'=>$id)),
)); ?>

	<p class="help-block">Los campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>
<div class="row-fluid">
    <div class="span12 form-search">
        <?php echo $form->textField($model,'bultos',array('class'=>'span1','maxlength'=>10, 'placeholder'=>'Bultos')); ?>
        
        <?php echo $form->textField($model,'clase',array('class'=>'span1','maxlength'=>10, 'placeholder'=>'Clase')); ?>

        <?php echo $form->textField($model,'kilos',array('class'=>'span2','maxlength'=>10, 'placeholder'=>'Kilos')); ?>
        
        <?php echo $form->textField($model,'descripcion',array('class'=>'span3','maxlength'=>255, 'placeholder'=>'Descripción')); ?>

        <?php echo $form->textField($model,'contraentrega',array('class'=>'span2','maxlength'=>10, 'placeholder'=>'Contraentrega')); ?>

        <?php echo $form->textField($model,'cta_corriente',array('class'=>'span2','maxlength'=>10, 'placeholder'=>'Cta Corriente')); ?>
        
        <?php echo $form->textField($model,'cancelado',array('class'=>'span1','maxlength'=>10, 'placeholder'=>'Cancelado')); ?>
        <?php echo $form->hiddenField($model,'remesas_id'); ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=>'Agregar Item',
        )); ?>
    
    </div>
</div>

<?php $this->endWidget(); ?>

<script type="text/javascript">
/* <![CDATA[ */
$(function() {
    var input = document.createElement("input");
    if(('placeholder' in input)==false) { 
                $('[placeholder]').focus(function() {
                        var i = $(this);
                        if(i.val() == i.attr('placeholder')) {
                                i.val('').removeClass('placeholder');
                                if(i.hasClass('password')) {
                                        i.removeClass('password');
                                        this.type='password';
                                }                       
                        }
                }).blur(function() {
                        var i = $(this);        
                        if(i.val() == '' || i.val() == i.attr('placeholder')) {
                                if(this.type=='password') {
                                        i.addClass('password');
                                        this.type='text';
                                }
                                i.addClass('placeholder').val(i.attr('placeholder'));
                        }
                }).blur().parents('form').submit(function() {
                        $(this).find('[placeholder]').each(function() {
                                var i = $(this);
                                if(i.val() == i.attr('placeholder'))
                                        i.val('');
                        })
                });
        }
});
/* ]]> */
</script>
