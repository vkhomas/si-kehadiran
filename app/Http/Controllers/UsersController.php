<?php

namespace App\Http\Controllers;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Illuminate\Http\Request;
use App\Users;
use App\Publikasi;
use App\Kehadiran;
use App\Jurusan;
use App\KKeahlian;
use App\Dosen;
use App\Mahasiswa;
use App\Bimbingan;
use Carbon\Carbon;
use Excel;
// require('SimpleCalendar.php');

class UsersController extends Controller
{
	public function main_page(){
		if (\Auth::user()->role == "dosen")
			return redirect('/biodata-dosen');
		else
			return redirect('/biodata-mahasiswa');
	}

	public function list_mhs (){
		$this->getAbsen();
		$user 			= \Auth::user();
		$userS3 		= Mahasiswa::with('user','hadir')->where('nim','like','3%')->where('alumni',0)->where('dosbing',$user->name1)->get();
		$userS2 		= Mahasiswa::with('user','hadir')->where('nim','like','2%')->where('alumni',0)->where('dosbing',$user->name1)->get();
		$userS1 		= Mahasiswa::with('user','hadir')->where('nim','like','1%')->where('alumni',0)->where('dosbing',$user->name1)->get();
		foreach ($userS3 as $S3) {
			$kehadiran_mhs = Kehadiran::with('mhs')->where('users_id',$S3->users_id)->get();
			$durasi = 0;
			foreach ($kehadiran_mhs as $mhs_hadir) {
				$waktu_residensi = $S3->waktu_residensi*3600;
				$expected_duration = Carbon::parse($kehadiran_mhs->first()->created_at);
				$in = Carbon::parse($mhs_hadir->in_time);
				$out = Carbon::parse($mhs_hadir->out_time);
				if ((!$in->isWeekend()) and (!$out->isWeekend())){
					$now = Carbon::now('Asia/Jakarta');
					if ($mhs_hadir->out_time != null){
						if ($out->diffInSeconds($in) >= $waktu_residensi){
							$durasi = $durasi+$waktu_residensi;
						}
						else {
							$durasi = $durasi+$out->diffInSeconds($in);	
						}
					}
				}
			}
	        $daysForExtraCoding = $expected_duration->diffInDaysFiltered(function(Carbon $date){
	            return $date->isWeekday();
			}, Carbon::now('Asia/Jakarta'));

			$S3->rating_kehadiran = ($durasi/($daysForExtraCoding*$waktu_residensi))*100;
			if ($S3->rating_kehadiran >= 100){
				$S3->rating_kehadiran = 100.00;
			}
			$S3->save();
		}
		foreach ($userS2 as $S2) {
			$kehadiran_mhs = Kehadiran::with('mhs')->where('users_id',$S2->users_id)->get();
			$durasi = 0;
			foreach ($kehadiran_mhs as $mhs_hadir) {
				$waktu_residensi = $S2->waktu_residensi*3600;
				$expected_duration = Carbon::parse($kehadiran_mhs->first()->created_at);
				$in = Carbon::parse($mhs_hadir->in_time);
				$out = Carbon::parse($mhs_hadir->out_time);
				if ((!$in->isWeekend()) and (!$out->isWeekend())){
					$now = Carbon::now('Asia/Jakarta');
					if ($mhs_hadir->out_time != null){
						if ($out->diffInSeconds($in) >= $waktu_residensi){
							$durasi = $durasi+$waktu_residensi;
						}
						else {
							$durasi = $durasi+$out->diffInSeconds($in);	
						}
					}
				}
			}
	        $daysForExtraCoding = $expected_duration->diffInDaysFiltered(function(Carbon $date){
	            return $date->isWeekday();
			}, Carbon::now('Asia/Jakarta'));

			$S2->rating_kehadiran = ($durasi/($daysForExtraCoding*$waktu_residensi))*100;
			if ($S2->rating_kehadiran >= 100){
				$S2->rating_kehadiran = 100.00;
			}
			$S2->save();
		}
		foreach ($userS1 as $S1) {
			$kehadiran_mhs = Kehadiran::with('mhs')->where('users_id',$S1->users_id)->get();
			$durasi = 0;
			// dd($kehadiran_mhs);
			foreach ($kehadiran_mhs as $mhs_hadir) {
				$waktu_residensi = $S1->waktu_residensi*3600;
				$expected_duration = Carbon::parse($kehadiran_mhs->first()->created_at);
				$in = Carbon::parse($mhs_hadir->in_time);
				$out = Carbon::parse($mhs_hadir->out_time);
				if ((!$in->isWeekend()) and (!$out->isWeekend())){
					$now = Carbon::now('Asia/Jakarta');
					if ($mhs_hadir->out_time != null){
						if ($out->diffInSeconds($in) >= $waktu_residensi){
							$durasi = $durasi+$waktu_residensi;
						}
						else {
							$durasi = $durasi+$out->diffInSeconds($in);	
						}
					}
				}
			}
	        $daysForExtraCoding = $expected_duration->diffInDaysFiltered(function(Carbon $date){
	            return $date->isWeekday();
			}, Carbon::now('Asia/Jakarta'));

			$S1->rating_kehadiran = ($durasi/($daysForExtraCoding*$waktu_residensi))*100;
			if ($S1->rating_kehadiran >= 100){
				$S1->rating_kehadiran = 100.00;
			}
			$S1->save();
		}

		$user_tambahan 	= Mahasiswa::where('users_id',$user->id)->first();	
		$kehadiran 		= Kehadiran::where('users_id',$user->id)->orderByDesc('id')->first();
		$sisa = $this->checkRemaining();
		$this->checkDuration();

		return view('/daftar-mahasiswa',compact('userS3','userS2','userS1','kehadiran','user','user_tambahan','sisa'));
	}

