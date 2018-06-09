<?php
/* @var $this RecepcionVegetalesController */
/* @var $model RecepcionVegetales */


$this->breadcrumbs=array(
	'Recepcion Vegetales'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('icon' => 'glyphicon glyphicon-list','label'=>'List RecepcionVegetales', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Recepcion Vegetales', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#recepcion-vegetales-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php echo BsHtml::pageHeader('Recepcion Vegetales') ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo BsHtml::button('Advanced search',array('class' =>'search-button', 'icon' => BsHtml::GLYPHICON_SEARCH,'color' => BsHtml::BUTTON_COLOR_PRIMARY), '#'); ?></h3>
    </div>
    <div class="panel-body">
        <p>
            You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>
                &lt;&gt;</b>
            or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
        </p>

        <div class="search-form" style="display:none">
            <?php $this->renderPartial('_search',array(
                'model'=>$model,
            )); ?>
        </div>
        <!-- search-form -->

        <?php $this->widget('bootstrap.widgets.BsGridView',array(
			'id'=>'recepcion-vegetales-grid',
			'dataProvider'=>$model->search(),
			'filter'=>$model,
			'columns'=>array(
        		//'id',
		'fecha_lote',
		'lote_interno',
		//'fec_vencimiento',
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
		/*
		'peso_total',
		'unidades',
		'num_lote_externo',
		'caract_fisicas_color',
		'caract_fisicas_olor',
		'caract_fisicas_textura',
		'caract_fisicas_limpieza',
		'recibido',
		'observaciones',
		*/
				array(
					'class'=>'bootstrap.widgets.BsButtonColumn',
				),
			),
        )); ?>
    </div>
</div>




