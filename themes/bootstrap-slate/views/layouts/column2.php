<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="row-fluid column-top">
	<div class="span12">
		<h4 class="title"><?php echo $this->header===null?$this->pageTitle:$this->header;?></h4> 
		<?php $this->widget('bootstrap.widgets.TbMenu', array(
		    'type'=>'pills',
		    #'tooltip'=>'bottom',
		    'htmlOptions'=>array('class'=>'pull-right','style'=>'margin-bottom: 0px'),
		    'items'=>$this->menu,
		)); ?>
	</div>
</div>
<div class="row-fluid column-bottom">
	<div class="span12">
		<?php echo $content; ?>
	</div>
</div><!-- content -->
<?php $this->endContent(); ?>