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
                            Data Pribadi Dosen
                            {{csrf_field()}}
                            @if (\Auth::user()->email == "admin@admin.com")
                                @if ($user->approved == false)
                                    <button type="submit" formmethod="post" formaction="/biodata-dosen/{{$user_tambahan->nip}}" class="btn btn-default div-button" style="float:right">Approve</button>
                                @endif
                                <button type="submit" formmethod="post" formaction="/delete-dosen/{{$user_tambahan->nip}}" class="btn btn-default div-button" style="float:right">Hapus Dosen</button>
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
                            <label>NIP</label>
                            <div>{{$user_tambahan->nip}}</div>
                        </div>
                        <div class="form-group">
                            <label>Kelompok Keahlian</label>
                            <div>{{$user->kk}}</div>
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
                            <div>
                                @if ($user->id == \Auth::user()->id)
                                    <form action="/edit-dosen">
                                       <button type="submit" class="btn btn-default">Edit Biodata</button><br><br>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection