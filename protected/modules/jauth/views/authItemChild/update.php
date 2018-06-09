<?php
/* @var $this EncuestaController */
/* @var $model Encuesta */

$this->breadcrumbs = array(
    'Jererquías' => array('index'),
    $model->parent . ' - ' . $model->child => array('view', 'parent' => $model->parent, 'child' => $model->child),
    'Editar',
);
$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Listar Jerarquías', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear Jerarquía', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'Detalles Jerarquía', 'url'=>array('view', 'parent' => $model->parent, 'child' => $model->child)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar Jerarquía', 'url'=>array('admin')),
);
?>
<?php echo BsHtml::pageHeader('Editar','Jerarquía: '.$model->parent . ' - ' . $model->child) ?>
<?php echo $this->renderPartial('_form', array('model' => $model)); ?>