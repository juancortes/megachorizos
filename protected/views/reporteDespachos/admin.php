<?php
/* @var $this ReporteDespachosController */
/* @var $model ReporteDespachos */


$this->breadcrumbs=array(
	'Reporte Despachoses'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('icon' => 'glyphicon glyphicon-list','label'=>'Listar ReporteDespachos', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear ReporteDespachos', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#reporte-despachos-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php echo BsHtml::pageHeader('Administrar','Reporte Despachoses') ?>
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
			'id'=>'reporte-despachos-grid',
			'dataProvider'=>$model->search(),
			'filter'=>$model,
			'columns'=>array(
        		'id',
		'fecha_reporte',
		'destino',
				'buttons'=>array( 
						'update' => array(
							'visible' => 'Yii::app()->user->checkAccess("Admin1")',
						),
						'delete' => array(
							'visible' => 'Yii::app()->user->checkAccess("Admin1")',
						),
					),
			),
        )); ?>
    </div>
</div>




