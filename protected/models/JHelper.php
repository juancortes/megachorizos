<?php 
/**
* Helper class custom
*/
class JHelper
{
	public static function getEstado(){ 
		return array(0=>'No',1=>'Si');
	}

	public static function getUnidad(){ 
		return array(0 => 'Kg',
					 1 => 'Gr',
					 2 => 'Unidad');
	}

	public static function getPrioridad(){
		return array(
			1 => 1,
			2 => 2,
			3 => 3,
			4 => 4,
			5 => 5,
		);
	}

	public static function getEstadoProveedor(){ 
		return array(0=>'Inactivo',1=>'Activo');
	}

	public static function getEstadoText($i)
	{
		$array=JHelper::getPreguntaSiNo();
		return isset($array[$i]) ? $array[$i] : "Desconocido {$i}";
	}

	public static function getTipo(){ 
		return array(0=>'Carnica',1=>'No Carnica',2=>'Vegetales');
	}

	public static function getTipoPersonaText($i){
		$array=JHelper::getTipoPersona();
		return isset($array[$i])?$array[$i]:"Desconocido {$i}";
	}

	public static function getRefencia()
	{
		return array(
					  	' '=>'Seleccione una opción',
					  	'5 unidades' => '5 unidades',
						'6 unidades' =>	'6 unidades',
						'22 unidades' => '22 unidades',
						'Bloque' => 'Bloque',
						'100 gramos' => '100 gramos',
						'125 gramos' => '125 gramos',
						'150 gramos' => '150 gramos',
						'250 gramos' => '250 gramos',
						'300 gramos' => '300 gramos',
						'500 gramos' => '500 gramos',
						'600 gramos' => '600 gramos',
						'1000 gramos' => '1000 gramos',
						'1500 gramos' => '1500 gramos',
						'2000 gramos' => '2000 gramos'
					);

	}

	public static function getOpcion()
	{
		return array(' '=>'Seleccione una opción','0'=>'0','1'=>'1','NA'=>'NA');
	}

	public static function getNumeroOpciones()
	{
		return array(' '=>'Seleccione una opción',
					 '1'=>'1',
					 '2'=>'2',
					 '3'=>'3',
					 '4'=>'4',
					 '5'=>'5',
					 '6'=>'6',
					 '7'=>'7',
					 '8'=>'8',
					 '9'=>'9',
					 '10'=>'10',
					);
	}

	public static function getGeneroText($i)
	{
		$array=JHelper::getGenero();
		return isset($array[$i]) ? $array[$i] : "Desconocido {$i}";
	}

	public static function getEstadoCivil()
	{
		return array(' '=>'Seleccione una opción','C'=>'Casado','S'=>'Soltero','U'=>'Union Libre','V'=>'Viudo','D'=>'Divorciado');
	}

	public static function getEstadoCivilText($i)
	{
		$array=JHelper::getEstadoCivil();
		return isset($array[$i]) ? $array[$i] : "Desconocido {$i}";
	}

	public static function getPreguntaSiNo()
	{
		return array(' '=>'Seleccione una opción','C'=>'Si','N'=>'No');
	}

	public static function getPreguntaSiNoText($i)
	{
		$array=JHelper::getPreguntaSiNo();
		return isset($array[$i]) ? $array[$i] : "Desconocido {$i}";
	}

	public static function getPreguntaSiNo1()
	{
		return array(' '=>'Seleccione una opción','S'=>'Si','N'=>'No');
	}

	public static function getPreguntaSiNo1Text($i)
	{
		$array=JHelper::getPreguntaSiNo();
		return isset($array[$i]) ? $array[$i] : "Desconocido {$i}";
	}
}
 ?>