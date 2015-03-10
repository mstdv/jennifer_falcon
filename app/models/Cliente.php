<?php

class Cliente extends Eloquent {

	protected $table = 'clientes';
	public $timestamps = true;

	public static function getInf($id)
	{
		$cliente = Cliente::where('id', $id);

		if($cliente->count()==1) {
			$data = $cliente->get();
			return $data[0];
		} else {
			return null;
		}
	}

}