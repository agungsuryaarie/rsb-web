<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Photo;
use Illuminate\Http\Request;
use \Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;

class PhotoController extends Controller
{
    public function index(Request $request, $id)
    {
        $menu = 'Foto';
        $albumId = $id;
        $album = Album::find($id);
        if ($request->ajax()) {
            $data = Photo::where('album_id', $albumId)->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function ($row) {
                    $image = asset('storage/album/' . $row->image);
                    return '<img src="' . $image . '" width="150">';
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="btn btn-primary btn-xs edit"><i class="fas fa-edit"></i></a>';
                    $btn = '<center>' . $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-xs delete"><i class="fas fa-trash"></i></a><center>';
                    return $btn;
                })
                ->rawColumns(['image', 'action'])
                ->make(true);
        }

        return view('admin.photo.data', compact('menu', 'albumId', 'album'));
    }

    public function store(Request $request)
    {
        //Translate Bahasa Indonesia
        $message = array(
            'image.required' => 'Gambar harus diupload.',
        );

        $validator = Validator::make($request->all(), [
            'image' => $request->hidden_id ? 'nullable' : 'required', // Menjadikan gambar opsional saat edit
        ], $message);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $filename = null; // Inisialisasi variabel $filename sebagai null

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/album/', $filename);
        } else {
            // Jika tidak ada file gambar yang diunggah, periksa apakah ada hidden_id (mode edit)
            if ($request->hidden_id) {
                // Ambil data album yang akan diedit
                $album = Photo::find($request->hidden_id);
                $filename = $album->image; // Gunakan gambar lama
            }
        }

        Photo::updateOrCreate(
            [
                'id' => $request->hidden_id
            ],
            [
                'album_id' => $request->album_id,
                'image' => $filename,
            ]
        );

        return response()->json(['success' => 'Photo saved successfully.']);
    }

    public function edit($id)
    {
        $data = Photo::find($id);
        return response()->json($data);
    }

    public function destroy($id)
    {
        Photo::find($id)->delete();
        return response()->json(['success' => 'Photo deleted successfully.']);
    }
}
