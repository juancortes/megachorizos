<?php
/* @var $this SeccionarOrderProdccionController */
/* @var $model SeccionarOrderProdccion */


$this->breadcrumbs=array(
	'Seccionar Order Prodccion'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear Seccionar Order de Prodccion', 'url'=>array('create')),
);


?>

<?php echo BsHtml::pageHeader('Administrar Seccionar Order de Prodccion') ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo BsHtml::button('Advanced search',array('class' =>'search-button', 'icon' => BsHtml::GLYPHICON_SEARCH,'color' => BsHtml::BUTTON_COLOR_PRIMARY), '#'); ?></h3>
    </div>
    <div class="panel-body">
        

        <?php $this->widget('bootstrap.widgets.BsGridView',array(
			'id'=>'seccionar-order-prodccion-grid',
			'dataProvider'=>$model->search(),
			'filter'=>$model,
			'columns'=>array(
				'orden_produccion_id',
				/*
				'longitud',
				'estado',
				'user_id',
				*/
				array(
					'class'=>'bootstrap.widgets.BsButtonColumn',
				),
			),
        )); ?>
    </div>
</div>




