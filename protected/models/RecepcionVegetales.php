<?php

/**
 * This is the model class for table "recepcion_vegetales".
 *
 * The followings are the available columns in table 'recepcion_vegetales':
 * @property integer $id
 * @property string $fecha_lote
 * @property string $lote_interno
 * @property string $fec_vencimiento
 * @property string $proveedor_id
 * @property string $materia_prima_insumo
 * @property string $peso_total
 * @property integer $unidades
 * @property string $num_lote_externo
 * @property string $caract_fisicas_color
 * @property string $caract_fisicas_olor
 * @property string $caract_fisicas_textura
 * @property string $caract_fisicas_limpieza
 * @property integer $recibido
 * @property string $observaciones
 *
 * The followings are the available model relations:
 * @property Insumo $materiaPrimaInsumo
 * @property Proveedor $proveedor
 * @property User $recibido0
 */
class RecepcionVegetales extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'recepcion_vegetales';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fecha_lote,  proveedor_id, materia_prima_insumo, peso_total,  num_lote_externo, caract_fisicas_color, caract_fisicas_olor, caract_fisicas_textura, caract_fisicas_limpieza, recibido', 'required'),
			array(' unidades, recibido', 'numerical', 'integerOnly'=>true),
			array('proveedor_id, lote_interno, materia_prima_insumo, peso_total', 'length', 'max'=>10),
			array('num_lote_externo', 'length', 'max'=>100),
			array('caract_fisicas_color, caract_fisicas_olor, caract_fisicas_textura, caract_fisicas_limpieza', 'length', 'max'=>1),
			array('observaciones', 'length', 'max'=>255),
			array('fec_vencimiento, fec_ingreso', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, fecha_lote, lote_interno, fec_vencimiento, proveedor_id, materia_prima_insumo, peso_total, unidades, num_lote_externo, caract_fisicas_color, caract_fisicas_olor, caract_fisicas_textura, caract_fisicas_limpieza, recibido, observaciones', 'safe', 'on'=>'search'),
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
			'materiaPrimaInsumo' => array(self::BELONGS_TO, 'Insumo', 'materia_prima_insumo'),
			'proveedor' => array(self::BELONGS_TO, 'Proveedor', 'proveedor_id'),
			'recibido0' => array(self::BELONGS_TO, 'User', 'recibido'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id'                      => 'ID',
			'fecha_lote'              => 'Fecha Lote',
			'lote_interno'            => 'Lote Interno',
			'fec_vencimiento'         => 'Fecha de Vencimiento',
			'proveedor_id'            => 'Proveedor',
			'materia_prima_insumo'    => 'Materia Prima Insumo',
			'peso_total'              => 'Peso Total',
			'unidades'                => 'Unidades',
			'num_lote_externo'        => 'Número de Lote Externo',
			'caract_fisicas_color'    => 'Color',
			'caract_fisicas_olor'     => 'Olor',
			'caract_fisicas_textura'  => 'Textura',
			'caract_fisicas_limpieza' => 'Limpieza',
			'recibido'                => 'Recibido',
			'observaciones'           => 'Observaciones',
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
		$criteria->compare('fecha_lote',$this->fecha_lote,true);
		$criteria->compare('lote_interno',$this->lote_interno);
		$criteria->compare('fec_vencimiento',$this->fec_vencimiento,true);
		$criteria->compare('proveedor_id',$this->proveedor_id,true);
		$criteria->compare('materia_prima_insumo',$this->materia_prima_insumo,true);
		$criteria->compare('peso_total',$this->peso_total,true);
		$criteria->compare('unidades',$this->unidades);
		$criteria->compare('num_lote_externo',$this->num_lote_externo,true);
		$criteria->compare('caract_fisicas_color',$this->caract_fisicas_color,true);
		$criteria->compare('caract_fisicas_olor',$this->caract_fisicas_olor,true);
		$criteria->compare('caract_fisicas_textura',$this->caract_fisicas_textura,true);
		$criteria->compare('caract_fisicas_limpieza',$this->caract_fisicas_limpieza,true);
		$criteria->compare('recibido',$this->recibido);
		$criteria->compare('observaciones',$this->observaciones,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RecepcionVegetales the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
