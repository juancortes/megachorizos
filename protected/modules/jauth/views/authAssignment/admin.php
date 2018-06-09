<?php
/* @var $this AuthitemchildController */
/* @var $model Authitemchild */

$this->breadcrumbs = array(
    'Asignaciones' => array('index'),
    'Administrar',
    );

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Listar Asignaciones', 'url'=>array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear Asignaciones', 'url'=>array('create')),
    );

Yii::app()->clientScript->registerScript('search', "
    $('.search-button').click(function(){
       $('.search-form').toggle();
       return false;
   });
$('.search-form form').submit(function(){
	$('#authitemchild-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
return false;
});
");
?>
<?php echo BsHtml::pageHeader('Administrar','Asignación de permisos') ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo BsHtml::button('Búsqueda avanzada',array('class' =>'search-button', 'icon' => BsHtml::GLYPHICON_SEARCH,'color' => BsHtml::BUTTON_COLOR_PRIMARY), '#'); ?></h3>
    </div>
    <div class="panel-body">
        <p>
            Opcionalmente puede ingresar operadores de comparación (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>
            &lt;&gt;</b>
            ó <b>=</b>) al inicio de cada uno de los valores de búsqueda para especificar cómo debe hacerse la comparación.
        </p>
        <div class="search-form" style="display:none">
            <?php $this->renderPartial('_search',array(
                'model'=>$model,
                )
            ); 
            ?>
        </div>
        <?php
        $this->widget('bootstrap.widgets.BsGridView', array(
            'id' => 'authitemchild-grid',
            'dataProvider' => $model->search(),
            'type' => BsHtml::GRID_TYPE_STRIPED.' '.BsHtml::GRID_TYPE_HOVER,
            'columns' => array(
                'itemname',
                'userid',
                array(
                    'type'=>'raw',
                    'value'=>'CHtml::link("<span class=\"glyphicon glyphicon-list-alt\"></span>", array("view", "itemname" => $data->itemname, "userid" => $data->userid), array("data-toggle" => "tooltip", "data-original-title" => "Detalle"));',
                    ),
                array(
                    'type'  => 'raw',
                    'value'=>'CHtml::link("<span class=\"glyphicon glyphicon-edit\"></span>", "#", array("submit" => array("update", "itemname" => $data->itemname, "userid" => $data->userid), "data-toggle" => "tooltip", "data-original-title" => "Editar"));',
                    ),
                array(
                    'type'  => 'raw',
                    'value'=>'CHtml::link("<span class=\"glyphicon glyphicon-minus-sign\"></span>", "#", array("submit" => array("delete", "itemname" => $data->itemname, "userid" => $data->userid), "confirm" => "¿Está seguro de eliminar éste ítem?", "data-toggle" => "tooltip", "data-original-title" => "Eliminar"));',
                    ),
                ),
)
);
?>
</div>
</div>