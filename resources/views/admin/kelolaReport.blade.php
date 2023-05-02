@extends('layouts.adminMain')

@section('container')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold ">Laporan User</h6>
            </div>

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th data-orderable="false">No</th>
                                <th>Nama Tanaman</th>
                                <th>Jumlah Report</th>

                                <th>Gambar</th>
                                <th>Aksi</th>

                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($reports as $report)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $report->tanaman->nama_tanaman }}</td>
                                    <td>{{ $reportDetail->where('tanaman_id', $report->tanaman_id)->count() }}</td>

                                    <td><img width="150px" src="{{ Storage::url($report->tanaman->gambar) }}"></td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#lihatDetail-{{ $report->tanaman_id }}"
                                                data-bs-whatever="@getbootstrap"><i class="fas fa-comment"></i></button>
                                            <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                                data-bs-target="#detailTanaman-{{ $report->tanaman_id }}"
                                                data-bs-whatever="@getbootstrap"><i class="fas fa-eye"></i></button>


                                            <a class="btn btn-success" href="/homeAdmin/{{ $report->tanaman_id }}/edit"><i
                                                    class="fas fa-edit"></i></a>

                                            <form action="tanaman/{{ $report->tanaman_id }}" method="post">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Yakin ingin menghapus tanaman ini?');"><i
                                                        class="fas fa-trash"></i></button>
                                            </form>


                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                        {{-- <tfoot>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Total Pemasukan :</td>
                                <td> Rp
                                    {{ number_format($trx->where('status', '!=', 'menunggu pembayaran')->sum('harga_trx'), 2, ',', '.') }}
                                </td>
                                <td></td>
                                @can('kasir')
                                    <td></td>
                                @endcan

                                <td></td>
                            </tr>
                        </tfoot> --}}
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    </div>

    @foreach ($reportDetail as $detail)
        <div class="modal" id="lihatDetail-{{ $detail->tanaman_id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">

            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">

                        <h4 class="modal-title text-center mx-auto" id="exampleModalLabel">
                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;{{ strtoupper($detail->tanaman->nama_tanaman) }}</h4>

                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <h5>Jumlah : {{ $reportDetail->where('tanaman_id', $detail->tanaman_id)->count() }}</h5>
                        <table class="table table-striped table-advance table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Pesan</th>
                                    <th>Pelapor</th>
                                    <th>Waktu</th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reportDetail->where('tanaman_id', $detail->tanaman_id) as $report)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $report->pesan }}</td>
                                        <td>{{ $report->user->fullname }}</td>
                                        <td>{{ $report->created_at_formatted }}</td>



                                    </tr>
                                @endforeach
                            </tbody>
                        </table>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


    @foreach ($reportDetail as $detail)
        <div class="modal" id="detailTanaman-{{ $detail->tanaman_id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">

            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">

                        <h4 class="modal-title text-center mx-auto" id="exampleModalLabel">
                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;{{ strtoupper($detail->tanaman->nama_tanaman) }}</h4>

                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5>Penulis</h5>
                        <p>{{ $detail->tanaman->user->fullname }}</p>
                        <h5>Deskripsi</h5>
                        <p>{{ $detail->tanaman->desk }}</p>
                        <h5>khasiat</h5>
                        <p>{{ $detail->tanaman->khasiat }}</p>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{-- @foreach ($detail as $trx)
        <div class="modal" id="updatePembayaran-{{ $trx->kode_trx }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">

            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title centered" id="exampleModalLabel">
                            &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            UPDATE </h2>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5>{{ $trx->kode_trx }}</h5>
                        <table class="table table-striped table-advance table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Menu</th>
                                    <th>Qty</th>
                                    <th>Harga</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($notas->where('kode_trx', $trx->kode_trx) as $nota)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $nota->menu->nama_menu }}</td>
                                        <td>{{ $nota->jml_beli }} </td>
                                        <td>Rp {{ number_format($nota->total_harga, 2, ',', '.') }}</td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                        <h6>Total Harga : Rp
                            {{ number_format($trx->harga_trx, 2, ',', '.') }}
                            </td>
                        </h6>
                        </br>

                        <form action="/homeAdmin/keloladaftar/bayar/{{ $trx->kode_trx }}" method="post">
                            @csrf
                            <div class="kasir">
                                <input type="hidden" name="total_harga" id="total" class="total"
                                    data-price="{{ $trx->harga_trx }}" value="{{ $trx->harga_trx }}">
                                <h6>Total bayar&nbsp;
                                    <input type="number" id="bayar" name="total_bayar" step="100" min="0"
                                        value="{{ $trx->total_bayar }}" class="form-control" required>

                                </h6>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($detail as $trx)
        <div class="modal" id="lihatDetail-{{ $trx->kode_trx }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">

            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title centered" id="exampleModalLabel">
                            &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                            DETAIL TRANSAKSI </h2>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5>{{ $trx->kode_trx }}</h5>
                        <table class="table table-striped table-advance table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Menu</th>
                                    <th>Qty</th>
                                    <th>Harga</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($notas->where('kode_trx', $trx->kode_trx) as $nota)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $nota->menu->nama_menu }}</td>
                                        <td>{{ $nota->jml_beli }} </td>
                                        <td>Rp {{ number_format($nota->total_harga, 2, ',', '.') }}</td>

                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                        <h6>Total Harga :
                            Rp
                            {{ number_format($trx->harga_trx, 2, ',', '.') }}
                            </td>
                            </br></br>
                            Total bayar&nbsp; :
                            Rp {{ number_format($trx->total_bayar, 2, ',', '.') }}</td>
                            </br></br>
                            Kembali &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;:
                            Rp {{ number_format($trx->kembalian, 2, ',', '.') }}</td>
                        </h6>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!-- End of Main Content --> --}}

    <!-- Footer -->
@endsection
