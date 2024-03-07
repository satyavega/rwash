@extends('member.template.main')

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
                    <h1 class="m-0 text-dark">Input Transaksi</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @elseif (session('warning'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            {{ session('warning') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @elseif (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('member.transactions.store') }}" method="post">
                                @csrf
                                <div class="form-group row">
                                    <label for="barang" class="col-sm-2 col-form-label">Barang</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" id="barang" name="price_list_id">
                                            @foreach ($items as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="servis" class="col-sm-2 col-form-label">Servis</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" id="servis" name="service_type_id">
                                            @foreach ($services as $service)
                                            <option value="{{ $service->id }}">{{ $service->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="voucher" class="col-sm-2 col-form-label">Discount</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" id="voucher" name="voucher">
                                            <option value="0">No Voucher</option>
                                            @foreach ($userVouchers as $voucher)
                                            <option value="{{ $voucher->id }}">{{ $voucher->voucher->code }} - {{ $voucher->voucher->discount_value }}% off</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="delivery_service" class="col-sm-2 col-form-label">Delivery Service</label>
                                    <div class="col-sm-4">
                                        <input type="checkbox" id="delivery_service" name="delivery_service" data-toggle="delivery-charge"> Delivery Service
                                    </div>
                                </div>
                                <div class="form-group row" id="delivery-charge" style="display: none;">
                                    <label for="delivery_charge" class="col-sm-2 col-form-label">Delivery Charge</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="delivery_charge" name="delivery_charge" value="15000" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="payment_amount" class="col-sm-2 col-form-label">Payment Amount</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" id="payment_amount" name="payment_amount">
                                            <option value="cod">Cash on Delivery</option>
                                            <option value="transfer">Transfer</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="banyak" class="col-sm-2 col-form-label">Banyak</label>
                                    <div class="col-sm-2">
                                        <div class="input-group">
                                            <input type="number" id="quantity" name="quantity" class="form-control" value="1" min="1" max="100">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group-row">
                                    <div class="col-sm-4">
                                        <button type="submit" id="tambah-transaksi" class="btn btn-primary">Tambah Transaksi</button>
                                    </div>
                                </div>
                            </form>

                            <table id="tbl-input-transaksi" class="table mt-2 dt-responsive nowrap" style="width: 100%">
                                <thead class="thead-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Barang</th>
                                        <th>Servis</th>
                                        <th>Kategori</th>
                                        <th>Banyak</th>
                                        <th>Harga</th>
                                        <th>Pengiriman</th>
                                        <th>Biaya Pengiriman</th>
                                        <th>Total</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($member_transaction))
                                        @foreach ($member_transaction as $transaction)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $transaction['itemName'] }}</td>
                                                <td>{{ $transaction['serviceName'] }}</td>
                                                <td>{{ $transaction['categoryName'] }}</td>
                                                <td>{{ $transaction['quantity'] }}</td>
                                                <td>{{ $transaction['subTotal'] }}</td>
                                                <td>{{ $transaction['delivery_service'] ? 'Ya' : 'Tidak' }}</td>
                                                <td>{{ $transaction['delivery_charge'] }}</td>
                                                <td>{{ $transaction['subTotal'] + ($transaction['delivery_service'] ? $transaction['delivery_charge'] : 15000) }}</td>
                                                <td>
                                                    <a href="{{ route('member.transactions.session.destroy', ['rowId' => $transaction['rowId']]) }}" class="btn btn-danger">Hapus</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>

                            @if (isset($member_transaction))
                                <button id="btn-bayar" class="btn btn-success" data-toggle="modal"
                                    data-target="#paymentModal">Bayar</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('modals')
    <x-member.modals.payment-modal :$serviceTypes :vouchers="$vouchers ?? []" :totalPrice="$totalPrice ?? '0'" :show="isset($sessionTransaction)" />
@endsection

@section('scripts')
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#tbl-input-transaksi').DataTable({
                "searching": false,
                "bPaginate": false,
                "bLengthChange": false,
                "bFilter": false,
                "bInfo": false
            });
        });
    </script>

    @if (session('id_trs'))
        <script type="text/javascript">
            window.open('{{ route('admin.transactions.print.index', ['transaction' => session('id_trs')]) }}', '_blank');
        </script>
    @endif
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deliveryServiceCheckbox = document.getElementById('delivery_service');
        const deliveryChargeSection = document.getElementById('delivery_charge_section');
        const deliveryChargeInput = document.getElementById('delivery_charge');

        deliveryServiceCheckbox.addEventListener('change', function() {
            if (this.checked) {
                deliveryChargeSection.style.display = 'flex';
                deliveryChargeInput.value = '15000';

            } else {
                deliveryChargeSection.style.display = 'none';
                deliveryChargeInput.value = '0';
            }
        });
    });
</script>