	public function show_mhs (){
		$this->getAbsen();
		$user 			= \Auth::user();
		$user_tambahan 	= Mahasiswa::where('users_id',$user->id)->first();
		$kehadiran 		= Kehadiran::where('users_id',$user->id)->orderByDesc('id')->first();
		$publikasi 		= Publikasi::where('users_id',$user->id)->get();
		$bimbingan 		= Bimbingan::where('users_id',$user->id)->get();
		$sisa = $this->checkRemaining();
		$this->checkDuration();

		return view('/biodata-mahasiswa',compact('kehadiran','user','user_tambahan','publikasi','bimbingan','sisa'));
	}

	public function list_dosen(){
		$user = \Auth::user();
		$kehadiran = Kehadiran::where('users_id',$user->id)->orderByDesc('id')->first();
		$userDosen = Users::with('dos')->where('role','dosen')->get();
		$sisa = $this->checkRemaining();
		$this->checkDuration();

		return view('/daftar-dosen', compact('user','userDosen','kehadiran','sisa'));
	}

	public function show_dos (){
		$this->getAbsen();
		$user 			= \Auth::user();
		$user_tambahan 	= Dosen::where('users_id',$user->id)->first();
		$kehadiran 		= Kehadiran::where('users_id',$user->id)->orderByDesc('id')->first();
		$publikasi 		= Publikasi::where('users_id',$user->id)->get();

		return view('/biodata-dosen',compact('kehadiran','user','user_tambahan','publikasi'));
	}

	public function show_mhs_lain ($nim){
		$this->getAbsen();
		$user_lain 		= Mahasiswa::where('nim',$nim)->first();
		$user 			= Users::where('id',$user_lain->users_id)->first();
		$user_tambahan 	= Mahasiswa::where('users_id',$user->id)->first();
	    $publikasi 		= Publikasi::where('users_id',$user->id)->get();
	    $self 			= \Auth::user();
	    $kehadiran 		= Kehadiran::where('users_id',$self->id)->orderByDesc('id')->first();
	    $bimbingan 		= Bimbingan::where('users_id',$user->id)->get();
	    $sisa = $this->checkRemaining();
		$this->checkDuration();
	    
	    return view('/biodata-mahasiswa', compact('user_tambahan','publikasi','kehadiran','user','bimbingan','sisa'));
	}

	public function show_alumni ($nim){
		$this->getAbsen();
		$user_lain 		= Mahasiswa::where('nim',$nim)->first();
		$user 			= Users::where('id',$user_lain->users_id)->first();
		$user_tambahan 	= Mahasiswa::where('users_id',$user->id)->first();
	    $publikasi 		= Publikasi::where('users_id',$user->id)->get();
	    $self 			= \Auth::user();
	    $kehadiran 		= Kehadiran::where('users_id',$self->id)->orderByDesc('id')->first();
	    $sisa = $this->checkRemaining();
		$this->checkDuration();
	    
	    return view('/biodata-alumni', compact('user_tambahan','publikasi','kehadiran','user','sisa'));
	}

