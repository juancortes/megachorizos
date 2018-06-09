<?php
/* @var $this AuthitemController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
	'Autorizaciones',
	);

$this->menu=array(
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear Autorización', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar Autorización', 'url'=>array('admin')),
	);
	?>

	<?php echo BsHtml::pageHeader('Autorizaciones') ?>
	<?php
	$this->widget('bootstrap.widgets.BsListView', array(
		'dataProvider' => $dataProvider,
		'itemView' => '_view',
		));
		?>
