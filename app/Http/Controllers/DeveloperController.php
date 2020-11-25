<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Developer;
use Redirect;

class DeveloperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $developers = Developer::paginate(5);

        return view('developers.index', compact('developers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('developers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string|email|unique:developers,email',
            'phone_number' => 'required|numeric|digits:10',
            'address' => 'required',
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        if ($file = $request->file('avatar')) {
            $destinationPath = 'image/'; // upload path
            $devImage = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath, $devImage);
        }
        
        Developer::create([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'phone_number' => $request->get('phone_number'),
            'address' => $request->get('address'),
            'avatar' => isset($devImage) ? $devImage : null
        ]);
        
        return Redirect::to('developers');
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
        $developer = Developer::findOrFail($id);
        
        return view('developers.edit', compact('developer'));
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
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string|email|unique:developers,email,'.$id,
            'phone_number' => 'required|numeric|digits:10',
            'address' => 'required'
        ]);
        if ($file = $request->file('avatar')) {
            $destinationPath = 'image/'; // upload path
            $devImage = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath, $devImage);
        }

        $updateArray = isset($devImage) ? [
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'phone_number' => $request->get('phone_number'),
            'address' => $request->get('address'),
            'avatar' => $devImage
        ] : [
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'phone_number' => $request->get('phone_number'),
            'address' => $request->get('address')
        ];

        Developer::where('id', $id)->update($updateArray);

        return Redirect::to('developers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Developer::where('id', $id)->delete();

        return Redirect::to('developers');
    }

    /**
     * Remove the selected records.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */
    public function deleteSelectedRecords(Request $request)
    {
        $ids = $request->ids;

        Developer::whereIn('id', explode(',', $ids))->delete();

        return response()->json([
            'success' => 'Developers deleted successfully.'
        ]);
    }
}
