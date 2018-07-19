<?php

/**
 * This is the model class for table "detalle_tralados".
 *
 * The followings are the available columns in table 'detalle_tralados':
 * @property string $id
 * @property string $insumo_id
 * @property string $cliente_id
 * @property string $cantidad
 * @property string $observaciones
 * @property string $traslado_id
 *
 * The followings are the available model relations:
 * @property Traslados $traslado
 * @property Clientes $cliente
 * @property Inusmo $insumo
 */
class DetalleTralados extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'detalle_tralados';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('insumo_id, cliente_id, cantidad, traslado_id', 'required'),
			array('insumo_id, cliente_id, cantidad, traslado_id', 'length', 'max'=>10),
			array('observaciones', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, insumo_id, cliente_id, cantidad, observaciones, traslado_id', 'safe', 'on'=>'search'),
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
			'traslado' => array(self::BELONGS_TO, 'Traslados', 'traslado_id'),
			'cliente' => array(self::BELONGS_TO, 'Clientes', 'cliente_id'),
			'insumo' => array(self::BELONGS_TO, 'Insumo', 'insumo_id'),
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
			'cliente_id' => 'Cliente',
			'cantidad' => 'Cantidad',
			'observaciones' => 'Observaciones',
			'traslado_id' => 'Traslado',
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
		$criteria->compare('insumo_id',$this->insumo_id,true);
		$criteria->compare('cliente_id',$this->cliente_id,true);
		$criteria->compare('cantidad',$this->cantidad,true);
		$criteria->compare('observaciones',$this->observaciones,true);
		$criteria->compare('traslado_id',$this->traslado_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DetalleTralados the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
