<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Http\Resources\Book\Book as BookBook;
use App\Http\Resources\Book\BookCollection;
use App\Models\Book;
use App\Models\MasterDataDetail;
use App\Services\BookService;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function my_book(Request $request){
        $book = \Auth::user()
        ->books()
        ->with('deskripsi')
        ->where('judul_buku','LIKE',"%$request->keyword%")
        ->orderBy('judul_buku','ASC')
        ->paginate(9);
        return new BookCollection($book);;
    }
    public function my_book_read($kode) {
        $book = Book::where('kode_buku',$kode)->first();
        return new BookBook($book);
    }

    public function books_list(Request $request,$category) {
        $books = Book::with('category')
        ->search($request)
        ->where('status',1)
        ->whereHas('category',function($q) use($category) {
            return $q->where('description',$category);
        })
        ->orderBy('judul_buku','ASC')

        ->paginate(16);
        return new BookCollection($books);
    }
    public function index(Request $request)
    {
        $books = Book::with('deskripsi','category')
        ->search($request)
        ->categori($request)
        ->orderBy('judul_buku','ASC')
        ->paginate(10);
        return new BookCollection($books);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->keyword) {
            $book = Book::where('judul_buku','REGEXP',"^$request->keyword")
            ->orWhere('penerbit','REGEXP',"^$request->keyword%")
            ->orWhere('kode_buku','REGEXP',"^$request->keyword%")
            ->orderBy('judul_buku','ASC')
            ->get();
        } else {
            $book=[];
        }

        return new BookCollection($book);

    }

    public function category(){
        $kategori = MasterDataDetail::where('id_master_data',13)->get();
        return $kategori;
    }

    public function changeStatus($id){
        return BookService::changeStatus($id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function validasi($request,$id = null) {
        $segment = \Request::segment(3) == 'create' ? 'required|mimes:pdf' : ($request->file('file') ? 'mimes:pdf' : '' );
        $page = $request->file('file') ? 'required' : '';
        $id_book = $id ? ",$id" : "";
        $validator = \Validator::make($request->all(),[
            'penerbit' => 'required',
            'judul' => 'required',
            'kode' => 'required|regex:/^[a-zA-Z0-9]+$/|unique:books,kode_buku' . $id_book,
            'file' => "$segment",
            'pages' => "$page",
            'deskripsi' => [function($attribute,$value,$field) {
                $value = json_decode($value);
                foreach ($value as $item) {
                    if ($item->title == '') {
                        return $field($attribute . ' Title tidak boleh ada yang kosong');
                        break;
                    } else if($item->deskripsi == '') {
                        return $field($attribute . ' Deskripsi tidak boleh ada yang kosong');
                        break;
                    }
                }
            }]
        ],
        [
            'pages.required' => 'Harus menggunakan mozilla atau chrome',
            'kode.regex' => 'Kode hanya boleh angka dan huruf'
        ]);
        return $validator;
    }
    public function store(Request $request)
    {
        $validator = $this->validasi($request);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ],400);
        }
        return BookService::store($request);
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
        $book = Book::with('deskripsi')->findOrFail($id);
        return response()->json([
            'book' => new BookBook($book)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = $this->validasi($request,$id);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ],400);
        }
        return BookService::update($request,$id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return BookService::delete($id);
    }
}
