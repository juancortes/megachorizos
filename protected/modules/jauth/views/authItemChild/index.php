<?php
$this->breadcrumbs = array(
	'Jerarquías',
	);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear Jerarquía', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar Jerarquías', 'url'=>array('admin')),
);
	?>
	<?php echo BsHtml::pageHeader('Jerarquías') ?>
	<?php
	$this->widget('bootstrap.widgets.BsListView', array(
		'dataProvider' => $dataProvider,
		'itemView' => '_view',
		));
		?>
		<script>
			$(function ()
				{ $(".ttp").tooltip();
			});
		</script>
