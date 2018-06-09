<?php
/* @var $this PersonalController */
/* @var $model Personal */
/* @var $form BSActiveForm */
?>

<script type="text/javascript">
    $(function()
    {
        $("#cedula").change(function()
        {
            if($("#cedula").val() != "")
            {
                $("#username").val($("#cedula").val());
            }
        });
    });

</script>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'personal-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>true,
)); ?>

    <p class="help-block">Los campos con <span class="required">*</span> son obligatorios.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldControlGroup($model,'nombres',array('maxlength'=>255)); ?>
    <?php echo $form->textFieldControlGroup($model,'cedula',array('maxlength'=>20,'id'=>'cedula')); ?>
    <?php echo $form->textFieldControlGroup($model,'correo',array('maxlength'=>255)); ?>
    <?php echo $form->textFieldControlGroup($model,'username',array('maxlength'=>255,'readonly'=>true,'id'=>'username')); ?>
    <?php echo $form->passwordFieldControlGroup($model,'clave',array('maxlength'=>255)); ?>
    <?php 
        if($model->isNewRecord)
            echo $form->dropdownlistControlGroup($model,'rol',User::model()->getRoles($model->cedula), array('empty'=>'Selecciona...')); 
        else
        {
            $row = Yii::app()->db->createCommand(array(
                'select' => array('itemname', 'itemname'),
                'from'   => 'AuthAssignment',
                'where'  => 'userid=:userid',
                'params' => array(':userid'=>$model->cedula),
            ))->queryRow();
            
            $model->rol = $row['itemname'];
            echo $form->dropdownlistControlGroup($model,'rol',User::model()->getRoles($model->cedula), array('empty'=>'Selecciona...')); 
       }
    ?>
    <?php echo $form->hiddenField($model,'user_id'); ?>

    <?php echo BsHtml::submitButton('Crear', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>

<?php $this->endWidget(); ?> 
