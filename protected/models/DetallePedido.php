<?php

/**
 * This is the model class for table "detalle_pedido".
 *
 * The followings are the available columns in table 'detalle_pedido':
 * @property string $id_detalle_pedido
 * @property string $id_producto
 * @property string $cantidad
 * @property string $id_pedido
 *
 * The followings are the available model relations:
 * @property Pedidos $idPedido
 * @property Producto $idProducto
 */
class DetallePedido extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'detalle_pedido';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_producto, cantidad, id_pedido', 'required'),
			array('id_producto', 'length', 'max'=>11),
			array('cantidad', 'length', 'max'=>255),
			array('id_pedido', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_detalle_pedido, id_producto, cantidad, id_pedido', 'safe', 'on'=>'search'),
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
			'idPedido' => array(self::BELONGS_TO, 'Pedidos', 'id_pedido'),
			'idProducto' => array(self::BELONGS_TO, 'Producto', 'id_producto'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_detalle_pedido' => 'Id Detalle Pedido',
			'id_producto' => 'Id Producto',
			'cantidad' => 'Cantidad',
			'id_pedido' => 'Id Pedido',
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

		$criteria->compare('id_detalle_pedido',$this->id_detalle_pedido,true);
		$criteria->compare('id_producto',$this->id_producto,true);
		$criteria->compare('cantidad',$this->cantidad,true);
		$criteria->compare('id_pedido',$this->id_pedido,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DetallePedido the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
