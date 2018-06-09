<?php

/**
 * This is the model class for table "ctrl_horneado".
 *
 * The followings are the available columns in table 'ctrl_horneado':
 * @property string $id
 * @property string $fecha
 * @property integer $tanda
 * @property string $producto
 * @property string $cantidad
 * @property integer $averias
 * @property string $codigo_reproceso
 * @property integer $num_programa
 * @property string $temperatura_salida
 * @property string $temperatura_coccion
 * @property integer $sostenimiento_tiempo
 * @property string $sostenimiento_temperatura_interna
 * @property integer $caract_organolepticas_color
 * @property integer $caract_organolepticas_olor
 * @property integer $caract_organolepticas_sabor
 * @property integer $caract_organolepticas_temperatura
 * @property integer $caract_fisicas_tamano
 * @property integer $caract_fisicas_forma
 * @property string $responsable
 */
class CtrlHorneado extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ctrl_horneado';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fecha, tanda, producto, responsable', 'required'),
			array('tanda, averias, num_programa, sostenimiento_tiempo, caract_organolepticas_color, caract_organolepticas_olor, caract_organolepticas_sabor, caract_organolepticas_temperatura, caract_fisicas_tamano, caract_fisicas_forma', 'numerical', 'integerOnly'=>true),
			array('producto', 'length', 'max'=>255),
			array('cantidad, temperatura_salida, temperatura_coccion, sostenimiento_temperatura_interna', 'length', 'max'=>10),
			array('codigo_reproceso', 'length', 'max'=>100),
			array('responsable', 'length', 'max'=>150),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, fecha, tanda, producto, cantidad, averias, codigo_reproceso, num_programa, temperatura_salida, temperatura_coccion, sostenimiento_tiempo, sostenimiento_temperatura_interna, caract_organolepticas_color, caract_organolepticas_olor, caract_organolepticas_sabor, caract_organolepticas_temperatura, caract_fisicas_tamano, caract_fisicas_forma, responsable', 'safe', 'on'=>'search'),
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
			'tanda' => 'Tanda',
			'producto' => 'Producto',
			'cantidad' => 'Cantidad',
			'averias'  => 'Averias',
			'codigo_reproceso'  => 'Código Reproceso',
			'num_programa' 		=> 'Número Programa',
			'temperatura_salida'   => 'Salida',
			'temperatura_coccion'  => 'Coccion',
			'sostenimiento_tiempo' => 'Tiempo',
			'sostenimiento_temperatura_interna' => 'Temperatura Interna',
			'caract_organolepticas_color' => 'Color',
			'caract_organolepticas_olor' => 'Olor',
			'caract_organolepticas_sabor' => 'Sabor',
			'caract_organolepticas_temperatura' => 'Temperatura',
			'caract_fisicas_tamano' => 'Tamaño',
			'caract_fisicas_forma'  => 'Forma',
			'responsable' => 'Responsable',
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
		$criteria->compare('num_programa',$this->num_programa);
		$criteria->compare('temperatura_salida',$this->temperatura_salida,true);
		$criteria->compare('temperatura_coccion',$this->temperatura_coccion,true);
		$criteria->compare('sostenimiento_tiempo',$this->sostenimiento_tiempo);
		$criteria->compare('sostenimiento_temperatura_interna',$this->sostenimiento_temperatura_interna,true);
		$criteria->compare('caract_organolepticas_color',$this->caract_organolepticas_color);
		$criteria->compare('caract_organolepticas_olor',$this->caract_organolepticas_olor);
		$criteria->compare('caract_organolepticas_sabor',$this->caract_organolepticas_sabor);
		$criteria->compare('caract_organolepticas_temperatura',$this->caract_organolepticas_temperatura);
		$criteria->compare('caract_fisicas_tamano',$this->caract_fisicas_tamano);
		$criteria->compare('caract_fisicas_forma',$this->caract_fisicas_forma);
		$criteria->compare('responsable',$this->responsable,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CtrlHorneado the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
