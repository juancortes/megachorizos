<?php

/**
 * This is the model class for table "detalle_averias".
 *
 * The followings are the available columns in table 'detalle_averias':
 * @property string $id
 * @property string $fecha_reporte
 * @property string $producto_id
 * @property string $cantidad
 * @property string $lote
 * @property string $observaciones
 * @property string $averia_id
 *
 * The followings are the available model relations:
 * @property Averias $averia
 * @property Producto $producto
 */
class DetalleAverias extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'detalle_averias';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fecha_reporte, producto_id, cantidad, lote, averia_id', 'required'),
			array('producto_id, averia_id', 'length', 'max'=>11),
			array('cantidad', 'length', 'max'=>5),
			array('lote', 'length', 'max'=>255),
			array('observaciones', 'length', 'max'=>150),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, fecha_reporte, producto_id, cantidad, lote, observaciones, averia_id', 'safe', 'on'=>'search'),
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
			'averia' => array(self::BELONGS_TO, 'Averias', 'averia_id'),
			'producto' => array(self::BELONGS_TO, 'Producto', 'producto_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'fecha_reporte' => 'Fecha Reporte',
			'producto_id' => 'Producto',
			'cantidad' => 'Cantidad',
			'lote' => 'Lote',
			'observaciones' => 'Observaciones',
			'averia_id' => 'Averia',
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
		$criteria->compare('fecha_reporte',$this->fecha_reporte,true);
		$criteria->compare('producto_id',$this->producto_id,true);
		$criteria->compare('cantidad',$this->cantidad,true);
		$criteria->compare('lote',$this->lote,true);
		$criteria->compare('observaciones',$this->observaciones,true);
		$criteria->compare('averia_id',$this->averia_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DetalleAverias the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
