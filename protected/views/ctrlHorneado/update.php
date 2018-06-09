<?php
/* @var $this CtrlHorneadoController */
/* @var $model CtrlHorneado */
?>

<?php
$this->breadcrumbs=array(
	'Ctrl Horneados'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Editar',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Listar CtrlHorneado', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear CtrlHorneado', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'Detalles CtrlHorneado', 'url'=>array('view', 'id'=>$model->id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar CtrlHorneado', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Editar','CtrlHorneado '.$model->id) ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>