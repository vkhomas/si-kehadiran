@extends ('layouts.master')

@section ('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Edit Jurusan dan KK</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Edit Jurusan
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <form role="form" method="POST" action="/edit-jurusan-kk/{{$jurusan->jurusan_id}}">
                                    <div class="form-group">
                                        <label>Kode Jurusan</label>
                                        <input id="jurusan_id" name="jurusan_id" class="form-control" value="{{$jurusan->jurusan_id}}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Jurusan</label>
                                        <input id="nama_jurusan" name="nama_jurusan" class="form-control" value="{{$jurusan->nama_jurusan}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Keahlian</label>
                                        <div id='TextBoxesGroup'>
                                            <?php $temp=""; $i=1; ?>
                                            @foreach ($keahlian as $k)
                                                @if ($i == count($keahlian))
                                                    <?php $temp = $temp."{$k->nama_keahlian}"; ?>
                                                @else
                                                    <?php $temp = $temp."{$k->nama_keahlian};"; ?>
                                                    <?php $i++; ?>
                                                @endif
                                            @endforeach
                                            <input class="form-control" type="text" name="nama_keahlian" value="{{$temp}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-10 col-lg-offset-2">
                                            {{csrf_field()}}
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