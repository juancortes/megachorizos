<?php

/**
 * This is the model class for table "detalle_despacho".
 *
 * The followings are the available columns in table 'detalle_despacho':
 * @property string $id
 * @property string $producto
 * @property string $cliente_id
 * @property string $lote
 * @property string $cantidad
 * @property string $destino
 * @property string $observaciones
 * @property string $id_despacho
 *
 * The followings are the available model relations:
 * @property Clientes $cliente
 * @property Despachos $idDespacho
 * @property Producto $producto0
 */
class DetalleDespacho extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'detalle_despacho';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('producto, cliente_id, lote, cantidad,  id_despacho', 'required'),
			array('producto, cliente_id, id_despacho', 'length', 'max'=>11),
			array('lote', 'length', 'max'=>80),
			array('cantidad', 'length', 'max'=>50),
			array('destino', 'length', 'max'=>150),
			array('observaciones', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, producto, cliente_id, lote, cantidad, destino, observaciones, id_despacho', 'safe', 'on'=>'search'),
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
			'cliente' => array(self::BELONGS_TO, 'Clientes', 'cliente_id'),
			'idDespacho' => array(self::BELONGS_TO, 'Despachos', 'id_despacho'),
			'producto0' => array(self::BELONGS_TO, 'Producto', 'producto'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'producto' => 'Producto',
			'cliente_id' => 'Cliente',
			'lote' => 'Lote',
			'cantidad' => 'Cantidad',
			'destino' => 'Destino',
			'observaciones' => 'Observaciones',
			'id_despacho' => 'Id Despacho',
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
		$criteria->compare('producto',$this->producto,true);
		$criteria->compare('cliente_id',$this->cliente_id,true);
		$criteria->compare('lote',$this->lote,true);
		$criteria->compare('cantidad',$this->cantidad,true);
		$criteria->compare('destino',$this->destino,true);
		$criteria->compare('observaciones',$this->observaciones,true);
		$criteria->compare('id_despacho',$this->id_despacho,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DetalleDespacho the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
