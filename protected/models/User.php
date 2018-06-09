<?php

/**
 * This is the model class for table "User".
 *
 * The followings are the available columns in table 'User':
 * @property string $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $nombres
 * @property string $estado
 *
 * The followings are the available model relations:
 * @property Contacto $contacto
 */
class User extends CActiveRecord
{
    public $itemname;
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'User';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs. 
        return array(
            array('username', 'length', 'max'=>45),
            array('password', 'length', 'max'=>254),
            array('nombres', 'length', 'max'=>300),
            array('email', 'length', 'max'=>300),
            array('estado', 'length', 'max'=>1),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, username, password, nombres, email', 'safe', 'on'=>'search'),
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
            'contacto' => array(self::HAS_ONE, 'Contacto', 'identificador'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'username' => 'Usuario',
            'password' => 'Password',
            'nombres' => 'nombres',
            'email' => 'Correo',
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
        $criteria->compare('username',$this->username,true);
        $criteria->compare('password',$this->password,true);
        $criteria->compare('nombres',$this->nombres,true);
        $criteria->compare('email',$this->nombres,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

     /**
	* Obtiene los roles de un usuario basado en el modulo Rights
	* @var int $id Id del usuario
	* @return array de roles
	*/
	public function getRoles1( $id = false ){

		if( $id === false ){
			$id = Yii::app()->user->id;
		}

		if( $id === NULL ){
			return array('Guest');
		}

		$Rights = new Rights;
		$roles 	= $Rights->getAssignedRoles($id);

		$result = array();

		foreach( $roles as $key => $role ){
			$result[] = $key;
		}

		return $result;

	}

	/**
	* verifica si un usuario tiene un rol en especifico
	* @var int $id Id del usuario
	* @var string $rol rol a verificar
	* @return boolean
	*/
	public function hasRole($rol, $id = false){

		if( $id === false ){
			$id = Yii::app()->user->id;
		}

		$roles = $this->getRoles( $id );

		return in_array( $rol , $roles );


	} 

	public function getUsers() {
		$c=new CDbCriteria;
		$c->select="username, CONCAT(nombres,' (',username,')') as nombres";
		$model = $this->findAll($c);
		return CHtml::listData($model, 'username', 'nombres'); 
	}

    public function getUsersRol($rol)
    {
        $c = new CDbCriteria;
        $c->select     = "t.id,t.nombres";
        $c->join       = "INNER JOIN AuthAssignment a ON t.id = a.userid";
        $c->condition  = 'itemname in (:rol)';
        $c->params     = array(':rol'=>$rol);
        $model = $this->findAll($c);        
        return CHtml::listData($model, 'id', 'nombres'); 
    }

    public function getRolUser($id = false)
    {
        if( $id === false ){
            $id = Yii::app()->user->id;
        }

        $rol = Yii::app()->db->createCommand()
        ->select('userid','itemname')
        ->from('AuthAssignment ')
        ->where('userid =:userid', array(':userid'=>$id))
        ->queryRow();
        
        return $rol; 
    }

    public function getCoordinadoraCampoPpal()
    {
        $c = new CDbCriteria;
        $c->select     = "t.id,t.nombres";
        $c->join       = "INNER JOIN AuthAssignment a ON t.id = a.userid";
        $c->condition  = 'itemname IN (:rol) AND estado =:estado AND t.id NOT IN (210, 212, 213, 215)';
        $c->params     = array(':rol'=>'COORDINADOR DE CAMPO',':estado'=>'1');
        $model = $this->findAll($c);        
        return CHtml::listData($model, 'id', 'nombres'); 
    }

    public function getCoordinadoraCampoRegional()
    {
        $c = new CDbCriteria;
        $c->select     = "t.id,t.nombres";
        $c->join       = "INNER JOIN AuthAssignment a ON t.id = a.userid";
        $c->condition  = 'itemname IN (:rol) AND estado =:estado AND t.id  IN (210, 212, 213, 215)';
        $c->params     = array(':rol'=>'COORDINADOR DE CAMPO',':estado'=>'1');
        $model = $this->findAll($c);        
        return CHtml::listData($model, 'id', 'nombres'); 
    }

    public function getUsersRol3($rol)
    {
        $row = Yii::app()->db->createCommand()
        ->select('userid')
        ->from('AuthAssignment ')
        ->where('itemname =:itemname', array(':itemname'=>$rol))
        ->queryAll();
        
        return $row; 
    }

    public function getUsersRol1($detalle)
    {

        $c         = new CDbCriteria;
        $c->select = "t.id, t.nombres";
        $c->join   = "INNER JOIN si_personal p ON t.id = p.user_id";
        $c->join  .= " INNER JOIN si_areas a ON a.id = p.areas_id";
        $c->join  .= " INNER JOIN si_cc_areas_produccion ccap ON ccap.area_id = a.id";
        $c->condition = "t.estado=:estado AND ccap.detalle_centro_costos_id =:detalle";
        $c->params    = array(":estado" => '1',':detalle'=>$detalle);
        
        $model = $this->findAll($c);
        return CHtml::listData($model, 'id', 'nombres'); 
    }

    public function getUsersRol2($rol)
    {
        $c = new CDbCriteria;
        $c->select     = "t.id,t.nombres";
        $c->join       = "INNER JOIN AuthAssignment a ON t.id = a.userid";
        $c->condition  = "itemname in ('VICEPRESIDENTE ADMINISTRATIVO Y DE CALIDAD', 'VICEPRESIDENTE DE CONSULTORIA EMPRESARIAL',
                                        'Vicepresidente de Desarrollo Comercial', 'VICEPRESIDENTE DE GOBIERNO', 'VICEPRESIDENTE DE INTELIGENCIA DE MERCADOS',
                                        'VICEPRESIDENTE DE LEALTAD Y RELACIONES', 'VICEPRESIDENTE DE MARCA Y MEDIOS', 'VICEPRESIDENTE DE NEGOCIOS', 
                                        'VICEPRESIDENTE DE NEGOCIOS NUEVOS', 'Vicepresidente de Producción', 'Vicepresidente Financiero y de Licitaciones',
                                        'Vicepresidente misional', 'Director de Estadística', 'DIRECTOR DE PROYECTO', 'DIRECTOR REGIONAL - BARRANQUILLA', 
                                        'DIRECTOR REGIONAL - BUCARAMANGA, GERENTE REGIONAL - CALI', 'GERENTE REGIONAL - MEDELLÍN', 'PRESIDENTE',
                                        'ASISTENTE OPERATIVO','ASISTENTE DE VICEPRESIDENCIA','ASISTENTE DE RECURSOS HUMANOS','ASISTENTE DE LICITACIONES',
                                        'ASISTENTE DE ESTUDIOS','Asistente de Estadística','ASISTENTE DE EDICIÓN','ASISTENTE DE CRÍTICA Y CODIFICACION',
                                        'Asistente de Codificación', 'DIRECTOR DE ESTUDIOS'
                                        ) AND 
                        t.estado =:estado";
        $c->order       = 't.nombres';
        $c->params      = array(':estado'=>'1');
        $model = $this->findAll($c);        
        return CHtml::listData($model, 'id', 'nombres'); 
    }

    public function getRoles() {
       $row = Yii::app()->db->createCommand(array(
            'select' => array('name', 'name'),
            'from' => 'AuthItem',
            'where' => 'name!=:name',
            'params' => array(':name'=>'admin'),
        ))->queryAll();
        return CHtml::listData($row, 'name', 'name'); 
    }
}
?>