<?php

namespace App\Http\Controllers;

use App\Item;
use http\Env\Response;
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('items.item-edit', [
            'item' => Item::find($id)
        ]);
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
        if ($request->file('file')) {
            $path = $request->file('file')->store('app/public/img');
            $item->path = $path = 'storage'.substr($path, 10);
        }
        $item->name = $request->input('name');

        $item->sizes()->detach();
        if($request->input('sizes')) {
            foreach ($request->input('sizes') as $size) {
                $item->sizes()->attach($size);
            }
        }
        $item->save();
        return redirect()->route('index');
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
