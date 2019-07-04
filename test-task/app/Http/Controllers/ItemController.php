<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Item::with('sizes')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->file('file')) {
            $path = $request->file('file')->store('app/public/img');
            $path = 'storage'.substr($path, 10);
        } else {
            $path = "";
        }

        $item = new Item([
            'name'          => $request->input('name'),
            'avatar_url'    => $path,
        ]);
        $item->save();
        if($request->input('sizes') && $sizes = explode(',',$request->input('sizes'))) {
            foreach ($sizes as $size) {
                $item->sizes()->attach($size);
            }
        }
        return Item::with('sizes')->find($item->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Item::with('sizes')->find($id);
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
        $item = Item::find($id);

        $item->name = $request->query('name');

        if ($request->file('file')) {
            $path = $request->file('file')->store('app/public/img');
            $path = 'storage'.substr($path, 10);
        } else {
            $path = "";
        }

        $item->sizes()->detach();
        if($request->input('sizes') && $sizes = explode(',',$request->input('sizes'))) {
            foreach ($sizes as $size) {
                $item->sizes()->attach($size);
            }
        }

        $item->save();

    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::find($id);
        $item->sizes()->detach();
        $item->delete();
    }
}
