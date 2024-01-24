@extends('admin.template.main')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="base_url" content="{{ url('admin') }}">
@endsection

@section('main-content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark text-bold">Laporan Keuangan</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <h3 class="m-3 text-dark">Laporan Bulanan</h3>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-5">
                                    <form action="{{ route('admin.reports.print') }}" method="post" id="form-cetak" target="_blank">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="tahun" class="col-sm-4 col-form-label">Tahun</label>
                                            <div class="col-sm-6">
                                                <select class="form-control" id="tahun" name="year">
                                                    <option value="0" selected="selected" disabled="true">-- Pilih Tahun
                                                        --</option>
                                                    @foreach ($years as $year)
                                                        <option value="{{ $year->Tahun }}">{{ $year->Tahun }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="bulan" class="col-sm-4 col-form-label">Bulan</label>
                                            <div class="col-sm-6">
                                                <select class="form-control" id="bulan" name="month">
                                                    <option value="0" selected="selected" disabled="true">-- Pilih Tahun Dahulu --</option>
                                                </select>
                                            </div>
                                        </div>
                                        <button type="submit" href="#" id="btn-cetak" class="mt-3 btn btn-primary">Cetak Laporan Bulanan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <h3 class="m-3 text-dark">Laporan Tahunan</h3>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-5">
                                    <form action="{{ route('admin.reports.printYearly') }}" method="post" id="form-cetak-tahunan" target="_blank">
                                    @csrf
                                        <div class="form-group row">
                                            <label for="tahun-tahunan" class="col-sm-4 col-form-label">Tahun</label>
                                                <div class="col-sm-6">
                                                    <select class="form-control" id="tahun-tahunan" name="year">
                                                        <option value="0" selected="selected" disabled="true">-- Pilih Tahun --</option>
                                                        @foreach ($years as $year)
                                                        <option value="{{ $year->Tahun }}">{{ $year->Tahun }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                        </div>
                                    <button type="submit" href="#" class="mt-3 btn btn-primary">Cetak Laporan Tahunan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark text-bold">Laporan Transaksi</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6 d-flex justify-content-center align-items-center">
                <canvas id="myChartDaily" width="300" height="300"></canvas>
            </div>
            <div class="col-md-6 d-flex justify-content-center align-items-center border-left">
                <canvas id="myChartMonthly" width="300" height="300"></canvas>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const dateLabels = {!! json_encode($dateLabelsMonthly) !!};
const transactionData = {!! json_encode($dataChartMonthly) !!};

const data = dateLabels.map(label => transactionData[label] || 0);

var ctxMonthly = document.getElementById('myChartMonthly').getContext('2d');
var myChartMonthly = new Chart(ctxMonthly, {
    type: 'bar',
    data: {
        labels: dateLabels,
        datasets: [{
            label: '# of Transactions (Monthly)',
            data: data,
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    },
    options: {}
});

var ctxDaily = document.getElementById('myChartDaily').getContext('2d');
var myChartDaily = new Chart(ctxDaily, {
    type: 'bar',
    data: {
        labels: {!! json_encode($dateLabelsDaily) !!},
        datasets: [{
            label: '# of Transactions (Daily)',
            data: {!! json_encode($dataChartDaily) !!},
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
        }]
    },
    options: {}
});
</script>
<script src="{{ asset('js/ajax.js') }}"></script>
@endsection
