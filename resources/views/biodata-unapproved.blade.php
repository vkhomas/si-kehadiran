@extends ('layouts.master')

@section ('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Data Pribadi Mahasiswa
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
                            <img src="url" alt="foto_mhs" align="right" style="width:113.3858px;height:151.181102px;">
                            <div>{{$biodata->name1}}</div>
                        </div>
                        <div class="form-group">
                            <label>Nama Panggilan</label>
                            <div>{{$biodata->name2}}</div>
                        </div>
                        <div class="form-group">
                            <label>NIM</label>
                            <div>{{$biodata->nim}}</div>
                        </div>
                        <div class="form-group">
                            <label>Judul Riset</label>
                            <div>{{$biodata->judul_riset}}</div>
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
                                <button type="submit" class="btn btn-default">Yes</button>
                                <button type="reset" class="btn btn-default div-button">No</button><br><br>
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