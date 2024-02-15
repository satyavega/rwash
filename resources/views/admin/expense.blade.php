@extends('admin.template.main')

@section('css')
    <link href="{{ asset('vendor/datatables-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/datatables-responsive/css/responsive.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('main-content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Riwayat Pengeluaran</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="tbl-history-expenses" class="table dt-responsive nowrap" style="width: 100%">
                                <thead class="thead-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Kategori</th>
                                        <th>Jumlah</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($expenses as $expense)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ date('d F Y', strtotime($expense->date)) }}</td>
                                        <td>{{ $expense->category->name }}</td>
                                        <td>Rp {{ number_format($expense->total_amount, 0, ',', '.') }}</td>
                                        <td>{{ $expense->description }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <nav class="d-flex justify-content-end " aria-label="...">
                        <ul class="pagination">
                            <!-- Tombol Previous -->
                            @if ($expenses->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link" tabindex="-1" aria-disabled="true">Previous</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $expenses->previousPageUrl() }}" tabindex="-1">Previous</a>
                                </li>
                            @endif

                            <!-- Tombol Halaman -->
                            @for ($page = 1; $page <= $totalPages; $page++)
                                <li class="page-item{{ $expenses->currentPage() == $page ? ' active' : '' }}">
                                    <a class="page-link" href="{{ $expenses->url($page) }}">{{ $page }}</a>
                                </li>
                            @endfor

                            <!-- Tombol Next -->
                            @if ($expenses->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $expenses->nextPageUrl() }}">Next</a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <span class="page-link">Next</span>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
@endsection
