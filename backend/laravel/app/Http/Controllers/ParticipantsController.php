<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;

class ParticipantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // イベントの参加者を全員取得
        $items = Participant::all();
        return response()->json([
            'data'=>$items,
            'message' => 'Getting event data is success'
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // ユーザー情報の取得
        $same_item = Participant::where('user_uid', $request->user_uid)->where('share_id', $request->share_id)->first();
        if($same_item){
            // 既に存在したらエラーを返す
            return response()->json([
                'message'=>'You have already participated in the event'
            ], 400);
        }else{
            $item = new Participant;
            $item->share_id = $request->share_id;
            $item->user_uid = $request->user_uid;
            $item->user_name = $request->user_name;
            $item->user_photo_url = $request->user_photo_url;
            $item->user_lights = $request->user_lights;
            $item->save();
            return response()->json([
                'message'=>'Participating in the event is success'
            ], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function show(Participant $participant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Participant $participant)
    {
        // ユーザー情報の更新
        $valid_changing_user_property_value = $request->changing_user_property_value;
        // 所定のスラッシュ(/)を'%2F'に変える
        $valid_changing_user_property_value2 = preg_replace('/(images)\/([a-zA-Z0-9]*)\//', '$1%2F$2%2F', $valid_changing_user_property_value);
        $item = Participant::where('user_uid', $request->user_uid)->first();
        if(!$item) {
            return response()->json([
                'message' => 'Valid user is not exist'
            ], 200);
        }
        // ユーザーの更新する項目を$request->changing_user_propertyで受け取る
        // ユーザーの更新する項目の値を$request->changing_user_property_valueで受け取る
        $changing_user_property = $request->changing_user_property;
        if($request->token) {
            // firebaseのphotoURLを読み込むとき、photoURLに&tokenがありphotoURLを正しく読み込むための作業
            $item->$changing_user_property = $valid_changing_user_property_value2 . '&token=' . $request->token;
        } else {
            $item->$changing_user_property = $request->changing_user_property_value2;
        }
        $item->save();
        return response()->json([
            'message'=>'Updating user is success'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Participant $participant)
    {
        // アカウント消去の処理
        $item = Participant::where('user_uid', $request->user_uid)->delete();
        if($item) {
            return response()->json([
                'message'=>'Deleted user is success'
            ], 200);
        }

        // イベント関連の処理
        if($request->user_name === '*'){
            // 管理者がイベントを消去した時の処理
            // 消去したイベントに参加していたユーザーを全て消去
            Participant::where('share_id', $request->share_id)->delete();
            return response()->json([
                'message'=>'Deleted all participants in the event is success'
            ], 200);
        }else{
            // ユーザーがイベントの参加をキャンセルした時の処理
            Participant::where('share_id', $request->share_id)->where('user_name', $request->user_name)->delete();
            return response()->json([
                'message'=>'Canceling participation in the event is success'
            ], 200);
        }
    }
}
