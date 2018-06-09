<?php

/**
 * This is the model class for table "recepcion_materia_prima_carnica".
 *
 * The followings are the available columns in table 'recepcion_materia_prima_carnica':
 * @property string $id
 * @property string $fec_ingreso
 * @property string $lote_interno
 * @property string $proveedor
 * @property string $materia_prima_insumo
 * @property string $peso
 * @property string $temperatura_llegada
 * @property string $carct_orgleptica_color
 * @property string $carct_orgleptica_olor
 * @property string $carct_orgleptica_c_temperatura
 * @property string $hgiene_vehiculo
 * @property string $hgiene_canastas
 * @property string $conductor_dotacion
 * @property string $conductor_higiene
 * @property string $devolucion_si_no
 * @property string $devolucion_peso
 * @property string $observaciones
 * @property integer $recibido 
 * @property string $lote_externo
 * @property string $empaque_fecha_vencimiento
 * @property string $empaque_condicion
 * @property string $fecha_vencimiento
 * @property string $factura_interna
 * @property string $factura_externa
 * @property integer $unidad
 *
 * The followings are the available model relations:
 * @property Insumo $materiaPrimaInsumo
 * @property Proveedor $proveedor0
 * @property User $recibido0
 */
class RecepcionMateriaPrimaCarnica extends CActiveRecord
{
	public $recibido1;
	public $prov;
	public $tipo;
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'recepcion_materia_prima_carnica';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fec_ingreso, factura_interna, unidad, lote_interno, proveedor, materia_prima_insumo, peso, temperatura_llegada, carct_orgleptica_color, carct_orgleptica_olor, carct_orgleptica_c_temperatura, hgiene_vehiculo, hgiene_canastas, conductor_dotacion, conductor_higiene, devolucion_si_no, recibido, fecha_vencimiento', 'required'),
			array('recibido, unidad', 'numerical', 'integerOnly'=>true),
			array('lote_externo, lote_interno', 'length', 'max'=>100),
			array('observaciones', 'length', 'max'=>255),
			array('proveedor, materia_prima_insumo', 'length', 'max'=>11),
			array('peso', 'length', 'max'=>15),
			array('temperatura_llegada, factura_interna, factura_externa', 'length', 'max'=>10),
			array('temperatura_llegada', 'validacion'),
			array('carct_orgleptica_color, carct_orgleptica_olor, carct_orgleptica_c_temperatura, hgiene_vehiculo, hgiene_canastas, conductor_dotacion, conductor_higiene, devolucion_si_no,  empaque_fecha_vencimiento, empaque_condicion', 'length', 'max'=>1),
			array('unidad','safe'),
			array('devolucion_peso', 'length', 'max'=>4),
			array('observaciones', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('lote_externo, id, fec_ingreso, lote_interno, proveedor, materia_prima_insumo, peso, temperatura_llegada, carct_orgleptica_color, carct_orgleptica_olor, carct_orgleptica_c_temperatura, hgiene_vehiculo, hgiene_canastas, conductor_dotacion, conductor_higiene, devolucion_si_no, devolucion_peso, recibido', 'safe', 'on'=>'search'),
		);
	}

	public function validacion($att, $params)
	{
		if($this->temperatura_llegada > 5)
		{
			$this->addError($att, "No puede ingresar una tempreratura mayor a 5°C");
			return;
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
			'materiaPrimaInsumo' => array(self::BELONGS_TO, 'Insumo', 'materia_prima_insumo'),
			'proveedor0'         => array(self::BELONGS_TO, 'Proveedor', 'proveedor'),
			'recibido0'          => array(self::BELONGS_TO, 'User', 'recibido'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id'                             => 'ID',
			'fec_ingreso'                    => 'FECHA DE INGRESO',
			'lote_interno'                   => 'LOTE INTERNO',
			'proveedor'                      => 'PROVEEDOR',
			'materia_prima_insumo'           => 'INSUMO',
			'peso'                           => 'PESO (KG)',
			'temperatura_llegada'            => 'TEMPERATURA DE LLEGADA',
			'carct_orgleptica_color'         => 'COLOR',
			'carct_orgleptica_olor'          => 'OLOR',
			'carct_orgleptica_c_temperatura' => 'TEMPERATURA',
			'hgiene_vehiculo'                => 'VEHÍCULO',
			'hgiene_canastas'                => 'CANASTAS',
			'conductor_dotacion'             => 'DOTACIÓN',
			'conductor_higiene'              => 'HIGIENE',
			'devolucion_si_no'               => 'DEVOLUCIÓN',
			'devolucion_peso'                => 'PESO',
			'recibido'                       => 'RECIBIDO',
			'observaciones'                  => 'OBSERVACIONES',
			'prov'                           =>'Proveedor',
			'lote_externo'                   => 'Lote Externo',
			'empaque_fecha_vencimiento'      => 'Empaque Fecha Vencimiento',
			'empaque_condicion'              => 'Empaque Condicion',
			'fecha_vencimiento'              => 'Fecha Vencimiento',
			'factura_interna'                => 'Factura Interna',
			'factura_externa'                => 'Factura Externa',
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
		$criteria->compare('fec_ingreso',$this->fec_ingreso,true);
		$criteria->compare('lote_interno',$this->lote_interno,true);
		$criteria->compare('proveedor',$this->proveedor,true);
		$criteria->compare('materia_prima_insumo',$this->materia_prima_insumo,true);
		$criteria->compare('peso',$this->peso,true);
		$criteria->compare('temperatura_llegada',$this->temperatura_llegada,true);
		$criteria->compare('carct_orgleptica_color',$this->carct_orgleptica_color,true);
		$criteria->compare('carct_orgleptica_olor',$this->carct_orgleptica_olor,true);
		$criteria->compare('carct_orgleptica_c_temperatura',$this->carct_orgleptica_c_temperatura,true);
		$criteria->compare('hgiene_vehiculo',$this->hgiene_vehiculo,true);
		$criteria->compare('hgiene_canastas',$this->hgiene_canastas,true);
		$criteria->compare('conductor_dotacion',$this->conductor_dotacion,true);
		$criteria->compare('conductor_higiene',$this->conductor_higiene,true);
		$criteria->compare('devolucion_si_no',$this->devolucion_si_no,true);
		$criteria->compare('devolucion_peso',$this->devolucion_peso,true);
		$criteria->compare('recibido',$this->recibido);
		$criteria->compare('observaciones',$this->observaciones,true);
		$criteria->compare('lote_externo',$this->lote_externo,true);
		$criteria->compare('empaque_fecha_vencimiento',$this->empaque_fecha_vencimiento,true);
		$criteria->compare('empaque_condicion',$this->empaque_condicion,true);
		$criteria->compare('fecha_vencimiento',$this->fecha_vencimiento,true);
		$criteria->compare('factura_interna',$this->factura_interna,true);
		$criteria->compare('factura_externa',$this->factura_externa,true);
		$criteria->compare('unidad',$this->unidad);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RecepcionMateriaPrimaCarnica the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function traerTodosLotes($insumo)
	{
		$model = $this->findAlByAttributes(array('materia_prima_insumo'=>$insumo));
		if(isset($model))
		{
			return $model;
		}
		else 
		{
			return array();
		}
	}
}
