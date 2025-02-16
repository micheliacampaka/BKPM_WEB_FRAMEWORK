<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManagementUserController extends Controller{
    public function index(){
        //return "Hallo ini adalah method index, dalam controller ManagementUser.";
        //return "Method ini nantinya akan digunakan untuk mengambil semua data user";
        $nama = "Michelia Campaka";

        $pelajaran = ["Workshop Sistem Informasi Web Framework"];

        return view('home', compact ('nama', 'pelajaran'));
    }
}