<?php

class Producto extends Eloquent {

	protected $table = 'productos';
	public $timestamps = true;

	public function getProveedor()
	{
		return $this->belongsToMany('Proveedor');
	}

	public function getMarca()
	{
		return $this->hasOne('Marca');
	}

	public static function getInf($id)
	{
		$Producto = Producto::where('id', $id);

		if($Producto->count()==1) {
			$data = $Producto->get();
			return $data[0];
		} else {
			return null;
		}
	}

}