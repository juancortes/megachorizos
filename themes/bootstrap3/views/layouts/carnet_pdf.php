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
	// $cs->registerCssFile($themePath . '/css/bootstrap.css');
	// $cs->registerCssFile($themePath . '/css/bootstrap-theme.css');
	// $cs->registerCssFile($baseUrl . '/static/css/jcustom.css');
	// $cs->registerCssFile($baseUrl . '/static/bootstrap-datepicker/css/bootstrap-datetimepicker.min.css');

	/**
	 * JavaScripts
	 */
	// $cs->registerCoreScript('jquery', CClientScript::POS_END);
	// $cs->registerCoreScript('jquery.ui', CClientScript::POS_END);
	// $cs->registerScriptFile($themePath . '/js/bootstrap.min.js', CClientScript::POS_END);
	// $cs->registerScript('tooltip', "$('[data-toggle=\"tooltip\"]').tooltip();$('[data-toggle=\"popover\"]').tooltip()", CClientScript::POS_READY);
	?>
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	    <script src="<?php echo $baseUrl . '/static/js/html5shiv.js'; ?>"></script>
	    <script src="<?php echo $baseUrl . '/static/js/respond.min.js'; ?>"></script>
	    <![endif]-->
	    <?php // $cs->registerScriptFile($baseUrl.'/static/js/moment.min.js'); ?>
	    <?php // $cs->registerScriptFile($themePath.'/js/transition.js'); ?>
	    <?php // $cs->registerScriptFile($themePath.'/js/collapse.js'); ?>
	    <?php // $cs->registerScriptFile($baseUrl.'/static/bootstrap-datepicker/js/bootstrap-datetimepicker.min.js'); ?>

	    <?php $cs->registerCssFile($baseUrl.'/static/360GS/css/reset.css'); ?>
	    <?php $cs->registerCssFile($baseUrl.'/static/360GS/css/text.css'); ?>
	    <?php $cs->registerCssFile($baseUrl.'/static/360GS/css/960.css'); ?>
	    <?php $cs->registerCssFile($baseUrl.'/static/360GS/css/demo.css'); ?>
	    <!-- <link rel="stylesheet" href="css/reset.css" />
	    <link rel="stylesheet" href="css/text.css" />
	    <link rel="stylesheet" href="css/960.css" />
	    <link rel="stylesheet" href="css/demo.css" /> -->
	    <title><?php //echo CHtml::encode($this->pageTitle); ?></title>
	</head>

	<body ng-app>
		<div class="container" id="page">
			<?php echo $content; ?>

		</div><!-- page -->

	</body>
	</html>
