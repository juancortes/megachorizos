<?php
/* @var $this AuthitemController */
/* @var $model Authitem */

$this->breadcrumbs = array(
    'Autorizaciones' => array('index'),
    'Administrar',
    );

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Listar Autorizaciones', 'url'=>array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear Autorizaciones', 'url'=>array('create')),
    );

Yii::app()->clientScript->registerScript('search', "
    $('.search-button').click(function(){
     $('.search-form').toggle();
     return false;
 });
$('.search-form form').submit(function(){
	$('#authitem-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
return false;
});
");
?>

<?php echo BsHtml::pageHeader('Administrar','Autorizaciones') ?>
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
                'name',
                'type',
                'description',
                'bizrule',
                'data',
                array(
                    'type'=>'raw',
                    'value'=>'CHtml::link("<span class=\"glyphicon glyphicon-list-alt\"></span>", array("view", "id" => $data->name), array("data-toggle" => "tooltip", "data-original-title" => "Detalle"));',
                    ),
                array(
                    'type'=>'raw',
                    'value'=>'CHtml::link("<span class=\"glyphicon glyphicon-edit\"></span>", array("update", "id"=>$data->name), array("data-toggle" => "tooltip", "data-original-title" => "Editar"));',
                    ),
                array(
                    'type'=>'raw',
                    'value'=>'CHtml::link("<span class=\"glyphicon glyphicon-minus-sign\"></span>", "#", array("submit"=>array("delete","id"=>$data->name),"confirm"=>"¿Está seguro de eliminar este ítem?","data-toggle" => "tooltip", "data-original-title" => "Eliminar"));',
                    ),
                ),
            )
        ); 
        ?>
    </div>
</div>
