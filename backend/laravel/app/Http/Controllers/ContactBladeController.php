<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ContactBladeController extends Controller
{
    public function isAuth(Request $request) {
        $isAuth = $request->session()->get('auth', false);
        if($isAuth) {
            $request->session()->put('auth', true);
            $contacts = Contact::all();
            $data = [
                'data' => $contacts
            ];
            return view('contact.list', $data);
        } else {
            return view('contact.login');
        }
    }
    public function login(Request $request) {
        $user = DB::table('users')->where('name', $request->name)->first();
        if(Hash::check($request->password, $user->password)) {
            $request->session()->put('auth', true);
            $contacts = Contact::all();
            $data = [
                'data' => $contacts
            ];
            return redirect('/contact');
        } else {
            return redirect('/login');
        }
    }
    public function logout(Request $request) {
        $request->session()->flush();
        return redirect('/login');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $isAuth = $request->session()->get('auth', false);
        if($isAuth) {
            $contacts = Contact::all();
            $data = [
                'data' => $contacts
            ];
            return view('contact.list', $data);
        } else {
            return redirect('/login');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Contact::where('id', $request->id)->delete();
        return view('contact.delete');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Contact $contact)
    {
        $item = Contact::where('id', $request->id)->first();
        $data = [
            'data' => $item
        ];
        return view('contact.correspondence', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        //
    }
}
