<?php

/**
 * This is the model class for table "detalle_inventario_empaque_vacio".
 *
 * The followings are the available columns in table 'detalle_inventario_empaque_vacio':
 * @property string $id
 * @property string $producto_id
 * @property integer $unidad
 * @property string $lote
 * @property string $reproceso
 * @property string $observaciones
 * @property string $inventario_empaque_vacio_id
 *
 * The followings are the available model relations:
 * @property Producto $producto
 * @property InventarioEmpaqueVacio $inventarioEmpaqueVacio
 */
class DetalleInventarioEmpaqueVacio extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'detalle_inventario_empaque_vacio';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('producto_id, unidad, lote, reproceso, inventario_empaque_vacio_id', 'required'),
			array('unidad', 'numerical', 'integerOnly'=>true),
			array('producto_id, inventario_empaque_vacio_id', 'length', 'max'=>11),
			array('lote', 'length', 'max'=>100),
			array('reproceso', 'length', 'max'=>255),
			array('observaciones', 'length', 'max'=>150),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, producto_id, unidad, lote, reproceso, observaciones, inventario_empaque_vacio_id', 'safe', 'on'=>'search'),
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
			'producto' => array(self::BELONGS_TO, 'Producto', 'producto_id'),
			'inventarioEmpaqueVacio' => array(self::BELONGS_TO, 'InventarioEmpaqueVacio', 'inventario_empaque_vacio_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'producto_id' => 'Producto',
			'unidad' => 'Unidad',
			'lote' => 'Lote',
			'reproceso' => 'Reproceso',
			'observaciones' => 'Observaciones',
			'inventario_empaque_vacio_id' => 'Inventario Empaque Vacio',
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
		$criteria->compare('producto_id',$this->producto_id,true);
		$criteria->compare('unidad',$this->unidad);
		$criteria->compare('lote',$this->lote,true);
		$criteria->compare('reproceso',$this->reproceso,true);
		$criteria->compare('observaciones',$this->observaciones,true);
		$criteria->compare('inventario_empaque_vacio_id',$this->inventario_empaque_vacio_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DetalleInventarioEmpaqueVacio the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
