<?php

namespace App\Http\Controllers\Gambar;

use App\Http\Controllers\Controller;
use App\Models\Gambar;
use Illuminate\Http\Request;

class GambarController extends Controller
{
    public function index() {

        $data = Gambar::paginate(10);
        return $data;
    }

    public function store(Request $request) {
        $data = new Gambar();
        $file  = $request->file('foto')->store('foto_depan','public');
        $data->foto = $file;
        $data->save();
        return response()->json([
            'message' => 'berhasil upload'
        ],200);
    }

    public function destroy($id) {
        $data = Gambar::findOrFail($id);
        $data->delete();
        return response()->json([
            'message' => 'berhasil hapus foto'
        ],200);
    }
}
