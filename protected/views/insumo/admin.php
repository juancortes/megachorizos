<?php
/* @var $this InsumoController */
/* @var $model Insumo */


$this->breadcrumbs=array(
	'Insumos'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('icon' => 'glyphicon glyphicon-list','label'=>'Listar Insumo', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear Insumo', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-trash','label'=>'Vaciar Inventario', 'url'=>'#', 'linkOptions'=>array('submit'=>array('vaciar','id'=>$model->id),'confirm'=>'¿Está seguro vaciar el invitentario?')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#insumo-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php echo BsHtml::pageHeader('Administrar','Insumos') ?>
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
        <div id="statusMsg">
			<?php if(Yii::app()->user->hasFlash('success')):?>
			    <div class="flash-success">
			        <?php echo Yii::app()->user->getFlash('success'); ?>
			    </div>
			<?php endif; ?>
			 
			<?php if(Yii::app()->user->hasFlash('error')):?>
			    <div class="flash-error">
			        <?php echo Yii::app()->user->getFlash('error'); ?>
			    </div>
			<?php endif; ?>
		</div>

        <?php $this->widget('bootstrap.widgets.BsGridView',array(
			'id'=>'insumo-grid',
			'dataProvider'=>$model->search(),
			'filter'=>$model,
			'columns'=>array(
				'materia_prima',
				array(
					'name'=>'tipo',
					//'header'=>'Centro de Costos',
					'value'=>'($data->tipo == 0) ? "Carnico" : "No Carnico"',
					'htmlOptions'=>array('width'=>'100px'),
				),
				'cantidad',
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




