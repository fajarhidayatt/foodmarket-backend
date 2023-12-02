<?php

namespace App\Http\Controllers;

use App\Http\Requests\FoodRequest;
use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $food = Food::paginate(10);

        return view('food.index', [
            'food' => $food
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('food.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FoodRequest $request)
    {
        $data = $request->all();

        $data['picturePath'] = $request->file('picturePath')->store('assets/food', 'public');

        Food::create($data);

        return redirect()->route('food.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show(Food $food)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit(Food $food)
    {
        return view('food.edit',[
            'item' => $food
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Food $food)
    {
        $data = $request->all();

        // if upload new photo
        if($request->file('picturePath'))
        {
            // if old photo exist, delete it
            if($food['picturePath'] != null) {
                // get file old photo
                $old_picture = last(explode('/', $food['picturePath']));

                Storage::disk('public')->delete('assets/food/' . $old_picture);
            }

            // store path new photo to database
            $data['picturePath'] = $request->file('picturePath')->store('assets/food', 'public');
        }

        $food->update($data);

        return redirect()->route('food.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Food $food)
    {
        // if photo exist, delete it
        if($food['picturePath'] != null) {
            // get file photo
            $old_picture = last(explode('/', $food['picturePath']));

            Storage::disk('public')->delete('assets/food/' . $old_picture);
        }

        $food->delete();

        return redirect()->route('food.index');
    }
}
