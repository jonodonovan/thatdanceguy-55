<?php

namespace App\Http\Controllers;

use App\Partner;
use Illuminate\Http\Request;
use Session;

class PartnerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['public', 'publicshow']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function public()
    {
        $partners = Partner::get();

        return view('public.partner.index')->withPartners($partners);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function publicshow($slug)
    {
        $partner = Partner::where('slug', '=', $slug)->firstOrFail();

        return view('public.partner.show')->withPartner($partner);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $partners = Partner::get();

        return view('admin.partner.index')->withPartners($partners);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.partner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'name'      => 'required|max:255',
            'website'   => 'nullable|max:255',
            'intro'     => 'nullable|max:255',
            'phone'     => 'nullable|max:255',
            'email'     => 'nullable|max:255',
            'specialty' => 'nullable|max:255',
        ));

        $partner = new Partner;

        $partner->slug = $request->name;
        $delimiter = '-';
        $partner->slug = iconv('UTF-8', 'ASCII//TRANSLIT', $partner->slug);
        $partner->slug = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $partner->slug);
        $partner->slug = preg_replace("/[\/_|+ -]+/", $delimiter, $partner->slug);
        $partner->slug = strtolower(trim($partner->slug, $delimiter));

        $partner->name = $request->name;
        $partner->website = $request->website;
        $partner->intro = $request->intro;
        $partner->phone = $request->phone;
        $partner->email = $request->email;
        $partner->specialty = $request->specialty;

        $partner->save();

        Session::flash('success', 'New Partner Created');

        return redirect()->route('admin.partner.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $partner = Partner::where('slug', '=', $slug)->firstOrFail();

        return view('admin.partner.show')->withPartner($partner);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $partner = Partner::where('slug', '=', $slug)->firstOrFail();

        return view('admin.partner.edit')->withPartner($partner);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $partner = Partner::where('slug', '=', $slug)->firstOrFail();

        $this->validate($request, array(
            'name'      => 'required|max:255',
            'website'   => 'nullable|max:255',
            'intro'     => 'nullable|max:255',
            'phone'     => 'nullable|max:255',
            'email'     => 'nullable|max:255',
            'specialty' => 'nullable|max:255',
        ));

        $partner->slug = $request->name;
        $delimiter = '-';
        $partner->slug = iconv('UTF-8', 'ASCII//TRANSLIT', $partner->slug);
        $partner->slug = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $partner->slug);
        $partner->slug = preg_replace("/[\/_|+ -]+/", $delimiter, $partner->slug);
        $partner->slug = strtolower(trim($partner->slug, $delimiter));

        $partner->name = $request->name;
        $partner->website = $request->website;
        $partner->intro = $request->intro;
        $partner->phone = $request->phone;
        $partner->email = $request->email;
        $partner->specialty = $request->specialty;

        $partner->save();

        Session::flash('success', 'Partner Updated');

        return redirect()->route('admin.partner.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $partner = Partner::findorFail($id);
        $partner->delete();

        Session::flash('success', 'Partner Deleted');
        return redirect()->route('admin.partner.index');
    }
}
