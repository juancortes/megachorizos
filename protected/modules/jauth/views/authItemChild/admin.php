<?php
/* @var $this AuthitemchildController */
/* @var $model Authitemchild */

$this->breadcrumbs = array(
    'Jerarquías' => array('index'),
    'Adminstrar',
    );

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Listar Jeraquías', 'url'=>array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear Jerarquía', 'url'=>array('create')),
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
<?php echo BsHtml::pageHeader('Administrar','Jerarquías') ?>
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
        <!-- search-form -->

        <?php $this->widget('bootstrap.widgets.BsGridView',array(
            'id'=>'pais-grid',
            'dataProvider'=>$model->search(),
            // 'filter'=>$model,
            'columns' => array(
                'parent',
                'child',
                array(
                    'type'=>'raw',
                    'value'=>'CHtml::link("<span class=\"glyphicon glyphicon-list-alt\"></span>", array("view", "parent" => $data->parent, "child" => $data->child), array("data-toggle" => "tooltip", "data-original-title" => "Detalle"));',
                    ),
                array(
                    'type'  => 'raw',
                    'value'=>'CHtml::link("<span class=\"glyphicon glyphicon-edit\"></span>", "#", array("submit" => array("update", "parent" => $data->parent, "child" => $data->child), "data-toggle" => "tooltip", "data-original-title" => "Editar"));',
                    ),
                array(
                    'type'  => 'raw',
                    'value'=>'CHtml::link("<span class=\"glyphicon glyphicon-minus-sign\"></span>", "#", array("submit" => array("delete", "parent" => $data->parent, "child" => $data->child), "confirm" => "¿Está seguro de eliminar éste ítem?", "data-toggle" => "tooltip", "data-original-title" => "Eliminar"));',
                    ),
                ),
            )
); 
?>
</div>
</div>