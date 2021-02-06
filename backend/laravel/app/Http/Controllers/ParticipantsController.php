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
        $items = Participant::all();
        return response()->json([
            'data'=>$items
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
        $same_item = Participant::where('user_uid', $request->user_uid)->first();
        if($same_item){
            return response()->json([
                'message'=>'既にイベントに参加しています'
            ]);
        }else{
            $item = new Participant;
            $item->share_id = $request->share_id;
            $item->user_uid = $request->user_uid;
            $item->user_name = $request->user_name;
            $item->user_photo_url = $request->user_photo_url;
            $item->user_lights = $request->user_lights;
            $item->save();
            return response()->json([
                'message'=>'イベントに参加しました！'
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
        return response()->json([
            'a' => $request->a,
            'b' => $request->b
        ], 200);
        $item = Participant::where('user_uid', $request->user_uid)->first();
        if(!$item) {
            return response()->json([
                'message' => $request->user_uid
            ], 200);
        }
        return response()->json([
            'message' => $request->changing_user_property_value
        ], 200);
        $changing_user_property = $request->changing_user_property;
        $item->$changing_user_property = $request->changing_user_property_value;
        return response()->json([
            'message'=>'ユーザー情報を更新しました'
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
                'message'=>'退会手続きを行いました。何かご不明な点があれば、こちらのリンクからお問い合わせください。'
            ]);
        }

        // イベント関連の処理
        if($request->user_name === '*'){
            // 管理者がイベントを消去した時の処理
            // 消去したイベントに参加していたユーザーを全て消去
            Participant::where('share_id', $request->share_id)->delete();
            return response()->json([
                'message'=>'イベントの参加者を全員消去しました'
            ], 200);
        }else{
            // ユーザーがイベントの参加をキャンセルした時の処理
            Participant::where('share_id', $request->share_id)->where('user_name', $request->user_name)->delete();
            return response()->json([
                'message'=>'イベントの参加をキャンセルしました'
            ], 200);
        }
    }
}
