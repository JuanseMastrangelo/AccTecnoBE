<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use MP;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\ComprasModel;

class MercadoPago extends Controller {


    function __construct() {
        MP::sandbox_mode(false);
    }


    // Devuelve datos sobre la compra
    public function createPreference(Request $request) {
        $preferenceData = [
            'items' => $request[0],
            "additional_info" => json_encode($request[1]),
            'shipments' => [
                'mode' => 'not_specified',
                'dimensions' => '10x10x10,300',
                'cost' => 670
            ],
            'payer' => [
                "name" => $request[1]['userData']['name'],
                "email" => $request[1]['userData']['email']."ar", // QUITAR .AR
            ],
            "notification_url" => "https://softwareargentina.store/api/notification",
        ];

        return MP::create_preference($preferenceData);
    }

// TEST USER COMPRADOR
//    {
//    "id": 692616119,
//    "nickname": "TETE5445823",
//    "password": "qatest3580",
//    "site_status": "active",
//    "email": "test_user_58294528@testuser.com"
//    }

// TEST USER VENDEDOR
//{
//    "id": 692621623,
//    "nickname": "TETE7142268",
//    "password": "qatest1442",
//    "site_status": "active",
//    "email": "test_user_12047295@testuser.com"
//}

    public function notificationIPN(Request $request) {
        $id = $request->get('id');
        $topic = $request->get('topic');
        $token = MP::get_access_token();
        $task = ComprasModel::create([
            'status' => $topic,
            'userData' => $token,
            'items' => "",
            'collectorId' => $id
        ]);
        switch($topic) {
            case "payment":
                $payment = MP::get_payment($id);
                $merchant_order = MP::get_MerchantOrder($payment->order->id);
                break;
            case "merchant_order":
                $merchant_order = MP::get_MerchantOrder($id);
                $this->notifDatabase($merchant_order, $id);
                break;
        }

        return $request;
    }

    public function notifDatabase($merchant_order, $id): bool
    {
        $paid_amount = 0;
        $array = $merchant_order['response']['payments'];
        $array_num = count($array);
        for ($i = 0; $i < $array_num; ++$i){
            $payment = $array[$id];
            if ($payment['status'] == 'approved'){
                $paid_amount += $payment['transaction_amount'];
            }
        }
        $message = "";
        if($paid_amount >= $merchant_order['response']['total_amount']){
            if (count($merchant_order['response']['shipments'])>0) { // The merchant_order has shipments
                if($merchant_order['response']['shipments'][0]->status == "ready_to_ship") {
                    $message = "Totally paid. Print the label and release your item.";
                }
            } else { // The merchant_order don't has any shipments
                $message = "Totally paid. Release your item.";
            }
        } else {
            $message = "Not paid yet. Do not release your item.";
        }

        $task = ComprasModel::create([
            'status' => strval($message),
            'userData' => $merchant_order['response']['additional_info'],
            'items' => json_encode($merchant_order['response']['items']),
            'collectorId' => $id
        ]);
        return true;
    }

}
