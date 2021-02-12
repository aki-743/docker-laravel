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
        $customer = $stripe->customers->retrieve(
            $request->id,
            []
        );

        if(!$customer) {
            // クレジットを登録していない場合
            return response()->json([
                'data' => '',
                'message' => 'Customer`s paymentmethods is undefiend',
            ], 200);
        }

        if ($customer->default_source) {
            // デフォルトソースがある時の処理（クレジットカードを更新している時）
            $customerPaymentMethods = $stripe->paymentMethods->retrieve(
                $customer->default_source,
                []
            );
            return response()->json([
                'data' => $customerPaymentMethods,
                'message' => 'Getting customer`s paymentmethods is success',
            ], 200);
        } else {
            // デフォルトソースが無いときの処理（クレジットカードを一回も更新しいない時）
            $customerPaymentMethods = $stripe->paymentMethods->all([
                'customer' => $request->id,
                'type' => 'card'
            ]);
            return response()->json([
                'data' => $customerPaymentMethods->data,
                'message' => 'Getting customer`s paymentmethods is success',
            ], 200);
        }
    }
    public function creditUpdate(Request $request) {
        // ユーザーのクレジットカード情報の更新
        require_once(__DIR__.'/../../../vendor/autoload.php');

        $secret_key = config('app.STRIPE_SECRET_KEY');

        $stripe = new \Stripe\StripeClient($secret_key);

        $customer_id = $request->id;
        $token = $request->token;

        $new_card = $stripe->customers->createSource(
            $customer_id,
            ['source' => $token]
          );          
        $customer->default_source = $new_card->id;
        $customer->save();
        return response()->json([
            'message' => 'Updating customer`s paymentmethods is success',
        ], 200);
    }
    public function trialUpdate(Request $request) {
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
