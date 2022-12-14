<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ColorStoreRequest;
use App\Http\Requests\Backend\ColorUpdateRequest;
use App\Models\Backend\Marcador;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $colors = Marcador::all();

        return view('color.index', compact('colors'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('color.create');
    }

    /**
     * @param \App\Http\Requests\Backend\ColorStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ColorStoreRequest $request)
    {
        $color = Marcador::create($request->validated());

        $request->session()->flash('Marcador.id', $color->id);

        return redirect()->route('color.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Backend\Marcador $Marcador
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Marcador $color)
    {
        return view('color.show', compact('color'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Backend\Marcador $Marcador
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Marcador $color)
    {
        return view('color.edit', compact('color'));
    }

    /**
     * @param \App\Http\Requests\Backend\ColorUpdateRequest $request
     * @param \App\Models\Backend\Marcador $Marcador
     * @return \Illuminate\Http\Response
     */
    public function update(ColorUpdateRequest $request, Marcador $color)
    {
        $color->update($request->validated());

        $request->session()->flash('color.id', $color->id);

        return redirect()->route('color.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Backend\Marcador $Marcador
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Marcador $color)
    {
        $color->delete();

        return redirect()->route('color.index');
    }
}
