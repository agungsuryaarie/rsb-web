<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProgramController extends Controller
{
    public function index(Request $request)
    {
        $menu = 'Program';
        if ($request->ajax()) {
            $data = Program::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('host', function ($data) {
                    return $data->user->name;
                })
                ->addColumn('cover_image', function ($row) {
                    $coverImage = asset('storage/program/' . $row->cover);
                    return '<img src="' . $coverImage . '" width="250">';
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('program.edit', $row->id) . '" class="btn btn-primary btn-xs edit"><i class="fas fa-edit"></i></a>';
                    $btn = '<center>' . $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-xs delete"><i class="fas fa-trash"></i></a><center>';
                    return $btn;
                })
                ->rawColumns(['cover_image', 'action'])
                ->make(true);
        }

        return view('admin.program.data', compact('menu'));
    }

    public function create()
    {
        $menu = "Program Create";
        $host = User::where('host', true)->get();
        return view('admin.program.create', compact('menu', 'host'));
    }

    public function store(Request $request)
    {
        //Translate Bahasa Indonesia
        $message = array(
            'name.required'            => 'Judul Program harus diisi.',
            'host.required'            => 'Penyiar harus dipilih.',
            'description.required'     => 'Deskripsi harus diisi.',
            'cover.required' => 'Cover harus diupload.',
        );

        // Validasi input dengan rule yang ditentukan
        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'host'          => 'required',
            'description'   => 'required',
            'cover'         => $request->hidden_id ? 'nullable' : 'required', // Menjadikan gambar opsional saat edit
        ], $message);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $filename = null; // Inisialisasi variabel filename
        $oldImage = null; // Inisialisasi variabel oldImageName

        if ($request->hasFile('cover')) {
            // Hapus gambar lama dari storage jika ada
            if ($request->hidden_id) {
                $program = Program::find($request->hidden_id);
                $oldImage = $program->image;
                if ($oldImage) {
                    Storage::delete('public/program/' . $oldImage);
                }
            }

            // Unggah gambar baru
            $image = $request->file('cover');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/program', $filename);
        }

        $data = [
            'host' => $request->host,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
        ];

        if ($filename) {
            $data['cover'] = $filename;
        }

        Program::updateOrCreate(
            [
                'id' => $request->hidden_id
            ],
            $data
        );

        return redirect()->route('program.index')->with(['success' => 'Program saved successfully.']);
    }

    public function edit(Program $program)
    {
        $menu = "Post Edit";
        $host = User::where('host', true)->get();
        $program = Program::where('id', $program->id)->first();
        return view('admin.program.edit', compact('menu', 'host', 'program'));
    }

    public function destroy($id)
    {
        $program = Program::find($id);
        if ($program->image) {
            Storage::delete('public/program/' . $program->image);
        }
        $program->delete();
        return response()->json(['success' => 'Program deleted successfully.']);
    }
}
