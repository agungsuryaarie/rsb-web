<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $menu = 'Event';
        if ($request->ajax()) {
            $data = Event::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('cover_image', function ($row) {
                    $coverImage = asset('storage/event/' . $row->cover);
                    return '<img src="' . $coverImage . '" width="250">';
                })
                ->addColumn('action', function ($row) {
                    $editBtn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Edit" class="btn btn-primary btn-xs edit"><i class="fas fa-edit"></i></a>';
                    $deleteBtn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-xs delete"><i class="fas fa-trash"></i></a>';
                    return '<center>'  . $editBtn . ' ' . $deleteBtn . '</center>';
                })
                ->rawColumns(['cover_image', 'action'])
                ->make(true);
        }

        return view('admin.event.data', compact('menu'));
    }

    public function store(Request $request)
    {
        //Translate Bahasa Indonesia
        $message = array(
            'title.required' => 'Judul harus diisi.',
            'description.required' => 'Deskripsi harus diisi.',
            'cover.required' => 'Cover harus diupload.',
        );

        $validator = Validator::make($request->all(), [
            'title'  => 'required',
            'description'  => 'required',
            'cover' => $request->hidden_id ? 'nullable' : 'required', // Menjadikan gambar opsional saat edit
        ], $message);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $filename = null; // Inisialisasi variabel $filename sebagai null

        if ($request->hasFile('cover')) {
            $image = $request->file('cover');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/event/', $filename);
        } else {
            // Jika tidak ada file gambar yang diunggah, periksa apakah ada hidden_id (mode edit)
            if ($request->hidden_id) {
                // Ambil data album yang akan diedit
                $album = Event::find($request->hidden_id);
                $filename = $album->cover; // Gunakan gambar lama
            }
        }

        Event::updateOrCreate(
            [
                'id' => $request->hidden_id
            ],
            [
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'description' => $request->description,
                'cover' => $filename,
            ]
        );

        return response()->json(['success' => 'Event saved successfully.']);
    }

    public function edit($id)
    {
        $data = Event::find($id);
        return response()->json($data);
    }

    public function destroy($id)
    {
        Event::find($id)->delete();
        return response()->json(['success' => 'Event deleted successfully.']);
    }
}
