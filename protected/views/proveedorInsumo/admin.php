<?php
/* @var $this ProveedorInsumoController */
/* @var $model ProveedorInsumo */


$this->breadcrumbs=array(
	'Proveedor Insumos'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('icon' => 'glyphicon glyphicon-list','label'=>'Listar ProveedorInsumo', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear ProveedorInsumo', 'url'=>array('create')),
);


?>

<?php echo BsHtml::pageHeader('Administrar','Proveedor Insumos') ?>
<div class="panel panel-default">
   

        <?php $this->widget('bootstrap.widgets.BsGridView',array(
			'id'=>'proveedor-insumo-grid',
			'dataProvider'=>$model->search(),
			'filter'=>$model,
			'columns'=>array(
				array(
					'name'=>'proveedor_id',
					//'header'=>'Centro de Costos',
					'value'=>'$data->proveedor->nom_proveedor',
					'htmlOptions'=>array('width'=>'400px'),
				),
				array(
					'name'=>'insumo_id',
					//'header'=>'Centro de Costos',
					'value'=>'$data->insumo->materia_prima',
					'htmlOptions'=>array('width'=>'400px'),
				),
				
				'cantidad',
				array(
					'class'=>'bootstrap.widgets.BsButtonColumn',
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




