<!DOCTYPE html>
<html lang="en">

<head>
    <title>Laporan Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <style>

    </style>
</head>

<body>

    <header class="text-center">
        <div class="row">
            <div class="col-4">
                <h1>{{config('app.name')}}</h1>
            </div>
            <div class="col-4">
                <h3>Laporan Transaksi Tahun {{$yearInput}}</h3>
            </div>
            <div class="col-4">
            </div>
        </div>
    </header>
    <hr>
    <main>
        <div class="card">
            <div class="card-body">
              <div class="container mb-5 mt-3">
                <div class="container">
                  <div class="col-md-12">
                    <div class="text-center">
                      <i class="fab fa-mdb fa-4x ms-0" style="color:#5d9fc5 ;"></i>
                    </div>
                </div>
                <div class="row my-2 mx-1 justify-content-center">
                    <div class="col-6">
                        <table class="table table-striped">
                            <thead style="background-color:#84B0CA ;" class="text-white">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Tanggal Transaksi</th>
                                    <th scope="col">Nama Member</th>
                                    <th scope="col">Total Transaksi</th>
                                    <th scope="col">Total Akhir</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $rowNumber = 1; @endphp
                                @foreach($groupedData as $memberId => $dates)
                                    @foreach($dates as $date => $data)
                                        <tr>
                                            <td>{{ $rowNumber++ }}</td>
                                            <td>{{ $date }}</td>
                                            <td>{{ optional($transactions->firstWhere('member.id', $memberId)->member)->name }}</td>
                                            <td>{{ $data['transactions_count'] }}</td>
                                            <td>Rp {{ number_format($data['total_amount'], 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                                <tr>
                                    <td colspan="6"><hr></td>
                                </tr>
                                <tr style="padding-top: 10px">
                                    <td colspan="3" class="text-right"><strong>Total : </strong></td>
                                    <td><strong>{{$transactionsCount}} transaksi</strong></td>
                                    <td><strong>Rp {{ number_format($revenue, 0, ',', '.') }}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                </div>
              </div>
            </div>
          </div>
    </main>
    <hr>
    <footer class="text-end">
        <span class="text-muted small text-end">Dicetak pada {{date('d M Y')}}</span>
    </footer>

</body>

</html>
