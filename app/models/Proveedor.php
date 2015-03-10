<?php

class Proveedor extends Eloquent {

	protected $table = 'proveedores';
	public $timestamps = true;

	public static function getInf($id)
	{
		$proveedor = Proveedor::where('id', $id);

		if($proveedor->count()==1) {
			$data = $proveedor->get();
			return $data[0];
		} else {
			return null;
		}
	}

}