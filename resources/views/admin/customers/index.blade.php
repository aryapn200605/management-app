@extends('admin.layouts.panel')

@section('title', 'Pelanggan')

@section('content-header')

@endsection

@section('content')

    <section>
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-striped" id="datatable">
                    <thead>
                        <tr class="text-center">
                            <th class="align-middle" style="width: 2%">No</th>
                            <th class="align-middle" style="width: 20%">Nama</th>
                            <th class="align-middle" style="width: 20%">No. Handphone</th>
                            <th class="align-middle" style="width: 40%">Alamat</th>
                            <th class="align-middle" style="width: 10%">Total Transaksi</th>
                            <th class="align-middle" style="width: 8%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <tr>
                            <td class="align-middle">1</td>
                            <td class="align-middle">Andi Suhhhh</td>
                            <td class="align-middle">086761273819238</td>
                            <td class="align-middle text-nowrap overflow-hidden">
                                @shortenText("Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque tenetur quae sunt eaque explicabo necessitatibus est dicta repellat sed voluptate porro accusantium aperiam temporibus nam quod architecto possimus quis, maiores quia facilis ad, suscipit ipsa. Rem, esse sit reiciendis eaque fuga ipsam nisi quaerat veritatis praesentium magnam, quam facilis sunt!")
                            </td>
                            <td class="align-middle">1</td>
                            <td class="align-middle">
                                <button type="button" class="btn btn-default dropdown-toggle dropdown-icon"
                                    data-toggle="dropdown">
                                    <i class="fa fa-pencil"></i>
                                </button>
                                <div class="dropdown-menu" role="menu">
                                    <a class="dropdown-item" href="#">Detail</a>
                                    <a class="dropdown-item" href="#">Edit</a>
                                    <a class="dropdown-item" href="#">Delete</a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

@endsection

@section('script')
    <script></script>
@endsection
