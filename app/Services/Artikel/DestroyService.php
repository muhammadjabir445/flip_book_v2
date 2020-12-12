<?php
namespace App\Services\Artikel;

use App\Models\Artikel;

class DestroyService {
    public function handle($id) {
        $artikel = Artikel::findOrFail($id);
        if($artikel->foto && file_exists(public_path('storage/' . $artikel->foto))){
            \Storage::delete($artikel->foto);
        }
        $artikel->delete();
        return $artikel;
    }
}
