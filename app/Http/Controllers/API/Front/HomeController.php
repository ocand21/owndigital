<?php

namespace App\Http\Controllers\API\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\Halaman;
use App\Layanan;
use App\Portofolio;
use App\Tim;
use App\KonfigWeb;

class HomeController extends Controller
{

    public function konfigWeb(){
      $konfig = KonfigWeb::first();

      return response()->json($konfig);
    }

    public function loadKalimatKontak(){
      $kKontak = Halaman::where('judul', 'Kontak Kami')->first();

      return response()->json($kKontak);
    }

    public function loadKataTim(){

        $kTim = Halaman::where('judul', 'Tim Kami')->first();

        return response()->json($kTim);
    }

    public function loadTim(){
      $tim = Tim::orderByRaw("FIELD(posisi, 'CEO, Founder', 'Web Developer', 'Android Developer')ASC")->get();

      return response()->json($tim);
    }

    public function loadProjek(){
      // $projek = Portofolio::get();

      $projek = DB::table('portofolio')
                    ->join('layanan', 'layanan.id', 'portofolio.id_layanan')
                    ->select(DB::raw("portofolio.id, portofolio.cover, portofolio.judul, portofolio.slug, layanan.nama"))
                    ->limit(3)
                    ->get();

      return response()->json($projek);
    }

    public function loadPorto(){
      $porto = Halaman::where('judul', 'Projek Kami')->first();

      return response()->json($porto);
    }

    public function detilLayanan($id){
      $layanan = Layanan::findOrFail($id);

      return response()->json($layanan);
    }

    public function layanan(){
      $layanan = Layanan::get();

      return response()->json($layanan);
    }

    public function about(){
      $about = Halaman::where('judul', 'Tentang Kami')->first();

      return response()->json($about);
    }
}
