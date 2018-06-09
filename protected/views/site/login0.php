<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>
<!-- form -->

<div class="container">
	<div class="text-center" >

		<div id="loginHeader">
			<div class="logo-cnc">
    <img width="350" src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo_CNC_nuevo.jpg" alt="">
  </div>

  <div class="logo-empresa">
    <img width="150" src="<?php echo Yii::app()->request->baseUrl; ?>/images/EEB.jpg" alt="">
  </div>

			<p id="intro" ><?php echo Yii::app()->params['login']['intro'] ?></p>
		</div>

	</div>
      <!-- <form class="form-signin form-horizontal" method="POST" action="" > -->
      <?php $form=$this->beginWidget('CActiveForm', array(
      		'id'=>'login-form',
      		'enableClientValidation'=>true,
      			'clientOptions'=>array(
      			'validateOnSubmit'=>true,
      		),
      		'htmlOptions' => array('class' => 'form-signin'),
      )); ?>
        <h2 class="form-signin-heading">Iniciar sesión</h2>
        <div class="form-group">
          <?php echo $form->labelEx($model,'username'); ?>
          <?php echo $form->textField($model,'username', array('class' => 'form-control')); ?>
          <?php echo $form->error($model,'username', array('class' => 'text-danger') ); ?>
        </div>

        <div class="form-group">
          <?php echo $form->labelEx($model,'password'); ?>
          <?php echo $form->passwordField($model,'password', array('class' => 'form-control')); ?>
		  <?php echo $form->error($model,'password', array('class' => 'text-danger')); ?>
        </div>

		<div class="text-danger"></div>
        <button class="btn btn-md btn-primary btn-block" type="submit">Entrar</button>


      <?php $this->endWidget(); ?>

      <div class="warning-text" >
         <p class="text-center" >
          <i>Por favor si tiene alguna dificultad comuníquese con el Centro Nacional de Consultoría <?php echo Yii::app()->params['login']['telefono'] ?> en <?php echo Yii::app()->params['login']['ciudad'] ?>, con la extensión <?php echo Yii::app()->params['login']['ext'] ?> o si lo prefiere envíe un correo a <?php echo Yii::app()->params['adminEmail'] ?></i>
        </p>
      </div>

    </div>