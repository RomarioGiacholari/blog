<?php

namespace App\Http\Controllers;

use App\Episode;
use App\Http\Middleware\Administrator;
use App\Podcast;
use App\ViewModels\Episode\CreateViewModel;
use App\ViewModels\Episode\EditViewModel;
use App\ViewModels\Episode\IndexViewModel;
use App\ViewModels\Episode\ShowViewModel;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class EpisodeController extends Controller
{
    public function __construct()
    {
        $this->middleware(Administrator::class)->except(['show', 'index']);
    }

    public function index()
    {
        $viewModel = new IndexViewModel();
        $viewModel->pageTitle = 'Podcast | Episodes';
        $viewModel->episodes = null;

        $podcast = Podcast::query()->first();

        if ($podcast && isset($posdcast->episodes)) {
            $episodeList = $podcast->episodes()->paginate(24);

            if ($episodeList && !$episodeList->isEmpty()) {
                $viewModel->episodes = $episodeList;
            }
        }

        return view('episodes.index', ['viewModel' => $viewModel]);
    }

    public function show(Episode $episode)
    {
        $viewModel = new ShowViewModel();
        $viewModel->episode = $episode;
        $viewModel->pageTitle = null;

        if (isset($episode->title)) {
            $viewModel->pageTitle = "Podcast | Episodes | {$episode->title}";
        }

        return view('episodes.show', ['viewModel' => $viewModel]);
    }

    public function create()
    {
        $viewModel = new CreateViewModel();
        $viewModel->pageTitle = 'New episode';

        return view('episodes.create', ['viewModel' => $viewModel]);
    }

    public function store(Request $request)
    {
        $this->validateEpisode($request);

        $attributes = [
            'title'       => $request->input('title'),
            'description' => $request->input('description'),
            'slug'        => $request->input('title'),
            'audioBase64' => static::convertToBase64($request->file('audioBase64')),
        ];

        $user = auth()->user();

        if ($user && isset($user->podcasts)) {
            $podcast = $user->podcasts()->first() ?? null;

            if ($podcast !== null) {
                $episode = $podcast->episodes()->create($attributes);

                return redirect(route('episodes.show', ['episode' => $episode]));
            }
        }

        return back();
    }

    public function edit(Episode $episode)
    {
        $viewModel = new EditViewModel();
        $viewModel->episode = $episode;
        $viewModel->pageTitle = null;

        if (isset($episode->title)) {
            $viewModel->pageTitle = $episode->title;
        }

        return view('episodes.edit', ['viewModel' => $viewModel]);
    }

    public function update(Request $request, Episode $episode)
    {
        $this->validateEpisode($request, $episode->id);

        $attributes = [
            'title'       => $request->input('title'),
            'description' => $request->input('description'),
            'slug'        => $request->input('title'),
            'audioBase64' => static::convertToBase64($request->file('audioBase64')),
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
            'title'       => "required|max:20|unique:episodes,title,{$episodeId}",
            'description' => 'required|max:255',
            'audioBase64' => 'required|mimes:audio/mpeg,mpga,mp3,m4a,wav,aac',
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
