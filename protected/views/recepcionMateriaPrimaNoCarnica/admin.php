<?php
/* @var $this RecepcionMateriaPrimaNoCarnicaController */
/* @var $model RecepcionMateriaPrimaNoCarnica */


$this->breadcrumbs=array(
	'Recepcion Materia Prima No Carnicas'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('icon' => 'glyphicon glyphicon-list','label'=>'Listar RecepcionMateriaPrimaNoCarnica', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear RecepcionMateriaPrimaNoCarnica', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#recepcion-materia-prima-no-carnica-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php echo BsHtml::pageHeader('Administrar Recepción de Materias Primas No Carnicas') ?>
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
			'id'=>'recepcion-materia-prima-no-carnica-grid',
			'dataProvider'=>$model->search(),
			'filter'=>$model,
			'columns'=>array(
		'fec_ingreso',
		'lote_interno',
		'fec_vencimiento',
		array(
			'name'=>'proveedor_id',
			//'header'=>'Centro de Costos',
			'value'=>'$data->proveedor->nom_proveedor',
			'htmlOptions'=>array('width'=>'100px'),
		),
		array(
			'name'=>'materia_prima_insumo',
			//'header'=>'Centro de Costos',
			'value'=>'$data->materiaPrimaInsumo->materia_prima',
			'htmlOptions'=>array('width'=>'100px'),
		),
		'observaciones',
		/*
		'peso_total',
		'unidades',
		'num_lote_externo',
		'caract_fisicas_empaque',
		'caract_fisicas_rotulado',
		'devolucion_si_no',
		'devolucion_peso_unidades',
		'recibido',
		*/
				array(
					'class'=>'bootstrap.widgets.BsButtonColumn',
					'template'=>'{view}{update}{delete}',
					'buttons'=>array
	    			(
						'update' => array
						(
						    'label'=>'Actilizar',     //Text label of the button.
						    'visible'=>'(Yii::app()->user->checkAccess("Admin1") || Yii::app()->user->checkAccess("admin")) ? true: false',   //A PHP expression for determining whether the button is visible.
						)
					),
				),
			),
        )); ?>
    </div>
</div>




