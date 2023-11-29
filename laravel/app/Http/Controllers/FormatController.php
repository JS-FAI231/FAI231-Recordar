<?php

namespace App\Http\Controllers;

use App\Models\Format;
use Illuminate\Http\Request;

/**
 * Class FormatController
 * @package App\Http\Controllers
 */
class FormatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $formats = Format::paginate();

        return view('format.index', compact('formats'))
            ->with('i', (request()->input('page', 1) - 1) * $formats->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $format = new Format();
        return view('format.create', compact('format'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Format::$rules);

        $format = Format::create($request->all());

        return redirect()->route('formats.index')
            ->with('success', 'Format created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $format = Format::find($id);

        return view('format.show', compact('format'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $format = Format::find($id);

        return view('format.edit', compact('format'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Format $format
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Format $format)
    {
        request()->validate(Format::$rules);

        $format->update($request->all());

        return redirect()->route('formats.index')
            ->with('success', 'Format updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $format = Format::find($id)->delete();

        return redirect()->route('formats.index')
            ->with('success', 'Format deleted successfully');
    }
}
