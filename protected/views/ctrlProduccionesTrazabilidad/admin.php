<script type="text/javascript">
	var anularTraza = function(location)
  	{
	  	cod = location.split("/");
	  	cod = cod[4];
	  	cod = cod.split(".");
	  	orden = cod[0];
	  	//alert(cod);
	  	$.post('../CtrlProduccionesTrazabilidad/anular',
	  	{
		  orden:orden
		},function(res)
		{
            alertify.alert(res);
			$.fn.yiiGridView.update('ctrl-producciones-trazabilidad-grid');
		});	
	}			
</script>

<?php
/* @var $this CtrlProduccionesTrazabilidadController */
/* @var $model CtrlProduccionesTrazabilidad */


$this->breadcrumbs=array(
	'Orden de Producción'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear Orden de Producción', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#ctrl-producciones-trazabilidad-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php echo BsHtml::pageHeader('Administrar Orden de Producción') ?>
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
			'id'=>'ctrl-producciones-trazabilidad-grid',
			'dataProvider'=>$model->search(),
			'filter'=>$model,
			'columns'=>array(
		'orden_produccion',
		'fecha',
		array(
			'name'=>'producto',
			//'header'=>'Centro de Costos',
			'value'=>'$data->producto0->nombre',
			'htmlOptions'=>array('width'=>'450px'),
			'filter'=>CHtml::listData(Producto::model()->findAll(array('order'=>'nombre ')),'id','nombre'),
		),
		array(
			'name'=>'estado',
			'value' => '$data->estado == 1 ? "Activo": "Anulado"'
		),
		/*
		'responsable',
		'destino',
		'cantidad',
		*/
				array(
					'class'=>'bootstrap.widgets.BsButtonColumn',
					'template'=>'{update}{view}{anular}',
					'buttons' => array(
							'anular'=>array(
											 'url'=>'Yii::app()->controller->createUrl("actuaciones/cerrar", array("id"=>$data->id))',
											 'imageUrl'=>'../images/anular.jpeg',
											 
											 'click' => 'js:function(e) {
											 
											 e.preventDefault();
											 var location = $(this).attr("href");
											 
											 bootbox.confirm({
											    message: "Realmente quiere anular esta orden de producción?",
											    buttons: {
											        confirm: {
											            label: "Yes",
											            className: "btn-success"
											        },
											        cancel: {
											            label: "No",
											            className: "btn-danger"
											        }
											    },
											    callback: function (confirm) {
											        if (confirm) { anularTraza(location); }
													 
											    }
											});
											 
										 	return false;
									 }',
									 'visible'=>'(Yii::app()->user->checkAccess("Admin1")== 1)  ? true: true ',
						 	),
					),
				),
			),
        )); ?>
    </div>
</div>




