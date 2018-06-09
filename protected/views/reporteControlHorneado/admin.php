<?php
/* @var $this ReporteControlHorneadoController */
/* @var $model ReporteControlHorneado */


$this->breadcrumbs=array(
	'Reporte Control Horneados'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('icon' => 'glyphicon glyphicon-list','label'=>'Listar ReporteControlHorneado', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear ReporteControlHorneado', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#reporte-control-horneado-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php echo BsHtml::pageHeader('Administrar','Reporte Control Horneados') ?>
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
			'id'=>'reporte-control-horneado-grid',
			'dataProvider'=>$model->search(),
			'filter'=>$model,
			'columns'=>array(
        		//'id',
		'fecha',
		'tanda',
		array( 
			'name'=>'producto',
			//'header'=>'Centro de Costos',
			'value'=>'$data->producto0->nombre',
		),
		'cantidad',
		'averias',
		/*
		'codigo_reproceso',
		'numero_programa',
		'temperatura_salida',
		'temperatura_coccion',
		'sostenimiento_tiempo',
		'sostenimiento_temperatura_interna',
		'caract_organoleptica_color',
		'caract_organoleptica_olor',
		'caract_organoleptica_sabor',
		'caract_organoleptica_textura',
		'caract_fisicas_tamano',
		'caract_fisicas_forma',
		'responsable_id',
		*/
				array(
					'class'=>'bootstrap.widgets.BsButtonColumn',
					'template'=>'{view}',
					
				),
			),
        )); ?>
    </div>
</div>




