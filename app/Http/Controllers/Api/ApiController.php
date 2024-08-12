<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Post;
use App\Models\Profile;
use App\Models\Program;
use App\Models\UserPublic;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function login(Request $request)
    {
        $message = array(
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Penulisan email tidak benar.',
            'password.required' => 'Password harus diisi.',
        );
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ], $message);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $credentials = $request->only('email', 'password');
        $isEmailRegistered = UserPublic::where('email', $credentials['email'])->exists();

        if (!$isEmailRegistered) {
            return response()->json([
                'message' => 'Email tidak terdaftar.',
            ], 401);
        }

        if (Auth::guard('client')->attempt($credentials)) {
            $user = Auth::guard('client')->user();
            $token = $user->createToken('ClientToken')->plainTextToken;

            return response()->json([
                'token' => $token,
                'user' => $user,
            ]);
        }

        return response()->json([
            'message' => 'Email atau Password salah.',
        ], 401);
    }

    public function register(Request $request)
    {
        $message = array(
            'name.required' => 'Nama harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Penulisan email tidak benar.',
            'email.unique' => 'Email sudah digunakan.',
            'nohp.required' => 'Nomor Hp/WhatsApp harus diisi.',
            'nohp.unique' => 'Nomor Hp/WhatsApp sudah digunakan.',
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password_confirmation.required' => 'Konfirmasi Password harus diisi.',
            'password_confirmation.same' => 'Konfirmasi Password tidak sesuai dengan Password.',
            'password_confirmation.min' => 'Password minimal 8 karakter.',
        );
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users_public|max:255',
            'nohp' => 'required|string|max:20|unique:users_public',
            'password' => 'required|string|min:8',
            'password_confirmation' => 'required|min:8|same:password',
        ], $message);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = new UserPublic([
            'name' => $request->name,
            'email' => $request->email,
            'nohp' => $request->nohp,
            'password' => Hash::make($request->password),
        ]);
        $user->save();

        return response()->json(['message' => 'Pendaftaran berhasil.'], 201);
    }

    public function getUserData(Request $request)
    {
        // if (Auth::check()) {
        //     $user = $request->user();
        //     return response()->json($user);
        // } else {
        //     return response()->json(['error' => 'Anda belum login atau tidak memiliki token'], 401);
        // }
        $user = [
            "id" => 1,
            "name" => "RSB FM",
            "email" => "diskominfobatubara@gmail.com",
            "nohp" => "",
            "status" => "1"
        ];

        return response()->json($user);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();
        return response()->json([
            'message' => 'Sampai ketemu lagi',
        ]);
    }
    public function getBerita()
    {
        $berita = Post::where('status', '=', 1)->latest()->get();
        return response()->json($berita);
    }
    public function getBeritaDetail($id)
    {
        try {
            $news = Post::findOrFail($id);
            return response()->json($news);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Berita tidak ditemukan.'], 404);
        }
    }
    public function getProgram()
    {
        $program = Program::with('user')->latest()->get();
        return response()->json($program);
    }
    public function getProgramDetail($id)
    {
        try {
            $program = Program::with('user')->findOrFail($id);
            return response()->json($program);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Program tidak ditemukan.'], 404);
        }
    }
    public function getEvent()
    {
        $event = Event::latest()->get();
        return response()->json($event);
    }
    public function getEventDetail($id)
    {
        try {
            $event = Event::findOrFail($id);
            return response()->json($event);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Event tidak ditemukan.'], 404);
        }
    }
    public function getHost()
    {
        $hosts = Profile::join('users', 'profiles.user_id', '=', 'users.id')
            ->select('profiles.*', 'users.host', 'users.name')
            ->where('users.host', '=',  1)
            ->latest()
            ->get();

        return response()->json($hosts);
    }
    public function getHostDetail($id)
    {
        try {
            $host = Profile::with('user')->findOrFail($id);
            return response()->json($host);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Host tidak ditemukan.'], 404);
        }
    }
    public function getVideo()
    {
        $video = Video::latest()->get();
        return response()->json($video);
    }
}
