<?php

namespace App\Http\Controllers\API\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Image;

use App\Portofolio;
use App\FotoPortofolio;

class PortofolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $portofolio = Portofolio::orderBy('id', 'asc')->get();

        return response()->json($portofolio);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
          'cover' => 'required',
          'judul' => 'required',
          'id_layanan' => 'required',
          'isi' => 'required',
          'link' => 'sometimes',
        ]);

        DB::beginTransaction();
        try {
          $name = time().'.' . explode('/', explode(':', substr($request->cover, 0, strpos($request->cover, ';')))[1])[1];
          Image::make($request->cover)->resize(1044, 524)->save(public_path('img/portofolio/').$name);

          $portofolio = Portofolio::create([
            'cover' => '/img/portofolio/' . $name,
            'judul' => $request->judul,
            'id_layanan' => $request->id_layanan,
            'isi' => $request->isi,
            'slug' => str_slug($request->judul),
            'link' => $request->link,
          ]);

        } catch (\Exception $e) {
          DB::rollback();
          throw $e;
        }

        DB::commit();

        return response()->json([
          'msg' => 'Berhasil'
        ]);

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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $porto = Portofolio::findOrFail($id);

        $oldPath = public_path($porto->cover);
        try {
          unlink($oldPath);
          $porto->delete();
        } catch (\Exception $e) {
          DB::rollback();
          throw $e;
        }

        DB::commit();

        return response()->json([
          'msg' => 'Berhasil dihapus',
        ]);

    }
}
