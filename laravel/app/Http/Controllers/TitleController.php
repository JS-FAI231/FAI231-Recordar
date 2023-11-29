<?php

namespace App\Http\Controllers;

use App\Models\Title;
use App\Models\Image;
use App\Models\Track;
use App\Models\Format;
use App\Models\Country;
use App\Models\Style;
use App\Models\Wish;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Activitylog\Models\Activity;

use Owenoj\LaravelGetId3\GetId3;

use Illuminate\Support\Facades\Http;

use RicorocksDigitalAgency\Soap\Facades\Soap;
use Illuminate\Http\Request;

/**
 * Class TitleController
 * @package App\Http\Controllers
 */
class TitleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $txtBuscar = $request->get('txtBuscar');

        $titles = Title::orderby('artista', 'asc')
            ->where('titulo', 'like', '%' . $txtBuscar . '%')
            ->orWhere('artista', 'like', '%' . $txtBuscar . '%')
            ->orWhere('catalogo', 'like', '%' . $txtBuscar . '%')
            ->paginate();

        return view('title.index', compact('titles', 'txtBuscar'))->with('i', (request()->input('page', 1) - 1) * $titles->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = new Title();
        $formats = Format::get();
        $countries = Country::where('deshabilitado', '<>', 'null')->get();
        $styles = Style::get();

        return view('title.create', compact('title', 'formats', 'countries', 'styles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Title::$rules);

        $title = Title::create($request->all());

        if (request()->hasFile('image')) {
            $file = $request->file('image');
            foreach ($file as $imagen) {
                $name = $imagen->getClientOriginalName();
                $destinationPath = public_path('media\\') . $title->id . '\\';
                $relativePath = 'media\\' . $title->id . '\\';
                $imagen->move($destinationPath, $name);

                if (
                    Image::where('title_id', $title->id)
                        ->where('path', $relativePath)
                        ->where('fileName', $name)
                        ->exists()
                ) {
                    // The record exists
                } else {
                    // The record does not exist
                    $image = new Image();
                    $image->title_id = $title->id;
                    $image->path = $relativePath;
                    $image->filename = $name;
                    $image->save();
                }
            }
        }

        if (request()->hasFile('tracks')) {
            $file = $request->file('tracks');
            foreach ($file as $track) {
                $name = $track->getClientOriginalName();
                $destinationPath = public_path('media\\') . $title->id . '\audio\\';
                $relativePath = 'media\\' . $title->id . '\audio\\';
                $track->move($destinationPath, $name);

                if (
                    Track::where('title_id', $title->id)
                        ->where('path', $relativePath)
                        ->where('fileName', $name)
                        ->exists()
                ) {
                    // The record exists
                } else {
                    // The record does not exist
                    $track = new Track();
                    $track->title_id = $title->id;
                    $track->path = $relativePath;
                    $track->filename = $name;
                    $track->save();
                }
            }
        }

        return redirect()
            ->route('titles.index')
            ->with('success', 'Title created successfully.');
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

        return view('title.show', compact('title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = Title::find($id);
        $formats = Format::get();
        $countries = Country::where('deshabilitado', '<>', 'null')->get();
        $styles = Style::get();

        return view('title.edit', compact('title', 'formats', 'countries', 'styles'));
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
        request()->validate(Title::$rules);

        if (request()->hasFile('image')) {
            $file = $request->file('image');
            foreach ($file as $imagen) {
                $name = $imagen->getClientOriginalName();
                $destinationPath = public_path('media\\') . $title->id;
                $relativePath = 'media\\' . $title->id;
                $imagen->move($destinationPath, $name);

                if (
                    Image::where('title_id', $title->id)
                        ->where('path', $relativePath)
                        ->where('fileName', $name)
                        ->exists()
                ) {
                    // The record exists
                } else {
                    // The record does not exist
                    $image = new Image();
                    $image->title_id = $title->id;
                    $image->path = $relativePath;
                    $image->filename = $name;
                    $image->save();
                }
            }
        }

        if (request()->hasFile('tracks')) {
            $files = $request->file('tracks');
            foreach ($files as $file) {
                $name = $file->getClientOriginalName();
                $destinationPath = public_path('media\\') . $title->id . '\audio\\';
                $relativePath = 'media\\' . $title->id . '\audio\\';
                $file->move($destinationPath, $name);

                if (
                    Track::where('title_id', $title->id)
                        ->where('path', $relativePath)
                        ->where('filename', $name)
                        ->exists()
                ) {
                    // The record exists
                } else {
                    // The record does not exist
                    $track = new Track();
                    $track->title_id = $title->id;
                    $track->path = $relativePath;
                    $track->filename = $name;
                    $track->save();
                }
            }
        }

        $title->update($request->all());

        return redirect()
            ->route('titles.index')
            ->with('success', 'Title updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        //Constrainst Submissions,Wishes,Images,Tracks,Visits

        $title = Title::find($id)->delete();

        return redirect()
            ->route('titles.index')
            ->with('success', 'Title deleted successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Title $title
     * @return \Illuminate\Http\Response
     */
    public function readTag(Request $request, Title $title)
    {
        if (request()->hasFile('tracks')) {
            $files = $request->file('tracks');
            foreach ($files as $file) {
                //$name = $file->getClientOriginalName();
                $track = new GetId3($file);
                dd($track->extractInfo());
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Title $title
     * @return \Illuminate\Http\Response
     */
    public function addtowish(Request $request)
    {
        $title = Title::find($request->title_id);
        $mywish = Wish::where('title_id', $request->title_id)
            ->where('user_id', $request->user_id)
            ->get();

        if (count($mywish) == 0) {
            $auxWish = new Wish();
            $auxWish->user_id = $request->user_id;
            $auxWish->title_id = $request->title_id;
            $auxWish->save();
        }
        return redirect()
            ->back()
            ->with('success', 'Title updated successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Title $title
     * @return \Illuminate\Http\Response
     */
    public function removefromwish(Request $request)
    {
        $title = Title::find($request->title_id);
        $mywish = Wish::where('title_id', $request->title_id)
            ->where('user_id', $request->user_id)
            ->get();

        if (count($mywish) == 1) {
            // $auxWish = new Wish();
            // $auxWish->user_id = $request->user_id;
            // $auxWish->title_id = $request->title_id;
            $wish = Wish::find($mywish[0]->id)->delete();
            //dd($mywish[0]->id);
        }
        return redirect()
            ->back()
            ->with('success', 'Title updated successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Title $title
     * @return \Illuminate\Http\Response
     */
    public function setfolder(Request $request)
    {
        $mywish = Wish::where('title_id', $request->title_id)
            ->where('user_id', Auth::user()->id)
            ->get();

        $data['success'] = 'noUserId';
        if (count($mywish) == 1) {
            $wish = Wish::find($mywish[0]->id);
            $wish->folder_id = $request->folder_id;
            $wish->save();
            $data['success'] = $wish->folder_id;
        }

        return response()->json($data);
    }

    /**
     * Retrieve Lyrics information through SOAP
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function searchSoapLyrics(Request $request)
    {
        $wsdl = 'http://api.chartlyrics.com/apiv1.asmx?WSDL';
        $response = null;
        $stopProcess=false;
        $stopWords = ['about', 'after', 'all', 'also', 'an', 'and', 'another',
         'any', 'are', 'as', 'at', 'be', 'because', 'been', 'before', 'being',
         'between', 'both', 'but', 'by', 'came', 'can', 'come', 'could', 'did',
         'do', 'does', 'each', 'else', 'for', 'from', 'get', 'got', 'had', 'has',
         'have', 'he', 'her', 'here', 'him', 'himself', 'his', 'how', 'if', 'in',
         'into', 'is', 'it', 'its', 'just', 'like', 'make', 'many', 'me', 'might',
         'more', 'most', 'much', 'must', 'my', 'never', 'no', 'now', 'of', 'on',
         'only', 'or', 'other', 'our', 'out', 'over', 're', 'said', 'same', 'see',
         'should', 'since', 'so', 'some', 'still', 'such', 'take', 'than', 'that',
         'the', 'their', 'them', 'then', 'there', 'these', 'they', 'this', 'those',
         'through', 'to', 'too', 'under', 'up', 'use', 'very', 'want', 'was', 'way',
         'we', 'well', 'were', 'what', 'when', 'where', 'which', 'while', 'who',
         'will', 'with', 'would', 'you', 'your'];

        if (in_array(explode(" ",strtolower($request->txtArtist)),$stopWords)){
            $stopProcess=true;
        }
        if (in_array(explode(" ",strtolower($request->txtSong)),$stopWords)){
            $stopProcess=true;
        }

        if ($request->txtArtist && $request->txtSong && !$stopProcess) {
            if (strlen($request->txtArtist) > 0) {
                $response = Soap::to($wsdl)->call('SearchLyric', ['artist' => $request->txtArtist, 'song' => $request->txtSong]);
                $response = $response->SearchLyricResult->SearchLyricResult;
            }
        }

        //dd($response);
        return view('title.soaplyricsearch', compact('response'));

        //$funcs = Soap::to($wsdl)->functions();
        //   array:10 [▼ // app\Http\Controllers\TitleController.php:384
        //   0 => "SearchLyricResponse SearchLyric(SearchLyric $parameters)"
        //   1 => "SearchLyricTextResponse SearchLyricText(SearchLyricText $parameters)"
        //   2 => "GetLyricResponse GetLyric(GetLyric $parameters)"
        //   3 => "AddLyricResponse AddLyric(AddLyric $parameters)"
        //   4 => "SearchLyricDirectResponse SearchLyricDirect(SearchLyricDirect $parameters)"
        //   5 => "SearchLyricResponse SearchLyric(SearchLyric $parameters)"
        //   6 => "SearchLyricTextResponse SearchLyricText(SearchLyricText $parameters)"
        //   7 => "GetLyricResponse GetLyric(GetLyric $parameters)"
        //   8 => "AddLyricResponse AddLyric(AddLyric $parameters)"
        //   9 => "SearchLyricDirectResponse SearchLyricDirect(SearchLyricDirect $parameters)" ]

        //dd($funcs);
    }

    /**
     * Retrieve Lyrics Text through SOAP
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function textSoapLyrics($id, $chks)
    {
        $wsdl = 'http://api.chartlyrics.com/apiv1.asmx?WSDL';
        $responseText = null;
        if ($id != '' && $chks != '') {
            $responseText = Soap::to($wsdl)->call('GetLyric', ['lyricId' => $id, 'lyricCheckSum' => $chks]);
            $responseText = $responseText->response->GetLyricResult;
        }
        //dd($responseText);
        return view('title.soaplyrictext', compact('responseText'));
    }

    /**
     * Retrieve deezer information through API.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function searchDeezerApi(Request $request)
    {
        if ($request->txtBuscar) {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', 'https://deezerdevs-deezer.p.rapidapi.com/search?q=' . $request->txtBuscar, [
                'headers' => [
                    'X-RapidAPI-Host' => 'deezerdevs-deezer.p.rapidapi.com',
                    'X-RapidAPI-Key' => 'c1f6e8231emshb82a30b58b39cbfp130ad7jsn70af26b9f793',
                ],
            ]);
            $deezerresponse = json_decode($response->getBody())->data;
        } else {
            $deezerresponse = null;
        }
        return view('title.deezersearch', compact('deezerresponse'));
    }

    /**
     * Retrieve deezer information through API.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function titleDeezerApi($titleid)
    {
        //dd($titleid);
        if ($titleid) {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', 'https://deezerdevs-deezer.p.rapidapi.com/album/' . $titleid, [
                'headers' => [
                    'X-RapidAPI-Host' => 'deezerdevs-deezer.p.rapidapi.com',
                    'X-RapidAPI-Key' => 'c1f6e8231emshb82a30b58b39cbfp130ad7jsn70af26b9f793',
                ],
            ]);
            $deezerresponse = json_decode($response->getBody());
            //dd($deezerresponse);
        } else {
            $deezerresponse = null;
        }

        return view('title.deezertitle', compact('deezerresponse'));
    }

    /**
     * Retrieve spotify information through API.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function searchSpotifyApi(Request $request)
    {
        $spotifymultiresponse = null;
        if ($request->txtBuscar) {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', 'https://spotify23.p.rapidapi.com/search/?q=' . $request->txtBuscar . '&type=multi&offset=0&limit=10&numberOfTopResults=5', [
                'headers' => [
                    'X-RapidAPI-Host' => 'spotify23.p.rapidapi.com',
                    'X-RapidAPI-Key' => 'c1f6e8231emshb82a30b58b39cbfp130ad7jsn70af26b9f793',
                ],
            ]);
            $spotifymultiresponse = json_decode($response->getBody());
            // dd($spotifymultiresponse);
        }
        return view('title.spotifysearch', compact('spotifymultiresponse'));
    }

    /**
     * Rating a title...
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function rateTitle(Request $request)
    {
        $response = ['status' => 'fail'];

        if ($request->wish_id) {
            $wish = Wish::find($request->wish_id);
            $wish->valoracion = $request->rate;
            $wish->save();

            if ($request->title_id) {
                $title = Title::find($request->title_id);
                $title->valoracion = 0;
                $wishes = $title->wishes;
                $valor = 0;
                $i = 0;
                foreach ($wishes as $thewish) {
                    if ($thewish->valoracion != 0) {
                        $valor = $valor + $thewish->valoracion;
                        $i = $i + 1;
                    }
                }
                if ($i != 0) {
                    $valor = floor($valor / $i);
                }
                $title->valoracion = $valor;
                $title->save();
            }
            $response = ['status' => 'ok', 'wish' => $wish, 'title' => $title];
        }

        //ActivityLog on 'Rating' if status is ok
        if ($response['status'] == 'ok') {
            if (Auth::user()) {
                $activities = Activity::where('log_name', 'rating')
                    ->where('subject_type', 'App\Models\Wish')
                    ->where('subject_id', $wish->id)
                    ->where('causer_type', 'App\Models\User')
                    ->where('causer_id', Auth::user()->id)
                    ->get();

                if (count($activities) == 0) {
                    activity('rating')
                        ->performedOn($wish)
                        ->log('1');
                } else {
                    foreach ($activities as $activity) {
                        $activity->description = $activity->description + 1;
                        $activity->save();
                    }
                }
            }
            $response['status'] = 'rating';
        }
        return $response;
    }
}
