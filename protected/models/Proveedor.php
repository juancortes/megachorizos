<?php

/**
 * This is the model class for table "proveedor".
 *
 * The followings are the available columns in table 'proveedor':
 * @property string $id
 * @property string $nom_proveedor
 * @property string $tipo_proveedor
 * @property string $correo
 * @property string $celular
 * @property string $direccion
 * @property string $tipo_doc
 * @property string $cedula
 * @property string $municipio_id
 * @property string $codigo_base
 * @property string $tipo
 * @property string $estado
 *
 * The followings are the available model relations:
 * @property DetalleCtrlProducciones[] $detalleCtrlProducciones
 * @property ProveedorInsumo[] $proveedorInsumos
 * @property RecepcionMateriaPrimaCarnica[] $recepcionMateriaPrimaCarnicas
 * @property RecepcionMateriaPrimaNoCarnica[] $recepcionMateriaPrimaNoCarnicas
 */
class Proveedor extends CActiveRecord
{
	public $nombre;
	public $insumo;
	public $fecha_inicial;
	public $fecha_final;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'proveedor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nom_proveedor, tipo_proveedor, tipo_doc, tipo', 'required'),
			array('nom_proveedor', 'length', 'max'=>100),
			array('tipo_proveedor, tipo_doc, tipo, estado', 'length', 'max'=>1),
			array('correo, direccion', 'length', 'max'=>255),
			array('celular', 'length', 'max'=>30),
			array('cedula', 'length', 'max'=>50),
			array('municipio_id', 'length', 'max'=>8),
			array('codigo_base', 'length', 'max'=>3),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nom_proveedor, tipo_proveedor, correo, celular, direccion, tipo_doc, cedula, municipio_id, codigo_base, tipo, estado', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'detalleCtrlProducciones' => array(self::HAS_MANY, 'DetalleCtrlProducciones', 'proveedor_id'),
			'proveedorInsumos' => array(self::HAS_MANY, 'ProveedorInsumo', 'proveedor_id'),
			'recepcionMateriaPrimaCarnicas' => array(self::HAS_MANY, 'RecepcionMateriaPrimaCarnica', 'proveedor'),
			'recepcionMateriaPrimaNoCarnicas' => array(self::HAS_MANY, 'RecepcionMateriaPrimaNoCarnica', 'proveedor_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nom_proveedor' => 'NOMBRE PROVEEDOR',
			'tipo_proveedor' => 'TIPO PROVEEDOR',
			'correo' => 'CORREO',
			'celular' => 'CELULAR',
			'direccion' => 'DIRECCIÓN',
			'tipo_doc' => 'TIDPO DE DOCUMENTO',
			'cedula' => 'CÉDULA',
			'municipio_id' => 'MUNICIPIO',
			'codigo_base' => 'CÓDIGO BASE',
			'tipo' => 'TIPO',
			'estado' => 'ESTADO',
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
		$criteria->compare('nom_proveedor',$this->nom_proveedor,true);
		$criteria->compare('tipo_proveedor',$this->tipo_proveedor,true);
		$criteria->compare('correo',$this->correo,true);
		$criteria->compare('celular',$this->celular,true);
		$criteria->compare('direccion',$this->direccion,true);
		$criteria->compare('tipo_doc',$this->tipo_doc,true);
		$criteria->compare('cedula',$this->cedula,true);
		$criteria->compare('municipio_id',$this->municipio_id,true);
		$criteria->compare('codigo_base',$this->codigo_base,true);
		$criteria->compare('tipo',$this->tipo,true);
		$criteria->compare('estado',$this->estado,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Proveedor the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}



	/**
	 * Obtiene todos los proveedores
	*/	
	public function getproveedores($tipo)
	{
		$c 			   = new CDbCriteria();
		$c->condition  = 'tipo=:tipo';
        $c->params     = array(':tipo'=>"$tipo");
        $c->order 	   = 'nom_proveedor';
		$model 		   = $this->model()->findAll($c);
		return CHtml::listData($model, 'id','nom_proveedor');
	}

	/**
	 * Obtiene todos los proveedores
	*/	
	public function getproveedor()
	{
		$c 			   = new CDbCriteria();
        $c->order 	   = 'nom_proveedor';
		$model 		   = $this->model()->findAll($c);
		return CHtml::listData($model, 'id','nom_proveedor');
	}
}
