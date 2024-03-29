<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pengeluaran</title>
</head>
<body>
    <header class="text-center">
        <div class="row">
            <div class="col-4">
                <h1>{{config('app.name')}}</h1>
            </div>
            <div class="col-4">
                <h3>Laporan Transaksi Bulan ini Tahun ini</h3>
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
                            <thead style="background-color:#84B0CA;" class="text-white">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col" style="width: 100px;">Tanggal</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Deskripsi</th>
                                    <th scope="col" style="width: 120px;">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $total_expenses = 0; // Inisialisasi total pengeluaran
                                @endphp
                                @foreach ($expenses as $expense)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $expense->date }}</td>
                                    <td>{{ $expense->category ? $expense->category->name : 'No Category' }}</td>
                                    <td>{{ $expense->description }}</td>
                                    <td> Rp. {{ number_format($expense->total_amount, 0, ',', '.') }}</td>
                                    @php
                                    $total_expenses += $expense->total_amount; // Menambahkan total pengeluaran
                                    @endphp
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="4" class="text-right"><strong>Total Pengeluaran : </strong></td>
                                    <td><strong>Rp. {{ number_format($total_expenses, 0, ',', '.') }}</strong></td>
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