	public function list_alumni (){
		$this->getAbsen();
		$user 			= \Auth::user();
		$userS3 		= Mahasiswa::with('user','hadir')->where('nim','like','3%')->where('alumni',1)->where('dosbing',$user->name1)->get();
		$userS2 		= Mahasiswa::with('user','hadir')->where('nim','like','2%')->where('alumni',1)->where('dosbing',$user->name1)->get();
		$userS1 		= Mahasiswa::with('user','hadir')->where('nim','like','1%')->where('alumni',1)->where('dosbing',$user->name1)->get();
		$user_tambahan 	= Mahasiswa::where('users_id',$user->id)->first();	
		$kehadiran 		= Kehadiran::where('users_id',$user->id)->orderByDesc('id')->first();
		$sisa = $this->checkRemaining();
		$this->checkDuration();

		return view('/daftar-alumni',compact('userS3','userS2','userS1','kehadiran','user','user_tambahan','sisa'));
	}

	public function status_mhs (){
		$this->getAbsen();
		$user 			= \Auth::user();
		$kehadiran 		= Kehadiran::where('users_id',$user->id)->orderByDesc('id')->first();
		$userMhs 		= Kehadiran::distinct()->with('user','mhs')->where('in_time','!=',null)->where('out_time',null)->get();
		$sisa = $this->checkRemaining();
		$this->checkDuration();

		return view('/status-kehadiran', compact('kehadiran','user','userMhs','sisa'));
	}

	public function list_unapproved (){
		$this->getAbsen();
		$user 			= \Auth::user();
		$user_tambahan = Mahasiswa::with('user')->where('dosbing',$user->name1)->get();
		$userMhs 		= Users::with('mhs')->where('approved',false)->where('role','mahasiswa')->get();
		$kehadiran 		= Kehadiran::where('users_id',$user->id)->orderByDesc('id')->first();
		$sisa = $this->checkRemaining();
		$this->checkDuration();

		return view('/daftar-unapproved',compact('userMhs','kehadiran','user','user_tambahan','sisa'));
	}

	public function registrasi_mhs(){
		$this->getAbsen();
		$jurusan 	= Jurusan::all();
		$kk 		= Kkeahlian::with('jurusan')->get();
		$dosen 		= Dosen::all();
		$userDosen = Users::with('dos')->where('role','dosen')->get();

		return view('registrasi',compact('jurusan','kk','userDosen'));
	}

	public function registrasi_dosen(){
		$this->getAbsen();
		$jurusan 	= Jurusan::all();
		$kk 		= Kkeahlian::all();

		return view('registrasi-dosen',compact('jurusan','kk'));
	}

	public function edit_mhs (){
		$this->getAbsen();
		$user = \Auth::user();
		$user_tambahan = Mahasiswa::where('users_id',$user->id)->first();
		$kehadiran = Kehadiran::where('users_id',$user->id)->orderByDesc('id')->first();
		$publikasi = Publikasi::where('users_id',$user->id)->get();
		$sisa = $this->checkRemaining();
		$this->checkDuration();

		return view('/edit-mahasiswa',compact('kehadiran','user','user_tambahan','publikasi','sisa'));
	}

	public function edit_dos (){
		$this->getAbsen();
		$user = \Auth::user();
		$user_tambahan = Dosen::where('users_id',$user->id)->first();
		$kehadiran = Kehadiran::where('users_id',$user->id)->orderByDesc('id')->first();
		$publikasi = Publikasi::where('users_id',$user->id)->get();
		$sisa = $this->checkRemaining();
		$this->checkDuration();

		return view('/edit-dosen',compact('kehadiran','user','user_tambahan','publikasi','sisa'));
	}

	public function makeApprove($nim){
		$this->getAbsen();
		$user_lain 		= Mahasiswa::where('nim',$nim)->first();
		$user 			= Users::where('id',$user_lain->users_id)->first();
		$user->approved = true;
		$user->save();

		return redirect ('/biodata-mahasiswa/'.$nim);
	}

	public function makeApproveDosen($nip){
		$this->getAbsen();
		$user_lain 		= Dosen::where('nip',$nip)->first();
		$user 			= Users::where('id',$user_lain->users_id)->first();
		$user->approved = true;
		$user->save();

		return redirect ('/biodata-dosen/'.$nip);
	}

	public function makeAlumni($nim){
		$this->getAbsen();
		$mahasiswa = Mahasiswa::where('nim',$nim)->first();
		$mahasiswa->alumni = true;
		$mahasiswa->save();

		return redirect ('/daftar-alumni');
	}

