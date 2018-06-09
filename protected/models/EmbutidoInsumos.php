<?php

/**
 * This is the model class for table "embutido_insumos".
 *
 * The followings are the available columns in table 'embutido_insumos':
 * @property integer $id
 * @property string $fecha
 * @property integer $proceso_embutido_id
 * @property string $insumo_id
 * @property integer $cantidad
 * @property integer $porcion
 * @property string $producto_id
 * @property integer $estimado
 *
 * The followings are the available model relations:
 * @property Producto $producto
 * @property ProcesoEmbutido $procesoEmbutido
 * @property Insumo $insumo
 */
class EmbutidoInsumos extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'embutido_insumos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fecha, proceso_embutido_id, insumo_id, cantidad, porcion, producto_id, estimado', 'required'),
			array('proceso_embutido_id, cantidad, porcion, estimado', 'numerical', 'integerOnly'=>true),
			array('insumo_id, producto_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, fecha, proceso_embutido_id, insumo_id, cantidad, porcion, producto_id', 'safe', 'on'=>'search'),
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
			'procesoEmbutido' => array(self::BELONGS_TO, 'ProcesoEmbutido', 'proceso_embutido_id'),
			'insumo' => array(self::BELONGS_TO, 'Insumo', 'insumo_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id'                  => 'ID',
			'fecha'               => 'Fecha',
			'proceso_embutido_id' => 'Proceso Embutido',
			'insumo_id'           => 'Insumo',
			'cantidad'            => 'Cantidad',
			'porcion'             => 'Porcion',
			'producto_id'         => 'Producto',
			'estimado'            => 'Estimado',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('proceso_embutido_id',$this->proceso_embutido_id);
		$criteria->compare('insumo_id',$this->insumo_id,true);
		$criteria->compare('cantidad',$this->cantidad);
		$criteria->compare('porcion',$this->porcion);
		$criteria->compare('producto_id',$this->producto_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EmbutidoInsumos the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
