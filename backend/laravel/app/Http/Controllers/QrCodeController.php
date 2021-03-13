<?php

namespace App\Http\Controllers;

use App\Models\Qr;
use Illuminate\Http\Request;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;

class QrCodeController extends Controller
{
    public function generate(Request $request) {
        // 現金払いの場合のQRコード生成
        $writer = new PngWriter();

        // プランや支払額を取得
        $plan = $request->plan;
        $month = $request->month;
        $settlement_amount = $request->settlement_amount;
        // 乱数を生成する
        $length1 = rand(30, 36);
        $length2 = rand(30, 36);
        $id = substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz'), 0, 8);
        $key1 = substr(bin2hex(random_bytes($length1)), 0, $length2);
        $key2 = substr(bin2hex(random_bytes($length2)), 0, $length1);

        $qrCodeURL = 'https://www.guildzaemonia.com/facebooklogin?cashPayment=true&plan='.$plan.'&month='.$month.'&settlement_amount='.$settlement_amount.'&qr_id='.$id.'&key1='.$key1.'&key2='.$key2;

        // Create QR code
        $qrCode = QrCode::create($qrCodeURL)
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
            ->setSize(300)
            ->setMargin(10)
            ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));

        // API通信を行いkey情報の保管
    

        $item = new Qr;
        $item->qr_id = $id;
        $item->key1 = $key1;
        $item->key2 = $key2;
        $item->save();

        // QRコードの出力
        $result = $writer->write($qrCode);
        header('Content-Type: '.$result->getMimeType());
        echo $result->getString();


        // // Save it to a file
        // $result->saveToFile(__DIR__.'/qrcode.png');

        // // Generate a data URI to include image data inline (i.e. inside an <img> tag)
        // $dataUri = $result->getDataUri();

        // return view('qrcode.generate', $dataUri);
    }

    public function confirmKey1(Request $request) {
        $item = Qr::where('qr_id', $request->qr_id)->where('key1', $request->key1)->first();
        if($item) {
            return response()->json([
                'message' => 'Correct access'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Unexpected error: Unauthorized access'
            ], 400);
        }
    }

    public function confirmKey2(Request $request) {
        $item = Qr::where('qr_id', $request->qr_id)->where('key2', $request->key2)->first();
        if($item) {
            // キー情報の消去
            Qr::where('qr_id', $request->qr_id)->delete();
            return response()->json([
                'message' => 'Correct access'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Unexpected error: Unauthorized access'
            ], 400);
        }
    }
}
