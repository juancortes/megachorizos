<?php
/* @var $this AuthitemChildController */
/* @var $model AuthitemChild */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php
    $form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
        ));
        ?>

        <?php echo $form->dropDownListControlGroup($model, 'itemname',AuthItem::model()->getAuthItem(), array('empty'=>'Todos'));  ?>
        <?php echo $form->dropDownListControlGroup($model, 'userid',User::model()->getUsers(), array('empty'=>'Todos'));  ?>

        <?php 
        echo BsHtml::submitButton('Buscar', array(
            'color' => BsHtml::BUTTON_COLOR_PRIMARY
            )
        );
        ?>

        <?php $this->endWidget(); ?>

</div><!-- search-form -->