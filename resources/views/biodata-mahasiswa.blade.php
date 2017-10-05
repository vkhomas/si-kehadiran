@extends ('layouts.master')

@section ('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/zabuto_calendar.min.css')}}">
@endsection

@section ('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        <form role="form">
                        @if (\Auth::user()->email == "admin@admin.com")
                            Data Pribadi
                        @else
                            Data Pribadi Mahasiswa
                        @endif
                            {{csrf_field()}}
                            @if ((\Auth::user()->role == "dosen") and (\Auth::user()->approved == true) and (\Auth::user()->name1 == $user_tambahan->dosbing))
                                @if ($user->approved == false)
                                    <button type="submit" formmethod="post" formaction="/biodata-mahasiswa/{{$user_tambahan->nim}}" class="btn btn-default div-button" style="float:right">Approve</button>
                                @endif
                                @if ($user_tambahan->alumni == false)
                                    <button type="submit" formmethod="post" formaction="/daftar-alumni/{{$user_tambahan->nim}}" class="btn btn-default div-button" style="float:right">Pindah ke Alumni</button>
                                @endif
                                <button type="submit" formmethod="post" formaction="/delete-mahasiswa/{{$user_tambahan->nim}}" class="btn btn-default div-button" style="float:right">Hapus Mahasiswa</button>
                            @endif
                        </form>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel-body">
                        <!-- $Calendar->show()}} -->
                        @if (\Auth::user()->role == "dosen")
                            <div class="form-group">
                                <label>ID</label>
                                <div>{{$user->id}}</div>
                            </div>
                        @endif
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <img src="{{$user->foto}}" alt="foto" align="right" style="width:113.3858px;height:151.181102px;">
                            <div>{{$user->name1}}</div>
                        </div>
                        <div class="form-group">
                            <label>Nama Panggilan</label>
                            <div>{{$user->name2}}</div>
                        </div>
                        <div class="form-group">
                            <label>NIM</label>
                            <div>{{$user_tambahan->nim}}</div>
                        </div>
                        <div class="form-group">
                            <label>Judul Riset</label>
                            <div>{{$user_tambahan->judul_riset}}</div>
                        </div>
                        <div class="form-group">
                            <label>Publikasi Ilmiah</label>
                            <div>
                                <ul>
                                    @foreach ($publikasi as $pu)
                                        <li>{{$pu->publikasi}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Daftar Bimbingan</label>
                            <div>
                                <ol>
                                    @foreach ($bimbingan as $bim)
                                        <li>{{$bim->judul_bimbingan}} - {{$bim->waktu_bimbingan}}</li>
                                    @endforeach
                                </ol>
                            </div>
                        </div>
                        <div class="form-group">
                            <div>
                                @if ($user->id == \Auth::user()->id)
                                    <form action="/edit-mahasiswa">
                                       <button type="submit" class="btn btn-default">Edit Biodata</button><br><br>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="panel-body">
<!--                         <div class="form-group">
                            <label>Residensi</label>
                            <div id="my-calendar"></div>
                        </div> -->
                        @if (((\Auth::user()->role == "mahasiswa") and (\Auth::user()->approved == true)) and ($user_tambahan->bimbingan == false) and (\Auth::user()->email != "admin@admin.com"))
                        <div class="form-group">
                            <form method=POST action="/request-bimbingan/{{$user_tambahan->nim}}">
                                {{csrf_field()}}
                                <label>Request Bimbingan</label>
                                <input name="judul_bimbingan" id="judul_bimbingan" type="text" class="form-control" required><br>
                                    <button type="submit" class="btn btn-default div-button" style="float:right">Request Bimbingan</button>
                            </form>
                        </div>
                        @endif
                        @if ((\Auth::user()->role == "dosen") and (\Auth::user()->approved == true))
                            <form role="form">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label>Bulan</label>
                                    <select id="month" name="month" class="form-control" required>
                                        <option value="1">Januari</option>
                                        <option value="2">Februari</option>
                                        <option value="3">Maret</option>
                                        <option value="4">April</option>
                                        <option value="5">Mei</option>
                                        <option value="6">Juni</option>
                                        <option value="7">Juli</option>
                                        <option value="8">Agustus</option>
                                        <option value="9">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Tahun</label>
                                    <select id="year" name="year" class="form-control" required>
                                        <option>2017</option>
                                    </select>
                                </div>
                                <div class="col-lg-10 col-lg-offset-4">
                                    <button type="submit" class="btn btn-default" formmethod="POST" formaction="/export-data/{{$user_tambahan->nim}}">Export to CSV</button>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection

@section ('script')
    <script src="{{asset('js/zabuto_calendar.min.js')}}"></script>

    <script type="application/javascript">
        var eventData = [
            {"date":"2017-08-01","badge":false,"title":"888","footer":"sada"},
            {"date":"2017-08-02","badge":true,"title":"777"}
        ];
        $(document).ready(function () {
            $("#my-calendar").zabuto_calendar({language: "en", today:true, data:eventData});
        });
    </script>
@endsection