	public function deleteMahasiswa($nim){
		$this->getAbsen();
		$user = Mahasiswa::where('nim',$nim)->first();
		Publikasi::where('users_id',$user->users_id)->delete();
		Users::where('id',$user->users_id)->delete();
		Kehadiran::where('id',$user->users_id)->delete();
		Bimbingan::where('id',$user->users_id)->delete();
		Mahasiswa::where('nim',$nim)->delete();
		return redirect('/daftar-mahasiswa');
	}

	public function deleteDosen($nip){
		$this->getAbsen();
		$user = Dosen::where('nip',$nip)->first();
		Publikasi::where('users_id',$user->users_id)->delete();
		Users::where('id',$user->users_id)->delete();
		Kehadiran::where('id',$user->users_id)->delete();
		$user->delete();
		return redirect('/daftar-unapproved-dosen');
	}

	public function deleteAlumni($nim){
		$this->getAbsen();
		$user = Mahasiswa::where('nim',$nim)->with('user','hadir')->delete();
		return redirect('/daftar-alumni');
	}

	public function list_request_bimbingan(){
		$this->getAbsen();
		$user = \Auth::user();
		$userMhs = Mahasiswa::with('user')->where('bimbingan',true)->where('dosbing',$user->name1)->get();
		$kehadiran = Kehadiran::where('users_id',$user->id)->orderByDesc('id')->first();
		$bimbingan = Users::with('mhs','bimbingan')->where('role','mahasiswa')->get();

		$list_bimb = array();
		foreach ($bimbingan as $key) {
			if (($key->mhs->bimbingan == true) and ($key->mhs->dosbing == $user->name1))
				array_push($list_bimb, $key->bimbingan->last()->judul_bimbingan);
		}
		$sisa = $this->checkRemaining();
		$this->checkDuration();

		return view('/daftar-request-bimbingan', compact('userMhs','user','kehadiran','bimbingan','list_bimb','sisa'));
	}

	public function requestBimbingan($nim){
		$this->getAbsen();
		$user = Mahasiswa::where('nim',$nim)->first();
		$user->bimbingan = true;
		$user->save();

		$bimbingan = new Bimbingan;
		$bimbingan->users_id = $user->users_id;
		$bimbingan->judul_bimbingan = request("judul_bimbingan");
		$bimbingan->save();

		return redirect('/biodata-mahasiswa');
	}

	public function endBimbingan($nim){
		$this->getAbsen();
		$user = Mahasiswa::where('nim',$nim)->first();
		$user->bimbingan = false;
		$user->save();

		$bimbingan = Bimbingan::where('users_id',$user->users_id)->orderByDesc('id')->first();
		$bimbingan->waktu_bimbingan = Carbon::now('Asia/Jakarta');
		$bimbingan->save();

		return redirect('/daftar-request-bimbingan');
	}

	public function cancelBimbingan($nim){
		$this->getAbsen();
		$user = Mahasiswa::where('nim',$nim)->first();
		$user->bimbingan = false;
		$user->save();

		return redirect('/daftar-request-bimbingan');
	}

	public function list_unapproved_dosen(){
		$user 			= \Auth::user();
		$userDosen 		= Users::with('dos')->where('approved',false)->where('role','dosen')->get();
		$kehadiran 		= Kehadiran::where('users_id',$user->id)->orderByDesc('id')->first();
		$sisa = $this->checkRemaining();
		$this->checkDuration();

		return view('/daftar-unapproved-dosen',compact('kehadiran','user','userDosen','sisa'));
	}

	public function show_dos_lain ($nip){
		$user_lain		= Dosen::where('nip',$nip)->first();
		$user 			= Users::where('id',$user_lain->users_id)->first();
		$user_tambahan 	= Dosen::where('users_id',$user->id)->first();
		$self 			= \Auth::user();
		$kehadiran 		= Kehadiran::where('users_id',$user->id)->orderByDesc('id')->first();
		$publikasi 		= Publikasi::where('users_id',$user->id)->get();
		$sisa = $this->checkRemaining();
		$this->checkDuration();

		return view('/biodata-dosen',compact('user','user_tambahan','user_lain','publikasi','self','kehadiran','sisa'));
	}

	public function list_jurusan_kk(){
		$jurusan = Jurusan::all();
		$keahlian = KKeahlian::all();
		$user = \Auth::user();
		$kehadiran 		= Kehadiran::where('users_id',$user->id)->orderByDesc('id')->first();
		$sisa = $this->checkRemaining();
		$this->checkDuration();

		return view('/daftar-jurusan-kk', compact('jurusan','keahlian','user','kehadiran','sisa'));
	}

