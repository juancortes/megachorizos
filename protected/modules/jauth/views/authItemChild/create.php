<?php
$this->breadcrumbs=array(
	'Jerarquías'=>array('index'),
	'Crear',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Listar Jerarquías', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar Jerarquías', 'url'=>array('admin')),
);
?>

<h1>Crear Jererquía de permisos</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>