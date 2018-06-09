<?php
/* @var $this PedidosController */
/* @var $model Pedidos */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'pedidos-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Los campos con <span class="required">*</span> son obligatorios.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldControlGroup($model,'fecha',array('value'=>date('Y-m-d'))); ?>
    <?php 
        $usuario = Yii::app()->user->id;
        $user = User::model()->findByAttributes(array('username'=>$usuario));
    ?>
    <?php echo $form->hiddenField($model,'responsable',array('value'=>$user->id)); ?>
    <?php echo $form->dropDownListControlGroup($model, 'lote', CtrlProduccionesTrazabilidad::model()->getTanda(), array('id' => 'lote', 'class'=>'select select2 demo ',  'style' => 'width: 80%;','empty'=>'Seleccione un Lote'));  ?>
    <?php echo $form->dropDownListControlGroup($model, 'id_producto', Producto::model()->getProductos(), array('id' => 'id_producto', 'class'=>'select select2 demo ',  'style' => 'width: 80%;','empty'=>'Seleccione un Producto'));  ?>
    <?php echo $form->textFieldControlGroup($model,'temperatura',array('maxlength'=>255)); ?>
    <?php echo $form->dropDownListControlGroup($model, 'id_cliente', Clientes::model()->getClientes(), array('id' => 'id_cliente', 'class'=>'select select2 demo ',  'style' => 'width: 80%;','empty'=>'Seleccione un Cliente'));  ?>

    <?php echo BsHtml::submitButton('Enviar', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>

<?php $this->endWidget(); ?>
