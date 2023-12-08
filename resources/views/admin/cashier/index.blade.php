@extends('admin.layouts.panel')

@section('title', 'Kasir')

@section('content-header')

@endsection

@section('content')

    <section>
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">E-Nota</h3>
            </div>
            <form action="{{ route('transaction') }}" method="post" class="form-horizontal">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tanggal</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control tgl-input" name="date"
                                        placeholder="Tanggal" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nama</label>
                                <div class="input-group col-sm-9 ">
                                    <input type="hidden" id="customer-id"name="customer_id" value="">
                                    <input type="text" class="form-control" name="customer" id="name-input"
                                        placeholder="Nama Lengkap" required>
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-danger find-customer-btn">Cari</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">No. Invoice</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="invoice" placeholder="No. Invoice"
                                        value="@invoiceNumber" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">No. Handphone</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="phone" id="phone-input"
                                        placeholder="No. handphone" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="text-center">
                                        <th style="width: 2.5%">No</th>
                                        <th style="width: 35%">Produk</th>
                                        <th style="width: 20%">Quantity</th>
                                        <th style="width: 20%">Harga Satuan</th>
                                        <th style="width: 20%">Total</th>
                                        <th style="width: 2.5%">Label</th>
                                    </tr>
                                </thead>
                                <tbody id="table-product">
                                    {{-- Table Append --}}
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="6" class="align-middle">
                                            <button type="button" class="btn btn-info btn-block find-product-btn">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </td>
                                    </tr>

                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-3">
                            <p class="lead">Status Pembayaran:</p>
                            <button type="button" class="btn btn-danger" id="payment-status">Belum Lunas</button>
                        </div>
                        <div class="col-3">
                            <p class="lead">Metode Pembayaran:</p>
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary payment" id="cash">Cash</button>
                                <button type="button" class="btn btn-outline-secondary payment"
                                    id="transfer">Transfer</button>
                            </div>
                            <input type="hidden" id="payment-method" name="payment_method" value="cash">
                        </div>
                        <!-- /.col -->
                        <div class="col-6">
                            <div class="table">
                                <table class="table">
                                    <tr>
                                        <th class="align-middle" style="width:50%">Tenggat Waktu (Deadline)</th>
                                        <td>
                                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input"
                                                    name="deadline" data-target="#reservationdate" id="deadline"
                                                    required />
                                                <div class="input-group-append" data-target="#reservationdate"
                                                    data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="align-middle" style="width:50%">Total Harga</th>
                                        <td>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp.</span>
                                                </div>
                                                <input type="text" class="form-control text-right separator"
                                                    name="grand_total" value="0" id="grand-total" readonly>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="align-middle">DP (Uang Muka)</th>
                                        <td>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp.</span>
                                                </div>
                                                <input type="text" class="form-control text-right separator"
                                                    value="0" name="deposits" id="deposits">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="align-middle">Sisa Pembayaran</th>
                                        <td>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp.</span>
                                                </div>
                                                <input type="text" class="form-control text-right separator"
                                                    name="paid_amount" value="0" id="pendingAmount" readonly>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                        <div class="col-12">
                            <button type="submit" class="btn btn-success float-right" id="btn-bayar" disabled><i
                                    class="far fa-credit-card"></i>
                                Bayar
                            </button>
                        </div>
                    </div>
                </div>
                <!-- /.card-footer -->
            </form>
        </div>
        <!-- /.card -->
    </section>

    @component('components.modal', [
        'id' => 'modal-customer',
    ])
        @slot('title', 'Cari Customer')

        @slot('body')
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Nama Customer">
                <div class="input-group-append">
                    <button type="button" class="btn btn-primary">Cari</button>
                </div>
            </div>
            <table class="table table-bordered table-striped mt-2">
                <thead>
                    <tr class="text-center">
                        <th class="align-middle" style="width: 2%">No</th>
                        <th class="align-middle" style="width: 30%">Nama</th>
                        <th class="align-middle" style="width: 30%">No. Handphone</th>
                        <th class="align-middle" style="width: 30%">Alamat</th>
                        <th class="align-middle" style="width: 8%">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-center" id="customer-table-body">
                    <!-- Customer data will be dynamically inserted here -->
                </tbody>
            </table>
        @endslot
    @endcomponent

    @component('components.modal', [
        'id' => 'modal-product',
    ])
        @slot('title', 'Cari Produk')

        @slot('body')
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Nama Produk">
                <div class="input-group-append">
                    <button type="button" class="btn btn-primary">Cari</button>
                </div>
            </div>
            <table class="table table-bordered table-striped mt-2">
                <thead>
                    <tr class="text-center">
                        <th class="align-middle" style="width: 2%">No</th>
                        <th class="align-middle" style="width: 45%">Nama</th>
                        <th class="align-middle" style="width: 45%">Harga Satuan</th>
                        <th class="align-middle" style="width: 8%">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-center" id="product-table-body">
                    <!-- Customer data will be dynamically inserted here -->
                </tbody>
            </table>
        @endslot
    @endcomponent
