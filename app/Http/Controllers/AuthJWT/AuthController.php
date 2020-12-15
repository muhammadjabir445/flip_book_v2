<?php

namespace App\Http\Controllers\AuthJWT;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\User;
use App\Jobs\SendResetPassword;
use App\Models\Menu;
use App\User as AppUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register','password_reset','password_reset_action','get_sekolah']]);
    }

    public function status_login($id) {
        $user = AppUser::findOrFail($id);
        if ($user) {
            if($user->id_role === 25 && $user->status == 1) {
                $user->status = 0;
                $user->save();
            }
        }
    }

    public function login(Request $request)
    {
        $credentials = request(['email', 'password']);


        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        } else {
            $user = AppUser::where('email',$request->email)->first();
            if ($user) {
                if ($user->id_role === 25 && $user->status === 1 ) {
                    auth()->logout();
                    return response()->json(['message' => 'Akun telah login ditempat lain'], 400);
                } else if($user->id_role === 25 && $user->status === 0) {
                    AppUser::where('email',$request->email)->update([
                        'status' => 1
                    ]);
                }
            }
        }

        return $this->respondWithToken($token);
    }

    public function register(Request $request){
        $validator = \Validator::make($request->all(), [
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'sekolah' =>'required'
        ],[
            '*.unique' => 'Email Sudah Tersedia',
            '*.required' => ':attribute tidak boleh kosong'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ],400);
        }
        $user = new \App\User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->sekolah = \Str::upper($request->sekolah);
        $user->password = \Hash::make($request->password);
        $user->id_role = $request->role ? $request->role : 25;
        $user->save();

        return $this->login($request);
    }

    public function get_sekolah(Request $request) {
        $user = \App\User::select(\DB::raw('DISTINCT sekolah'))->where('sekolah','LIKE',"%$request->keyword%")->where('sekolah','!=',NULL)->get();
        return $user;
    }

    /**
     * Get the authenticated User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me(Request $request)
    {
        // return response()->json($this->guard()->user());
        $header = $request->header('Authorization');
        $header = explode('Bearer ',$header);
        $user =$this->guard();
        if ($user) {
            if ($user->id_role === 25) {
                $update_user = AppUser::findOrFail($user->id);
                $update_user ->status = 1;
                $update_user ->save();
            }
        }

        return $this->respondWithToken($header[1]);
    }

    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {

        $user =$this->guard();

        if ($user->id_role === 25) {
            $user = AppUser::findOrFail(\Auth::user()->id);
            if($user->id_role === 25 && $user->status == 1) {
                $user->status = 0;
                $user->save();
            }
        }
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function EditProfile(Request $request){
        $user = AppUser::with('role')->findOrFail($request->id);
        if ($request->password) {
            $user->password = \Hash::make($request->password);
        }

        if($request->file('foto_profile')){
            if($user->foto and file_exists(storage_path('app/public/'.$user->foto))){
                \Storage::delete('public/'.$user->foto);
                }
            $file = $request->file('foto_profile')->store('foto_profile','public');
            $user->foto = $file;
        }
        $user->name = $request->name;
        $user->save();
        return response()->json( [
            'user' => $user,
        ]);
    }

    protected function respondWithToken($token)
    {
        $user =$this->guard();
        $menu = Menu::with(['child_menu' => function($q) use ($user) {
            $q->whereIn('id',$user->role->role_menu->child);
        }])->whereIn('id',$user->role->role_menu->parent)->orderBy('priority','desc')->get();
        return response()->json([
            'access_token' => $token,
            'user' => new User($user),
            'menu' => $menu,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard()->user();
    }

    public function password_reset(Request $request){
        $validator = \Validator::make($request->all(), [
            'email' => 'required|exists:users,email',
        ],[
            '*.exists' => 'Email Salah',
            '*.required' => ':attribute tidak boleh kosong'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ],400);
        }
        $token = \Str::random(60);

        $data = \DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => \Carbon\Carbon::now()
        ]);
        $akun = AppUser::where('email',$request->email)->first();
        // return $akun;
        SendResetPassword::dispatch($akun,$token);
        return response()->json([
            'message' => 'Silakan Check Email Anda'
        ]);
    }

    public function password_reset_action(Request $request, $token) {
        $validator = \Validator::make($request->all(), [
            'password' => 'required',
            'token' => 'required|exists:password_resets,token'
        ],[
            '*.required' => ':attribute tidak boleh kosong'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ],400);
        }
        $data = \DB::table('password_resets')->where('token',$token)->first();
        $now = \Carbon\Carbon::now();
        $data_date = \Carbon\Carbon::parse($data->created_at);
        $selisi = $data_date->diffInHours($now,false);
        if ($selisi >= 6) {
            return response()->json([
                'message' =>'Expired'
            ],400);
        }
        $update = AppUser::where('email',$data->email)->update([
            'password' => \Hash::make($request->password)
        ]);

        if ($update) {
            \DB::table('password_resets')->where('email',$data->email)->delete();
        }
        return response()->json([
            'message' =>'Berhasil'
        ],200);
    }
}
