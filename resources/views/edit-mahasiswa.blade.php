@extends ('layouts.master')

@section ('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Edit Biodata</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Edit Biodata Mahasiswa
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <form method="POST" role="form" enctype="multipart/form-data">
                                {{csrf_field()}}
                                    <fieldset>
                                        <div class="form-group">
                                            <label for="disabledSelect">E-mail</label>
                                            <input class="form-control" id="email" type="text" name="email" value="{{\Auth::user()->email}}" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="disabledSelect">Nama Lengkap</label>
                                            <input class="form-control" id="nama-lengkap" type="text" name="name1" value="{{\Auth::user()->name1}}" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="disabledSelect">Nama Panggilan</label>
                                            <input class="form-control" id="nama-panggilan" type="text" name="name2" value="{{\Auth::user()->name2}}" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label>NIM</label>
                                            <input class="form-control" id="nim" type="number" name="nim" value="{{$user_tambahan->nim}}">
                                        </div>
                                    </fieldset>
                                    <div class="form-group">
                                        <label>Upload Foto</label>
                                        <input id="foto" type="file" name="foto" required>
                                        <span class="help-block " style="color:red">
                                            <strong>{{ $errors->first('foto') }}</strong>
                                        </span>
                                    </div>
                                    @if (\Auth::user()->role == "mahasiswa")
                                        <div class="form-group">
                                            <label>Judul Riset</label>
                                            <input class="form-control" name="judul_riset" value="{{$user_tambahan->judul_riset}}">
                                            <span class="help-block " style="color:red">
                                                <strong>{{ $errors->first('judul_riset') }}</strong>
                                            </span>
                                        </div>
                                        <div class="form-group">
                                            <label>Waktu Residensi</label>
                                            @if ($user_tambahan->waktu_residensi == 1)
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="waktu_residensi" id="waktu_residensi" value="1" checked>1 Jam
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="waktu_residensi" id="waktu_residensi" value="2">2 Jam
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="waktu_residensi" id="waktu_residensi" value="4">4 Jam
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="waktu_residensi" id="waktu_residensi" value="8">8 Jam
                                                    </label>
                                                </div>
                                            @elseif ($user_tambahan->waktu_residensi == 2)
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="waktu_residensi" id="waktu_residensi" value="1">1 Jam
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="waktu_residensi" id="waktu_residensi" value="2" checked>2 Jam
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="waktu_residensi" id="waktu_residensi" value="4">4 Jam
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="waktu_residensi" id="waktu_residensi" value="8">8 Jam
                                                    </label>
                                                </div>
                                            @elseif ($user_tambahan->waktu_residensi == 4)
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="waktu_residensi" id="waktu_residensi" value="1">1 Jam
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="waktu_residensi" id="waktu_residensi" value="2">2 Jam
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="waktu_residensi" id="waktu_residensi" value="2" checked>4 Jam
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="waktu_residensi" id="waktu_residensi" value="2">8 Jam
                                                    </label>
                                                </div>
                                            @else
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="waktu_residensi" id="waktu_residensi" value="1">1 Jam
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="waktu_residensi" id="waktu_residensi" value="2">2 Jam
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="waktu_residensi" id="waktu_residensi" value="2">4 Jam
                                                    </label>    
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="waktu_residensi" id="waktu_residensi" value="2" checked>8 Jam
                                                    </label>
                                                </div>
                                            @endif                               
                                        </div>
                                    @endif
                                    <div class="form-group" >
                                        <label>Publikasi Ilmiah (Format IEEE)</label>
                                        <div id='TextBoxesGroup'>
                                        <?php $temp=""; $i=1; ?>
                                            @foreach ($publikasi as $pu)
                                                @if ($i == count($publikasi))
                                                    <?php $temp = $temp."{$pu->publikasi}"; ?>
                                                @else
                                                    <?php $temp = $temp."{$pu->publikasi},"; ?>
                                                    <?php $i++; ?>
                                                @endif
                                            @endforeach
                                            <input class="form-control" type="text" name="publikasi" value="{{$temp}}">
                                        </div>
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
@endsection