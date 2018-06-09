<?php
/* @var $this EncuestaController */
/* @var $model Encuesta */

$this->breadcrumbs = array(
    'Asignaciones' => array('index'),
    $model->itemname . ' - ' . $model->userid,
    );

/*$this->menu = array(
    array('label' => 'Listar', 'url' => array('index'), 'icon'=>BsHtml::GLYPHICON_LIST),
    array('label' => 'Crear', 'url' => array('create'), 'icon'=>BsHtml::GLYPHICON_FILE),
    array('label' => 'Editar', 'url' => '#', 'icon'=>BsHtml::GLYPHICON_EDIT, 'linkOptions' => array('submit' => array('update', 'itemname' => $model->itemname, 'userid' => $model->userid))),
    array('label' => 'Eliminar', 'url' => '#', 'icon'=>BsHtml::GLYPHICON_TRASH, 'linkOptions' => array('submit' => array('delete', 'itemname' => $model->itemname, 'userid' => $model->userid), 'confirm' => '¿Está seguro de eliminar éste ítem?')),
    array('label' => 'Reporte', 'url' => array('admin'), 'icon'=>BsHtml::GLYPHICON_LIST_ALT),
    );*/
$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Listar Asignaciones', 'url'=>array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear Asignación', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-edit','label'=>'Editar Asignación', 'url'=>'#', 'linkOptions' => array('submit' => array('update', 'itemname' => $model->itemname, 'userid' => $model->userid))),
    array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Eliminar Asignación', 'url'=>'#', 'linkOptions' => array('submit' => array('delete', 'itemname' => $model->itemname, 'userid' => $model->userid), 'confirm' => '¿Está seguro de eliminar éste ítem?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar Asignación', 'url'=>array('admin')),
    );
    ?>
    <?php echo BsHtml::pageHeader('Detalles','Asignación: '.$model->itemname . ' - ' . $model->userid) ?>

    <?php
    $this->widget('zii.widgets.CDetailView', array(
        'htmlOptions' => array(
            'class' => 'table table-striped table-condensed table-hover',
            ),
        'data' => $model,
        'attributes' => array(
            'itemname',
            'userid',
            ),
        ));
        ?>
