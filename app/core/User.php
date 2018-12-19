<?php
namespace app\core;

/**
 * 
 */
class User 
{
	public static $ip;
	public static $routingTable;

	public static function CurrentUser() {
		self::$ip = $_SERVER['REMOTE_ADDR'];
		self::$routingTable = [
			'/'						=> 'DashBoard::show',
			'/qr/show'				=> 'QR::show',

			'/products/edit'		=> 'Products::showOne',
			'/products/delete'		=> 'Products::delete',
			'/products/save'		=> 'Products::save',
			'/products'				=> 'Products::showAll',

			'/units/edit'			=> 'Units::showOne',
			'/units/delete'			=> 'Units::delete',
			'/units/save'			=> 'Units::save',
			'/units'				=> 'Units::showAll',

			'/locationtypes/edit'	=> 'LocationTypes::showOne',
			'/locationtypes/delete'	=> 'LocationTypes::delete',
			'/locationtypes/save'	=> 'LocationTypes::save',
			'/locationtypes'		=> 'LocationTypes::showAll',

			'/locations/edit'		=> 'Locations::showOne',
			'/locations/delete'		=> 'Locations::delete',
			'/locations/save'		=> 'Locations::save',
			'/locations'			=> 'Locations::showAll',

			'/movements/edit'		=> 'Movements::showOne',
			'/movements/delete'		=> 'Movements::delete',
			'/movements/save'		=> 'Movements::save',
			'/movements'			=> 'Movements::showAll'
		];
	}
}
?>