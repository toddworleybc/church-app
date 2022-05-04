<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeachingsStoreRequest;
use App\Models\Teaching;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class TeachingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Inertia::render('Admin/Teaching/Index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
    
        return Inertia::render('Admin/Teaching/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeachingsStoreRequest $request)
    {


        $validated = $request->validate();


        // - validate data 
        // - write form errors 
        // - upload image 
        // - figure out video and audio (s3, localdisk, youtube)
        // - rebuild scripture api
        // - set message success/fail




        Teaching::create($request->all());

        return Redirect::route('teachings.index')->with('message', 'success');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teaching  $teaching
     * @return \Illuminate\Http\Response
     */
    public function show(Teaching $teaching)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teaching  $teaching
     * @return \Illuminate\Http\Response
     */
    public function edit(Teaching $teaching)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teaching  $teaching
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teaching $teaching)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teaching  $teaching
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teaching $teaching)
    {
        //
    }
}
