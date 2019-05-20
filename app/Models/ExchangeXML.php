<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Mavsan\LaProtocol\Interfaces\Import;

class ExchangeXML extends Model implements Import
{
	private $overwrite = false;

	private $details = "";

	public function import($fileName) 
	{
		$xml = simplexml_load_file($fileName);
		
		$catalogs = $xml->CATALOGS;
		
		$this->details = "Загружаем единицы измерения...";
		$units = $catalogs->xpath('CATALOG[@GUID="5CE03670-701D-4E98-A9B5-9F106E1F8B73"]/ELEMENTS/ITEM'); 
		self::parse_units($units);
		
		$this->details = "Загружаем товары...";
		$products = $catalogs->xpath('CATALOG[@GUID="AD367DF7-2B6C-467B-AB19-ADBADD372451"]/ELEMENTS/ITEM'); 
		self::parse_products($products);

		$documents = $xml->DOCUMENTS;
		
		$this->details = "Загружаем реализации товаров...";
		$implementations = $documents->xpath('DOCUMENT[@GUID="97DF59FC-B2E2-4941-AAB8-DC0FD2178BCB"]/ELEMENTS/ITEM'); 
		self::parse_implementations($implementations);

		$this->details = "Готово!";
		return self::answerSuccess;
	}

	public function getAnswerDetail() {
		return $this->details;
	}

	private function parse_units($elements)
	{
		foreach ($elements as $item) {
			$unit = Unit::whereUuid($item['GUID'])->first();
			if (!$unit) {
				$unit = new Unit;
				$unit->uuid = $item['GUID'];
			} elseif (!$this->overwrite) return;
			$unit->name = $item['name'];
			$unit->synchronized_at = date('Y-m-d H:i:s');
			$unit->save(); 
		}
	}

	private function parse_products($elements)
	{
		foreach ($elements as $item) {
			$base_unit = Unit::whereUuid($item['base_unit'])->firstOrFail();
			$product = Product::whereUuid($item['GUID'])->first();
			if (!$product) {
				$product = new Product;
				$product->uuid = $item['GUID'];
			} elseif (!$this->overwrite) return;
			$product->name = $item['name'];
			$product->base_unit_id = $base_unit->id;
			$product->synchronized_at = date('Y-m-d H:i:s');
			$product->save(); 
		}
	}

	private function parse_implementations($elements)
	{
		$movement_type_id = 3;
		foreach ($elements as $document) {
			$movement = Movement::whereUuid($document['GUID'])->first();
			if (!$movement) {
				$movement = new Movement;
				$movement->deleted_at = date('Y-m-d H:i:s');
				$movement->uuid = $document['GUID'];
				$movement->movement_type_id = $movement_type_id;
			} elseif (!$this->overwrite) return;
			$movement->synchronized_at = date('Y-m-d H:i:s');
			$movement->save();

			$tables = $document->TABLES;
			$productTable = $tables->xpath('TABLE[@GUID="5C27C2FA-664E-4BD9-AFD4-55D06E7BAABE"]/ITEM');
			$lines = [];
			foreach ($productTable as $row) {
				$product = Product::whereUuid($row['GUID'])->firstOrFail();
				$line = new MovementLine;
				$line->product_id = $product->id;	
				$line->quantity = $row['quantity'];
				$lines[] = $line; 
			}
			$movement->lines()->saveMany($lines);
		}
	}

