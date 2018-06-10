<?php

/**
 * This is the model class for table "ctrl_producciones_trazabilidad".
 *
 * The followings are the available columns in table 'ctrl_producciones_trazabilidad':
 * @property string $id
 * @property integer $orden_produccion
 * @property string $fecha
 * @property string $producto
 * @property string $responsable
 * @property integer $cant_produccion
 * @property integer $unidades_producidas
 * @property string $peso
 * @property integer $prioridad
 * @property integer $estado
 * @property string $observaciones
 *
 * The followings are the available model relations:
 * @property Producto $producto0
 * @property DetalleCtrlProducciones[] $detalleCtrlProducciones
 */
class CtrlProduccionesTrazabilidad extends CActiveRecord
{
	public $tanda;
	public $proveedor;
	public $producto1;
	public $cantidad;

	public $aproveedor;
	public $aproducto1;
	public $acantidad;
	public $detalle1;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ctrl_producciones_trazabilidad';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('orden_produccion, fecha, producto, responsable,  peso', 'required'),
			array('orden_produccion, cant_produccion, unidades_producidas, prioridad, estado', 'numerical', 'integerOnly'=>true),
			array('orden_produccion, producto', 'length', 'max'=>10),
			array('responsable', 'length', 'max'=>255),
			array('peso', 'length', 'max'=>15),
			array('peso', 'validarIngreso'),
			array('observaciones', 'length', 'max'=>150),
			array('aproveedor, aproducto1, acantidad, detalle1', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, orden_produccion, fecha, producto, responsable, cant_produccion', 'safe', 'on'=>'search'),
		);
	}

	public function validarIngreso($att, $params)
	{
		$datos       = [];   
		if(isset($_POST['CtrlProduccionesTrazabilidad']['detalle']))
		{
			$formulacion = Formulacion::model()->findAllByAttributes(array('producto_id' => $_POST['CtrlProduccionesTrazabilidad']['producto']));
			$ingreso     = $_POST['CtrlProduccionesTrazabilidad']['detalle'];
			
			foreach ($ingreso as $key => $value) {
				
					foreach ($value as $insumo => $lote) {
						$ins = explode('_', $insumo);

						if($lote != '' && $ins[0] == 'cantidad')
						{
							if(!isset($datos[$ins[1]]))
								$datos[$ins[1]] = 0;
							$datos[$ins[1]] += $lote;
						}
					}
			}

			

			
			if(count($datos) != count($formulacion))
			{
				$this->addError($att, "No ha ingresado el total de insumos la formulacion");
				return;
			}
			else
			{
			Yii::log("formulacion enviada=".print_r($datos,true), 'error', 'application.controllers.TercerosmetasController');

				foreach ($formulacion as $key => $value) {
					if(round($this->cant_produccion * $value->peso,2) != round($datos[$value->materia_prima],2))
					{
			Yii::log("materia_prima enviada=".print_r($value->materia_prima,true), 'error', 'application.controllers.TercerosmetasController');
			Yii::log("cant_produccion enviada=".print_r($this->cant_produccion,true), 'error', 'application.controllers.TercerosmetasController');
			Yii::log("peso formula=".print_r($value->peso,true), 'error', 'application.controllers.TercerosmetasController');
						$this->addError($att, "No ha ingresado la totalidad de la formulacion");
						return;
					}
				}
			}
		}
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'producto0' => array(self::BELONGS_TO, 'Producto', 'producto'),
			'detalleCtrlProducciones' => array(self::HAS_MANY, 'DetalleCtrlProducciones', 'ctrl_producciones_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id'               => 'ID',
			'orden_produccion' => 'ORDER DE PRODUCCIÓN',
			'fecha'            => 'FECHA',
			'producto'         => 'PRODUCTO',
			'producto1'        => 'PRODUCTO',
			'responsable'      => 'RESPONSABLE',
			'cant_produccion'  => 'NÚMERO PRODUCIDAS',
			'peso'             => 'Peso',
			'estado'           => 'Estado',
			'observaciones'    => 'Observaciones',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('orden_produccion',$this->orden_produccion);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('producto',$this->producto,true);
		$criteria->compare('responsable',$this->responsable,true);
		$criteria->compare('cant_produccion',$this->cant_produccion);
		$criteria->compare('unidades_producidas',$this->unidades_producidas);
		$criteria->compare('peso',$this->peso,true);
		$criteria->compare('prioridad',$this->prioridad);
		$criteria->compare('estado',$this->estado);
		$criteria->compare('observaciones',$this->observaciones,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CtrlProduccionesTrazabilidad the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	

	public function getTanda()
	{
		$c=new CDbCriteria;
		$c->select = "t.id,  CONCAT(fecha,' - ' ,orden_produccion, ' - ', p.nombre) AS orden_produccion";
		$c->join   = "INNER JOIN producto p ON t.producto = p.id";
		$c->addCondition('t.estado = 1');
		$c->order  = "fecha, orden_produccion, p.nombre";

		$model = $this->findAll($c);
		return CHtml::listData($model, 'id', 'orden_produccion'); 
	}

	public function getProveedor()
	{
		$model = Proveedor::model()->findAllBySql('SELECT id,CONCAT(nom_proveedor," ",codigo_base) AS nom_proveedor FROM  proveedor WHERE tipo = "0" ');
		
		return CHtml::listData($model, 'id', 'nom_proveedor'); 
	}
	
}
