<?php

/**
 * This is the model class for table "formula_estimado".
 *
 * The followings are the available columns in table 'formula_estimado':
 * @property string $id
 * @property string $fecha
 * @property string $producto_id
 * @property integer $peso
 * @property string $longitud
 * @property string $insumo_id
 *
 * The followings are the available model relations:
 * @property Insumo $insumo
 * @property Producto $producto
 */
class FormulaEstimado extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'formula_estimado';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fecha, producto_id, peso, insumo_id', 'required'),
			array('peso', 'numerical', 'integerOnly'=>true),
			array('producto_id, longitud, insumo_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, fecha, producto_id, peso, longitud, insumo_id', 'safe', 'on'=>'search'),
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
			'fecha' => 'Fecha',
			'producto_id' => 'Producto',
			'peso' => 'Peso',
			'longitud' => 'Longitud',
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
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('producto_id',$this->producto_id,true);
		$criteria->compare('peso',$this->peso);
		$criteria->compare('longitud',$this->longitud,true);
		$criteria->compare('insumo_id',$this->insumo_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FormulaEstimado the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
