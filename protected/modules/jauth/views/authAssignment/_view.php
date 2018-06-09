<div class="view">
    <span>
        <?php
        echo CHtml::link(null, array('#'), array(
            'class' => 'glyphicon glyphicon-eye-open pull-right ttp',
            'data-toggle' => "tooltip",
            'data-original-title' => "Detalles",
            'style'=>'padding-left: 5px;',
            'submit' => array('view', 'itemname' => $data->itemname, 'userid' => $data->userid),)
        );
        ?>
    </span>
    <b><?php
        echo CHtml::link(null, array('#'), array(
            'class' => 'glyphicon glyphicon-trash pull-right ttp',
            'data-toggle' => "tooltip",
            'data-original-title' => "Eliminar",
            'submit' => array('delete', 'itemname' => $data->itemname, 'userid' => $data->userid),
            'confirm' => '¿Está seguro de eliminar éste ítem?')
        );
        ?></b>
        <b><?php echo CHtml::encode($data->getAttributeLabel('itemname')); ?>:</b>
        <?php echo CHtml::encode($data->itemname); ?>
        <br />

        <b><?php echo CHtml::encode($data->getAttributeLabel('userid')); ?>:</b>
        <?php echo CHtml::encode($data->userid); ?>
        <br />

    </div>