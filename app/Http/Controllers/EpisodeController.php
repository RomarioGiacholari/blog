<?php

namespace App\Http\Controllers;

use \stdClass;
use App\Episode;
use App\Podcast;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class EpisodeController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except(['show', 'index']);
    }

    public function index()
    {
        $viewModel = new stdClass;
        $viewModel->pageTitle = "Podcast | Episodes";
        $viewModel->episodes = null;

        $podcast = Podcast::first();

        if ($podcast) {
            $episodeList = $podcast->episodes()->paginate(24);

            if ($episodeList && count($episodeList) > 0) {
                $viewModel->episodes = $episodeList;
            }
        }

        return view("episodes.index", ["viewModel" => $viewModel]);
    }

    public function show(Episode $episode)
    {
        $viewModel = new stdClass;
        $viewModel->pageTitle = null;
        $viewModel->episode = null;

        if ($episode && isset($episode->title)) {
            $viewModel->pageTitle = "Podcast | Episodes | {$episode->title}";
            $viewModel->episode = $episode;
        }

        return view("episodes.show", ["viewModel" => $viewModel]);
    }

    public function create()
    {
        $viewModel = new stdClass;
        $viewModel->pageTitle = "New episode";

        return view("episodes.create", ["viewModel" => $viewModel]);
    }

    public function store(Request $request)
    {
        $this->validateEpisode($request);

        $attributes = [
            'title' => $request->title,
            'description' => $request->description,
            'slug' => $request->title,
            'audioBase64' => static::convertToBase64($request->audioBase64),
        ];

        $user = auth()->user();
        $podcast = $user->podcasts()->first() ?? null;

        if ($podcast !== null) {
            $episode = $podcast->episodes()->create($attributes);

            return redirect(route("episodes.show", ["episode" => $episode]));
        }

        return back();
    }

    public function edit(Episode $episode)
    {
        $viewModel = new stdClass;
        $viewModel->episode = null;
        $viewModel->pageTitle = null;

        if ($episode && isset($episode->title)) {
            $viewModel->episode = $episode;
            $viewModel->pageTitle = $episode->title;
        }

        return view('episodes.edit', ['viewModel' => $viewModel]);
    }

    public function update(Request $request, Episode $episode)
    {
        $this->validateEpisode($request, $episode->id);

        $attributes = [
            'title' => $request->title,
            'description' => $request->description,
            'slug' => $request->title,
            'audioBase64' => static::convertToBase64($request->audioBase64),
        ];

        $episode->fill($attributes);
        $episode->save();
        
        return redirect(route('home.episodes'));
    }

    public function destroy(Episode $episode)
    {
        $episode->delete();

        return back();
    }

    private function validateEpisode(Request $request, int $episodeId = 0): void
    {
        $this->validate($request, [
            "title" => "required|max:20|unique:episodes,title,{$episodeId}",
            "description" => "required|max:255",
            "audioBase64" => "required|mimes:audio/mpeg,mpga,mp3,m4a,wav,aac"
        ]);
    }

    private static function convertToBase64(UploadedFile $audioFile): ?string
    {
        $base64File = null;

        if (isset($audioFile)) {
            $file = file_get_contents($audioFile);

            if (isset($file)) {
                $base64File = base64_encode($file);
            }
        }

        return $base64File;
    }
}
