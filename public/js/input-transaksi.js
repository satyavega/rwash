$(document).ready(function() {
    let subTotal = 0;
    let fixTotal = 0;
    let tempPotongan = 0;
    let tempCost = 0;

    // Inisialisasi dan penghitungan subtotal
    updateSubTotal();

    // Event: Pilihan barang berubah
    $('#barang').on('change', function() {
        updateSubTotal();
    });

    // Event: Modal pembayaran ditampilkan
    $("#bayarModal").on("shown.bs.modal", function () {
        $(this).find("#input-bayar").focus();
    });

    // Event: Perubahan pada input pembayaran
    $("#input-bayar").on("keyup", function () {
        $("#kembalian").html($("#input-bayar").val() - fixTotal);
    });

    // Event: Tombol simpan pada modal pembayaran diklik
    $("#btn-simpan").on("click", function (event) {
        if (parseInt($("#input-bayar").val()) < fixTotal || $("#input-bayar").val() == "") {
            event.preventDefault();
            alert("Pembayaran kurang!");
        } else {
            // Kirim data transaksi
            submitTransaction();
        }
    });

    // Event: Perubahan voucher
    $("#voucher").on("change", function () {
        let potongan = $("option:selected", this).data("potong");
        tempPotongan = potongan;
        recalculateTotal();
    });

    // Event: Perubahan jenis servis
    $("#service-type").on("change", function () {
        let cost = $("option:selected", this).data("type-cost");
        tempCost = cost;
        recalculateTotal();
    });

    // Fungsi untuk mengupdate subtotal
    function updateSubTotal() {
        let items = $('#barang').val(); // Array ID item yang dipilih
        subTotal = 0;

        items.forEach(function(itemId) {
            let itemPrice = getItemPrice(itemId); // Fungsi untuk mendapatkan harga item
            let quantity = 1; // Sesuaikan dengan logika pengambilan kuantitas
            subTotal += itemPrice * quantity;
        });

        recalculateTotal();
    }
    function getItemPrice(itemId, categoryId, serviceId, callback) {
        $.ajax({
            url: '/api/prices',
            type: 'GET',
            data: {
                item_id: itemId,
                category_id: categoryId,
                service_id: serviceId
            },
            success: function(response) {
                // Asumsikan response adalah objek yang mengandung harga
                callback(response.price);
            },
            error: function() {
                alert("Error mengambil data harga");
                callback(0);
            }
        });
    }
    items.forEach(function(itemId) {
        // Dapatkan categoryId dan serviceId dari elemen UI
        let categoryId = $("#kategori").val();
        let serviceId = $("#servis").val();

        getItemPrice(itemId, categoryId, serviceId, function(price) {
            let quantity = 1; // Sesuaikan dengan logika pengambilan kuantitas
            subTotal += price * quantity;
            // Update subtotal di UI
        });
    });

    // Fungsi untuk menghitung total
    function recalculateTotal() {
        fixTotal = subTotal - tempPotongan + tempCost;
        fixTotal = Math.max(fixTotal, 0); // Pastikan tidak negatif
        $("#total-harga").val(fixTotal);
        $("#kembalian").html($("#input-bayar").val() - fixTotal);
    }

    // Fungsi untuk mengirim data transaksi
    function submitTransaction() {
        $.ajax({
            url: 'URL_KE_SERVER', // URL server untuk menghandle transaksi
            type: 'POST',
            data: $('#transaction-form').serialize(),
            success: function(response) {
                // Proses jika berhasil
                alert('Transaksi berhasil disimpan');
            },
            error: function(xhr, status, error) {
                // Proses jika terjadi error
                alert('Terjadi kesalahan: ' + error);
            }
        });
    }
});
