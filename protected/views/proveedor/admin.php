<?php
/* @var $this ProveedorController */
/* @var $model Proveedor */


$this->breadcrumbs=array(
	'Proveedors'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('icon' => 'glyphicon glyphicon-list','label'=>'Listar Proveedor', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear Proveedor', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#proveedor-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php echo BsHtml::pageHeader('Administrar','Proveedors') ?>
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
            )); ?>
        </div>
        <!-- search-form -->

        <?php $this->widget('bootstrap.widgets.BsGridView',array(
			'id'=>'proveedor-grid',
			'dataProvider'=>$model->search(),
			'filter'=>$model,
			'columns'=>array(
        		//'id',
		'nom_proveedor',
		array(
			'name'=>'tipo',
			'value'=>'($data->tipo == 0) ? "Carnico":"No Carnico"',
			'filter'=>CHtml::listData(array(array('id'=>0,'texto'=>'Carnico'),array('id'=>1,'texto'=>'No Carnico')),'id','texto'),
		),
		'correo',
		'celular',
		'codigo_base',
		/*
		'direccion',
		'tipo_doc',
		'cedula',
		'municipio_id',
		'tipo',
		*/ 
			array(
					'class'=>'bootstrap.widgets.BsButtonColumn',
					'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',
					'deleteConfirmation'=>'Desea borrar este Insumo?',
					'buttons'=>array( 
						'update' => array(
							'visible' => 'Yii::app()->user->checkAccess("Admin1")',
						),
						'delete' => array(
							'visible' => 'Yii::app()->user->checkAccess("Admin1")',
						),
					),
				),
			),
        )); ?>
    </div>
</div>




