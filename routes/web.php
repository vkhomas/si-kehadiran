<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Users;
use App\Kehadiran;
use App\Publikasi;
use App\Mahasiswa;
use App\Jurusan;
use App\Dosen;
use Intervention\Image\ImageServiceProvider;

Route::get('/biodata-dosen', 'UsersController@show_dos')->middleware('auth');

Route::get('/daftar-mahasiswa', 'UsersController@list_mhs')->middleware('auth');

Route::get('/biodata-mahasiswa', 'UsersController@show_mhs')->middleware('auth');

Route::get('/biodata-mahasiswa/{nim}', 'UsersController@show_mhs_lain')->middleware('auth');

Route::get('/daftar-alumni', 'UsersController@list_alumni')->middleware('auth');

Route::get('/biodata-alumni/{nim}', 'UsersController@show_alumni')->middleware('auth');

Route::get('/status-kehadiran', 'UsersController@status_mhs')->middleware('auth');

Route::get('/daftar-unapproved', 'UsersController@list_unapproved')->middleware('auth');

Route::get('/edit-mahasiswa', 'UsersController@edit_mhs')->middleware('auth');

Route::post('/edit-mahasiswa', function(){
    $rules = array(
            'foto'              => 'required|file',
            'judul_riset'       => 'required|string',
            'waktu_residensi'   => 'required|integer',
            'publikasi'         => 'required|string'
            );

    $validator = Validator::make(Request::all(), $rules);

    if ($validator->fails()){
        $messages = $validator->messages();
        return redirect('/edit-mahasiswa')->withErrors($validator);
    } else{
        $user = \Auth::user();

        $photoname = request("nim");
        // dd($photoname);
        $file_extension = '.'.Request::file('foto')->getClientOriginalExtension();
        $photo = $photoname.$file_extension;
        $image = Request::file('foto');
        Storage::disk('photo')->putFileAs("", Request::file('foto'), $photo);
        $image_path = asset('storage/photo/'.$photo);
        $user->foto = $image_path;
        $user->approved         = false;
        $user->save();

        $mahasiswa                  = Mahasiswa::where('users_id',$user->id)->first();
        $mahasiswa->judul_riset     = request('judul_riset');
        $mahasiswa->waktu_residensi = request('waktu_residensi');
        $mahasiswa->save();

        $publikasi              = Publikasi::where('users_id',$user->id);
        $publikasi->delete();
        $publikasi              = request("publikasi");
        $split                  = explode(",", $publikasi);

        foreach ($split as $key) {
            $publikasi              = new Publikasi;
            $publikasi->users_id    = $user->id;
            $publikasi->publikasi   = $key;
            $publikasi->save();
        }

        return redirect('/biodata-mahasiswa');
    }
});

Route::get('/edit-dosen', 'UsersController@edit_dos')->middleware('auth');

Route::post('/edit-dosen',function(){
    $rules = array(
            'foto'              => 'required|file',
            'publikasi'         => 'required|string'
            );

    $validator = Validator::make(Request::all(), $rules);

    if ($validator->fails()){
        $messages = $validator->messages();
        return redirect('/edit-dosen')->withErrors($validator);
    } else{
        $user = \Auth::user();

        $photoname = request("nip");
        $file_extension = '.'.Request::file('foto')->getClientOriginalExtension();
        $photo = $photoname.$file_extension;
        $image = Request::file('foto');
        Storage::disk('photo')->putFileAs("", Request::file('foto'), $photo);
        $image_path = asset('storage/photo/'.$photo);
        $user->foto = $image_path;
        $user->save();

        $publikasi              = Publikasi::where('users_id',$user->id);
        $publikasi->delete();
        $publikasi              = request("publikasi");
        $split                  = explode(",", $publikasi);

        foreach ($split as $key) {
            $publikasi              = new Publikasi;
            $publikasi->users_id    = $user->id;
            $publikasi->publikasi   = $key;
            $publikasi->save();
        }

        return redirect('/biodata-dosen');
    }
});


Route::get('/registrasi', 'UsersController@registrasi_mhs');

Route::get('/registrasi-dosen', 'UsersController@registrasi_dosen');

Route::post('/registrasi', function(){
    $rules = array(
        'email'             => 'required|string|unique:users',
        'password'          => 'required|string',
        'name1'             => 'required|string',
        'name2'             => 'required|string',
        'nim'               => 'required|integer|unique:mahasiswa',
        'foto'              => 'required|file',
        'kk'                => 'required|string',
        'dosbing'           => 'required|string',
        'judul_riset'       => 'required|string',
        'waktu_residensi'   => 'required|integer',
        'publikasi'         => 'required|string'
        );

    $validator = Validator::make(Request::all(), $rules);

    if ($validator->fails()){
        $messages = $validator->messages();
        return redirect('/registrasi')->withErrors($validator);
    } 
    else {
        $user = new Users;
        $user->name1 = request("name1");
        $user->name2 = request("name2");
        $user->email = request("email");
        $user->password = bcrypt(request("password"));

        $photoname = request("nim");
        $file_extension = '.'.Request::file('foto')->getClientOriginalExtension();
        $photo = $photoname.$file_extension;
        $image = Request::file('foto');
        Storage::disk('photo')->putFileAs("", Request::file('foto'), $photo);
        $image_path = asset('/storage/photo/'.$photo);
        $user->foto = $image_path;

        $user->kk = request("kk");
        $split = explode(" - ", $user->kk);
        $user->kk = $split[2];
        $user->role = "mahasiswa";
        $user->jurusan = $split[1];
        $user->save();

        $mhs = new Mahasiswa;
        $mhs->users_id = $user->id;
        $mhs->nim = request("nim");
        $user->dosbing = request("dosbing");
        $split = explode(" - ", $user->dosbing);
        $mhs->dosbing = $split[1];
        $mhs->judul_riset = request("judul_riset");
        $mhs->waktu_residensi = request("waktu_residensi");
        $mhs->save();

        $user_publ = new Publikasi;
        $user_publ->users_id = $user->id;
        $user_publ->publikasi = request("publikasi");
        $split = explode(",", $user_publ->publikasi);
        foreach ($split as $key) {
            $user_publ = new Publikasi;
            $user_publ->users_id = $user->id;
            $user_publ->publikasi = $key;
            $user_publ->save();
        }

        $user_hadir = new Kehadiran;
        $user_hadir->users_id = $user->id;
        $user_hadir->save();

        return redirect('/biodata-mahasiswa');
    }
});

