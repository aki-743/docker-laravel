<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class StripeController extends Controller
{
    public function show(Request $request) {
        require_once(__DIR__.'/../../../vendor/autoload.php');

        $secret_key = config('app.STRIPE_SECRET_KEY');

        $stripe = new \Stripe\StripeClient($secret_key);
        $customer = $stripe->paymentMethods->all([
            'customer' => $request->id,
            'type' => 'card'
        ]);
        return response()->json([
            'data' => $customer->data,
            'message' => 'Getting customer`s paymentmethods is success',
        ], 200);
    }
    public function update(Request $request) {
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
