<?php
$this->widget('bootstrap.widgets.BsNavbar', array(
	'collapse' => true,
	'brandLabel' => BsHtml::icon(BsHtml::GLYPHICON_HOME),
	'brandUrl' => Yii::app()->homeUrl,
	'items' => array(
		array(
			'class' => 'bootstrap.widgets.BsNav',
			'type' => 'navbar',
			'activateParents' => true,
			'items' => array(
				array(
					'label' => 'Acceso Personal',
					'url' => array(
						'#'
						),
					'visible' => Yii::app()->user->checkAccess("Admin1"),
					'items' => array(
						BsHtml::menuHeader(BsHtml::icon(BsHtml::GLYPHICON_BOOKMARK), array(
							'class' => 'text-center',
							'style' => 'color:#99cc32;font-size:32px;'
							)),
						array(
							'label' => 'Persona',
							'url' => array(
								'/personal/index'
								)
							),
						
						array(
							'label' => 'Items',
							'url' => array(
								'/jauth/authItem/index'
								)
							),
						array(
							'label' => 'Asignaciones',
							'url' => array(
								'/jauth/authAssignment/index',
								'view' => 'about'
								)
							),
						array(
							'label' => 'Jerarquias',
							'url' => array(
								'/jauth/authItemChild/index'
								)
							),
						)
					),
					array(
						'label' => 'Trazabilidad',
						'visible' => Yii::app()->user->checkAccess("Admin1") || Yii::app()->user->checkAccess("admin") ,
						'url' => array(
							'#'
							),
						'items' => array(
						
						array(
							'label' => 'Recepción materia carnica',
							'url' => array(
								'/recepcionMateriaPrimaCarnica/admin'
								)
							),

						array(
							'label' => 'Recepción materia no carnica',
							'url' => array(
								'/recepcionMateriaPrimaNoCarnica/admin'
								)
							),

						array(
							'label' => 'Recepción vegetales',
							'url' => array(
								'/recepcionVegetales/admin'
								)
							),

						array(
							'label' => 'Orden de Producción',
							'url' => array(
								'/ctrlProduccionesTrazabilidad/admin'
								)
							),
						array(
							'label' => 'Embutidora',
							'url' => array(
								'/procesoEmbutido/admin'
								)
							),
						

						array(
							'label' => 'Control horneado',
							'url' => array(
								'/reporteControlHorneado/admin'
								)
							),
						array(
							'label' => 'Producto no conforme',
							'url' => array(
								'/averias/admin'
								)
							),
						array(
							'label' => 'Inventario Empaque al Vacio',
							'url' => array(
								'/inventarioEmpaqueVacio/admin'
								)
							),
						array(
							'label' => 'Despachos Pedidos',
							'url' => array(
								'/despachos/admin'
								)
							),
						/*array(
							'label' => 'Empaque al vacío',
							'url' => array(
								'/reporteEmpaqueVacio/admin'
								)
							),*/
						
						)
					),
					array(
						'label' => 'Trazabilidad',
						'visible' => Yii::app()->user->checkAccess("Recepcion") ,
						'url' => array(
							'#'
							),
						'items' => array(						
							array(
								'label' => 'Recepción materia carnica',
								'url' => array(
									'/recepcionMateriaPrimaCarnica/admin'
									)
								),

							array(
								'label' => 'Recepción materia no carnica',
								'url' => array(
									'/recepcionMateriaPrimaNoCarnica/admin'
									)
								),

							array(
								'label' => 'Recepción vegetales',
								'url' => array(
									'/recepcionVegetales/admin'
									)
								),	
							array(
								'label' => 'Traslados',
								'url' => array(
									'/traslados/admin'
									)
								),					
						)
					),
					array(
						'label' => 'Trazabilidad',
						'visible' => Yii::app()->user->checkAccess("Despachos") ,
						'url' => array(
							'#'
							),
						'items' => array(						
							array(
							'label' => 'Despachos Pedidos',
							'url' => array(
								'/despachos/admin'
								)
							),
						)
					),
					array(
						'label' => 'Trazabilidad',
						'visible' => Yii::app()->user->checkAccess("Horneador") ,
						'url' => array(
							'#'
							),
						'items' => array(						
							array(
							'label' => 'Control horneado',
							'url' => array(
								'/reporteControlHorneado/admin'
								)
							),
						)
					),
					array(
						'label' => 'Trazabilidad',
						'visible' => Yii::app()->user->checkAccess("Mezclador") ,
						'url' => array(
							'#'
							),
						'items' => array(						
							array(
							'label' => 'Orden de Producción',
							'url' => array(
								'/ctrlProduccionesTrazabilidad/admin'
								)
							),	
						)
					),
					array(
						'label' => 'Parametrizacion',
						'visible' => Yii::app()->user->checkAccess("Admin1") || Yii::app()->user->checkAccess("admin") ,
						'url' => array(
							'#'
							),
						'items' => array(

						array(
							'label' => 'Formula Estimado',
							'url' => array(
								'/formulaEstimado/admin'
								)
						),

						array(
							'label' => 'Seccionar Orden Producción',
							'url' => array(
								'/SeccionarOrderProdccion/admin'
								)
						),
						
						array(
							'label' => 'Proveedor',
							'url' => array(
								'/proveedor/admin'
								)
							),
						array(
							'label' => 'Traslados',
							'url' => array(
								'/traslados/admin'
								)
							),

						array(
							'label' => 'Asignar Producto a Proveedor',
							'url' => array(
								'/proveedorInsumo/admin'
								)
							),

						array(
							'label' => 'Producto',
							'url' => array(
								'/producto/admin'
								)
							),
						array(
							'label' => 'Insumos',
							'url' => array(
								'/insumo/admin'
								)
							),
						array(
							'label' => 'Formulacion',
							'url' => array(
								'/formulacion/admin'
								)
							),
						
						)
					),
					array(
						'label' => 'Clientes',
						'visible' => Yii::app()->user->checkAccess("Admin1") || Yii::app()->user->checkAccess("admin") ,
						'url' => array(
							'#'
							),
						'items' => array(
						
						array(
							'label' => 'Clientes',
							'url' => array(
								'/clientes/admin'
								)
							),
						/*array(
							'label' => 'Pedidos',
							'url' => array(
								'/pedidos/admin'
								)
							),*/
						
						
						)
					),

					array(
						'label' => 'Reportes',
						'visible' => Yii::app()->user->checkAccess("Admin1") || Yii::app()->user->checkAccess("admin") ,
						'url' => array(
							'#'
							),
						'items' => array(
						
						array(
							'label' => 'Producción',
							'url' => array(
								'/insumo/reporteProduccion'
								)
							),
						array(
							'label' => 'Insumos',
							'url' => array(
								'/producto/reporteProducto'
								)
							),
						array(
							'label' => 'Trasllados',
							'url' => array(
								'/traslados/reporteTraslados'
								)
							),
						array(
							'label' => 'Proveedor',
							'url' => array(
								'/proveedor/reporteProveedor'
								)
							),
						)
					),
				
				),
				
),
array(
	'class' => 'bootstrap.widgets.BsNav',
	'type' => 'navbar',
	'activateParents' => true,
	'items' => array(
		array(
			'label' => 'Login',
			'url' => array(
				'/site/login'
				),
			'pull' => BsHtml::NAVBAR_NAV_PULL_RIGHT,
			'visible' => Yii::app()->user->isGuest,
			'icon'=>BsHtml::GLYPHICON_USER
			),
		array(
			'label' => 'Logout (' . Yii::app()->user->name . ')',
			'pull' => BsHtml::NAVBAR_NAV_PULL_RIGHT,
			'url' => array(
				'/site/logout'
				),
			'visible' => !Yii::app()->user->isGuest,
			'icon'=>BsHtml::GLYPHICON_USER
			)
		),
	'htmlOptions' => array(
		'pull' => BsHtml::NAVBAR_NAV_PULL_RIGHT
		)
	)

)
));
?>