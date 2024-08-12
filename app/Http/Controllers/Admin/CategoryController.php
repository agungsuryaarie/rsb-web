<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $menu = 'Kategori';
        if ($request->ajax()) {
            $data = Category::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="btn btn-primary btn-xs edit"><i class="fas fa-edit"></i></a>';
                    $btn = '<center>' . $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-xs delete"><i class="fas fa-trash"></i></a><center>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.kategori.data', compact('menu'));
    }

    public function store(Request $request)
    {
        //Translate Bahasa Indonesia
        $message = array(
            'name.required' => 'Nama Kategori harus diisi.',
        );

        $validator = Validator::make($request->all(), [
            'name'  => 'required',
        ], $message);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        Category::updateOrCreate(
            [
                'id' => $request->hidden_id
            ],
            [
                'user_id' => Auth::user()->id,
                'name' => $request->name,
            ]
        );

        return response()->json(['success' => 'Kategori saved successfully.']);
    }

    public function edit($id)
    {
        $data = Category::find($id);
        return response()->json($data);
    }

    public function destroy($id)
    {
        Category::find($id)->delete();
        return response()->json(['success' => 'Kategori deleted successfully.']);
    }
}
