<?php
/**
 * The following variables are available in this template:
 * - $this: the BootstrapCode object
 */
?>
<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getControllerClass(); ?> */
/* @var $model <?php echo $this->getModelClass(); ?> */

<?php
echo "\n";
$label = $this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	'$label'=>array('index'),
	'Administrar',
);\n";

?>

$this->menu=array(
	array('icon' => 'glyphicon glyphicon-list','label'=>'Listar <?php echo $this->modelClass; ?>', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear <?php echo $this->modelClass; ?>', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#<?php echo $this->class2id($this->modelClass); ?>-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php echo "<?php echo BsHtml::pageHeader('Administrar','$label') ?>\n"; ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo "<?php echo BsHtml::button('Búsqueda avanzada',array('class' =>'search-button', 'icon' => BsHtml::GLYPHICON_SEARCH,'color' => BsHtml::BUTTON_COLOR_PRIMARY), '#'); ?>"; ?></h3>
    </div>
    <div class="panel-body">
        <p>
            Opcionalmente puede ingresar operadores de comparación (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>
                &lt;&gt;</b>
            ó <b>=</b>) al inicio de cada uno de los valores de búsqueda para especificar cómo debe hacerse la comparación.
        </p>

        <div class="search-form" style="display:none">
            <?php echo "<?php \$this->renderPartial('_search',array(
                'model'=>\$model,
            )); ?>\n"; ?>
        </div>
        <!-- search-form -->

        <?php echo "<?php"; ?> $this->widget('bootstrap.widgets.BsGridView',array(
			'id'=>'<?php echo $this->class2id($this->modelClass); ?>-grid',
			'dataProvider'=>$model->search(),
			'filter'=>$model,
			'columns'=>array(
        <?php
        $count = 0;
        foreach ($this->tableSchema->columns as $column) {
            if (++$count == 7) {
                echo "\t\t/*\n";
            }
            echo "\t\t'" . $column->name . "',\n";
        }
        if ($count >= 7) {
            echo "\t\t*/\n";
        }
        ?>
				array(
					'class'=>'bootstrap.widgets.BsButtonColumn',
				),
			),
        )); ?>
    </div>
</div>




