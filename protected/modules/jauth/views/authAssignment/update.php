<?php
/* @var $this EncuestaController */
/* @var $model Encuesta */

$this->breadcrumbs = array(
    'Asignaciones' => array('index'),
    $model->itemname . ' - ' . $model->userid => array('view', 'itemname' => $model->itemname, 'userid' => $model->userid),
    'Editar',
);
$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Listar Asignaciones', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear Asignación', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'Detalles Asignación', 'url'=>array('view', 'itemname' => $model->itemname, 'userid' => $model->userid)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar Asignación', 'url'=>array('admin')),
);
?>
<?php echo BsHtml::pageHeader('Editar','Asignación: '.$model->itemname . ' - ' . $model->userid) ?>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>