<?php

namespace App\Http\Controllers\API\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\Layanan;

class LayananController extends Controller
{

    public function destroy(Request $request, $id){
      $layanan = Layanan::findOrFail($id);
      DB::beginTransaction();
      try {
        $layanan->delete();
      } catch (\Exception $e) {
        DB::rollback();
        throw $e;
      }

      DB::commit();

      return response()->json([
        'msg' => 'Berhasil dihapus',
      ]);

    }

    public function update(Request $request){
      $request->validate([
        'icon' => 'required',
        'nama' => 'required',
        'deskripsi' => 'required',
      ]);

      DB::beginTransaction();
      try {
        $layanan = Layanan::findOrFail($request->id);
        $layanan->update([
          'icon' => $request->icon,
          'nama' => $request->nama,
          'deskripsi' => $request->deskripsi,
          'slug' => str_slug($request->slug),
        ]);
      } catch (\Exception $e) {
        DB::rollback();
        throw $e;
      }

      DB::commit();

      return response()->json([
        'msg' => 'Berhasil ditambah',
      ]);

    }

    public function store(Request $request){
      $request->validate([
        'icon' => 'required',
        'nama' => 'required',
        'deskripsi' => 'required',
      ]);

      DB::beginTransaction();
      try {
        $layanan = Layanan::create([
          'icon' => $request->icon,
          'nama' => $request->nama,
          'deskripsi' => $request->deskripsi,
          'slug' => str_slug($request->slug),
        ]);
      } catch (\Exception $e) {
        DB::rollback();
        throw $e;
      }

      DB::commit();

      return response()->json([
        'msg' => 'Berhasil ditambah',
      ]);

    }

    public function index(){
      $layanan = Layanan::get();

      return response()->json($layanan);
    }
}
