<?php

/**
 * This is the model class for table "insumo".
 *
 * The followings are the available columns in table 'insumo':
 * @property string $id
 * @property string $materia_prima
 * @property string $tipo
 * @property string $cantidad
 *
 * The followings are the available model relations:
 * @property Proveedor[] $proveedors
 * @property RecepcionMateriaPrimaCarnica[] $recepcionMateriaPrimaCarnicas
 * @property RecepcionMateriaPrimaNoCarnica[] $recepcionMateriaPrimaNoCarnicas
 */
class Insumo extends CActiveRecord {
	public $nom_proveedor;
	public $nombre;
	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'insumo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('materia_prima, tipo', 'required'),
			array('materia_prima', 'length', 'max' => 255),
			array('tipo', 'length', 'max'          => 1),
			array('cantidad', 'length', 'max'      => 10),
			array('nombre', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, materia_prima, tipo, cantidad', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'proveedors'                      => array(self::MANY_MANY, 'Proveedor', 'inventario_insumo(insumo_id, proveedor_id)'),
			'recepcionMateriaPrimaCarnicas'   => array(self::HAS_MANY, 'RecepcionMateriaPrimaCarnica', 'materia_prima_insumo'),
			'recepcionMateriaPrimaNoCarnicas' => array(self::HAS_MANY, 'RecepcionMateriaPrimaNoCarnica', 'materia_prima_insumo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'id'            => 'ID',
			'materia_prima' => 'MATERIA PRIMA',
			'tipo'          => 'TIPO',
			'cantidad'      => 'CANTIDAD',
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
	public function search() {
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id, true);
		$criteria->compare('materia_prima', $this->materia_prima, true);
		$criteria->compare('tipo', $this->tipo, true);
		$criteria->compare('cantidad', $this->cantidad, true);

		return new CActiveDataProvider($this, array(
				'criteria' => $criteria,
			));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Insumo the static model class
	 */
	public static function model($className = __CLASS__) {
		return parent::model($className);
	}

	/**
	 * Obtiene todos los Insumos
	 */
	public function getInsumo($tipo) {
		$c            = new CDbCriteria();
		$c->condition = 'tipo=:tipo';
		$c->params    = array(':tipo' => "$tipo");
		$model        = $this->model()->findAll($c);
		return CHtml::listData($model, 'id', 'materia_prima');
	}

	/**
	 * Obtiene todos los Insumos
	 */
	public function getInsumos() {
		$c        = new CDbCriteria();
		$model    = $this->model()->findAll($c);
		$c->order = 'materia_prima';
		return CHtml::listData($model, 'id', 'materia_prima');
	}

	/**
	 * Obtiene todos los Insumos por Proveedor
	 */
	public function getInsumo2($tipo, $prov) {
		$c            = new CDbCriteria();
		$c->join      = 'INNER JOIN proveedor_insumo pi ON pi.insumo_id = t.id';
		$c->condition = 't.tipo=:tipo AND pi.proveedor_id =:prov';
		$c->params    = array(':tipo' => "$tipo", ':prov' => $prov);
		$c->order     = 'materia_prima DESC';
		$model        = $this->model()->findAll($c);
		return CHtml::listData($model, 'id', 'materia_prima');
	}
}
