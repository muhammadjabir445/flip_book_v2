<?php
namespace App\Services\Artikel;

use App\Models\Artikel;

class StoreService {
    public function handle($request) {
        $artikel = new Artikel;
        $artikel->judul = $request->judul;
        $artikel->isi_artikel = $request->isi_artikel;
        $artikel->slug = \Str::slug($request->judul,'-') . $artikel->id;
        if ($request->file('foto')) {
            $file = $request->file('foto')->store('foto_artikel','public');
            $artikel->foto = $file;
        }
        $artikel->save();
        $artikel = Artikel::findOrFail($artikel->id);
        $artikel->slug = \Str::slug($request->judul,'-') . "-$artikel->id";
        $artikel->save();

        return $artikel;
    }
}
