<?php

/**
 * This is the model class for table "seccionar_order_prodccion".
 *
 * The followings are the available columns in table 'seccionar_order_prodccion':
 * @property string $id
 * @property string $fecha_sistema
 * @property string $orden_produccion_id
 * @property integer $estado
 * @property integer $user_id
 *
 * The followings are the available model relations:
 * @property CtrlProduccionesTrazabilidad $ordenProduccion
 * @property SeccionarOrderProdccionDetalle[] $seccionarOrderProdccionDetalles
 */
class SeccionarOrderProdccion extends CActiveRecord
{
	public $prioridad;
	public $peso_orden_produccion;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'seccionar_order_prodccion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fecha_sistema, orden_produccion_id, estado, user_id', 'required'),
			array('estado, user_id', 'numerical', 'integerOnly'=>true),
			array('orden_produccion_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, fecha_sistema, orden_produccion_id, estado, user_id', 'safe', 'on'=>'search'),
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
			'ordenProduccion' => array(self::BELONGS_TO, 'CtrlProduccionesTrazabilidad', 'orden_produccion_id'),
			'seccionarOrderProdccionDetalles' => array(self::HAS_MANY, 'SeccionarOrderProdccionDetalle', 'producto_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id'                    => 'ID',
			'fecha_sistema'         => 'Fecha Sistema',
			'orden_produccion_id'   => 'Orden Produccion',
			'estado'                => 'Estado',
			'user_id'               => 'User',
			'peso_orden_produccion' =>'Peso Orden de Producci??n'
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
		$criteria->compare('fecha_sistema',$this->fecha_sistema,true);
		$criteria->compare('orden_produccion_id',$this->orden_produccion_id,true);
		$criteria->compare('estado',$this->estado);
		$criteria->compare('user_id',$this->user_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SeccionarOrderProdccion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
