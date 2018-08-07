<?php

/**
 * This is the model class for table "proveedor_insumo_historico".
 *
 * The followings are the available columns in table 'proveedor_insumo_historico':
 * @property integer $id
 * @property string $insumo_id
 * @property string $proveedor_id
 * @property string $cantidad
 * @property string $fecha_ingreso
 * @property string $accion
 *
 * The followings are the available model relations:
 * @property Insumo $insumo
 * @property Proveedor $proveedor
 */
class ProveedorInsumoHistorico extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'proveedor_insumo_historico';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('insumo_id, proveedor_id, fecha_ingreso', 'required'),
			array('insumo_id, proveedor_id, cantidad', 'length', 'max'=>10),
			array('accion', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, insumo_id, proveedor_id, cantidad, fecha_ingreso', 'safe', 'on'=>'search'),
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
			'proveedor' => array(self::BELONGS_TO, 'Proveedor', 'proveedor_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'insumo_id' => 'Insumo',
			'proveedor_id' => 'Proveedor',
			'cantidad' => 'Cantidad',
			'fecha_ingreso' => 'Fecha Ingreso',
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
		$criteria->compare('insumo_id',$this->insumo_id,true);
		$criteria->compare('proveedor_id',$this->proveedor_id,true);
		$criteria->compare('cantidad',$this->cantidad,true);
		$criteria->compare('fecha_ingreso',$this->fecha_ingreso,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ProveedorInsumoHistorico the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
