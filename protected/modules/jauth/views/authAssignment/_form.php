<div class="form">

    <?php
    $form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
        'id' => 'auth-assignment-form',
        'enableAjaxValidation' => false,
        'errorMessageCssClass' => 'alert alert-error',
        ));
        ?>

        <p class="note">Los campos con <span class="required">*</span> son obligatotios.</p>

        <?php echo $form->errorSummary($model, null, null, array('class' => 'alert alert-error')); ?>

        <?php echo $form->dropDownListControlGroup($model, 'itemname',AuthItem::model()->getAuthItem());  ?>
        <?php echo $form->dropDownListControlGroup($model, 'userid',User::model()->getUsers());  ?>
        
        <?php
        echo BsHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array(
            'color' => BsHtml::BUTTON_COLOR_PRIMARY
            )
        );
        ?>
        <?php $this->endWidget(); ?>

    </div><!-- form -->
    <script type="text/javascript">
        $(function(){
        //select2 plugin
        $(".select2").select2();
    });
</script>