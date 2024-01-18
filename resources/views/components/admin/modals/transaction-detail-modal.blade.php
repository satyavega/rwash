<div class="modal fade" id="transactionDetailModal" tabindex="-1" role="dialog"
    aria-labelledby="transactionDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="transactionDetailModalLabel">Detail Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>ID Transaksi: <span id="id-transaksi-detail"></span></h5>
                <div class="row">
                    <div class="col-12">
                        <table id="tbl-detail-transaksi" class="table table-bordered">
                            <thead class="">
                                <tr>
                                    <th>No</th>
                                    <th>Barang</th>
                                    <th>Servis</th>
                                    <th>Kategori</th>
                                    <th>Banyak</th>
                                    <th>Harga</th>
                                    <th>Sub Total</th>
                                </tr>
                            </thead>
                            <tbody id="tbl-ajax">
                            </tbody>
                            <tr>
                                <td colspan="6" class="text-center"><b>Tipe Servis</b></td>
                                <td><b><span id="service-type"></b></span></td>
                            </tr>
                            <tr>
                                <td colspan="6" class="text-center"><b>Dibayar</b></td>
                                <td><span id="payment-amount"></span></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
