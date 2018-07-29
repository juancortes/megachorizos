<script type="text/javascript">
    var anularTrasladoos = function(location)
    {
        cod = location.split("/");
        cod = cod[4];
        cod = cod.split(".");
        traslado = cod[0];
        //alert(cod);
        $.post('../Traslados/anular', 
        {
          traslado:traslado
        },function(res)
        {
            alertify.alert(res);
            $.fn.yiiGridView.update('traslados-grid');
        }); 
    }           
</script>
<?php
/* @var $this TrasladosController */
/* @var $model Traslados */


$this->breadcrumbs=array(
	'Trasladoses'=>array('admin'),
	'Administrar',
);

$this->menu=array(
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear Traslados', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#traslados-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php echo BsHtml::pageHeader('Administrar Traslados') ?>
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
			'id'=>'traslados-grid',
			'dataProvider'=>$model->search(),
			'filter'=>$model,
			'columns'=>array(
        		'id',
        		'fecha',
        		'responsable',
        		'verificado',
                array(
                    'name'=>'estado',
                    'value' => '$data->estado == 1 ? "Activo": "Anulado"'
                ),
                array(
                    'class'     => 'bootstrap.widgets.BsButtonColumn',
                    'template'  => '{view}{anular}',
                    'buttons' => array(
                        'anular'=>array(
                            'url'=>'Yii::app()->controller->createUrl("actuaciones/cerrar", array("id"=>$data->id))',
                            'imageUrl'=>'../images/anular.jpeg',
                            'click' => 'js:function(e) {
                                             
                                             e.preventDefault();
                                             var location = $(this).attr("href");
                                             
                                             bootbox.confirm({
                                                message: "Realmente quiere anular esta traslado?",
                                                buttons: {
                                                    confirm: {
                                                        label: "Si",
                                                        className: "btn-success"
                                                    },
                                                    cancel: {
                                                        label: "No",
                                                        className: "btn-danger"
                                                    }
                                                },
                                                callback: function (confirm) {
                                                    if (confirm) { anularTrasladoos(location); }
                                                     
                                                }
                                            });
                                             
                                            return false;
                                    }',
                                    'visible'=>'((Yii::app()->user->checkAccess("Admin1")== 1 ) ) ? true: true ',
                            ),
                    ),
                ),
            ),
        )); ?> 
    </div>
</div>




