<div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
    </button>
    <a class="navbar-brand" href="/ ">Sistem Informasi Kehadiran Mahasiswa Tingkat Akhir</a>
</div>

<ul class="nav navbar-top-links navbar-right">
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-user">
            <li>
                @if (\Auth::user()->role == "mahasiswa")
                    <a href="/biodata-mahasiswa"><i class="fa fa-user fa-fw"></i> User Profile</a>
                @else (\Auth::user()->approved == true)
                    <a href="/biodata-dosen"><i class="fa fa-user fa-fw"></i> User Profile</a>
                @endif
            </li>
            <li class="divider"></li>
            <li>
                <!-- <a href="login"><i class="fa fa-sign-out fa-fw"></i> Logout</a> -->
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                    Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}  
                </form>
            </li>
        </ul>
        <!-- /.dropdown-user -->
    </li>
    <!-- /.dropdown -->
</ul>

<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                {{\Auth::user()->name1}}
                @if (\Auth::user()->approved == false)
                    pending
                @endif
                @if (($kehadiran->in_time == NULL) and ($kehadiran->out_time == NULL))
                    offline
                @elseif ($kehadiran->out_time == NULL)
                    online
                @else
                    offline
                @endif
                @if (\Auth::user()->role == "mahasiswa")
                    {{$sisa}}
                @endif
            </li>
            @if (\Auth::user()->email == "admin@admin.com")
                <li>
                    <a href="/daftar-dosen">Halaman Utama</a>
                </li>
                <li>
                    <a href="/daftar-unapproved-dosen">Daftar Unapproved Dosen</a>
                </li>
                <li>
                    <a href="/daftar-jurusan-kk">Daftar Jurusan & KK</a>
                </li>
            @else
                @if ((\Auth::user()->role == "dosen") and (\Auth::user()->approved == true))
                    <li>
                        <a href="/daftar-mahasiswa"><i class="fa fa-database fa-fw"></i> Halaman Utama</a>
                    </li>
                    <li>
                        <a href="/daftar-alumni"><i class="fa fa-archive fa-fw"></i> Alumni</a>
                    </li>
                    <li>
                        <a href="/status-kehadiran"><i class="fa fa-user fa-fw"></i> Status Kehadiran</a>
                    </li>
                    <li>
                        <a href="/daftar-unapproved"><i class="fa fa-pause fa-fw"></i> Unapproved Mahasiswa</a>
                    </li>
                    <li>
                        <a href="/daftar-request-bimbingan"><i class="fa fa-pause fa-fw"></i> Request Bimbingan</a>
                    </li>
                @endif
            @endif
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
