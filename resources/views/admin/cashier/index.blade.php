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
            <form class="form-horizontal">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tanggal</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control tgl-input" placeholder="Tanggal" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nama</label>
                                <div class="input-group col-sm-9 ">
                                    <input type="text" class="form-control" placeholder="Nama Lengkap">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-danger">Cari</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">No. Invoice</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="No. Invoice"
                                        value="@invoiceNumber" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">No. Handphone</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="No. handphone">
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
                                <tbody>
                                    <tr>
                                        <td class="align-middle text-center">
                                            1
                                        </td>
                                        <td class="align-middle">
                                            Produk 1
                                        </td>
                                        <td><input type="text" class="form-control text-center" placeholder="Quantity">
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp.</span>
                                                </div>
                                                <input type="text" class="form-control text-right currency"
                                                    value="@currency(25000)">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp.</span>
                                                </div>
                                                <input type="text" class="form-control text-right currency"
                                                    value="@currency(25000)">
                                            </div>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-outline-danger btn-block">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" class="align-middle">
                                            <button type="button" class="btn btn-info btn-block">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
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
                            <button type="button" class="btn btn-danger">Belum Lunas</button>
                        </div>
                        <div class="col-3">
                            <p class="lead">Metode Pembayaran:</p>
                            <div class="btn-group">
                                <button type="button" class="btn btn-info">Cash</button>
                                <button type="button" class="btn btn-info">Transfer</button>
                            </div>
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
                                                    data-target="#reservationdate" />
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
                                                <input type="text" class="form-control text-right currency"
                                                    value="@currency(25000)" disabled>
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
                                                <input type="text" class="form-control text-right currency"
                                                    value="@currency(25000)">
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
                                                <input type="text" class="form-control text-right currency"
                                                    value="@currency(25000)" disabled>
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
                            <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i
                                    class="fas fa-print"></i> Print</a>
                            <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i>
                                Bayar
                            </button>
                            {{-- <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                                <i class="fas fa-download"></i> Generate PDF
                            </button> --}}
                        </div>
                    </div>
                </div>
                <!-- /.card-footer -->
            </form>
        </div>
        <!-- /.card -->
    </section>

@endsection

@section('script')
    <script></script>
@endsection
