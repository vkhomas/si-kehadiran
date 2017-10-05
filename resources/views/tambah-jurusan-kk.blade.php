@extends ('layouts.master')

@section ('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Tambah Jurusan dan KK</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Tambah Jurusan
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <form method="POST" role="form">
                                {{csrf_field()}}
                                    <div class="form-group">
                                        <label>Kode Jurusan</label>
                                        <input id="jurusan_id" class="form-control" name="jurusan_id" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Jurusan</label>
                                        <input id="nama_jurusan" class="form-control" name="nama_jurusan" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Keahlian</label>
                                        <div id='TextBoxesGroup'>
                                            <input id="nama_keahlian" class="form-control" type="text" name="nama_keahlian">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-10 col-lg-offset-4">
                                            <button type="submit" class="btn btn-default" formmethod="post" formaction="/tambah_jurusan_kk">Submit Button</button>
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