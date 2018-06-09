<div class="row-fluid">
    <?php
    /* @var $this AuthitemController */
    /* @var $model Authitem */
    /* @var $form CActiveForm */
    ?>

    <div class="form">

        <?php
        $form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
            'id' => 'authitem-form',
            'enableAjaxValidation' => false,
            'errorMessageCssClass' => 'alert alert-error',
            ));
            ?>

            <p class="note">Los campos con <span class="required">*</span> son obligatorios.</p>

            <?php echo $form->errorSummary($model, null, null, array('class' => 'alert alert-error')); ?>

            <?php echo $form->textFieldControlGroup($model, 'name');  ?>
            <?php echo $form->dropDownListControlGroup($model, 'type', $model->getTipo());  ?>
            <?php echo $form->textAreaControlGroup($model, 'description', array('rows' => 6, 'cols' => 50));  ?>
            
            <?php
            echo BsHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array(
                'color' => BsHtml::BUTTON_COLOR_PRIMARY
                )
            );
            ?>
        

            <?php $this->endWidget(); ?>

        </div><!-- form -->
    </div>