<?php

/**
 * This is the model class for table "reporte_empaque_vacio".
 *
 * The followings are the available columns in table 'reporte_empaque_vacio':
 * @property string $id
 * @property string $fecha
 * @property string $producto
 * @property integer $total_paquetes
 * @property integer $peso
 * @property string $numero_lote
 * @property string $carac_fisicas_color
 * @property string $carac_fisicas_olor
 * @property string $carac_fisicas_tamano
 * @property string $carac_fisicas_forma
 * @property string $carac_fisicas_exur
 * @property integer $responsable_id
 * @property string $referencia
 *
 * The followings are the available model relations:
 * @property User $responsable
 */
class ReporteEmpaqueVacio extends CActiveRecord
{
	public $responsable;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'reporte_empaque_vacio';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fecha, producto, total_paquetes, peso, numero_lote, carac_fisicas_color, carac_fisicas_olor, carac_fisicas_tamano, carac_fisicas_forma, carac_fisicas_exur, responsable_id', 'required'),
			array('total_paquetes, peso, responsable_id', 'numerical', 'integerOnly'=>true),
			array('producto, numero_lote', 'length', 'max'=>100),
			array('referencia', 'length', 'max'=>150),
			array('carac_fisicas_color, carac_fisicas_olor, carac_fisicas_tamano, carac_fisicas_forma, carac_fisicas_exur', 'length', 'max'=>2),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, fecha, referencia, producto, total_paquetes, peso, numero_lote, carac_fisicas_color, carac_fisicas_olor, carac_fisicas_tamano, carac_fisicas_forma, carac_fisicas_exur, responsable_id', 'safe', 'on'=>'search'),
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
			'responsable' => array(self::BELONGS_TO, 'User', 'responsable_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'fecha' => 'FECHA',
			'producto' => 'PRODUCTO',
			'total_paquetes' => 'TOTAL DE PAQUETES',
			'peso' => 'PESO',
			'numero_lote' => 'NÚMERO DE LOTE',
			'carac_fisicas_color' => 'COLOR',
			'carac_fisicas_olor' => 'OLOR',
			'carac_fisicas_tamano' => 'TAMAÑO',
			'carac_fisicas_forma' => 'FORMA',
			'carac_fisicas_exur' => 'TEXTURA',
			'responsable_id' => 'RESPONSABLE',
			'referencia' => 'REFERENCIA',
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
		$criteria->compare('producto',$this->producto,true);
		$criteria->compare('total_paquetes',$this->total_paquetes);
		$criteria->compare('peso',$this->peso);
		$criteria->compare('numero_lote',$this->numero_lote,true);
		$criteria->compare('carac_fisicas_color',$this->carac_fisicas_color,true);
		$criteria->compare('carac_fisicas_olor',$this->carac_fisicas_olor,true);
		$criteria->compare('carac_fisicas_tamano',$this->carac_fisicas_tamano,true);
		$criteria->compare('carac_fisicas_forma',$this->carac_fisicas_forma,true);
		$criteria->compare('carac_fisicas_exur',$this->carac_fisicas_exur,true);
		$criteria->compare('responsable_id',$this->responsable_id);
		$criteria->compare('referencia',$this->referencia,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ReporteEmpaqueVacio the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