	public function add_jurusan_kk(){
		$user = \Auth::user();
		$kehadiran = Kehadiran::where('users_id',$user->id)->orderByDesc('id')->first();
		$sisa = $this->checkRemaining();
		$this->checkDuration();

		return view('/tambah-jurusan-kk', compact('user','kehadiran','sisa'));
	}

	public function submit_jurusan_kk(){
		$j = new Jurusan;
		$j->jurusan_id = request('jurusan_id');
		$j->nama_jurusan = request('nama_jurusan');
		$j->save();

		$j = request('nama_keahlian');
		$split = explode(';', $j);
		for($a=0;$a<=count($split)-1;$a++) {
			$k = new KKeahlian;
			$k->jurusan_id = request('jurusan_id');
			$k->nama_keahlian = $split[$a];
			$k->save();	
		}

		return redirect('/daftar-jurusan-kk');
	}

	public function edit_jurusan_kk($jurusan_id){
		$jurusan = Jurusan::where('jurusan_id',$jurusan_id)->first();
		$keahlian = KKeahlian::where('jurusan_id',$jurusan_id)->get();
		$user = \Auth::user();
		$kehadiran = Kehadiran::where('users_id',$user->id)->orderByDesc('id')->first();
		$sisa = $this->checkRemaining();
		$this->checkDuration();

		return view('/edit-jurusan-kk', compact('jurusan','kehadiran','user','keahlian','sisa'));
	}

	public function submit_edit_jurusan_kk($jurusan_id){
		$j = Jurusan::where('jurusan_id',$jurusan_id)->first();
		$j->nama_jurusan = request('nama_jurusan');
		$j->save();

		$j = request('nama_keahlian');
		$k = KKeahlian::where('jurusan_id',$jurusan_id);
		$k->delete();

		$split = explode(';', $j);
		for($a=0;$a<=count($split)-1;$a++) {
			$k = new KKeahlian;
			$k->jurusan_id = $jurusan_id;
			$k->nama_keahlian = $split[$a];
			$k->save();	
		}

		return redirect('/daftar-jurusan-kk');
	}


	public function del_jurusan_kk($jurusan_id){
		$jurusan = Jurusan::where('jurusan_id',$jurusan_id)->delete();
		$keahlian = KKeahlian::where('jurusan_id',$jurusan_id)->delete();

		return redirect('/daftar-jurusan-kk');
	}

	public function export_data($nim){
		$mahasiswa = Mahasiswa::where('nim',$nim)->first();
		$user = Users::where('id',$mahasiswa->users_id)->first();
		$kehadiran = Kehadiran::where('users_id',$user->id)->whereMonth('created_at',request('month'))->whereYear('created_at',request('year'))->select('id','in_time','out_time')->get();
		$csv = [];
		$csv[] = ['id','in_time','out_time','durasi'];
		foreach ($kehadiran as $k) {
			$csv[] = $k->toArray();
		}
		Excel::create($nim.'/'.request('month').'/'.request('year'),function($excel) use ($csv){
			$excel->setTitle('Kehadiran');
			$excel->setCreator('Laravel');
			$excel->setDescription('Data Kehadiran');
			$excel->sheet('sheet1', function($sheet) use ($csv){
				$sheet->fromArray($csv,null,'A1',false,false);
			});
		})->download('xlsx');

		return redirect ('/biodata-mahasiswa');
	}

