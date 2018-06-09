<?php
/* @var $this AuthitemController */
/* @var $model Authitem */
/* @var $form CActiveForm */
?>

<div class="wide form">

	<?php 
	$form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
		'action'=>Yii::app()->createUrl($this->route),
		'method'=>'get',
		)
	); 
	?>
	<?php echo $form->textFieldControlGroup($model, 'name', array('size'=>60,'maxlength'=>64));  ?>
	<?php echo $form->textFieldControlGroup($model, 'type');  ?>
	<?php echo $form->textAreaControlGroup($model, 'description', array('rows'=>6, 'cols'=>50));  ?>
	<?php echo $form->textAreaControlGroup($model, 'bizrule', array('rows'=>6, 'cols'=>50));  ?>
	<?php echo $form->textAreaControlGroup($model, 'data', array('rows'=>6, 'cols'=>50));  ?>
	<div class="form-actions">
        <?php echo BsHtml::submitButton('Buscar',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

	<?php $this->endWidget(); ?>

</div><!-- search-form -->