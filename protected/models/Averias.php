<?php

/**
 * This is the model class for table "averias".
 *
 * The followings are the available columns in table 'averias':
 * @property string $id
 * @property string $fecha
 * @property string $responsable_punto
 * @property string $conductor_responsable
 * @property string $destino
 *
 * The followings are the available model relations:
 * @property DetalleAverias[] $detalleAveriases
 */
class Averias extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'averias';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fecha, responsable_punto, conductor_responsable, destino', 'required'),
			array('fecha, destino', 'length', 'max'=>150),
			array('responsable_punto, conductor_responsable', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, fecha, responsable_punto, conductor_responsable, destino', 'safe', 'on'=>'search'),
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
			'detalleAveriases' => array(self::HAS_MANY, 'DetalleAverias', 'averia_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id'                    => 'ID',
			'fecha'                 => 'Fecha',
			'responsable_punto'     => 'Responsable Punto',
			'conductor_responsable' => 'Conductor Responsable',
			'destino'               => 'Etapas del Proceso',
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
		$criteria->compare('responsable_punto',$this->responsable_punto,true);
		$criteria->compare('conductor_responsable',$this->conductor_responsable,true);
		$criteria->compare('destino',$this->destino,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Averias the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
