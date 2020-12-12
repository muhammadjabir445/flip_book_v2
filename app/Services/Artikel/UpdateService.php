<?php
namespace App\Services\Artikel;

use App\Models\Artikel;

class UpdateService {
    public function handle($id,$request) {
        $artikel = Artikel::findOrFail($id);
        $artikel->judul = $request->judul;
        $artikel->isi_artikel = $request->isi_artikel;
        $artikel->slug = \Str::slug($request->judul,'-') . $artikel->id;

        if ($request->file('foto')) {
            if($artikel->foto && file_exists(public_path('storage/' . $artikel->foto))){
                \Storage::delete($artikel->foto);
            }
            $file = $request->file('file')->store('foto_artikel','public');
            $artikel->foto = $file;
        }
        $artikel->save();
        return $artikel;
    }
}
