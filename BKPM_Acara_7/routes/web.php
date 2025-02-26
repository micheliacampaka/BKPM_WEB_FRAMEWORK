<?php

// --------------------ACARA 3--------------------

// mengimport kelas route dari laravel
use Illuminate\Support\Facades\Route;
// route untuk halaman utama
Route::get('/', function () {
    return view('welcome');//mengambalikan tampilan
});
// route sederhana yang mengembalikan teks
route::get('/foo', function(){
    return 'Hello Word';//tampilan saat diakses
});
//route dengan parameter dinamis (id)
route::get('user/{$id}', function($id){
    return 'user'.$id;//menampilkan user dengan nilai id yang diberikan
});
// Route::get('/user',[UserController::class,'index']);
Route::get('/user','UserController@index');

// berbagai metode http dalam routing laravel
//Route::get($uri, $callback);
//Route::post($uri, $callback);
//Route::put($uri, $callback);
//Route::patch($uri, $callback);
//Route::delete($uri, $callback);
//Route::options($uri, $callback);

// regedit otomatis 
Route::redirect('/coba','/sini');
// route untuk halaman utama ('/')
Route::get('/', function(){
    return view('profile',[ //mengembalikan view dengan data nama dan nim
        'nama' => 'Michelia',
        'nim'=> 'e41231599'
    ]);
});
// route dengan parameter optional
Route::get('user1/{name?}', function ($name = null){
    return $name? "Hallo, $name!" : "Hallo";//menampilkan "hallo" 
});
//route dengan parameter opsional,ada nilai default'Michelia'
Route::get('user2/{name?}', function ($name = 'Michelia'){
    return $name? "Hallo, $name!" : "Hallo Michelia";
});
//route dgn parameter wajib 'name', harus huruf
Route::get('user3/{name}', function($name){
    return "selamat, $name!";
})->where('nama', '[A-Za-z]+');
//route dgn parameter 'id' berupa angka
Route::get('user4/{id}', function ($id){
    return "User ID: $id";
})->where('id', '[0-9]+');
//route dengan parameter 'name' harus huruf kecil, 'id' harus angka
Route::get('user5/{id}/{name}', function ($id, $name){
    return "User ID: $id, Name: $name";
})->where(['id'=>'[0-9]+','name' => '[a-z]+']);
//route dgn parameter 'search' nisa menerima semua jenis karakter
Route::get('search/{search}', function($search){
    return $search;
})->where('search', '.*');//menerima semua yang diinputkan



// --------------------ACARA 4--------------------
use App\Http\Controllers\ProfileController;

Route::get('user6/profile', function(){
    return "ini adalah halaman user6!";
})->name('profile.user6');

Route::get('user7/profile', ['ProfileController@show'])->name('profile');


//$url = route('profile');
//return redirect()->route('profile');

Route::get('/redirect-profile', function(){
    return redirect()->route('profile', ['id'=>1, 'photos'=>'yes']);
});
Route::middleware(['check.user'])->group(function(){
    Route::get('/profileLogin',['UserController::class','profile'])->name('profile');
});
Route::namespace('App\Http\Controller\User')->group(function(){
    Route::get('/user/info','UserController@info')->name('user.info');
});
Route::domain('{account}.example.com')->group(function(){
    Route::get('/', function ($account){
        return "ini halaman akun : ".$account;
    });
});
Route::prefix('pengguna')->group(function(){
    Route::get('/dashboard', function(){
        return "ini adalah halaman dashboard pengguna";
    });
});
Route::name('pre')->prefix('cobalagi')->group(function(){
    Route::get('/dashboard', function(){
        return "ini halaman dashboard prefix name";
    });
});