@endsection


@section('script')
    <script>
        var productObject = [];
        var productIndex = 1;

        $('.find-customer-btn').on('click', function() {
            url = "{{ route('findAllCustomer') }}"

            $.ajax({
                url: url,
                method: 'GET',
                success: function(data) {
                    var html = '';
                    $.each(data, function(index, customer) {
                        html += '<tr>' +
                            '<td class="align-middle">' + (index + 1) + '</td>' +
                            '<td class="align-middle">' + customer.name + '</td>' +
                            '<td class="align-middle">' + customer.phone + '</td>' +
                            '<td class="align-middle">' + customer.address + '</td>' +
                            '<td class="align-middle">' +
                            '<button type="button" class="btn btn-success" onclick="selectCustomer(' +
                            customer.id + ', \'' + customer.name + '\', \'' + customer.phone +
                            '\')">Pilih</button>' +
                            '</td>' +
                            '</tr>';
                    });

                    $('#customer-table-body').html(html);

                    $('#modal-customer').modal('show');
                },
                error: function(error) {
                    console.error(error);
                }
            });
        });

        function selectCustomer(customerId, customerName, customerPhone) {
            $('#modal-customer').modal('hide');
            $('#customer-id').val(customerId);
            $('#name-input').val(customerName);
            $('#phone-input').val(customerPhone);
        }

        $('.payment').click(function() {
            var selectedPayment = $(this).attr('id');
            $('#' + selectedPayment).removeClass('btn-outline-secondary').addClass('btn-primary');
            $('.payment').not('#' + selectedPayment).removeClass('btn-primary').addClass('btn-outline-secondary');
            $('#payment-method').val(selectedPayment);
        });

        $('.find-product-btn').on('click', function() {
            url = "{{ route('findAllProduct') }}"

            productIds = productObject.map(function(product) {
                return product.id;
            })

            $.ajax({
                url: url,
                method: 'GET',
                success: function(data) {
                    var html = '';
                    $.each(data, function(index, product) {
                        if (productIds.indexOf(product.id) === -1) {
                            html += '<tr>' +
                                '<td class="align-middle">' + (index + 1) + '</td>' +
                                '<td class="align-middle">' + product.name + '</td>' +
                                '<td class="align-middle">' + product.price + '</td>' +
                                '<td class="align-middle">' +
                                '<button type="button" class="btn btn-success" onclick="selectProduct(' +
                                product.id + ', \'' + product.name + '\', \'' + product.price +
                                '\')">Pilih</button>' +
                                '</td>' +
                                '</tr>';
                        }
                    });

                    $('#product-table-body').html(html);

                    $('#modal-product').modal('show');
                },
                error: function(error) {
                    console.error(error);
                }
            });
        });

        $('#table-product').on('change', '[id^="qty_"]', function() {
            updateTotal($(this).attr('id'));
        });

        $('#table-product').on('change', '[id^="price_"]', function() {
            updatePrice($(this).attr('id'));
        });

        $('#table-product').on('change', '[id^="total_"]', function() {
            updateTotalAndPrice($(this).attr('id'));
        });

        $('#deposits').on('input', function() {
            updateDeposit();
        });

        function selectProduct(id, name, price) {
            $('#modal-product').modal('hide');

            var object = {
                id: id,
                name: name,
                qty: 1,
                price: price,
                total: price
            }

            productObject.push(object);
            renderTable()
        }

        function renderTable() {
            var productIndex = 1;
            var html = productObject.map(product => `
                <tr>
                    <td class="align-middle">${productIndex++}</td>
                    <input type="hidden" id="product-id" name="product_id[]" value="${product.id}">
                    <td class="align-middle">
                        <input type="text" class="form-control text-center separator" value="${product.name}" 
                            id="name_${product.id}" placeholder="Nama Produk" name="name[]" disabled>
                    </td>
                    <td class="align-middle">
                        <input type="text" class="form-control text-center separator" value="${product.qty}" 
                            id="qty_${product.id}" placeholder="Quantity" name="qty[]">
                    </td>
                    <td class="align-middle">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp.</span>
                            </div>
                            <input type="text" class="form-control text-right separator" value="${product.price}" 
                                id="price_${product.id}" name="price[]">
                        </div>
                    </td>
                    <td class="align-middle">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp.</span>
                            </div>
                            <input type="text" class="form-control text-right separator" value="${product.total}" 
                                id="total_${product.id}" name="total[]">
                        </div>
                    </td>
                    <td>
                        <button type="button" class="btn btn-outline-danger btn-block" 
                                onclick="removeProductRow(${product.id})">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
            `).join('');


            calculateGrandTotal();
            updateDeposit();

            var isProductObjectNotEmpty = productObject.length > 0;
            $('#btn-bayar').prop('disabled', !isProductObjectNotEmpty);

            $('#table-product').html(html);
        }

        function removeProductRow(productId) {
            var index = productObject.findIndex(product => product.id == productId);
            if (index !== -1) {
                productObject.splice(index, 1);
                renderTable();
            }
        }

        function updateTotal(qtyId) {
            var productId = qtyId.split('_')[1];
            var priceId = 'price_' + productId;
            var totalId = 'total_' + productId;

            var qty = $('#' + qtyId).val();
            var price = $('#' + priceId).val();

            var total = Math.round(parseFloat(qty) * parseFloat(price));

            $('#' + totalId).val(total);

            updateProductObject(productId, 'qty', Math.round(qty));
            updateProductObject(productId, 'total', total);
        }

        function updatePrice(priceId) {
            var productId = priceId.split('_')[1];
            var qtyId = 'qty_' + productId;
            var totalId = 'total_' + productId;

            var qtyInput = $('#' + qtyId);
            var priceInput = $('#' + priceId);
            var totalInput = $('#' + totalId);

            var qty = Math.round(parseFloat(qtyInput.val())) || 0;
            var price = Math.round(parseFloat(priceInput.val())) || 0;

            if (qty < 1 || isNaN(qty)) {
                qtyInput.val(1);
                qty = 1;
            }

            var total = qty * price;

            totalInput.val(total);

            updateProductObject(productId, 'qty', qty);
            updateProductObject(productId, 'price', price);
            updateProductObject(productId, 'total', total);
        }

        function updateTotalAndPrice(totalId) {
            var productId = totalId.split('_')[1];
            var qtyId = 'qty_' + productId;
            var priceId = 'price_' + productId;

            var qtyInput = $('#' + qtyId);
            var priceInput = $('#' + priceId);
            var totalInput = $('#' + totalId);

            var qty = Math.round(parseFloat(qtyInput.val())) || 0;
            var total = Math.round(parseFloat(totalInput.val())) || 0;

            if (qty < 1 || isNaN(qty)) {
                qtyInput.val(1);
                qty = 1;
            }

            var price = Math.round(total / qty);
            priceInput.val(price);

            totalInput.val(qty * price);

            updateProductObject(productId, 'qty', qty);
            updateProductObject(productId, 'price', price);
            updateProductObject(productId, 'total', total);
        }

        function updateProductObject(productId, field, value) {
            var index = productObject.findIndex(product => product.id == productId);
            if (index !== -1) {
                productObject[index][field] = value;
                calculateGrandTotal();
            }
        }

        function calculateGrandTotal() {
            var grandTotal = 0;
            productObject.forEach(product => {
                grandTotal += parseInt(product.total) || 0;
            });
            $('#grand-total').val(grandTotal);
            $('#pendingAmount').val(grandTotal);
        }

        function updateDeposit() {
            var deposit = parseInt($('#deposits').val()) || 0;
            var grandTotal = parseInt($('#grand-total').val()) || 0;
            var paymentStatusButton = $('#payment-status');

            if (deposit >= grandTotal) {
                $('#deposits').val(grandTotal);
                deposit = grandTotal;

                paymentStatusButton.removeClass('btn-danger').addClass('btn-success').text('Lunas');
            } else {
                paymentStatusButton.removeClass('btn-success').addClass('btn-danger').text('Belum Lunas');
            }

            var pendingAmount = grandTotal - deposit;
            $('#pendingAmount').val(pendingAmount);
        }
    </script>
@endsection
