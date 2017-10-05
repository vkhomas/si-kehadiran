@extends ('layouts.master')

@section ('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        <form role="form">
                            Data Pribadi Mahasiswa
                            @if ((\Auth::user()->role == "dosen") and (\Auth::user()->approved == true))
                                {{csrf_field()}}
                                <button formmethod="post" formaction="/delete-alumni/{{$user_tambahan->nim}}" class="btn btn-default div-button" style="float:right">Hapus Alumni</button>
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
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <img src="url" alt="foto" align="right" style="width:113.3858px;height:151.181102px;">
                            <div>{{ $user->name1 }}</div>
                        </div>
                        <div class="form-group">
                            <label>Nama Panggilan</label>
                            <div>{{ $user->name2 }}</div>
                        </div>
                        <div class="form-group">
                            <label>NIM</label>
                            <div>{{ $user_tambahan->nim }}</div>
                        </div>
                        <div class="form-group">
                            <label>Jurusan</label>
                            <div>{{ $user->jurusan }}</div>
                        </div>
                        <div class="form-group">
                            <label>Kelompok Keahlian</label>
                            <div>{{ $user->kk }}</div>
                        </div>
                        <div class="form-group">
                            <label>Judul Riset</label>
                            <div>{{ $user_tambahan->judul_riset }}</div>
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
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection

@section('script')
    <!-- jQuery -->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{asset('vendor/metisMenu/metisMenu.min.js')}}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{asset('js/sb-admin-2.js')}}"></script>
@endsection