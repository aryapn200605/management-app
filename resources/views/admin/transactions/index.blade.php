@extends('admin.layouts.panel')

@section('title', 'Transaksi')

@section('content-header')
    <div class="input-group date" id="reservationdate" data-target-input="nearest">
        <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" />
        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
        </div>
    </div>

@endsection

@section('content')

    <section>
        <div class="d-flex">
            <div class="form-group mr-2">
                <select class="form-control select2-danger" name="status" id="status-dropdown"
                    data-dropdown-css-class="select2-danger" style="width: 20vh;">
                    <option value="all" {{ $status == 'all' ? 'selected' : '' }}>Semuanya</option>
                    <option value="lunas" {{ $status == 'lunas' ? 'selected' : '' }}>Lunas</option>
                    <option value="belum-lunas" {{ $status == 'belum-lunas' ? 'selected' : '' }}>Belum Lunas</option>
                </select>
            </div>
            <div class="form-group">
                <select class="form-control select2-danger" name="lunas" id="type-dropdown"
                    data-dropdown-css-class="select2-danger" style="width: 20vh;">
                    <option value="all" {{ $type == 'all' ? 'selected' : '' }}>Semuanya</option>
                    <option value="proses" {{ $type == 'proses' ? 'selected' : '' }}>Proses</option>
                    <option value="selesai" {{ $type == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="batal" {{ $type == 'batal' ? 'selected' : '' }}>Dibatalkan</option>
                </select>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <table class="datatable table table-bordered table-striped">
                    <thead>
                        <tr class="text-center">
                            <th class="align-middle" style="width: 2%">No</th>
                            <th class="align-middle" style="width: 15%">Tanggal</th>
                            <th class="align-middle" style="width: 15%">Invoice</th>
                            <th class="align-middle" style="width: 15%">Nama Customer</th>
                            <th class="align-middle" style="width: 15%">Sisa Pembayaran</th>
                            <th class="align-middle" style="width: 15%">Total</th>
                            <th class="align-middle" style="width: 15%">Status Pembayaran</th>
                            <th class="align-middle" style="width: 3%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($datas as $data)
                            <tr>
                                <td class="align-middle">{{ $loop->iteration }}</td>
                                <td class="align-middle">{{ $data['batch']->created_at->format('d F Y') }}</td>
                                <td class="align-middle">{{ $data['batch']->invoice }}</td>
                                <td class="align-middle">{{ $data['batch']->name }}</td>
                                <td class="align-middle">Rp. @currency($data['batch']->paid_amount)</td>
                                <td class="align-middle">Rp. @currency($data['total'])</td>
                                <td class="align-middle">
                                    @if ($data['batch']->status == 1)
                                        <span class="badge bg-success">Lunas</span>
                                    @else
                                        <span class="badge bg-danger">Belum Lunas</span>
                                    @endif
                                    |
                                    @if ($data['batch']->type == 1)
                                        <span class="badge bg-warning">Proses</span>
                                    @elseif($data['batch']->type == 2)
                                        <span class="badge bg-success">Selesai</span>
                                    @elseif($data['batch']->type == 3)
                                        <span class="badge bg-danger">Dibatalkan</span>
                                    @endif
                                </td>
                                <td class="align-middle">
                                    <button type="button" class="btn btn-info btn-trx-info"
                                        data-id="{{ $data['batch']->invoice }}">
                                        <i class="fa fa-info"></i>
                                    </button>
                                    {{-- <button type="button" class="btn btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>


    @component('components.modal', [
        'id' => 'modal-info',
    ])
        @slot('title', 'Transaksi')

        @slot('body')
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="text" class="form-control" id="date" disabled>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Invoice</label>
                        <input type="text" class="form-control" id="invoice" disabled>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Customer</label>
                        <input type="text" class="form-control" id="customer" disabled>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>No. Handphone</label>
                        <input type="text" class="form-control" id="phone" disabled>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Total Pembelian</label>
                        <input type="text" class="form-control" id="total" disabled>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Sisa Pembayaran</label>
                        <input type="text" class="form-control" id="paid" disabled>
                    </div>
                </div>
                <div class="col-12">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Produk</th>
                                <th>Qty</th>
                                <th>Total Harga</th>
                            </tr>
                        </thead>
                        <tbody id="trx-details">
                            <!-- Detail transaksi akan ditampilkan di sini -->
                        </tbody>
                    </table>
                </div>
            </div>
        @endslot

        @slot('button')
            <button type="button" class="btn btn-success" id="btn-pay">
                Bayar Sisa
            </button>
            <button type="button" class="btn btn-info" id="btn-print">
                Print
            </button>
        @endslot
    @endcomponent

@endsection

@section('script')
    <script>
        $('#status-dropdown').on('change', function() {
            redirectToTransaction();
        });

        $('#type-dropdown').on('change', function() {
            redirectToTransaction();
        });

        $('#btn-pay').on('click', function() {
            $('#paid').prop('disabled', false).focus();
        });

        $('#paid').on('blur', function() {
            showConfirmationModal();
        })

        function showConfirmationModal() {
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda ingin mengubah nilai "Sisa Pembayaran"?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal',
                showCloseButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    // Implement your AJAX request here
                    // Example: ajaxUpdatePaidValue();
                } else if (result.dismiss === Swal.DismissReason.close) {
                    // If closed, focus on the "Paid" input
                    $('#paid').focus();
                } else {
                    // If canceled, disable the "Paid" input and return focus
                    $('#paid').prop('disabled', true).focus();
                }
            });
        }

        function redirectToTransaction() {
            var statusValue = $('#status-dropdown').val();
            var typeValue = $('#type-dropdown').val();

            var redirectUrl = 'transaction?status=' + encodeURIComponent(statusValue) + '&type=' + encodeURIComponent(
                typeValue);

            window.location.href = redirectUrl;
        }

        $('.btn-trx-info').on('click', function() {
            var batchId = $(this).data('id');

            // Kirim permintaan AJAX untuk mendapatkan data transaksi berdasarkan ID
            $.ajax({
                url: 'transaction/findOne/' + batchId,
                type: 'GET',
                success: function(response) {
                    $('#date').val(response.batch.created_at);
                    $('#invoice').val(response.batch.invoice);
                    $('#customer').val(response.batch.name);
                    $('#phone').val(response.batch.phone);
                    $('#total').val(response.total);
                    $('#paid').val(response.batch.paid_amount);

                    $('#trx-details').empty();

                    var rows = response.trx.map(function(trx) {
                        return '<tr>' +
                            '<td>' + trx.id + '</td>' +
                            '<td>' + trx.name + '</td>' +
                            '<td>' + trx.qty + '</td>' +
                            '<td>Rp. ' + (trx.total_price).toLocaleString('id-ID') + '</td>' +
                            '</tr>';
                    });

                    if (response.batch.paid_amount == 0) {
                        $('#btn-pay').prop('disabled', true);
                    } else {
                        $('#btn-pay').prop('disabled', false);
                    }

                    $('#trx-details').html(rows.join(''));


                    $('#modal-info').modal('show');
                },
                error: function(err) {
                    console.error(err);
                }
            });
        });
    </script>
@endsection
