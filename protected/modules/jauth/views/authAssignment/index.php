<?php
$this->breadcrumbs = array(
	'Asignaciones',
	);

$this->menu=array(
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear Asignación', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar Asignaciones', 'url'=>array('admin')),
	);
	?>


	<?php echo BsHtml::pageHeader('Asignaciones') ?>


	<?php $this->widget('bootstrap.widgets.BsListView',array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_view',
		)
		); 	?>

