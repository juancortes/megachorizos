<?php
/* @var $this EncuestaController */
/* @var $model Encuesta */

$this->breadcrumbs = array(
    'Jerarquías' => array('index'),
    $model->parent . ' - ' . $model->child,
    );

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Listar Jerarquías', 'url'=>array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear Jerarquía', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-edit','label'=>'Editar Jerarquía', 'url'=>'#','linkOptions' => array('submit' => array('update', 'parent' => $model->parent, 'child' => $model->child))),
    array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Eliminar Jerarquía', 'url'=>'#','linkOptions' => array('submit' => array('delete', 'parent' => $model->parent, 'child' => $model->child), 'confirm' => '¿Está seguro de eliminar éste ítem?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar Jerarquía', 'url'=>array('admin')),
    );
    ?>

    <?php echo BsHtml::pageHeader('Detalles','Jerarquía: '.$model->parent . ' - ' . $model->child) ?>
    <?php
    $this->widget('zii.widgets.CDetailView', array(
        'data' => $model,
        'htmlOptions' => array(
            'class' => 'table table-striped table-condensed table-hover',
            ),
        'attributes' => array(
            array(
                'name' => 'parent',
                'value' => $model->getParent($model),
                ),
            array(
                'name' => 'child',
                'value' => $model->getChild($model),
                ),
            ),
        ));
        ?>
