<?php

/**
 * This is the model class for table "recepcion_materia_prima_no_carnica".
 *
 * The followings are the available columns in table 'recepcion_materia_prima_no_carnica':
 * @property string $id
 * @property string $fec_ingreso
 * @property string $lote_interno
 * @property string $fec_vencimiento
 * @property string $proveedor_id
 * @property string $materia_prima_insumo
 * @property string $peso_total
 * @property integer $unidades
 * @property string $num_lote_externo
 * @property string $caract_fisicas_empaque
 * @property string $caract_fisicas_rotulado
 * @property string $devolucion_si_no
 * @property string $devolucion_peso_unidades
 * @property integer $recibido
 * @property string $observaciones
 * @property string $caract_fisicas_hermeticidad
 * @property string $factura_interna
 * @property string $factura_externa
 * @property integer $unidad
 *
 * The followings are the available model relations:
 * @property Insumo $materiaPrimaInsumo
 * @property Proveedor $proveedor
 * @property User $recibido0
 */
class RecepcionMateriaPrimaNoCarnica extends CActiveRecord
{
	public $recibido1;
	public $prov;
	public $cantidad;
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'recepcion_materia_prima_no_carnica';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fec_ingreso, factura_interna, unidad, fec_vencimiento, proveedor_id, materia_prima_insumo, peso_total, unidades, num_lote_externo, caract_fisicas_empaque, caract_fisicas_rotulado, devolucion_si_no, devolucion_peso_unidades, recibido', 'required'),
			array('unidades, recibido, unidad', 'numerical', 'integerOnly'=>true),
			array('lote_interno, proveedor_id, materia_prima_insumo', 'length', 'max'=>11),
			array('peso_total, factura_interna, factura_externa', 'length', 'max'=>10),
			array('lote_interno','unique','on'=>'insert'),
			array('recibido1, prov, cantidad,unidad ','safe'),
			array('num_lote_externo', 'length', 'max'=>100),
			array('caract_fisicas_empaque, caract_fisicas_rotulado, devolucion_si_no', 'length', 'max'=>1),
			array('devolucion_peso_unidades', 'length', 'max'=>4),
			array('observaciones', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, fec_ingreso, lote_interno, fec_vencimiento, proveedor_id, materia_prima_insumo, peso_total, unidades, num_lote_externo, caract_fisicas_empaque, caract_fisicas_rotulado, devolucion_si_no, devolucion_peso_unidades, recibido, observaciones', 'safe', 'on'=>'search'),
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
			'proveedor'          => array(self::BELONGS_TO, 'Proveedor', 'proveedor_id'),
			'recibido0'          => array(self::BELONGS_TO, 'User', 'recibido'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id'                          => 'ID',
			'fec_ingreso'                 => 'FECHA DE INGRESO',
			'lote_interno'                => 'LOTE INTERNO',
			'fec_vencimiento'             => 'FECHA DE VENCIMIENTO',
			'proveedor_id'                => 'PROVEEDOR',
			'materia_prima_insumo'        => 'INSUMO',
			'peso_total'                  => 'PESO TOTAL (KG)',
			'unidades'                    => 'UNIDADES',
			'num_lote_externo'            => 'NÚMERO DE LOTE EXTERNO',
			'caract_fisicas_empaque'      => 'EMPAQUE',
			'caract_fisicas_rotulado'     => 'FECHA VENCIMIENTO',
			'devolucion_si_no'            => 'DEVOLUCIÓN',
			'devolucion_peso_unidades'    => 'PESO UNIDADES (KG)',
			'recibido'                    => 'RECIBIDO',
			'observaciones'               => 'OBSERVACIONES',
			'caract_fisicas_hermeticidad' => 'HERMETICIDAD',
			'factura_interna'             => 'Factura Interna',
			'factura_externa'             => 'Factura Externa',
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
		$criteria->compare('fec_ingreso',$this->fec_ingreso,true);
		$criteria->compare('lote_interno',$this->lote_interno,true);
		$criteria->compare('fec_vencimiento',$this->fec_vencimiento,true);
		$criteria->compare('proveedor_id',$this->proveedor_id,true);
		$criteria->compare('materia_prima_insumo',$this->materia_prima_insumo,true);
		$criteria->compare('peso_total',$this->peso_total,true);
		$criteria->compare('unidades',$this->unidades);
		$criteria->compare('num_lote_externo',$this->num_lote_externo,true);
		$criteria->compare('caract_fisicas_empaque',$this->caract_fisicas_empaque,true);
		$criteria->compare('caract_fisicas_rotulado',$this->caract_fisicas_rotulado,true);
		$criteria->compare('devolucion_si_no',$this->devolucion_si_no,true);
		$criteria->compare('devolucion_peso_unidades',$this->devolucion_peso_unidades,true);
		$criteria->compare('recibido',$this->recibido);
		$criteria->compare('observaciones',$this->observaciones,true);
		$criteria->compare('caract_fisicas_hermeticidad',$this->caract_fisicas_hermeticidad,true);
		$criteria->compare('factura_interna',$this->factura_interna,true);
		$criteria->compare('factura_externa',$this->factura_externa,true);
		$criteria->compare('unidad',$this->unidad);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RecepcionMateriaPrimaNoCarnica the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