Route::post('/registrasi-dosen', function(){
    $rules = array(
            'email'             => 'required|string|unique:users',
            'password'          => 'required|string',
            'name1'             => 'required|string',
            'name2'             => 'required|string',
            'nip'               => 'required|integer|unique:dosen',
            'foto'              => 'required|file',
            'kk'                => 'required|string',
            'publikasi'         => 'required|string'
            );

    $validator = Validator::make(Request::all(), $rules);

    if ($validator->fails()){
        $messages = $validator->messages();
        return redirect('/registrasi-dosen')->withErrors($validator);
    } else{
        $user = new Users;
        $user->name1 = request("name1");
        $user->name2 = request("name2");
        $user->email = request("email");
        $user->password = bcrypt(request("password"));

        $photoname = request("nip");
        $file_extension = '.'.Request::file('foto')->getClientOriginalExtension();
        $photo = $photoname.$file_extension;
        $image = Request::file('foto');
        Storage::disk('photo')->putFileAs("", Request::file('foto'), $photo);
        $image_path = asset('storage/photo/'.$photo);
        $user->foto = $image_path;

        $user->kk = request("kk");
        $split = explode(" - ", $user->kk);
        $user->kk = $split[2];
        $user->role = "dosen";
        $user->jurusan = Jurusan::where('jurusan_id',$split[0])->first();
        $user->jurusan = $user->jurusan->nama_jurusan;
        $user->save();

        $dos = new Dosen;
        $dos->users_id = $user->id;
        $dos->nip = request("nip");
        $dos->save();

        $user_publ = new Publikasi;
        $user_publ->users_id = $user->id;
        $user_publ->publikasi = request("publikasi");
        $split = explode(",", $user_publ->publikasi);
        foreach ($split as $key) {
            $user_publ = new Publikasi;
            $user_publ->users_id = $user->id;
            $user_publ->publikasi = $key;
            $user_publ->save();
        }

        $user_hadir = new Kehadiran;
        $user_hadir->users_id = $user->id;
        $user_hadir->save();

        return redirect('/biodata-dosen/');
    }
});

Route::post('/biodata-mahasiswa/{nim}', 'UsersController@makeApprove')->middleware('auth');

Route::post('/daftar-alumni/{nim}', 'UsersController@makeAlumni')->middleware('auth');

Route::post('/delete-mahasiswa/{nim}', 'UsersController@deleteMahasiswa')->middleware('auth');

Route::post('/delete-alumni/{nim}', 'UsersController@deleteAlumni')->middleware('auth');

Route::post('/request-bimbingan/{nim}', 'UsersController@requestBimbingan')->middleware('auth');

Route::post('/end-bimbingan/{nim}', 'UsersController@endBimbingan')->middleware('auth');

Route::post('/cancel-bimbingan/{nim}', 'UsersController@cancelBimbingan')->middleware('auth');

Route::get('/daftar-request-bimbingan', 'UsersController@list_request_bimbingan')->middleware('auth');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/','UsersController@main_page')->middleware('auth');

Route::get('/daftar-unapproved-dosen', 'UsersController@list_unapproved_dosen')->middleware('auth');

Route::get('/biodata-dosen/{nip}', 'UsersController@show_dos_lain')->middleware('auth');

Route::post('/biodata-dosen/{nip}', 'UsersController@makeApproveDosen')->middleware('auth');

Route::post('/delete-dosen/{nip}', 'UsersController@deleteDosen')->middleware('auth');

Route::get('/daftar-dosen', 'UsersController@list_dosen')->middleware('auth');

Route::get('/daftar-jurusan-kk', 'UsersController@list_jurusan_kk')->middleware('auth');

Route::get('/tambah-jurusan-kk', 'UsersController@add_jurusan_kk')->middleware('auth');

Route::post('/tambah_jurusan_kk', 'UsersController@submit_jurusan_kk')->middleware('auth');

Route::post('/hapus-jurusan-kk/{jurusan_id}', 'UsersController@del_jurusan_kk')->middleware('auth');

Route::get('/edit-jurusan-kk/{jurusan_id}', 'UsersController@edit_jurusan_kk')->middleware('auth');

Route::post('/edit-jurusan-kk/{jurusan_id}', 'UsersController@submit_edit_jurusan_kk')->middleware('auth');

Route::post('/export-data/{nim}', 'UsersController@export_data')->middleware('auth');

// Route::get('/calendar', 'UsersController@showcalendar');