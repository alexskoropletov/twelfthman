<?php

namespace App\Http\Controllers;

use App\Photo;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    /**
     * Display a listing of the photos.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('loading');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = 'Error';

        if (
            $request->hasFile('photo-file')
            && $request->hasFile('photo-file')
            && $request->file('photo-file')->isValid()
            && in_array($request->file('photo-file')->getMimeType(), ['image/png', 'image/jpeg'])
        ) {
            $photo = new Photo();
            $photo->original_file_name = $request->file('photo-file')->getClientOriginalName();
            $photo->status = 1;
            $photo->name = $request->input('photo-name', '');
            $photo->save();

            $image = sprintf('image-%d.%s', $photo->id, $request->file('photo-file')->guessExtension());
            $request->file('photo-file')->storeAs('public/photo', $image);

            $process = new Process(sprintf(
                'convert -thumbnail 242 %s%s %simage-%s.png',
                base_path() . Storage::url('app/public/photo/'),
                $image,
                base_path() . Storage::url('app/public/thumbnail/'),
                $photo->id
            ));
            $process->run();

            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }

            $photo->image = $image;
            $photo->thumbnail = sprintf('image-%d.png', $photo->id);
            $photo->save();

            $result = 'OK';
        }

        return response()->json(compact('result'));
    }

    /**
     * Display the specified resource.
     *
     * @param integer $status
     * @return \Illuminate\Http\Response
     */
    public function show($status = 1)
    {
        $result = 'OK';
        $photos = Photo::where('status', $status)->get();
        $content = view('gallery', compact('photos'))->render();

        return response()->json(compact('result', 'content'));
    }

    /**
     * Show the form for editing the photo
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $result = 'OK';
        $content = view('form', compact('photos'))->render();

        return response()->json(compact('result', 'content'));
    }

    /**
     * Remove the photo
     *
     * @param  \App\Photo $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Photo $photo)
    {
        $result = 'Error';

        if ($photo->id) {
            $photo->status = 0;
            if ($photo->save()) {
                $result = 'OK';
            }
        }

        return response()->json(compact('result'));
    }

    /**
     * Restore the photo
     *
     * @param  \App\Photo $photo
     * @return \Illuminate\Http\Response
     */
    public function restore(Photo $photo)
    {
        $result = 'Error';

        if ($photo->id) {
            $photo->status = 1;
            if ($photo->save()) {
                $result = 'OK';
            }
        }

        return response()->json(compact('result'));
    }

    /**
     * Show controls for a single photo
     *
     * @param  \App\Photo $photo
     * @return \Illuminate\Http\Response
     */
    public function controls(Photo $photo)
    {
        $result = 'Error';
        $content = '';
        if ($photo->id) {
            $action = $photo->status ? 'destroy' : 'restore';
            $method = $photo->status ? 'DELETE' : 'PATCH';
            $content = view('controls', compact('photo', 'action', 'method'))->render();
            $result = 'OK';
        }

        return response()->json(compact('result', 'content'));
    }

    /**
     * Download the photo
     *
     * @param  \App\Photo $photo
     * @return \Illuminate\Http\Response
     */
    public function download(Photo $photo)
    {
        if ($photo->id) {
            return response()->download(
                base_path() . Storage::url('app/public/photo/' . $photo->image),
                $photo->original_file_name
            );
        }

        return response('Whoops!');
    }
}
