@extends('master')

@section('judul')
    @if ($lelang->status == 'ditutup')
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Selamat kepada <strong>{{ $lelang->pemenang }}</strong></h5>
                <p class="card-text"> Telah memenangkan lelang untuk barang
                    <strong>{{ $lelang->barang->nama_barang }}</strong> dengan harga
                    <strong>Rp{{ number_format($lelang->harga_akhir) }}</strong>
                </p>
            </div>
        </div>
    @endif
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            @error('harga')
                <b class="form-control is-invalid mb-3">Erorr! {{ $message }}</b>
            @enderror
            @if (!empty($lelang))
                <div class="row">
                    <div class="col-md-5">
                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <span
                                    class="badge {{ $lelang->status == 'ditutup' ? 'bg-danger' : 'bg-success' }}">{{ Str::title($lelang->status) }}</span>
                                <div class="text-center">
                                    @if ($lelang->barang->image)
                                        <img class="img-fluid mt-3" src="{{ asset('storage/' . $lelang->barang->image) }}"
                                            alt="User profile picture">
                                    @endif
                                </div>

                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>

                    <!-- /.col -->
                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-header">

                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane" id="bid">
                                        <form action="{{ route('historie.store', $lelang->id) }}" method="post"
                                            class="form-horizontal" data-parsley-validate>
                                            @csrf
                                            <div class="form-group">
                                                <label for="inputName">Tawarkan Harga</label>
                                                <div class="col-sm-12">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><strong>Rp.</strong></span>
                                                        </div>
                                                        <input type="text"
                                                            name="harga"class="form-control @error('harga') is-invalid @enderror"
                                                            placeholder="Masukan Penawaran @currency($lelang->barang->harga_awal)">
                                                        @error('harga')
                                                            <div class="invalid-feedback">
                                                                <b>{{ $message }}</b>
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="">
                                                    <button type="button" data-toggle="modal" data-target="#modal-sl"
                                                        class="btn btn-danger">Tawarkan</button>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="modal-sl">
                                                <div class="modal-dialog modal-sl">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Tawar Harga</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Apa kamu yakin untuk menawar
                                                                {{ $lelang->barang->nama_barang }}</p>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">Tutup</button>

                                                            <button type="submit" class="btn btn-danger">Iya</button>

                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                            <!-- /.modal -->
                                        </form>
                                    </div>
                                    <div class="tab-pane active" id="details">
                                        <form class="form-horizontal">
                                            <div class="form-group row">
                                                <label for="inputName" class="col-sm-3 col-form-label">Nama Barang</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="inputName"
                                                        value="{{ $lelang->barang->nama_barang }}" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail" class="col-sm-3 col-form-label">Harga Awal</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="inputEmail"
                                                        value="@currency($lelang->barang->harga_awal)" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputHargaAkhir" class="col-sm-3 col-form-label">Harga
                                                    Akhir</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="inputHargaAkhir"
                                                        value="@currency($lelang->harga_akhir)" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputTanggal" class="col-sm-3 col-form-label">Tanggal
                                                    Lelang</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="inputTanggal"
                                                        value="{{ \Carbon\Carbon::parse($lelang->tanggal_lelang)->format('j F Y') }}"
                                                        readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputStatus" class="col-sm-3 col-form-label">Status</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="inputStatus"
                                                        value="{{ $lelang->status }}" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputDeskripsi" class="col-sm-3 col-form-label">Deskripsi
                                                    Barang</label>
                                                <div class="col-sm-9">
                                                    <textarea class="form-control" id="inputDeskripsi" rows="3" readonly>{{ $lelang->barang->deskripsi_barang }}</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                @if ($lelang->status == 'dibuka')
                                                    <div class="col-sm-12">
                                                        <button type="button" class="btn btn-danger btn-lg btn-block"
                                                            data-toggle="modal" data-target="#exampleModal">
                                                            <i class="fas fa-file-invoice-dollar"></i> Tawar
                                                        </button>
                                                    </div>
                                                @else
                                                @endif
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <a href="{{ route('dashboard.masyarakat') }}"
                                                        class="btn btn-outline-info btn-lg btn-block">Kembali</a>
                                                </div>
                                            </div>

                                        </form>

                                        <form action="{{ route('historie.store', $lelang->id) }}" method="post">
                                            @csrf
                                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Tawar
                                                                {{ $lelang->barang->nama_barang }} </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form>
                                                                <div class="form-group">
                                                                    <label for="input">Input Harga Penawaran</label>
                                                                    <div class="input-group mb-3">
                                                                        <div class="input-group-prepend">
                                                                            <span
                                                                                class="input-group-text"><strong>Rp.</strong></span>
                                                                        </div>
                                                                        <input type="text" name="harga"
                                                                            class="form-control @error('harga') is-invalid @enderror"
                                                                            placeholder="Masukan Penawaran">
                                                                        @error('harga')
                                                                            <div class="invalid-feedback">
                                                                                <b>{{ $message }}</b>
                                                                            </div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Batal</button>
                                                            <button type="submit"
                                                                class="btn btn-danger">Tawarkan</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div><!-- /.card-body -->
                        </div>
                    </div>
                </div>
            @endif
            <!-- /.row -->
        </div><!-- /.container-fluid -->
        <div class="card">
            <div class="card-header">
                <strong>Histori Pelelang {{ $lelang->barang->nama_barang }}</strong>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Pelelang</th>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Harga Penawaran</th>
                                <th scope="col">Tanggal Penawaran</th>
                                <th scope="col">Status</th>
                                @if (auth()->user()->level == 'petugas')
                                    <th scope="col"></th>
                                @endif
                                @if (auth()->user()->level == 'admin')
                                    <th scope="col"></th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($histories as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ $item->lelang->barang->nama_barang }}</td>
                                    <td>@currency($item->harga)</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('j-F-Y') }}</td>
                                    <td>
                                        <span
                                            class="badge {{ $item->status == 'pending' ? 'bg-warning' : 'bg-success' }}">{{ Str::title($item->status) }}</span>
                                    </td>
                                    @if (auth()->user()->level == 'admin')
                                        <td>
                                            <a class="btn btn-primary btn-sm"
                                                href="{{ route('lelang.show', $item->id) }}">
                                                <i class="fas fa-folder"></i>
                                                View
                                            </a>
                                        </td>
                                    @endif
                                    @if (auth()->user()->level == 'petugas')
                                        <td>
                                            <form action="{{ route('barang.destroy', [$item->id]) }}" method="POST">
                                                <a class="btn btn-primary btn-sm"
                                                    href="{{ route('lelang.show', $item->id) }}">
                                                    <i class="fas fa-folder"></i>
                                                    View
                                                </a>
                                                <a class="btn btn-info btn-sm" href="">
                                                    <i class="fas fa-pencil-alt"></i>
                                                    Edit
                                                </a>
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm" type="submit" value="Delete">
                                                    <i class="fas fa-trash"></i>
                                                    Delete
                                                </button>
                                            </form>
                                        </td>

                                        <td>
                                            <div class="card-body">
                                                <button type="button" class="btn btn-success" data-toggle="modal"
                                                    data-target="#modal-success">
                                                    Jadikan Pemenang
                                                </button>
                                                <div class="modal fade" id="modal-success">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">KONFIRMASI PEMENANG</h4>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>ANDA YAKIN UNTUK MENJADIKAN
                                                                    "{{ $item->user->name }}" PEMENANG?
                                                                </p>
                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="button" class="btn btn-outline-light"
                                                                    data-dismiss="modal">Close</button>
                                                                <form
                                                                    action="{{ route('historie.setPemenang', $item->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <button type="submit"
                                                                        class="btn btn-primary">YAKIN!</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" style="text-align: center" class="text-danger"><strong>Data masih
                                            kosong</strong></td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
