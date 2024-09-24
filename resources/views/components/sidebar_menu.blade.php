<ul class="sidebar-menu">
  <li class="menu-header">Dashboard</li>
  <li class='{{ request()->routeIs('app.dashboard') ? 'active' : '' }}'>
    <a class="nav-link" href="{{ route('app.dashboard') }}"><i class="fas fa-home"></i> <span>Beranda</span></a>
  </li>

  @if (auth()->user()->hasRole('super-admin'))
    <li class="nav-item dropdown {{ request()->routeIs('app.pillar.tksk.*') ? 'active' : '' }}">
      <a href="#" class="nav-link has-dropdown"><i class="fas fa-list"></i><span>TKSK</span></a>
      <ul class="dropdown-menu">
        <li
          class='{{ request()->routeIs('app.pillar.tksk.index') || request()->routeIs('app.pillar.tksk.create') || request()->routeIs('app.pillar.tksk.edit') ? 'active' : '' }}'>
          <a class="nav-link" href="{{ route('app.pillar.tksk.index') }}">Profil</a>
        </li>

        <li class='{{ request()->routeIs('app.pillar.tksk.report.*') ? 'active' : '' }}'>
          <a class="nav-link" href="{{ route('app.pillar.tksk.report.index') }}">Laporan</a>
        </li>
        {{-- <li class=''>
          <a class="nav-link" href="#">Statistik</a>
        </li> --}}
      </ul>
    </li>

    <li class="nav-item dropdown {{ request()->routeIs('app.pillar.psm.*') ? 'active' : '' }}">
      <a href="#" class="nav-link has-dropdown"><i class="fas fa-list"></i><span>PSM</span></a>
      <ul class="dropdown-menu">
        <li class='{{ request()->routeIs('app.pillar.psm.profile.index') ? 'active' : '' }}'>
          <a class="nav-link" href="{{ route('app.pillar.psm.profile.index') }}">Profil</a>
        </li>
        <li class='{{ request()->routeIs('app.pillar.psm.report.index') ? 'active' : '' }}'>
          <a class="nav-link" href="{{ route('app.pillar.psm.report.index') }}">Laporan</a>
        </li>
        {{-- <li class=''>
          <a class="nav-link" href="#">Statistik</a>
        </li> --}}
      </ul>
    </li>

    <li class="nav-item dropdown {{ request()->routeIs('app.pillar.kartar.*') ? 'active' : '' }}">
      <a href="#" class="nav-link has-dropdown"><i class="fas fa-list"></i><span>Karang Taruna</span></a>
      <ul class="dropdown-menu">
        <li class='{{ request()->routeIs('app.pillar.kartar.index') ? 'active' : '' }}'>
          <a class="nav-link" href="{{ route('app.pillar.kartar.index') }}">Profil</a>
        </li>
        <li class='{{ request()->routeIs('app.pillar.kartar.report.index') ? 'active' : '' }}'>
          <a class="nav-link" href="{{ route('app.pillar.kartar.report.index') }}">Laporan</a>
        </li>
        {{-- <li class='{{ request()->routeIs('app.pillar.kartar.report.approval.index') ? 'active' : '' }}'>
          <a class="nav-link" href="{{ route('app.pillar.kartar.report.approval.index') }}">Verifikasi Laporan</a>
        </li> --}}
        {{-- <li class=''>
          <a class="nav-link" href="">Statistik</a>
        </li> --}}
      </ul>
    </li>


    <li class="nav-item dropdown {{ request()->routeIs('app.pillar.lks.*') ? 'active' : '' }}">
      <a href="#" class="nav-link has-dropdown"><i class="fas fa-list"></i><span>LKS</span></a>
      <ul class="dropdown-menu">
        <li class='{{ request()->routeIs('app.pillar.lks.index') ? 'active' : '' }}'>
          <a class="nav-link" href="{{ route('app.pillar.lks.index') }}">Profil</a>
        </li>
        <li class='{{ request()->routeIs('app.pillar.lks.report.*') ? 'active' : '' }}'>
          <a class="nav-link" href="{{ route('app.pillar.lks.report.index') }}">Laporan</a>
        </li>
        {{-- <li class='{{ request()->routeIs('app.pillar.lks.approval.*') ? 'active' : '' }}'>
          <a class="nav-link" href="{{ route('app.pillar.lks.approval.index') }}">Verifikasi
            Laporan</a>
        </li> --}}
        {{-- <li class=''>
          <a class="nav-link" href="#">Statistik</a>
        </li> --}}
      </ul>
    </li>

    <li class="nav-item dropdown {{ request()->routeIs('app.pillar.pkh.*') ? 'active' : '' }}">
      <a href="#" class="nav-link has-dropdown"><i class="fas fa-list"></i><span>PKH</span></a>
      <ul class="dropdown-menu">
        <li class='{{ request()->routeIs('app.pillar.pkh.index') ? 'active' : '' }}'>
          <a class="nav-link" href="{{ route('app.pillar.pkh.index') }}">Profil</a>
        </li>
        <li class='{{ request()->routeIs('app.pillar.pkh.report.index') ? 'active' : '' }}'>
          <a class="nav-link" href="{{ route('app.pillar.pkh.report.index') }}">Laporan</a>
        </li>
        {{-- <li class='{{ request()->routeIs('app.pillar.lks.approval.*') ? 'active' : '' }}'>
          <a class="nav-link" href="{{ route('app.pillar.lks.approval.index') }}">Verifikasi
            Laporan</a>
        </li> --}}
        {{-- <li class=''>
          <a class="nav-link" href="#">Statistik</a>
        </li> --}}
      </ul>
    </li>

    <li class="nav-item dropdown {{ request()->routeIs('app.pillar.aspd.*') ? 'active' : '' }}">
      <a href="#" class="nav-link has-dropdown"><i class="fas fa-list"></i><span>ASPD</span></a>
      <ul class="dropdown-menu">
        <li class='{{ request()->routeIs('app.pillar.aspd.index') ? 'active' : '' }}'>
          <a class="nav-link" href="{{ route('app.pillar.aspd.index') }}">Profil</a>
        </li>
        <li class='{{ request()->routeIs('app.pillar.aspd.report.index') ? 'active' : '' }}'>
          <a class="nav-link" href="">Laporan</a>
        </li>
        <li class='{{ request()->routeIs('app.pillar.aspd.quota.*') ? 'active' : '' }}'>
          <a class="nav-link" href="{{ route('app.pillar.aspd.quota.index') }}">Kuota</a>
        </li>
        {{-- <li class='{{ request()->routeIs('app.pillar.aspd.approval.*') ? 'active' : '' }}'>
                    <a class="nav-link" href="{{ route('app.pillar.lks.approval.index') }}">Verifikasi
                        Laporan</a>
                </li> --}}
        {{-- <li class=''>
          <a class="nav-link" href="#">Statistik</a>
        </li> --}}
      </ul>
    </li>
  @endif

  @if (auth()->user()->hasRole('admin') && auth()->user()->pillar->id === \App\Models\Pillars\Pillar::PILLAR_TKSK)
    <li class="nav-item dropdown {{ request()->routeIs('app.pillar.tksk.*') ? 'active' : '' }}">
      <a href="#" class="nav-link has-dropdown"><i class="fas fa-list"></i><span>TKSK</span></a>
      <ul class="dropdown-menu">
        <li
          class='{{ request()->routeIs('app.pillar.tksk.index') || request()->routeIs('app.pillar.tksk.create') || request()->routeIs('app.pillar.tksk.edit') ? 'active' : '' }}'>
          <a class="nav-link" href="{{ route('app.pillar.tksk.index') }}">Profil</a>
        </li>
        <li class='{{ request()->routeIs('app.pillar.tksk.report.index') ? 'active' : '' }}'>
          <a class="nav-link" href="{{ route('app.pillar.tksk.report.index') }}">Laporan</a>
        </li>
        <li class='{{ request()->routeIs('app.pillar.tksk.report.approval.*') ? 'active' : '' }}'>
          <a class="nav-link" href="{{ route('app.pillar.tksk.report.approval.index') }}">Verifikasi
            Laporan</a>
        </li>
        {{-- <li class=''>
          <a class="nav-link" href="#">Statistik</a>
        </li> --}}
      </ul>
    </li>
  @endif

  @if (auth()->user()->hasRole('admin') && auth()->user()->pillar->id === \App\Models\Pillars\Pillar::PILLAR_PSM)
    <li class="nav-item dropdown {{ request()->routeIs('app.pillar.psm.*') ? 'active' : '' }}">
      <a href="#" class="nav-link has-dropdown"><i class="fas fa-list"></i><span>PSM</span></a>
      <ul class="dropdown-menu">
        <li class='{{ request()->routeIs('app.pillar.psm.profile.index') ? 'active' : '' }}'>
          <a class="nav-link" href="{{ route('app.pillar.psm.profile.index') }}">Profil</a>
        </li>
        <li class='{{ request()->routeIs('app.pillar.psm.report.index') ? 'active' : '' }}'>
          <a class="nav-link" href="{{ route('app.pillar.psm.report.index') }}">Laporan</a>
        </li>
        <li class='{{ request()->routeIs('app.pillar.psm.report.approval.index') ? 'active' : '' }}'>
          <a class="nav-link" href="{{ route('app.pillar.psm.report.approval.index') }}">Verifikasi
            Laporan</a>
        </li>
        {{-- <li class=''>
          <a class="nav-link" href="#">Statistiks</a>
        </li> --}}
      </ul>
    </li>
  @endif

  @if (auth()->user()->hasRole('admin') && auth()->user()->pillar->id === \App\Models\Pillars\Pillar::PILLAR_KARTAR)
    <li class="nav-item dropdown {{ request()->routeIs('app.pillar.kartar.*') ? 'active' : '' }}">
      <a href="#" class="nav-link has-dropdown"><i class="fas fa-list"></i><span>Karang Taruna</span></a>
      <ul class="dropdown-menu">
        <li class='{{ request()->routeIs('app.pillar.kartar.*') ? 'active' : '' }}'>
          <a class="nav-link" href="{{ route('app.pillar.kartar.index') }}">Profil</a>
        </li>
        <li class='{{ request()->routeIs('app.pillar.kartar.report.*') ? 'active' : '' }}'>
          <a class="nav-link" href="{{ route('app.pillar.kartar.report.index') }}">Laporan</a>
        </li>
        <li class='{{ request()->routeIs('app.pillar.kartar.report.approval.index') ? 'active' : '' }}'>
          <a class="nav-link" href="{{ route('app.pillar.kartar.report.approval.index') }}">Verifikasi
            Laporan</a>
        </li>
        {{-- <li class=''>
          <a class="nav-link" href="">Statistik</a>
        </li> --}}
      </ul>
    </li>
  @endif

  @if (auth()->user()->hasRole('admin') && auth()->user()->pillar->id === \App\Models\Pillars\Pillar::PILLAR_LKS)
    <li class="nav-item dropdown {{ request()->routeIs('app.pillar.lks.*') ? 'active' : '' }}">
      <a href="#" class="nav-link has-dropdown"><i class="fas fa-list"></i><span>LKS</span></a>
      <ul class="dropdown-menu">
        <li class='{{ request()->routeIs('app.pillar.lks.index') ? 'active' : '' }}'>
          <a class="nav-link" href="{{ route('app.pillar.lks.index') }}">Profil</a>
        </li>
        <li class='{{ request()->routeIs('app.pillar.lks.report.*') ? 'active' : '' }}'>
          <a class="nav-link" href="{{ route('app.pillar.lks.report.index') }}">Laporan</a>
        </li>
        <li class='{{ request()->routeIs('app.pillar.lks.approval.*') ? 'active' : '' }}'>
          <a class="nav-link" href="{{ route('app.pillar.lks.approval.index') }}">Verifikasi
            Laporan</a>
        </li>
        {{-- <li class=''>
          <a class="nav-link" href="#">Statistik</a>
        </li> --}}
      </ul>
    </li>
  @endif

  @if (auth()->user()->hasRole('admin') && auth()->user()->pillar->id === \App\Models\Pillars\Pillar::PILLAR_PKH)
    <li class="nav-item dropdown {{ request()->routeIs('app.pillar.pkh.*') ? 'active' : '' }}">
      <a href="#" class="nav-link has-dropdown"><i class="fas fa-list"></i><span>PKH</span></a>
      <ul class="dropdown-menu">
        <li class='{{ request()->routeIs('app.pillar.pkh.index') ? 'active' : '' }}'>
          <a class="nav-link" href="{{ route('app.pillar.pkh.index') }}">Profil</a>
        </li>
        <li class='{{ request()->routeIs('app.pillar.pkh.report.index') ? 'active' : '' }}'>
          <a class="nav-link" href="{{ route('app.pillar.pkh.report.index') }}">Laporan</a>
        </li>
        <li class='{{ request()->routeIs('app.pillar.pkh.report.approval.*') ? 'active' : '' }}'>
          <a class="nav-link" href="{{ route('app.pillar.pkh.report.approval.index') }}">Verifikasi
            Laporan</a>
        </li>
        {{-- <li class=''>
          <a class="nav-link" href="#">Statistik</a>
        </li> --}}
      </ul>
    </li>
  @endif

  @if (auth()->user()->hasRole('admin') && auth()->user()->pillar->id === \App\Models\Pillars\Pillar::PILLAR_ASPD)
    <li class="nav-item dropdown {{ request()->routeIs('app.pillar.aspd.*') ? 'active' : '' }}">
      <a href="#" class="nav-link has-dropdown"><i class="fas fa-list"></i><span>ASPD</span></a>
      <ul class="dropdown-menu">
        <li class='{{ request()->routeIs('app.pillar.aspd.index') ? 'active' : '' }}'>
          <a class="nav-link" href="{{ route('app.pillar.aspd.index') }}">Profil</a>
        </li>
        <li class='{{ request()->routeIs('app.pillar.aspd.report.index') ? 'active' : '' }}'>
          <a class="nav-link" href="{{ route('app.pillar.aspd.report.index') }}">Laporan</a>
        </li>
        <li class='{{ request()->routeIs('app.pillar.aspd.report.approval.index') ? 'active' : '' }}'>
          <a class="nav-link" href="{{ route('app.pillar.aspd.report.approval.index') }}">Verifikasi
            Laporan</a>
        </li>

      </ul>
    </li>
  @endif

  <!-- report code management only available for super-admin (except dinas sosial jawa timur) and admin -->
  @if ((auth()->user()->hasRole('super-admin') && !auth()->user()->isDinsosJatim) || auth()->user()->hasRole('admin'))
    <li class="{{ request()->routeIs('app.report-code-management.*') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('app.report-code-management.index') }}"><i class="fas fa-paper-plane"></i>
        <span>Kode Pelaporan</span></a>
    </li>
  @endif

  @if (auth()->user()->hasRole('super-admin'))
    <li class='{{ request()->routeIs('app.account.*') ? 'active' : '' }}'>
      <a class="nav-link" href="{{ route('app.account.index') }}"><i class="fas fa-user"></i> <span>Kelola
          Akun</span></a>
    </li>
  @endif


  @if (auth()->user()->hasRole('employee'))
    @if (Auth::user()->pillar_id == 4)
      <li class="{{ request()->routeIs('app.pillar.lks.report.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('app.pillar.lks.report.index') }}"><i class="fas fa-paper-plane"></i>
          <span>Laporan</span></a>
      </li>
    @elseif(Auth::user()->pillar_id == 3)
      <li class="{{ request()->routeIs('app.pillar.kartar.report.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('app.pillar.kartar.report.index') }}"><i class="fas fa-paper-plane"></i>
          <span>Laporan</span></a>
      </li>
    @elseif(Auth::user()->pillar_id == 5)
      <li class="{{ request()->routeIs('app.pillar.pkh.report.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('app.pillar.pkh.report.index') }}"><i class="fas fa-paper-plane"></i>
          <span>Laporan</span></a>
      </li>
    @else
      <li class="{{ request()->routeIs('app.pillar.aspd.report.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('app.pillar.aspd.report.index') }}"><i class="fas fa-paper-plane"></i>
          <span>Laporan</span></a>
      </li>
    @endif
  @endif

  <li class='{{ request()->routeIs('app.complaint.*') ? 'active' : '' }}'>
    <a class="nav-link" href="{{ route('app.complaint.index') }}"><i class="fas fa-paper-plane"></i>
      <span>Masukkan / Saran</span></a>
  </li>

  <li class="nav-item dropdown">
    <a href="#" class="nav-link has-dropdown"><i class="fas fa-download"></i><span>Download</span></a>
    <ul class="dropdown-menu">
      <li class=''>
        <a class="nav-link" href="#">Materi Pelatihan</a>
      </li>
      <li class=''>
        <a class="nav-link" href="#">Format Laporan</a>
      </li>
    </ul>
  </li>

</ul>
