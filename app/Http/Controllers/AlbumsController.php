<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProjectRequest;

class AlbumsController extends Controller
{

    public function index()
    {
        $albums = Album::with('media')->get();
        $alums_names = $albums->pluck('name', 'id')->toArray();

        return view('index', compact('albums', 'alums_names'));
    }


    public function show(Album $album)
    {

        return view('show', compact('album'));
    }

    public function create()
    {
        $album = new Album();
        return view('create', compact('album'));
    }
    public function storeMedia(Request $request)
    {
        $path = storage_path('tmp/uploads');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('file');

        $name = uniqid() . '_' . trim($file->getClientOriginalName());

        $file->move($path, $name);

        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    public function store(StoreProjectRequest $request)
    {

        $product = Album::create([
            "name" => $request->input('name')
        ]);
        if ($request->has('document')) {
            foreach ($request->input('document', []) as $file) {
                $product->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('document');;
            }
        }
        return redirect()->route('album.index')->with('success', 'album added');
    }

    public function edit($id)
    {
        $album = Album::with('media')->findOrFail($id);
        return view('edit', compact('album'));
    }

    public function update(StoreProjectRequest $request, Album $album)
    {
        $album->update($request->all());

        if ($request->input('document', [])) {
            if (isset($album->media)) {
                if (count($album->media) > 0) {
                    foreach ($album->media as $media) {
                        if (!in_array($media->file_name, $request->input('document', []))) {
                            $media->delete();
                        }
                    }
                }
            }

            $media = $album->media->pluck('file_name')->toArray();
            foreach ($request->input('document', []) as $file) {
                if (count($media) === 0 || !in_array($file, $media)) {
                    $album->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('document');
                }
            }
        }

        return redirect()->route('album.index')->with('success', 'album added');
    }

    public function delete($album_id, $id)
    {
        $album = Album::findOrFail($album_id);
        $album->deleteMedia($id);
        return redirect()->route('album.index')->with('success', 'photo deleted');
    }

    public function ShowMove($album_id, $id)
    {

        $names = (array)(Album::pluck('name', 'id')->toArray());
        $album = Album::findOrFail($album_id);

        $images = $album->getMedia('document');
        $mediaItem = $images->where('id', $id)->first();

        return view('move', compact('names', 'mediaItem'));
    }
    public function move(Request $request)
    {

        $album_move = $request->input('album_move');
        $id = $request->input('image_id');
        $model_id = $request->input('model_id');

        $album = Album::findOrFail($model_id);
        $anotherModel = Album::findOrFail($album_move);

        $images = $album->getMedia('document');
        $mediaItem = $images->where('id', $id)->first();
        $mediaItem->move($anotherModel, 'document');
        return redirect()->route('album.index')->with('success', 'photo moved succesfuly');
    }

    public function DeleteAlbum($id)
    {
        $album = Album::findOrFail($id);
        $album->delete();

        return redirect()->route('album.index')->with('success', 'photo deleted succesfuly');
    }

    public function MoveAlbum(Request $request)
    {
        $id = $request->input('id');
        $model_id = $request->input('model_id');
        $album = Album::findOrFail($id);
        $anotherModel = Album::findOrFail($model_id);
        $images = $album->getMedia('document');
        $images->each(function ($item) use ($anotherModel,) {
            $item->move($anotherModel, 'document');
        });
        $album->delete();
        return redirect()->route('album.index')->with('success', 'Album moved succesfuly');
    }
}
