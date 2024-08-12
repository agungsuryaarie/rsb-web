<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;

class AlbumController extends Controller
{
    public function index(Request $request)
    {
        $menu = 'Album';
        if ($request->ajax()) {
            $data = Album::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('cover_image', function ($row) {
                    $coverImage = asset('storage/album/' . $row->cover);
                    return '<img src="' . $coverImage . '" width="250">';
                })
                ->addColumn('photo_count', function ($row) {
                    return $row->photo->count();
                })
                ->addColumn('action', function ($row) {
                    $fotoBtn = '<a href="' . route('photo.index', $row->id) . '" class="btn btn-success btn-xs"><i class="fas fa-camera"></i></a>';
                    $editBtn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Edit" class="btn btn-primary btn-xs edit"><i class="fas fa-edit"></i></a>';
                    $deleteBtn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-xs delete"><i class="fas fa-trash"></i></a>';
                    return '<center>' . $fotoBtn . ' '  . $editBtn . ' ' . $deleteBtn . '</center>';
                })
                ->rawColumns(['cover_image', 'action'])
                ->make(true);
        }

        return view('admin.album.data', compact('menu'));
    }

    public function store(Request $request)
    {
        //Translate Bahasa Indonesia
        $message = array(
            'name.required' => 'Nama harus diisi.',
            'cover.required' => 'Cover harus diupload.',
        );

        $validator = Validator::make($request->all(), [
            'name'  => 'required',
            'cover' => $request->hidden_id ? 'nullable' : 'required', // Menjadikan gambar opsional saat edit
        ], $message);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $filename = null; // Inisialisasi variabel $filename sebagai null

        if ($request->hasFile('cover')) {
            $image = $request->file('cover');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/album/', $filename);
        } else {
            // Jika tidak ada file gambar yang diunggah, periksa apakah ada hidden_id (mode edit)
            if ($request->hidden_id) {
                // Ambil data album yang akan diedit
                $album = Album::find($request->hidden_id);
                $filename = $album->cover; // Gunakan gambar lama
            }
        }

        Album::updateOrCreate(
            [
                'id' => $request->hidden_id
            ],
            [
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'cover' => $filename,
            ]
        );

        return response()->json(['success' => 'Album saved successfully.']);
    }

    public function edit($id)
    {
        $data = Album::find($id);
        return response()->json($data);
    }

    public function destroy($id)
    {
        Album::find($id)->delete();
        return response()->json(['success' => 'Album deleted successfully.']);
    }
}
