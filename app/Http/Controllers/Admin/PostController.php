<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $menu = 'Post';
        if ($request->ajax()) {
            $data = Post::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('category', function ($data) {
                    return $data->category->name;
                })
                ->addColumn('author', function ($data) {
                    return $data->user->name;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('post.edit', $row->id) . '" class="btn btn-primary btn-xs edit"><i class="fas fa-edit"></i></a>';
                    $btn = '<center>' . $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-xs delete"><i class="fas fa-trash"></i></a><center>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.post.data', compact('menu'));
    }

    public function create()
    {
        $menu = "Post Create";
        $kategori = Category::all();
        return view('admin.post.create', compact('menu', 'kategori'));
    }

    public function store(Request $request)
    {
        //Translate Bahasa Indonesia
        $message = array(
            'title.required'            => 'Judul harus diisi.',
            'title.max'                 => 'Judul maksimal 255 karakter.',
            'category_id.required'      => 'Kategori harus dipilih.',
            'content.required'          => 'Konten harus diisi.',
            'status.required'           => 'Status harus dipilih.',
            'image.required' => 'Gambar harus diupload.',
        );

        // Validasi input dengan rule yang ditentukan
        $validator = Validator::make($request->all(), [
            'title'             => 'required|max:255',
            'category_id'       => 'required',
            'content'           => 'required',
            'status'            => 'required',
            'image'             => $request->hidden_id ? 'nullable' : 'required', // Menjadikan gambar opsional saat edit
        ], $message);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $filename = null; // Inisialisasi variabel filename
        $oldImage = null; // Inisialisasi variabel oldImageName

        if ($request->hasFile('image')) {
            // Hapus gambar lama dari storage jika ada
            if ($request->hidden_id) {
                $post = Post::find($request->hidden_id);
                $oldImage = $post->image;
                if ($oldImage) {
                    Storage::delete('public/post/' . $oldImage);
                }
            }

            // Unggah gambar baru
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/post', $filename);
        }

        $postData = [
            'user_id'       => Auth::user()->id,
            'category_id'   => $request->category_id,
            'title'         => $request->title,
            'slug'          => Str::slug($request->title),
            'content'       => $request->content,
            'status'        => $request->status,
            'tanggal'       => date('Y-m-d'),
            'jam'           => date('H:i:s'),
        ];

        if ($filename) {
            $postData['image'] = $filename;
        }

        Post::updateOrCreate(
            [
                'id' => $request->hidden_id,
            ],
            $postData
        );

        return redirect()->route('post.index')->with(['success' => 'Post saved successfully.']);
    }

    public function edit(Post $post)
    {
        $menu = "Post Edit";
        $kategori = Category::all();
        $posts = Post::where('id', $post->id)->first();
        return view('admin.post.edit', compact('menu', 'kategori', 'posts'));
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        if ($post->image) {
            Storage::delete('public/post/' . $post->image);
        }
        $post->delete();
        return response()->json(['success' => 'Post deleted successfully.']);
    }
}
