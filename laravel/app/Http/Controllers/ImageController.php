<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Title;
use Illuminate\Http\Request;
use Storage;

/**
 * Class ImageController
 * @package App\Http\Controllers
 */
class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $txtBuscar = $request->get('txtBuscar');

        $titulos=Title::select('id')
        ->where('titulo', 'like', '%' . $txtBuscar . '%')
        ->orWhere('artista', 'like', '%' . $txtBuscar . '%');

        $images = Image::orderby('title_id')
        ->whereIn('title_id',$titulos)
        ->orWhere('title_id', 'like', '%' . $txtBuscar . '%')
        ->paginate();

        return view('image.index', compact('images','txtBuscar'))->with('i', (request()->input('page', 1) - 1) * $images->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $image = new Image();
        return view('image.create', compact('image'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Image::$rules);

        if ($request->hasFile('image')) {
            $imagen = $request->file('image');
            $name = $imagen->getClientOriginalName();
            $destinationPath = public_path('media\\') . $request->title_id . '\\';
            $relativePath='media\\'. $request->title_id . '\\';
            $imagen->move($destinationPath, $name);

            $request->merge(['path' => $relativePath]);
            $request->merge(['filename' => $name]);
        }
        
 
        $image = Image::create($request->all());

        return redirect()
            ->route('images.index')
            ->with('success', 'Image created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $image = Image::find($id);

        return view('image.show', compact('image'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $image = Image::find($id);

        return view('image.edit', compact('image'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Image $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $image)
    {
        request()->validate(Image::$rules);

        if ($request->hasFile('image')) {
            $imagen = $request->file('image');
            $name = $imagen->getClientOriginalName();
            $destinationPath = public_path('media\\') . $image->title->id . '\\';
            $relativePath='media\\'. $image->title->id . '\\';
            $imagen->move($destinationPath, $name);

            $image->path = $relativePath;
            $image->fileName = $name;
        }

        $image->update($request->all());

        return redirect()
            ->route('images.index')
            ->with('success', 'Image updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $image = Image::find($id);
        $archivo=public_path().'\\'.$image->path.$image->filename;
        if (file_exists($archivo)) {
            unlink($archivo);
        } else {
            dd('File does not exist.' . $archivo);
        }
        $image->delete();
         
        return redirect()
            ->route('images.index')
            ->with('success', 'Image deleted successfully');
    }
}
