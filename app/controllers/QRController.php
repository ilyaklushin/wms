<?php 
namespace app\controllers;
use app\core\App;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\QrCode;

/**
 * Контроллер работы с qr кодами
 */
class QRController //extends Controller 
{
	public function show($message)
	{
		$qrCode = new QrCode($message);
		$qrCode->setErrorCorrectionLevel(new ErrorCorrectionLevel(ErrorCorrectionLevel::HIGH));

		header('Content-Type: '.$qrCode->getContentType());
		echo $qrCode->writeString();
	}

}
?>