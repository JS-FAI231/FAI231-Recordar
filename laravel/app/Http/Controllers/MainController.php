<?php

namespace App\Http\Controllers;

use App\Models\Title;
use App\Models\Image;
use App\Models\Track;
use App\Models\Format;
use App\Models\Country;
use App\Models\Style;
use App\Models\Folder;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Spatie\Activitylog\Models\Activity;

/**
 * Class TitleController
 * @package App\Http\Controllers
 */
class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $txtBuscar = $request->get('txtBuscar');
        if ($txtStyle = $request->get('txtStyle')) {
        } else {
            $txtStyle = '';
        }
        if ($txtFormat = $request->get('txtFormat')) {
        } else {
            $txtFormat = '';
        }
        if ($txtCountry = $request->get('txtCountry')) {
        } else {
            $txtCountry = '';
        }
        if ($txtYear = $request->get('txtYear')) {
        } else {
            $txtYear = '';
        }
        if ($txtSort = $request->get('txtSort')) {
            if ($txtSort == '1') {
                $txtSortField = 'updated_at';
                $txtSortType = 'desc';
            }
            if ($txtSort == '2') {
                $txtSortField = 'artista';
                $txtSortType = 'asc';
            }
            if ($txtSort == '3') {
                $txtSortField = 'artista';
                $txtSortType = 'desc';
            }
            if ($txtSort == '4') {
                $txtSortField = 'titulo';
                $txtSortType = 'asc';
            }
            if ($txtSort == '5') {
                $txtSortField = 'titulo';
                $txtSortType = 'desc';
            }
        } else {
            $txtSortField = 'updated_at';
            $txtSortType = 'desc';
        }

        $titles = Title::orderby($txtSortField, $txtSortType)

            ->when($txtBuscar, function ($query, $txtBuscar) {
                return $query->where('titulo', 'like', '%' . $txtBuscar . '%')->orWhere('artista', 'like', '%' . $txtBuscar . '%');
            })
            ->when($txtStyle, function ($query, $txtStyle) {
                return $query->where('style_id', $txtStyle);
            })
            ->when($txtFormat, function ($query, $txtFormat) {
                return $query->where('format_id', $txtFormat);
            })
            ->when($txtCountry, function ($query, $txtCountry) {
                return $query->where('country_id', $txtCountry);
            })
            ->when($txtYear, function ($query, $txtYear) {
                return $query->where('released', $txtYear);
            })
            ->paginate();

        $estilos = [];
        $formatos = [];
        $paises = [];
        $decades = [];

        foreach ($titles as $title) {
            array_push($estilos, $title->style_id);
            array_push($formatos, $title->format_id);
            array_push($paises, $title->country_id);
            array_push($decades, $title->released);
        }

        $estilos = array_unique($estilos, SORT_NUMERIC);
        $formatos = array_unique($formatos, SORT_NUMERIC);
        $paises = array_unique($paises, SORT_NUMERIC);
        $decades = array_unique($decades, SORT_NUMERIC);
        sort($decades);

        //dd($decades);

        $styles = Style::orderBy('estilo')
            ->whereIn('id', $estilos)
            ->get();

        $formats = Format::orderBy('formato')
            ->whereIn('id', $formatos)
            ->get();

        $countries = Country::orderBy('nombre')
            ->whereIn('id', $paises)
            ->get();

        return view('main.index', compact('titles', 'styles', 'formats', 'countries', 'decades', 'txtBuscar', 'txtStyle', 'txtFormat', 'txtCountry', 'txtYear', 'txtSort'))->with('i', (request()->input('page', 1) - 1) * $titles->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = Title::find($id);

        if (Auth::user()) {
            $folders = Folder::where('user_id', Auth::user()->id)->get();

            //ActivityLog on 'visit'
            $activities = Activity::where('log_name', 'visit')
                ->where('subject_type', 'App\Models\Title')
                ->where('subject_id', $title->id)
                ->where('causer_type', 'App\Models\User')
                ->where('causer_id', Auth::user()->id)
                ->get();

            if (count($activities) == 0) {
                activity('visit')
                    ->performedOn($title)
                    ->log('1');
            } else {
                foreach ($activities as $activity) {
                    $activity->description = $activity->description + 1;
                    $activity->save();
                }
            }
        } else {
            $folders = [];
        }

        return view('main.show', compact('title', 'folders'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Title $title
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Title $title)
    {
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
    }
}
