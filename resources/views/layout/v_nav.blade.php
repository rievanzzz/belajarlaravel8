<ul class="sidebar-menu" data-widget="tree">
    <li class="{{ request()->is('/') ? 'active' : '' }}"><a href="/"><i class="fa fa-home"></i> <span>Home</span></a></li>

    @if (auth()->user()->level == 1)
        <li class="{{ request()->is('guru') ? 'active' : '' }}"><a href="/guru"><i class="fa fa-address-card-o"></i> <span>Guru</span></a></li>
        <li class="{{ request()->is('siswa') ? 'active' : '' }}"><a href="/siswa"><i class="fa fa-address-book"></i> <span>Siswa</span></a></li>
        <li class="{{ request()->is('users') ? 'active' : '' }}"><a href="/users"><i class="fa fa-users"></i> <span>Users</span></a></li>
        <li class="{{ request()->is('koperasi') ? 'active' : '' }}"><a href="/koperasi"><i class="fa fa-shopping-cart"></i> <span>Koperasi</span></a></li>
        <li class="{{ request()->is('pelanggan') ? 'active' : '' }}"><a href="/pelanggan"><i class="fa fa-cutlery"></i> <span>Pelanggan</span></a></li>
    @elseif (auth()->user()->level == 2)
        <li class="{{ request()->is('koperasi') ? 'active' : '' }}"><a href="/koperasi"><i class="fa fa-shopping-cart"></i> <span>Koperasi</span></a></li>
        <li class="{{ request()->is('pelanggan') ? 'active' : '' }}"><a href="/pelanggan"><i class="fa fa-cutlery"></i> <span>Pelanggan</span></a></li>

    @elseif (auth()->user()->level == 3)
        <li class="{{ request()->is('pelanggan') ? 'active' : '' }}"><a href="/pelanggan"><i class="fa fa-cutlery"></i> <span>Pelanggan</span></a></li>
    @endif
    </li>
</ul>