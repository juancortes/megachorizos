<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<?php
	$cs        = Yii::app()->clientScript;
	$themePath = Yii::app()->theme->baseUrl;
	$baseUrl = Yii::app()->baseUrl;

	/**
	 * StyleSHeets
	 */
	$cs->registerCssFile($themePath . '/css/bootstrap.css');
	$cs->registerCssFile($themePath . '/css/bootstrap-theme.css');
	$cs->registerCssFile($baseUrl . '/static/css/jcustom.css');
	$cs->registerCssFile($baseUrl . '/static/bootstrap-datepicker/css/bootstrap-datetimepicker.min.css');
	$cs->registerCssFile($baseUrl . '/css/tabla.css');

  	/**
    *alertify
    */
    $cs->registerCssFile($baseUrl . '/static/css/alertify.core.css');
    $cs->registerCssFile($baseUrl . '/static/css/alertify.default.css');
  	

	/**
	 * JavaScripts
	 */
	$cs->registerCoreScript('jquery', CClientScript::POS_END);
	$cs->registerCoreScript('jquery.ui', CClientScript::POS_END);
	$cs->registerScriptFile($themePath . '/js/bootstrap.min.js', CClientScript::POS_END);
	$cs->registerScript('tooltip', "$('[data-toggle=\"tooltip\"]').tooltip();$('[data-toggle=\"popover\"]').tooltip()", CClientScript::POS_READY);
	$cs->registerScriptFile($baseUrl . '/static/js/alertify.min.js');
	?>
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	    <script src="<?php echo $baseUrl . '/static/js/html5shiv.js'; ?>"></script>
	    <script src="<?php echo $baseUrl . '/static/js/respond.min.js'; ?>"></script>
	    <![endif]-->

	    <!-- key Press Validator -->
	    <?php $cs->registerScriptFile($baseUrl . '/static/js/keyPressValidator.js'); ?>

	    <!-- angularJS -->
	    <?php $cs->registerScriptFile($baseUrl . '/static/js/angular.min.js'); ?>

  	<?php $cs->registerScriptFile($baseUrl . '/static/js/aplicacion.js'); ?>
	<?php $cs->registerScriptFile($baseUrl.'/static/js/moment.min.js'); ?>
	<?php $cs->registerScriptFile($themePath.'/js/transition.js'); ?>
	<?php $cs->registerScriptFile($themePath.'/js/collapse.js'); ?>
	<?php $cs->registerScriptFile($baseUrl.'/static/bootstrap-datepicker/js/bootstrap-datetimepicker.min.js'); ?>
	<?php $cs->registerScriptFile($baseUrl.'/static/js/angular.min.js'); ?>
	<?php $cs->registerScriptFile($baseUrl.'/js/myjs.js'); ?>
	<?php $cs->registerScriptFile($baseUrl.'/js/bootbox.min.js'); ?>

	 <!-- select2 -->
	    <!-- <?php $cs->registerCssFile($baseUrl . '/static/select2/select2.css'); ?>
	    <?php $cs->registerScriptFile($baseUrl . '/static/select2/select2.js'); ?>
	    <?php $cs->registerScriptFile($baseUrl . '/static/select2/select2_locale_es.js'); ?> -->

	 <?php $cs->registerCssFile($baseUrl . '/css/select2.css'); ?>
	    <?php $cs->registerScriptFile($baseUrl . '/js/select2.js'); ?>
	    <?php $cs->registerScriptFile($baseUrl . '/js/es.js'); ?>
	    


	<?php //$cs->registerScriptFile($baseUrl . '/js/bootstrap3-typeahead.js'); ?>
	<?php $cs->registerScriptFile($baseUrl . '/js/typeahead.js'); ?>




	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body >
	<div class="container" id="page">
		<div class="bs-docs-header">
			<div class="container">
				<?php BsHtml::pageHeader(CHtml::encode(Yii::app()->name), CHtml::encode(Yii::app()->params['subtitulo'])) ?>
				<?php echo CHtml::image($baseUrl.'/images/logo.png', 'Megachorizos', array('style'=>'width: 1276px; padding-bottom: 15px;')); ?>
			</div>
		</div>




		<?php require_once('navbarMain.php'); ?>

		<?php require_once('breadcrumbs.php'); ?>

		<?php echo $content; ?>

		<div class="clear"></div>
		<hr />
		<div class="row">
			<div id="footer" style="text-align: center;">
				Desarrollado por Juan Carlos Cortes (3172177912) - Juan Fonseca 
				Copyright &copy; <?php echo date('Y'); ?> <br/>
				Todos los derechos reservados.<br/>
			</div>
		</div>

	</div><!-- page -->

</body>
</html>
