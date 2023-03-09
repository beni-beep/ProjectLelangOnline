@extends('master')

@section('judul')
    <h1>Dashboard Admin</h1>
@endsection

@section('content')
    <section class="content">
        @if (session()->has('success'))
            <div class="alert alert-info col-md-5" role="alert">
                {{ session('success') }}Selamat datang <strong>{{ Auth::user()->name }}</strong>
            </div>
        @endif
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-user"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Jumlah User</span>
                            <span class="info-box-number">
                                {{ $users->count() }}
                            </span>
                            <a href="/user" class="small-box-footer"><i class="fas fa-info-circle">Detail</i></a>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-boxes"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Jumlah Barang</span>
                            <span class="info-box-number">
                                {{ $barangs->count() }}
                            </span>
                            <a href="/barang" class="small-box-footer"><i class="fas fa-info-circle">Detail</i></a>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-file-invoice"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Jumlah Lelang</span>
                            <span class="info-box-number">
                                {{ $lelangs->count() }}
                            </span>
                            <a href="/lelang" class="small-box-footer"><i class="fas fa-info-circle">Detail</i></a>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-search-dollar"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Jumlah Penawaran</span>
                            <span class="info-box-number">
                                {{ $historie->count() }}

                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <strong>Data Penawaran Lelang</strong>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover">
                    <thead>
                    <tbody>
                        <tr>
                            <th>No</th>
                            <th>Pelelang</th>
                            <th>Nama Barang</th>
                            <th>Harga Penawaran</th>
                            <th>Tanggal Penawaran</th>
                            <th>Status</th>

                        </tr>
                    </tbody>
                    </thead>
                    @forelse ($historie as $item)
                        <tbody>
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->nama_barang }}</td>
                                <td>@currency($item->harga)</td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('j-F-Y') }}</td>
                                <td>
                                    <span
                                        class="badge {{ $item->status == 'pending' ? 'bg-warning' : 'bg-success' }}">{{ Str::title($item->status) }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td>Data masih kosong</td>
                            </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <!-- /.card-footer-->
        </div>
    </section>
@endsection
