<?php

/**
 * This is the model class for table "embutido_productos".
 *
 * The followings are the available columns in table 'embutido_productos':
 * @property integer $id
 * @property string $fecha
 * @property integer $proceso_embutido_id
 * @property string $producto_id
 * @property double $cantidad
 * @property integer $tipo
 * @property string $estimado
 * @property double $peso
 * @property integer $longitud
 * @property string $valor_real
 * @property string $diferencia
 * @property integer $lote_producto
 * @property string $cantidad_tipo
 * @property string $lote_tipo
 *
 * The followings are the available model relations:
 * @property Producto $producto
 * @property ProcesoEmbutido $procesoEmbutido
 */
class EmbutidoProductos extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'embutido_productos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fecha, proceso_embutido_id, producto_id, cantidad,  estimado, cantidad_tipo, lote_tipo', 'required'),
			array('proceso_embutido_id,  tipo,  longitud, tipo, lote_producto', 'numerical', 'integerOnly'=>true),
			array('producto_id, estimado, valor_real, diferencia, cantidad_tipo, lote_tipo', 'length', 'max'=>10),
			array('cantidad, peso', 'numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, fecha, proceso_embutido_id, producto_id, cantidad, tipo, estimado', 'safe', 'on'=>'search'),
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
			'producto' => array(self::BELONGS_TO, 'Producto', 'producto_id'),
			'procesoEmbutido' => array(self::BELONGS_TO, 'ProcesoEmbutido', 'proceso_embutido_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id'                  => 'ID',
			'fecha'               => 'Fecha',
			'proceso_embutido_id' => 'Proceso Embutido',
			'producto_id'         => 'Producto',
			'cantidad'            => 'Cantidad',
			'tipo'                => 'Tipo',
			'estimado'            => 'Estimado',
			'peso'                => 'Peso',
			'longitud'            => 'Longitud',
			'valor_real'          => 'Valor Real',
			'diferencia'          => 'Diferencia',
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
		$criteria->compare('proceso_embutido_id',$this->proceso_embutido_id);
		$criteria->compare('producto_id',$this->producto_id,true);
		$criteria->compare('cantidad',$this->cantidad);
		$criteria->compare('tipo',$this->tipo);
		$criteria->compare('estimado',$this->estimado);
		$criteria->compare('peso',$this->peso);
		$criteria->compare('longitud',$this->longitud);
		$criteria->compare('valor_real',$this->valor_real);
		$criteria->compare('diferencia',$this->diferencia);


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EmbutidoProductos the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
