<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class StripeController extends Controller
{
    public function show(Request $request) {
        // ユーザーのクレジットカード番号の下4桁を取得
        require_once(__DIR__.'/../../../vendor/autoload.php');

        $secret_key = config('app.STRIPE_SECRET_KEY');

        $stripe = new \Stripe\StripeClient($secret_key);
        $customer = $stripe->paymentMethods->all([
            'customer' => $request->id,
            'type' => 'card'
        ]);
        if($customer) {
            return response()->json([
                'data' => $customer->data,
                'message' => 'Getting customer`s paymentmethods is success',
            ], 200);
        } else {
            return response()->json([
                'data' => '',
                'message' => 'Customer`s paymentmethods is undefiend',
            ], 200);
        }
    }
    public function store(Request $request) {
        // ユーザーのクレジットカード情報の更新
        require_once(__DIR__.'/../../../vendor/autoload.php');

        $secret_key = config('app.STRIPE_SECRET_KEY');

        $stripe = new \Stripe\StripeClient($secret_key);
        $customer = $stripe->customers->retrieve(
            'cus_IvABg0whJdNnVd',
            []
        );
        $new_card = $stripe->customers->createSource(
            'cus_IvABg0whJdNnVd',
            ['source' => $request->token]
          );          
        $customer->default_source = $new_card->id;
        $customer->save();
        return response()->json([
            'data' => $customer,
            'message' => 'Getting customer`s paymentmethods is success',
        ], 200);
    }
    public function update(Request $request) {
        // ユーザーのトライアル期間の更新
        require_once(__DIR__.'/../../../vendor/autoload.php');

        $secret_key = config('app.STRIPE_SECRET_KEY');
        $subscription_id = $request->subscription_id;
        $trial_end_date = $request->trial_end_date;

        $stripe = new \Stripe\StripeClient($secret_key);
        $stripe->subscriptions->update(
            $subscription_id,
            ["trial_end" => $trial_end_date]
        );
        return response()->json([
            'message' => 'Updating subscription is success',
        ], 200);
    }
}
