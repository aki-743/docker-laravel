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
        $items = Event::all();
        return response()->json([
            'message'=>'Get eventsData successfully',
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
          'message'=>'Add eventsdata successfully'
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
        $participants = DB::table('participants')->where('share_id', $event->id)->get();
        return response()->json([
            'message'=>'Get participants successfully',
            'data'=>$participants
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
            'message'=>'イベント内容を更新しました'
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
        $item = Event::where('id', $event->id)->delete();
        if($item){
            return response()->json([
                'message'=>'イベントを消去しました'
            ]);
        }else{
            return response()->json([
                'message'=>'イベントの消去に失敗しました'
            ]);
        }
    }
}
