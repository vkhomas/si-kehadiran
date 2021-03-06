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
                <h1 class="page-header">Daftar Mahasiswa</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        S3
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-als3">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Persentase Kehadiran</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; ?>
                                @foreach ($userS3 as $S3)
                                    <tr class = "S3">
                                        <td>{{$i++}}</td>
                                        <td><a href="/biodata-mahasiswa/{{$S3->nim}}">{{$S3->user->name1}}</a></td>
                                        @if ($S3->rating_kehadiran >= 75)
                                            <td
                                                <div class="progress progress-striped active">
                                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{$S3->rating_kehadiran}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$S3->rating_kehadiran}}%">
                                                    </div>
                                                </div>
                                            </td>
                                        @elseif ($S3->rating_kehadiran >= 50)
                                            <td
                                                <div class="progress progress-striped active">
                                                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="{{$S3->rating_kehadiran}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$S3->rating_kehadiran}}%">
                                                    </div>
                                                </div>
                                            </td>
                                        @else
                                            <td
                                                <div class="progress progress-striped active">
                                                    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="{{$S3->rating_kehadiran}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$S3->rating_kehadiran}}%">
                                                    </div>
                                                </div>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        S2
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-als2">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Persentase Kehadiran</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; ?>
                                @foreach ($userS2 as $S2)
                                    <tr class = "S2">
                                        <td>{{$i++}}</td>
                                        <td><a href="/biodata-mahasiswa/{{$S2->nim}}">{{$S2->user->name1}}</a></td>
                                        @if ($S2->rating_kehadiran >= 75)
                                            <td
                                                <div class="progress progress-striped active">
                                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{$S2->rating_kehadiran}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$S2->rating_kehadiran}}%">
                                                    </div>
                                                </div>
                                            </td>
                                        @elseif ($S2->rating_kehadiran >= 50)
                                            <td
                                                <div class="progress progress-striped active">
                                                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="{{$S2->rating_kehadiran}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$S2->rating_kehadiran}}%">
                                                    </div>
                                                </div>
                                            </td>
                                        @else
                                            <td
                                                <div class="progress progress-striped active">
                                                    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="{{$S2->rating_kehadiran}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$S2->rating_kehadiran}}%">
                                                    </div>
                                                </div>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        S1
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-als1">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Persentase Kehadiran</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; ?>
                                @foreach ($userS1 as $S1)
                                    <tr class = "S1">
                                        <td>{{$i++}}</td>
                                        <td><a href="/biodata-mahasiswa/{{$S1->nim}}">{{$S1->user->name1}}</a></td>
                                        @if ($S1->rating_kehadiran >= 75)
                                            <td
                                                <div class="progress progress-striped active">
                                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{$S1->rating_kehadiran}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$S1->rating_kehadiran}}%">
                                                    </div>
                                                </div>
                                            </td>
                                        @elseif ($S1->rating_kehadiran >= 50)
                                            <td
                                                <div class="progress progress-striped active">
                                                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="{{$S1->rating_kehadiran}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$S1->rating_kehadiran}}%">
                                                    </div>
                                                </div>
                                            </td>
                                        @else
                                            <td
                                                <div class="progress progress-striped active">
                                                    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="{{$S1->rating_kehadiran}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$S1->rating_kehadiran}}%">
                                                    </div>
                                                </div>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- /.table-responsive -->
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
        $('#dataTables-als2').DataTable({
            responsive: true
        });
        $('#dataTables-als1').DataTable({
            responsive: true
        });        
    });    
    </script>
@endsection