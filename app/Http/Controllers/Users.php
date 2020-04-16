<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModelUsers;

class Users extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ModelUsers::all();
        return view('admin.users', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new ModelUsers();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->user_type = $request->user_type;
        $data->save();
        return redirect()->route('users.index')->with('alert-success', 'Berhasil Menambahkan Data!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = ModelUsers::where('id', $id)->get();

        return view('admin.users_edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = ModelUsers::where('id', $id)->first();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->user_type = $request->user_type;
        $data->save();
        return redirect()->route('users.index')->with('alert-success', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = ModelUsers::where('id', $id)->first();
        $data->delete();
        return redirect()->route('users.index')->with('alert-success', 'Data berhasi dihapus!');
    }
}
