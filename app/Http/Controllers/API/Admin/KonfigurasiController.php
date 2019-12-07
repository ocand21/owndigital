<?php

namespace App\Http\Controllers\API\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


use App\KonfigWeb;

class KonfigurasiController extends Controller
{

    public function loadKonfig(){
      $konfig = KonfigWeb::first();

      return response()->json($konfig);
    }

    public function postKonfig(Request $request){
      $request->validate([
        'nama_website' => 'required',
        'deskripsi' => 'required',
        'email' => 'required',
        'alamat' => 'required',
        'url_web' => 'sometimes',
        'whatsapp' => 'required',
        'instagram' => 'sometimes',
        'facebook' => 'sometimes',
        'twitter' => 'sometimes',
        'telegram' => 'sometimes',
      ]);

      DB::beginTransaction();
      try {
        $konfig = KonfigWeb::first();

        $konfig->update([
          'nama_website' => $request->nama_website,
          'deskripsi' => $request->deskripsi,
          'email' => $request->email,
          'alamat' => $request->alamat,
          'url_web' => $request->url_web,
          'whatsapp' => $request->whatsapp,
          'instagram' => $request->instagram,
          'facebook' => $request->facebook,
          'twitter' => $request->twitter,
          'telegram' => $request->telegram,
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
}
