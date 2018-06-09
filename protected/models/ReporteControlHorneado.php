<?php

/**
 * This is the model class for table "reporte_control_horneado".
 *
 * The followings are the available columns in table 'reporte_control_horneado':
 * @property string $id
 * @property string $fecha
 * @property integer $tanda
 * @property string $producto
 * @property string $cantidad
 * @property integer $averias
 * @property string $codigo_reproceso
 * @property string $numero_programa
 * @property string $temperatura_salida
 * @property string $temperatura_coccion
 * @property string $sostenimiento_tiempo
 * @property string $sostenimiento_temperatura_interna
 * @property string $caract_organoleptica_color
 * @property string $caract_organoleptica_olor
 * @property string $caract_organoleptica_sabor
 * @property string $caract_organoleptica_textura
 * @property string $caract_fisicas_tamano
 * @property string $caract_fisicas_forma
 * @property integer $responsable_id
 *
 * The followings are the available model relations:
 * @property Producto $producto0
 */
class ReporteControlHorneado extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'reporte_control_horneado';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fecha, tanda, responsable_id', 'required'),
			array('tanda, averias, responsable_id', 'numerical', 'integerOnly'=>true),
			array('producto', 'length', 'max'=>10),
			array('cantidad, temperatura_salida, temperatura_coccion, sostenimiento_tiempo, sostenimiento_temperatura_interna', 'length', 'max'=>11),
			array('codigo_reproceso', 'length', 'max'=>50),
			array('numero_programa, caract_organoleptica_color, caract_organoleptica_olor, caract_organoleptica_sabor, caract_organoleptica_textura, caract_fisicas_tamano, caract_fisicas_forma', 'length', 'max'=>2),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, fecha, tanda, producto, cantidad, averias, codigo_reproceso, numero_programa, temperatura_salida, temperatura_coccion, sostenimiento_tiempo, sostenimiento_temperatura_interna, caract_organoleptica_color, caract_organoleptica_olor, caract_organoleptica_sabor, caract_organoleptica_textura, caract_fisicas_tamano, caract_fisicas_forma, responsable_id', 'safe', 'on'=>'search'),
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
			'producto0' => array(self::BELONGS_TO, 'Producto', 'producto'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id'                                => 'ID',
			'fecha'                             => 'FECHA',
			'tanda'                             => 'TANDA',
			'producto'                          => 'Producto',
			'cantidad'                          => 'CANTIDAD (Unidades)',
			'averias'                           => 'AVERIAS (Unidades)',
			'codigo_reproceso'                  => 'CÓDIGO REPROCESO',
			'numero_programa'                   => 'NÚMERO PROGRAMA',
			'temperatura_salida'                => 'TEMPERATURA SALIDA (°C)',
			'temperatura_coccion'               => 'TEMPERATURA COCCIÓN (°C)',
			'sostenimiento_tiempo'              => 'TIEMPO (Horas)',
			'sostenimiento_temperatura_interna' => 'TEMPERATURA INTERNA (°C)',
			'caract_organoleptica_color'        => 'COLOR',
			'caract_organoleptica_olor'         => 'OLOR',
			'caract_organoleptica_sabor'        => 'SABOR',
			'caract_organoleptica_textura'      => 'TEXTURA',
			'caract_fisicas_tamano'             => 'TAMAÑO',
			'caract_fisicas_forma'              => 'FORMA',
			'responsable_id'                    => 'RESPONSABLE',
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
		$criteria->compare('tanda',$this->tanda);
		$criteria->compare('producto',$this->producto,true);
		$criteria->compare('cantidad',$this->cantidad,true);
		$criteria->compare('averias',$this->averias);
		$criteria->compare('codigo_reproceso',$this->codigo_reproceso,true);
		$criteria->compare('numero_programa',$this->numero_programa,true);
		$criteria->compare('temperatura_salida',$this->temperatura_salida,true);
		$criteria->compare('temperatura_coccion',$this->temperatura_coccion,true);
		$criteria->compare('sostenimiento_tiempo',$this->sostenimiento_tiempo,true);
		$criteria->compare('sostenimiento_temperatura_interna',$this->sostenimiento_temperatura_interna,true);
		$criteria->compare('caract_organoleptica_color',$this->caract_organoleptica_color,true);
		$criteria->compare('caract_organoleptica_olor',$this->caract_organoleptica_olor,true);
		$criteria->compare('caract_organoleptica_sabor',$this->caract_organoleptica_sabor,true);
		$criteria->compare('caract_organoleptica_textura',$this->caract_organoleptica_textura,true);
		$criteria->compare('caract_fisicas_tamano',$this->caract_fisicas_tamano,true);
		$criteria->compare('caract_fisicas_forma',$this->caract_fisicas_forma,true);
		$criteria->compare('responsable_id',$this->responsable_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ReporteControlHorneado the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
