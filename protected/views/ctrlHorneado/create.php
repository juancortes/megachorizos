<?php
/* @var $this CtrlHorneadoController */
/* @var $model CtrlHorneado */
?>

<?php
$this->breadcrumbs=array(
	'Ctrl Horneados'=>array('index'),
	'Crear',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Listar CtrlHorneado', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar CtrlHorneado', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Crear','CtrlHorneado') ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>