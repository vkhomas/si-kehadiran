@extends ('layouts.master')
@section ('script')
    <!-- DataTables CSS -->
    <link href="{{asset('vendor/datatables-plugins/dataTables.bootstrap.css')}}" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="{{asset('vendor/datatables-responsive/dataTables.responsive.css')}}" rel="stylesheet">
@endsection

@section ('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Request Bimbingan</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Request
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-unapproved">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Judul</th>
                                    <th>Bimbingan</th>
                                </tr>
                            </thead>
                            <tbody>
                            <form role="form">
                                <?php $i=1; ?>
                                @foreach ($bimbingan as $bim)
                                    @if (($bim->mhs->bimbingan == true) and ($bim->mhs->dosbing == \Auth::user()->name1))
                                    <tr>
                                        {{csrf_field()}}
                                        <td>{{$i++}}</td>
                                        <td>
                                            <a href ="/biodata-mahasiswa/{{$bim->mhs->nim}}">{{$bim->name1}}</a>
                                        </td>
                                        <td>
                                            {{$list_bimb[$i-2]}}
                                        </td>
                                        <td>
                                            <button type="submit" formmethod="post" formaction="/end-bimbingan/{{$bim->mhs->nim}}" class="btn btn-default div-button">Selesai</button><button type="submit" formmethod="post" formaction="/cancel-bimbingan/{{$bim->mhs->nim}}" class="btn btn-default div-button">Cancel</button>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                            </form>
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