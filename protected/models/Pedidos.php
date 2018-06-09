<?php

/**
 * This is the model class for table "pedidos".
 *
 * The followings are the available columns in table 'pedidos':
 * @property string $id_pedidos
 * @property string $fecha
 * @property integer $responsable
 * @property string $lote
 * @property string $temperatura
 * @property integer $id_cliente
 * @property string $id_producto
 *
 * The followings are the available model relations:
 * @property Producto $idProducto
 * @property Clientes $idCliente
 */
class Pedidos extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pedidos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fecha, responsable, lote, id_cliente, id_producto', 'required'),
			array('responsable, id_cliente', 'numerical', 'integerOnly'=>true),
			array('lote, temperatura', 'length', 'max'=>255),
			array('id_producto', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_pedidos, fecha, responsable, lote, temperatura, id_cliente, id_producto', 'safe', 'on'=>'search'),
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
			'idProducto' => array(self::BELONGS_TO, 'Producto', 'id_producto'),
			'idCliente' => array(self::BELONGS_TO, 'Clientes', 'id_cliente'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_pedidos' => 'Id Pedidos',
			'fecha' => 'Fecha',
			'responsable' => 'Responsable',
			'lote' => 'Lote',
			'temperatura' => 'Temperatura',
			'id_cliente' => 'Cliente',
			'id_producto' => 'Producto',
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

		$criteria->compare('id_pedidos',$this->id_pedidos,true);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('responsable',$this->responsable);
		$criteria->compare('lote',$this->lote,true);
		$criteria->compare('temperatura',$this->temperatura,true);
		$criteria->compare('id_cliente',$this->id_cliente);
		$criteria->compare('id_producto',$this->id_producto,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Pedidos the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
