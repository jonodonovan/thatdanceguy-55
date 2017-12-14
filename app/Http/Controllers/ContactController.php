<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;
use Session;

class ContactController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['store']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::get();
        return view('admin.contact.index', compact('contacts'));
    }

    /**
        * Store a newly created resource in storage.
        *
        * @param  \Illuminate\Http\Request  $request
        * @return \Illuminate\Http\Response
        */
       public function store()
       {
           $contact = request()->validate([
               'name' => 'required|max:255',
               'companyname' => 'max:255',
               'email' => 'max:255',
               'phonenumber' => 'max:15',
               'message' => 'required'
           ]);

           Contact::Create($contact);
           Session::flash('success', 'Thank you');

           return redirect('/hire-me');
       }
}
