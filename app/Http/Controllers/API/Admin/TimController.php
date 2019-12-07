<?php

namespace App\Http\Controllers\API\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\Tim;
use Image;

class TimController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $tim = Tim::get();

      return response()->json($tim);
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
          'nama' => 'required',
          'foto' => 'required',
          'posisi' => 'required',
          'whatsapp' => 'sometimes',
          'telegram' => 'sometimes',
          'facebook' => 'sometimes',
          'instagram' => 'sometimes',
          'twitter' => 'sometimes',
        ]);

        DB::beginTransaction();
        try {
            $name = time().'.' . explode('/', explode(':', substr($request->foto, 0, strpos($request->foto, ';')))[1])[1];
            Image::make($request->foto)->save(public_path('img/tim/').$name);

            $tim = Tim::create([
              'foto' => '/img/tim/' . $name,
              'nama' => $request->nama,
              'posisi' => $request->posisi,
              'whatsapp' => $request->whatsapp,
              'telegram' => $request->telegram,
              'facebook' => $request->facebook,
              'instagram' => $request->instagram,
              'twitter' => $request->twitter,
            ]);

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
        'nama' => 'required',
        'foto' => 'sometimes',
        'posisi' => 'required',
        'whatsapp' => 'sometimes',
        'telegram' => 'sometimes',
        'facebook' => 'sometimes',
        'instagram' => 'sometimes',
        'twitter' => 'sometimes',
      ]);

      DB::beginTransaction();
      try {
          $tim = Tim::findOrFail($id);

          $tim->nama = $request->nama;
          $tim->posisi = $request->posisi;
          $tim->whatsapp = $request->whatsapp;
          $tim->telegram = $request->telegram;
          $tim->facebook = $request->facebook;
          $tim->instagram = $request->instagram;
          $tim->twitter = $request->twitter;

          if ($request->foto != $tim->foto) {
            $name = time().'.' . explode('/', explode(':', substr($request->foto, 0, strpos($request->foto, ';')))[1])[1];
            Image::make($request->foto)->save(public_path('img/tim/').$name);

            $tim->foto = '/img/tim/' . $name;
          }

          $tim->save();

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
        $tim = Tim::findOrFail($id);

        $oldPath = public_path($tim->foto);

        DB::beginTransaction();
        try {
          unlink($oldPath);
          $tim->delete();
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
