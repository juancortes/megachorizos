<script type="text/javascript">
	function subirArchivo(nombre)
	{
		var parametros = {
                "nombre": nombre
            };

            $.ajax({
                type: "post",
                dataType: "json",
                url: 'subirArchivo',
                //contentType: false,
                data:parametros,
                //processData: false,
            }).done(function(respuesta) {
               
               
            });
	}

</script>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'ctrl-producciones-trazabilidad-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>
asfasfasdf
<?php $this->widget('ext.EAjaxUpload.EAjaxUpload',
array(
        'id'=>'uploadFile',
        'config'=>array(
               'action'=>Yii::app()->createUrl('producto/upload'),
               'allowedExtensions'=>array("txt"),//array("jpg","jpeg","gif","exe","mov" and etc...
               'sizeLimit'=>100*1024*1024,// maximum file size in bytes
               //'minSizeLimit'=>10*1024*1024,// minimum file size in bytes
               'onComplete'=>"js:function(id, fileName, responseJSON){ subirArchivo(responseJSON.filename); }",
               //'messages'=>array(
               //                  'typeError'=>"{file} has invalid extension. Only {extensions} are allowed.",
               //                  'sizeError'=>"{file} is too large, maximum file size is {sizeLimit}.",
               //                  'minSizeError'=>"{file} is too small, minimum file size is {minSizeLimit}.",
               //                  'emptyError'=>"{file} is empty, please select files again without it.",
               //                  'onLeave'=>"The files are being uploaded, if you leave now the upload will be cancelled."
               //                 ),
               //'showMessage'=>"js:function(message){ alert(message); }"
              )
)); ?>


<?php $this->endWidget(); ?>