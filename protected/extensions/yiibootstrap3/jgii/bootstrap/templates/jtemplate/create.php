<?php
/**
 * The following variables are available in this template:
 * - $this: the BootstrapCode object
 */
?>
<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getControllerClass(); ?> */
/* @var $model <?php echo $this->getModelClass(); ?> */
<?php echo "?>\n"; ?>

<?php
echo "<?php\n";
$label = $this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	'$label'=>array('index'),
	'Crear',
);\n";
?>

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Listar <?php echo $this->modelClass; ?>', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar <?php echo $this->modelClass; ?>', 'url'=>array('admin')),
);
?>

<?php echo "<?php echo BsHtml::pageHeader('Crear','$this->modelClass') ?>\n"; ?>

<?php echo "<?php \$this->renderPartial('_form', array('model'=>\$model)); ?>"; ?>