	public function export()
	{
		$path = config('protocolExchange1C.exchangePatch');
		$filename = date('Y-m-d H-i-s').'.zip';
		
		$doc = new \DOMDocument('1.0','utf-8');

		$doc->formatOutput = true;

		$data = $doc->createElement('DATA');
		$doc->appendChild($data);

		$catalogs = $doc->createElement('CATALOGS');
		$data->appendChild($catalogs); 

		$unit_catalog = $doc->createElement('CATALOG');
		$catalogs->appendChild($unit_catalog); 
		$unit_catalog_guid = $doc->createAttribute('GUID');
		$unit_catalog_guid->value = "5CE03670-701D-4E98-A9B5-9F106E1F8B73";
		$unit_catalog->appendChild($unit_catalog_guid);

		$product_catalog = $doc->createElement('CATALOG');
		$catalogs->appendChild($product_catalog); 
		$product_catalog_guid = $doc->createAttribute('GUID');
		$product_catalog_guid->value = "AD367DF7-2B6C-467B-AB19-ADBADD372451";
		$product_catalog->appendChild($product_catalog_guid);

		$documents = $doc->createElement('DOCUMENTS');
		$documents = $data->appendChild($documents); 

		$order_document = $doc->createElement('DOCUMENT');
		$documents->appendChild($order_document); 
		$order_document_guid = $doc->createAttribute('GUID');
		$order_document_guid->value = "CCCB9F09-DE0F-438B-A576-E32F915911E3";
		$order_document->appendChild($order_document_guid);

		$unit_catalog_elements = $doc->createElement('ELEMENTS');
		$unit_catalog->appendChild($unit_catalog_elements);

		$product_catalog_elements = $doc->createElement('ELEMENTS');
		$product_catalog->appendChild($product_catalog_elements);

		$order_document_elements = $doc->createElement('ELEMENTS');
		$order_document->appendChild($order_document_elements); 
		

		$movements = Movement::whereRaw('updated_at > synchronized_at')
								->where('movement_type_id', 3)
								->get();

		foreach ($movements as $movement) {
			
			$order_document_item = $doc->createElement('ITEM');
			$order_document_elements->appendChild($order_document_item); 
			
			$order_document_tables = $doc->createElement('TABLES');
			$order_document_item->appendChild($order_document_tables); 
			
			$order_document_product_table = $doc->createElement('TABLE');
			$order_document_tables->appendChild($order_document_product_table);
			$order_document_product_table_guid = $doc->createAttribute('GUID');
			$order_document_product_table_guid->value = "401441DA-0968-4F8E-904D-8A16CEECD003";
			$order_document_product_table->appendChild($order_document_product_table_guid);
 
			$products = [];
			$lines = $movement->lines()->get();
			foreach ($lines as $line) {
				$product = $line->product;
				if (!in_array($product, $products)) $products[] = $product;

				$product_item = $doc->createElement('ITEM');
				$order_document_product_table->appendChild($product_item);
				
				$product_item_guid = $doc->createAttribute('GUID');
				$product_item_guid->value = $product->uuid;
				$product_item->appendChild($product_item_guid);
 				
 				$product_item_quantity = $doc->createAttribute('quantity');
				$product_item_quantity->value = $line->quantity;
				$product_item->appendChild($product_item_quantity);
			}

			$units = [];
			foreach ($products as $product) {
				$base_unit = $product->base_unit;
				$units[] = $base_unit;

				$product_item = $doc->createElement('ITEM');
				$product_catalog_elements->appendChild($product_item);

				$product_item_guid = $doc->createAttribute('GUID');
				$product_item_guid->value = $product->uuid;
				$product_item->appendChild($product_item_guid);

 				$product_item_name = $doc->createAttribute('name');
				$product_item_name->value = $product->name;
				$product_item->appendChild($product_item_name);

 				$product_item_base_unit = $doc->createAttribute('base_unit');
				$product_item_base_unit->value = $base_unit->uuid;
				$product_item->appendChild($product_item_base_unit);
			}

			foreach ($units as $unit) {
				$unit_item = $doc->createElement('ITEM');
				$unit_catalog_elements->appendChild($unit_item);

				$unit_item_guid = $doc->createAttribute('GUID');
				$unit_item_guid->value = $unit->uuid;
				$unit_item->appendChild($unit_item_guid);

 				$unit_item_name = $doc->createAttribute('name');
				$unit_item_name->value = $unit->name;
				$unit_item->appendChild($unit_item_name);
			}
		}

		return $doc->saveXML();
	}
}