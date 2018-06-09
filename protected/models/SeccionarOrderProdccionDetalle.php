<?php

/**
 * This is the model class for table "seccionar_order_prodccion_detalle".
 *
 * The followings are the available columns in table 'seccionar_order_prodccion_detalle':
 * @property string $id
 * @property string $fecha_sistema
 * @property string $seccionar_order_prodccion_id
 * @property string $producto_id
 * @property string $peso_total
 * @property string $peso_unidad
 * @property string $longitud
 * @property integer $estado
 * @property integer $user_id
 * @property string $insumo_id
 *
 * The followings are the available model relations:
 * @property Insumo $insumo
 * @property SeccionarOrderProdccion $producto
 * @property Producto $seccionarOrderProdccion
 */
class SeccionarOrderProdccionDetalle extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'seccionar_order_prodccion_detalle';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fecha_sistema, seccionar_order_prodccion_id, producto_id, peso_total, peso_unidad, longitud, estado, user_id', 'required'),
			array('estado, user_id', 'numerical', 'integerOnly'=>true),
			array('seccionar_order_prodccion_id, producto_id, peso_total, peso_unidad, longitud, insumo_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, fecha_sistema, seccionar_order_prodccion_id, producto_id, peso_total, peso_unidad, longitud, estado, user_id, insumo_id', 'safe', 'on'=>'search'),
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
			'insumo' => array(self::BELONGS_TO, 'Insumo', 'insumo_id'),
			'producto' => array(self::BELONGS_TO, 'SeccionarOrderProdccion', 'producto_id'),
			'seccionarOrderProdccion' => array(self::BELONGS_TO, 'Producto', 'seccionar_order_prodccion_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'fecha_sistema' => 'Fecha Sistema',
			'seccionar_order_prodccion_id' => 'Seccionar Order Prodccion',
			'producto_id' => 'Producto',
			'peso_total' => 'Peso Total',
			'peso_unidad' => 'Peso Unidad',
			'longitud' => 'Longitud',
			'estado' => 'Estado',
			'user_id' => 'User',
			'insumo_id' => 'Insumo',
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
		$criteria->compare('fecha_sistema',$this->fecha_sistema,true);
		$criteria->compare('seccionar_order_prodccion_id',$this->seccionar_order_prodccion_id,true);
		$criteria->compare('producto_id',$this->producto_id,true);
		$criteria->compare('peso_total',$this->peso_total,true);
		$criteria->compare('peso_unidad',$this->peso_unidad,true);
		$criteria->compare('longitud',$this->longitud,true);
		$criteria->compare('estado',$this->estado);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('insumo_id',$this->insumo_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SeccionarOrderProdccionDetalle the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
