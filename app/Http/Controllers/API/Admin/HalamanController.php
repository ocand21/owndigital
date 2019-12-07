<?php

namespace App\Http\Controllers\API\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Image;
use App\Halaman;

class HalamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $halaman = Halaman::get();

        return response()->json($halaman);
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
          'judul' => 'required',
          'foto' => 'sometimes',
          'isi' => 'required|min:10',
        ]);

        DB::beginTransaction();
        try {
          if ($request->foto) {
            $name = time().'.' . explode('/', explode(':', substr($request->foto, 0, strpos($request->foto, ';')))[1])[1];
            Image::make($request->foto)->save(public_path('img/halaman/').$name);

            $halaman = Halaman::create([
              'judul' => $request->judul,
              'foto' => '/img/halaman' . $name,
              'isi' => $request->isi,
              'slug' => str_slug($request->judul),
            ]);
          } else {
            $halaman = Halaman::create([
              'judul' => $request->judul,
              'isi' => $request->isi,
              'slug' => str_slug($request->judul),
            ]);
          }

        } catch (\Exception $e) {
          DB::rollback();
          throw $e;
        }

        DB::commit();

        return response()->json([
          'msg' => 'Berhasil',
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
      $request->validate([
        'judul' => 'required',
        'foto' => 'sometimes',
        'isi' => 'required|min:10',
      ]);

      $halaman = Halaman::findOrFail($id);

      DB::beginTransaction();
      try {

        $halaman->judul = $request->judul;
        $halaman->isi = $request->isi;
        $halaman->slug = str_slug($request->judul);

        if ($request->foto != $halaman->foto) {
          $name = time().'.' . explode('/', explode(':', substr($request->foto, 0, strpos($request->foto, ';')))[1])[1];
          Image::make($request->foto)->save(public_path('img/halaman/').$name);

          $halaman->foto = '/img/halaman/' . $name;
        }

        $halaman->save();

      } catch (\Exception $e) {
        DB::rollback();
        throw $e;
      }

      DB::commit();

      return response()->json([
        'msg' => 'Berhasil',
      ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
