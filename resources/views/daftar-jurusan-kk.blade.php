@extends ('layouts.master')
@section ('css')
    <!-- DataTables CSS -->
    <link href="{{asset('vendor/datatables-plugins/dataTables.bootstrap.css')}}" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="{{asset('vendor/datatables-responsive/dataTables.responsive.css')}}" rel="stylesheet">
@endsection

@section ('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                    <h1 class="page-header">
                        <form method="post">
                            Daftar Jurusan dan KK
                            <button formmethod="get" formaction="/tambah-jurusan-kk" class="btn btn-default div-button" style="float:right">Tambah</button>
                        </form>
                    </h1>
                </div>
            </form>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Jurusan dan Keahlian
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                    <form>
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-als3">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kode Jurusan</th>
                                    <th>Nama Jurusan</th>
                                    <th>Keahlian</th>
                                    <th>Edit/Hapus</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; ?>
                                @foreach ($jurusan as $j)
                                    <tr class = "jurusan">
                                        <td>{{$i++}}</td>
                                        <td>{{$j->jurusan_id}}</td>
                                        <td>{{$j->nama_jurusan}}</td>
                                        <td>
                                            @foreach ($keahlian as $k)
                                                @if ($j->jurusan_id == $k->jurusan_id)
                                                    <ol>{{$k->nama_keahlian}}</ol>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            {{csrf_field()}}    
                                            <button type="submit" formmethod="get" formaction="/edit-jurusan-kk/{{$j->jurusan_id}}" class="btn btn-default div-button">Edit</button>
                                            <button type="submit" formmethod="post" formaction="/hapus-jurusan-kk/{{$j->jurusan_id}}" class="btn btn-default div-button">Hapus</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- /.table-responsive -->
                        </form>
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

@section ('script')
    <!-- DataTables JavaScript -->
    <script src="{{asset('vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendor/datatables-plugins/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('vendor/datatables-responsive/dataTables.responsive.js')}}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{asset('js/sb-admin-2.js')}}"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-als3').DataTable({
            responsive: true
        });      
    });    
    </script>
@endsection