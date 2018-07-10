<?php

/**
 * This is the model class for table "proceso_embutido".
 *
 * The followings are the available columns in table 'proceso_embutido':
 * @property integer $id
 * @property string $fecha
 * @property string $tanda
 * @property double $cantidad_entrante
 * @property integer $averias_totales
 * @property string $observaciones
 *
 * The followings are the available model relations:
 * @property EmbutidoInsumos[] $embutidoInsumoses
 * @property EmbutidoProductos[] $embutidoProductoses
 * @property CtrlProduccionesTrazabilidad $tanda0
 */
class ProcesoEmbutido extends CActiveRecord
{
	public $insumo;
	public $porcion;
	public $cantidad;
	public $producto;
	public $producto1;
	public $estimado;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'proceso_embutido';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fecha', 'required'),
			array(' averias_totales', 'numerical', 'integerOnly'=>true),
			array('observaciones', 'length', 'max'=>200),
			array('cantidad_entrante', 'numerical'),
			array('tanda', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, fecha, tanda, cantidad_entrante, averias_totales, observaciones', 'safe', 'on'=>'search'),
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
			'embutidoInsumoses'   => array(self::HAS_MANY, 'EmbutidoInsumos', 'proceso_embutido_id'),
			'embutidoProductoses' => array(self::HAS_MANY, 'EmbutidoProductos', 'proceso_embutido_id'),
			'tanda0'              => array(self::BELONGS_TO, 'CtrlProduccionesTrazabilidad', 'tanda'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id'                => 'ID',
			'fecha'             => 'Fecha',
			'tanda'             => 'Tanda',
			'cantidad_entrante' => 'Cantidad Entrante',
			'averias_totales'   => 'Averias Totales',
			'observaciones'     => 'Observaciones',
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
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('tanda',$this->tanda);
		$criteria->compare('cantidad_entrante',$this->cantidad_entrante);
		$criteria->compare('averias_totales',$this->averias_totales);
		$criteria->compare('observaciones',$this->observaciones,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ProcesoEmbutido the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
