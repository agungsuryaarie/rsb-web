<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class VideoController extends Controller
{
    public function index(Request $request)
    {
        $menu = 'Video';
        if ($request->ajax()) {
            $data = Video::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('title', function ($row) {
                    return $row->title;
                })
                ->addColumn('thumbnail', function ($row) {
                    preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $row->link, $matches);

                    return '<img src="https://img.youtube.com/vi/' . $matches[1] . '/0.jpg" alt="" width="200px">';
                })
                ->addColumn('action', function ($row) {
                    $editBtn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Edit" class="btn btn-primary btn-xs edit"><i class="fas fa-edit"></i></a>';
                    $deleteBtn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-xs delete"><i class="fas fa-trash"></i></a>';
                    return '<center>'  . $editBtn . ' ' . $deleteBtn . '</center>';
                })
                ->rawColumns(['thumbnail', 'action'])
                ->make(true);
        }

        return view('admin.video.data', compact('menu'));
    }
    public function store(Request $request)
    {
        //Translate Bahasa Indonesia
        $message = array(
            'title.required' => 'Judul harus diisi.',
            'description.required' => 'Deskripsi harus diisi.',
            'link.required' => 'Link harus diisi.',
        );

        $validator = Validator::make($request->all(), [
            'title'  => 'required',
            'description'  => 'required',
            'link'  => 'required',
        ], $message);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
        Video::updateOrCreate(
            [
                'id' => $request->hidden_id
            ],
            [
                'title' => $request->title,
                'description' => $request->description,
                'link' => $request->link,
            ]
        );

        return response()->json(['success' => 'Video saved successfully.']);
    }
    public function edit($id)
    {
        $data = Video::find($id);
        return response()->json($data);
    }

    public function destroy($id)
    {
        Video::find($id)->delete();
        return response()->json(['success' => 'Video deleted successfully.']);
    }
}
