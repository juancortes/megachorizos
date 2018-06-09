<div class="row-fluid">

    <?php
    $form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
        'id' => 'auth-item-form',
        'enableAjaxValidation' => false,
        'errorMessageCssClass' => 'alert alert-error',
        ));
        ?>

        <p class="note">Los campos con <span class="required">*</span> son obligatorios.</p>

        <?php echo $form->errorSummary($model, null, null, array('class' => 'alert alert-error')); ?>

        <?php echo $form->dropDownListControlGroup($model, 'parent',AuthItem::model()->getAuthItem());  ?>
        <?php echo $form->dropDownListControlGroup($model, 'child',AuthItem::model()->getAuthItem());  ?>

        <?php
        echo BsHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array(
            'color' => BsHtml::BUTTON_COLOR_PRIMARY
            )
        );
        ?>

        <?php $this->endWidget(); ?>

</div><!-- form -->