	public function getAbsen()
    {
  //   	$proxy = "cache.itb.ac.id";
  //   	$port = "8080";
  //   	$fp = fsockopen($proxy,$port);
  //   	$Connect = fputs($fp,"CONNECT 10.8.40.15:80 HTTP/1.1");
  // //   	if ($Connect){
  // //   		dd('tes');
  // //   	}

		$IP = "10.8.40.20";
		// // $IP = "";
	    $Key = "0";
	    if($IP!=""){
	    	$Connect = @fsockopen($IP, "80", $errno, $errstr, 1);
	        if($Connect){
	            $soap_request="<GetAttLog><ArgComKey xsi:type=\"xsd:integer\">".$Key."</ArgComKey><Arg><PIN xsi:type=\"xsd:integer\">All</PIN></Arg></GetAttLog>";
	            $newLine="\r\n";
	            fputs($Connect, "POST /iWsService HTTP/1.0".$newLine);
	            fputs($Connect, "Content-Type: text/xml".$newLine);
	            fputs($Connect, "Content-Length: ".strlen($soap_request).$newLine.$newLine);
	            fputs($Connect, $soap_request.$newLine);
	            $buffer="";
	            while($Response=fgets($Connect, 1024)){
	                $buffer=$buffer.$Response;
	            }
	            $buffer = $this->Parse_Data($buffer,"<GetAttLogResponse>","</GetAttLogResponse>");
	            $buffer = explode("\r\n",$buffer);
	            for($a=1;$a<count($buffer)-1;$a++){
	                $data = $this->Parse_Data($buffer[$a],"<Row>","</Row>");
	                $PIN = (int)$this->Parse_Data($data,"<PIN>","</PIN>");
	                $DateTime = $this->Parse_Data($data,"<DateTime>","</DateTime>");
	               	$date = new Carbon($DateTime);
	               	$date->format('d/M/Y H:i:s'); 
	                $cek = Kehadiran::where('users_id',$PIN)->orderByDesc('id')->first();
	                if (($cek->out_time == null) && ($cek->in_time != null)){
	                	$cek->out_time = $date;
	                	$cek->save();
	                }
	                else
	                {
		                $biodata = new Kehadiran;
		                $biodata->users_id = $PIN;
	                	$biodata->in_time = $date;
	                	$biodata->save();
	                }
	            }
	           	$this->delAbsen();
	        }
	    }
    }

    private function delAbsen()
    {
		$IP = "10.8.40.20";
	    $Key = "0";
	    if($IP!=""){
	    	$Connect = @fsockopen($IP, "80", $errno, $errstr, 1);
	        if($Connect){
	            $soap_request="<ClearData><ArgComKey xsi:type=\"xsd:integer\">".$Key."</ArgComKey><Arg><Value xsi:type=\"xsd:integer\">3</Value></Arg></ClearData>";
	            $newLine="\r\n";
	            fputs($Connect, "POST /iWsService HTTP/1.0".$newLine);
	            fputs($Connect, "Content-Type: text/xml".$newLine);
	            fputs($Connect, "Content-Length: ".strlen($soap_request).$newLine.$newLine);
	            fputs($Connect, $soap_request.$newLine);
	            $buffer="";
	            while($Response=fgets($Connect, 1024)){
	                $buffer=$buffer.$Response;
	            }
	        }		
	    }
    }	

    private function Parse_Data($data,$p1,$p2)
    {
	    $data=" ".$data;
	    $hasil="";
	    $awal=strpos($data,$p1);
	    if($awal!=""){
	    $akhir=strpos(strstr($data,$p1),$p2);
	        if($akhir!=""){
	        $hasil=substr($data,$awal+strlen($p1),$akhir-strlen($p1));
	        }
	    }
	    return $hasil; 
	}

	private function checkDuration(){
		$threshold = Carbon::now()->setTime(22,0,0);
		if ($threshold < Carbon::now()){
			$kehadiran = Kehadiran::where('out_time',null)->where('in_time','!=',null)->delete();
		}
	}

	private function checkRemaining(){
		$user = \Auth::user();
		if ($user->role == "mahasiswa"){
			$user_tambahan = Mahasiswa::where('users_id',$user->id)->first();
			$kehadiran_sisa = Kehadiran::where('users_id',$user->id)->whereDate('created_at',date('Y-m-d'))->get();
			$waktu_residensi = $user_tambahan->waktu_residensi*3600;
			$durasi = 0;
			foreach ($kehadiran_sisa as $k) {
				$in = Carbon::parse($k->in_time);
				$out = Carbon::parse($k->out_time);
				if ((!$in->isWeekend()) and (!$out->isWeekend())){
					$now = Carbon::now('Asia/Jakarta');
					if ($k->out_time != null){
						if ($out->diffInSeconds($in) >= $waktu_residensi){
							$durasi = $durasi+$waktu_residensi;
						}
						else {
							$durasi = $durasi+$out->diffInSeconds($in);	
						}
					}
					else {
						$durasi = $durasi+Carbon::now()->diffInSeconds($in);
					}
				}
			}
			if ($waktu_residensi-$durasi >= 0){
				$sisa = gmdate('H:i:s',$waktu_residensi-$durasi);
			}
			else{
				$sisa = gmdate('H:i:s',0);
			}
			return $sisa;
		}
	}
}
