<?php

class Marca extends Eloquent {

	protected $table = 'marcas';
	public $timestamps = true;

	public static function getInf($id)
	{
		$marca = Marca::where('id', $id);

		if($marca->count()==1) {
			$data = $marca->get();
			return $data[0];
		} else {
			return null;
		}
	}

}