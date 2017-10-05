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
                        Edit Biodata Dosen
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <form method="POST" role="form" enctype="multipart/form-data">
                                {{csrf_field()}}
                                    <fieldset disabled>
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
                                            <label for="disabledSelect">NIP</label>
                                            <input class="form-control" id="nip" type="number" name="nip"
                                             value="{{$user_tambahan->nip}}" disabled>
                                        </div>
                                    </fieldset>
                                    <div class="form-group">
                                        <label>Upload Foto</label>
                                        <input id="foto" name="foto" type="file" required>
                                        <span class="help-block " style="color:red">
                                            <strong>{{ $errors->first('foto') }}</strong>
                                        </span>
                                    </div>
                                    <div class="form-group">
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
                                        <div class="col-lg-10 col-lg-offset-2">
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