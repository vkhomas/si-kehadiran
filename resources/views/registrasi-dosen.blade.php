<!DOCTYPE html>
<html lang="en">

@include ('layouts.css+title')

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">Sistem Informasi Kehadiran Mahasiswa Tingkat Akhir</a>
            </div>
            <!-- /.navbar-header -->
            <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li>
                        <a href="/registrasi"><i class="fa fa-database fa-fw"></i> Registrasi Mahasiswa</a>
                    </li>
                    <li>
                        <a href="/registrasi-dosen"><i class="fa fa-archive fa-fw"></i> Registrasi Dosen</a>
                    </li>
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Registrasi</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Registrasi Dosen
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form method="POST" role="form" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        <div class="form-group">
                                            <label>E-mail</label>
                                            <input id="email" class="form-control" name="email" required>
                                        </div>
                                        @if ($errors->has('email'))
                                            <span class="help-block " style="color:red">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                        <div class="form-group">
                                            <label>Password</label> 
                                            <input id="password" type="password" class="form-control" name="password" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Lengkap</label>
                                            <input id="name1" class="form-control" name="name1" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Panggilan</label>
                                            <input id="name2" class="form-control" name="name2" required>
                                        </div>
                                        <div class="form-group">
                                            <label>NIP</label>
                                            <input id="nip" class="form-control" name="nip" required>
                                        </div>
                                        @if ($errors->has('nip'))
                                            <span class="help-block " style="color:red">
                                                <strong>{{ $errors->first('nip') }}</strong>
                                            </span>
                                        @endif
                                        <div class="form-group">
                                            <label>Upload Foto</label>
                                            <input id="foto" type="file" name="foto" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Kode, Nama Fakultas dan Kelompok Keahlian</label>
                                            <select id = "kk" class="form-control" name="kk" ascending required>
                                            @foreach ($kk as $k)
                                                <option>{{$k->jurusan_id}} - {{$k->jurusan->nama_jurusan}} - {{$k->nama_keahlian}}</option>
                                            @endforeach 
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Publikasi Ilmiah (Format IEEE)<br>
                                            note: setiap publikasi dipisahkan tanda ';' tanpa kutip</label>
                                                <input type='textbox' class="form-control" id='publikasi' name="publikasi">
                                        </div>
                                        <div class="form-group">
                                            <div class="col-lg-10 col-lg-offset-4">
                                                <button type="submit" class="btn btn-default">Submit Button</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    @include ('layouts.script')

</body>

</html>
