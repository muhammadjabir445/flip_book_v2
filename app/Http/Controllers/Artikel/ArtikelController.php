<?php

namespace App\Http\Controllers\Artikel;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use Illuminate\Http\Request;
use App\Services\Artikel\StoreService;
use App\Services\Artikel\DestroyService;
use App\Services\Artikel\UpdateService;
class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Artikel::where('judul','LIKE',"%$request->keyword%")
        ->orderBy('created_at','desc')
        ->paginate(10);
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, StoreService $storeService)
    {
        $validator = \Validator::make($request->all(),[
            '*' => 'required'
        ],
        [
            '*.required' => ':attribute tidak boleh kosong',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ],400);
        }
        $data  = $storeService->handle($request);
        return response()->json([
            'message' => 'Berhasil Tambah Artikel'
        ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Artikel::findOrFail($id);
        return response()->json([
            'artikel' => $data
        ],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, UpdateService $updateService)
    {
        $validator = \Validator::make($request->all(),[
            'judul' => 'required',
            'isi_artikel' => 'required'
        ],
        [
            '*.required' => ':attribute tidak boleh kosong',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ],400);
        }
        $data  = $updateService->handle($id,$request);
        return response()->json([
            'message' => 'Berhasil Edit Artikel'
        ],201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, DestroyService $destroyService)
    {
        $destroyService->handle($id);
        return response()->json([
            'message' => 'Berhasil Hapus Artikel'
        ],201);
    }
}
