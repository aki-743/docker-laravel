<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // イベントの取得
        $items = Event::all();
        return response()->json([
            'data'=>$items,
            'message'=>'Getting event data is success'
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
        // 新しいイベントの格納
        $item = new Event;
        $item->year=$request->year;
        $item->month=$request->month;
        $item->day=$request->day;
        $item->event_name=$request->event_name;
        $item->event_day=$request->event_day;
        $item->event_color=$request->event_color;
        $item->start_time=$request->start_time;
        $item->finish_time=$request->finish_time;
        $item->event_detail=$request->event_detail;
        $item->save();
        return response()->json([
          'message'=>'To add event data is success'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        // 特定のイベントを取得
        $participants = DB::table('participants')->where('share_id', $event->id)->get();
        return response()->json([
            'data'=>$participants,
            'message'=>'Getting participants is success'
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        // イベント内容の更新
        $item = Event::where('id', $event->id)->first();
        $item->year=$request->year;
        $item->month=$request->month;
        $item->day=$request->day;
        $item->event_name=$request->event_name;
        $item->event_day=$request->event_day;
        $item->event_color=$request->event_color;
        $item->start_time=$request->start_time;
        $item->finish_time=$request->finish_time;
        $item->event_detail=$request->event_detail;
        $item->save();
        return response()->json([
            'message'=>'Updating event content is success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        // イベントの消去
        $item = Event::where('id', $event->id)->delete();
        if($item){
            return response()->json([
                'message'=>'Deleted event is success'
            ]);
        }else{
            return response()->json([
                'message'=>'Deleted event is false'
            ]);
        }
    }
}
