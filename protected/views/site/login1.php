<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
  'Login',
  );
  ?>

  <legend>Login</legend>
  <div class="row">
    <div class="col-sm-offset-3 col-sm-6">
      <p>Por favor complete el siguiente formulario con sus datos de acceso:</p>
      <div class="form">
        <?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
          'id'=>'login-form',
          'enableClientValidation'=>true,
          'clientOptions'=>array(
            'validateOnSubmit'=>true,
            ),
            )); ?>

            <!-- <p class="note">Los campos <span class="required">*</span> son obligatorios.</p> -->
            <?php echo $form->textFieldControlGroup($model, 'username'); ?>
            <?php echo $form->passwordFieldControlGroup($model, 'password'); ?>
            <?php echo $form->checkBoxControlGroup($model, 'rememberMe'); ?>

            <?php
            echo BsHtml::submitButton('Entrar', array(
              'color' => BsHtml::BUTTON_COLOR_PRIMARY
              )
            );
            ?>

            <?php $this->endWidget(); ?>
          </div><!-- form -->
        </div>
      </div>
