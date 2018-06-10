<?php
/* @var $this FormulaEstimadoController */
/* @var $model FormulaEstimado */


$this->breadcrumbs=array(
	'Formula Estimados'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear FormulaEstimado', 'url'=>array('create')),
);


echo BsHtml::pageHeader('Administrar','Formula Estimados') ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo BsHtml::button('Advanced search',array('class' =>'search-button', 'icon' => BsHtml::GLYPHICON_SEARCH,'color' => BsHtml::BUTTON_COLOR_PRIMARY), '#'); ?></h3>
    </div>
    <div class="panel-body">
        

        <?php $this->widget('bootstrap.widgets.BsGridView',array(
			'id'=>'formula-estimado-grid',
			'dataProvider'=>$model->search(),
			'filter'=>$model,
			'columns'=>array(
        		'id',
		'fecha',
		array(
			'name'  => 'producto',
			'value' => '$data->producto->nombre'
		),
		'peso',
		array(
			'name'  => 'longitud',
			'value' => 'round($data->longitud,2)'
		),
		'insumo_id',
				array(
					'class'=>'bootstrap.widgets.BsButtonColumn',
				),
			),
        )); ?>
    </div>
</div>




