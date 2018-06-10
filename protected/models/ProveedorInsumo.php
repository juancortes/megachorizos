<?php

/**
 * This is the model class for table "proveedor_insumo".
 *
 * The followings are the available columns in table 'proveedor_insumo':
 * @property string $id
 * @property string $insumo_id
 * @property string $proveedor_id
 * @property string $cantidad
 * @property string $fecha_ingreso
 *
 * The followings are the available model relations:
 * @property Proveedor $proveedor
 * @property Insumo $insumo
 */
class ProveedorInsumo extends CActiveRecord
{

	protected function beforeSave() { 
		$this->fecha_ingreso = date('Y-m-d H:i:s');
	}
	public $nom_proveedor;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'proveedor_insumo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('insumo_id, proveedor_id', 'required'),
			array('insumo_id, proveedor_id', 'length', 'max'=>11),
			array('cantidad', 'length', 'max'=>10),
			array('fecha_ingreso', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, insumo_id, proveedor_id, cantidad', 'safe', 'on'=>'search'),
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
			'proveedor' => array(self::BELONGS_TO, 'Proveedor', 'proveedor_id'),
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
			'insumo_id' => 'INSUMO',
			'proveedor_id' => 'PROVEEDOR',
			'cantidad' => 'CANTIDAD',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('t.cantidad',$this->cantidad,true);
		$criteria->compare('i.materia_prima',$this->insumo_id,true);
		$criteria->compare('p.nom_proveedor',$this->proveedor_id,true);

		$criteria->join = "INNER JOIN insumo i ON i.id = t.insumo_id";
		$criteria->join .= " INNER JOIN proveedor p ON p.id = t.proveedor_id";

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ProveedorInsumo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
