<?php

/**
 * This is the model class for table "detalle_ctrl_producciones".
 *
 * The followings are the available columns in table 'detalle_ctrl_producciones':
 * @property string $id
 * @property string $tipo
 * @property string $lote_interno
 * @property string $ctrl_producciones_id
 * @property string $cantidad
 * @property string $insumo_id
 * @property string $proveedor_id
 *
 * The followings are the available model relations:
 * @property Proveedor $proveedor
 * @property CtrlProduccionesTrazabilidad $ctrlProducciones
 * @property Insumo $insumo
 */
class DetalleCtrlProducciones extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'detalle_ctrl_producciones';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tipo, ctrl_producciones_id, cantidad, insumo_id', 'required'),
			array('tipo', 'length', 'max'=>1),
			array('lote_interno', 'length', 'max'=>255),
			array('ctrl_producciones_id, cantidad, insumo_id, proveedor_id', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, tipo, lote_interno, ctrl_producciones_id, cantidad, insumo_id, proveedor_id', 'safe', 'on'=>'search'),
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
			'ctrlProducciones' => array(self::BELONGS_TO, 'CtrlProduccionesTrazabilidad', 'ctrl_producciones_id'),
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
			'tipo' => 'Tipo',
			'lote_interno' => 'Lote Interno',
			'ctrl_producciones_id' => 'Ctrl Producciones',
			'cantidad' => 'Cantidad',
			'insumo_id' => 'Insumo',
			'proveedor_id' => 'Proveedor',
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
	public function search($id)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		$this->ctrl_producciones_id = $id;
		$criteria->compare('id',$this->id,true);
		$criteria->compare('tipo',$this->tipo,true);
		$criteria->compare('lote_interno',$this->lote_interno,true);
		$criteria->compare('ctrl_producciones_id',$this->ctrl_producciones_id);
		$criteria->compare('cantidad',$this->cantidad,true);
		$criteria->compare('insumo_id',$this->insumo_id,true);
		$criteria->compare('proveedor_id',$this->proveedor_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DetalleCtrlProducciones the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
