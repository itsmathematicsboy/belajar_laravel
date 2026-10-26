<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BelajarController extends Controller{
    public function index(){
        $title = "Belajar Laravel asik asik";
        return view('belajar', compact('title'));
    }

    public function actionTambah(Request $request){
        // $request = new Request();
        $title = "Penjumlahan";
        $angka1 = $request->angka1;
        $angka2 = $request->input("angka2");
        $jumlah = $angka1 + $angka2;
        return view('tambah', compact('jumlah', 'title'));
    }

    public function tambah(){
        $title = "Penjumlahan";
        return view("tambah", compact('title'));
    }

    public function kurang(){
        $title = "Pengurangan";
        return view('kurang', compact('title'));
    }

    public function actionKurang(Request $request)
    {
        // $request = new Request();
        $title = "Pengurangan";
        $angka1 = $request->angka1;
        $angka2 = $request->input("angka2");
        $kurang = $angka1 - $angka2;
        return view('kurang', compact('kurang', 'title'));
    }

    public function kali(){
        $title = "Perkalian";
        return view('kali', compact('title'));
    }

    public function actionKali(Request $request)
    {
        // $request = new Request();
        $title = "Perkalian";
        $angka1 = $request->angka1;
        $angka2 = $request->input("angka2");
        $kali = $angka1 * $angka2;
        return view('kali', compact('kali', 'title'));
    }

    public function bagi(){
        $title = "Pembagian";
        return view('bagi', compact('title'));
    }

    public function actionBagi(Request $request)
    {
        // $request = new Request();
        $title = "Pengurangan";
        $angka1 = $request->angka1;
        $angka2 = $request->input("angka2");
        try {
            // Pindahkan proses pembagian ke dalam try block
            $bagi = $angka1 / $angka2;

            return view('bagi', compact('bagi', 'title'));
        } catch (\DivisionByZeroError $e) {
            // Ditangkap jika pembagi bernilai 0 (PHP 8+)
            return "<p>Divisor cannot be zero</p>";
        }
    }
}
