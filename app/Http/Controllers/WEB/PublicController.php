<?php

namespace App\Http\Controllers\WEB;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\KonfigWeb;

class PublicController extends Controller
{
    public function index(){

      $konfig = KonfigWeb::first();

      return view('layouts.public', compact('konfig'));
    }
}
