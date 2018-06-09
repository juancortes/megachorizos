<div class="view">
    <span>
        <?php
        echo CHtml::link(null, array('#'), array(
            'class' => 'glyphicon glyphicon-eye-open pull-right ttp',
            'data-toggle' => "tooltip",
            'data-original-title' => "Detalles",
            'style'=>'padding-left: 5px;',
            'submit' => array('view', 'parent' => $data->parent, 'child' => $data->child),)
        );
        ?>
    </span>
    <span><?php
        echo CHtml::link(null, array('#'), array(
            'class' => 'glyphicon glyphicon-trash pull-right ttp',
            'data-toggle' => "tooltip",
            'data-original-title' => "Eliminar",
            'submit' => array('delete', 'parent' => $data->parent, 'child' => $data->child),
            // 'style'=>'padding-left: 5px;',
            'confirm' => '¿Está seguro de eliminar éste ítem?')
        );
        ?>
    </span>
    <b><?php echo CHtml::encode($data->getAttributeLabel('parent')); ?>:</b>
    <?php echo CHtml::encode($data->getParent($data)); ?>
    <?php //echo CHtml::encode($data->parent . ' (' . Obrero::getTextTypeAuthItem($data->parent0->type) . ')');  ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('child')); ?>:</b>
    <?php echo CHtml::encode($data->getChild($data)); ?>
    <br />
</div>