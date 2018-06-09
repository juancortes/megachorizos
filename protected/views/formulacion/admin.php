<?php
/* @var $this FormulacionController */
/* @var $model Formulacion */


$this->breadcrumbs=array(
	'Formulacions'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('icon' => 'glyphicon glyphicon-list','label'=>'Listar Formulacion', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear Formulacion', 'url'=>array('create')),
);


?>

<?php echo BsHtml::pageHeader('Administrar','Formulacions') ?>
<div class="panel panel-default">
    

        <?php $this->widget('bootstrap.widgets.BsGridView',array(
			'id'=>'formulacion-grid',
			'dataProvider'=>$model->search(),
			'filter'=>$model,
			'columns'=>array(
				array(
					'name'=>'producto_id',
					//'header'=>'Centro de Costos',
					'value'=>'$data->producto->nombre',
					'htmlOptions'=>array('width'=>'400px'),
				),
				array(
					'name'=>'materia_prima',
					//'header'=>'Centro de Costos',
					'value'=>'$data->materiaPrima->materia_prima',
					'htmlOptions'=>array('width'=>'400px'),
				),
				'peso',
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




