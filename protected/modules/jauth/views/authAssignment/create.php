<?php
$this->breadcrumbs=array(
	'Asignaciones'=>array('index'),
	'Crear',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Listar Asignaciones', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar Asignaciones', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Crear','Asignación') ?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>