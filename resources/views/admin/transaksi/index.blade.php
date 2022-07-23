@extends('layouts.header')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-2">Transaksi</h1>
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="col-md-4">
                            <div class="input-group">
                                <button class="btn btn-primary" id="Msearch" onclick="tampilProduk()">
                                    <i class="fas fa-search-plus"></i>
                                    Cari barang
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-stripped text-center" id="table-penjualan">
                            <thead>
                                <tr>
                                    <th>Nama _Produk</th>
                                    <th>Modal</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Sub</th>
                                    <th><i class="fas fa-cog"></i></th>
                                </tr>
                            </thead>
                            <tbody class="body_transaksi">
                                @if ( $datas !== null )
                                    @foreach ($datas->tr_detail as $item)
                                        <tr id="tr-{{ $item->id }}">
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->merek }}</td>
                                            <td>{{ $item->harga }}</td>
                                            <td class="col-1">
                                                <input type="number" name="qty" id="qty-{{ $item->id }}" data-id="{{ $item->id }}" data-product="{{ $item->product_id }}" class="form-control w-100 qty-{{ $item->id }}" onkeyup="hitungSubtotal({{ $item->id }})" value="{{ $item->qty }}" data-kue="{{ $item->harga }}">
                                            </td>
                                            <td class="harga-{{ $item->id }}" data-id="{{ $item->id }}">{{ $item->subtotal }}</td>
                                            <td>
                                                <button class="badge bg-danger btn_hapus" data-transaksi="{{ $item->transactions_id }}" data-id="{{ $item->id }}" style="border: 0px;">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-primary">
                    <div class="card-header">
                        <h3 class="card-title">Total Rp. <span class="total_harga">{{ $datas ? $datas->total : '' }}</span></h3>
                    </div>
                    <div class="card-body">
                        <div class="input-group">
                            <span class="input-group-text">Rp.</span>
                            <input type="text" class="form-control" name="bayar" id="bayarInput"
                                placeholder="Bayar" aria-label="Bayar" autocomplete="off">
                            <button class="btn btn-success" type="button" name="selesai" id="selesai" data-kue="{{ $datas ? $datas->id : '' }}"><i class="fas fa-check"></i></button>
                        </div>
                        <h5 class="text-bold mt-3">Kembalian : <span class="kembalian"></span></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.transaksi.produk')
    <style>
        #qty {
            padding: unset;
            font-size: unset;
            display: unset;
        }

    </style>
@endsection
@push('script')
    <script>

        function navtoggled() {
            $('.body').addClass("sb-sidenav-toggled");
        }

        function tampilProduk() {
            $('#ModalSearch').modal('show');
            const datatablesSimple = document.getElementById('table-produk');
            if (datatablesSimple) {
                new simpleDatatables.DataTable(datatablesSimple);
            }
        }

        $(document).on('keyup', '#bayarInput', function(){

            let val = $(this).val()
            let total = $('.total_harga').text()
            
            let kembalian = parseInt(val) - total
            
            let back = $('.kembalian').text(kembalian)
            
        })

        $(document).on('click', '#selesai', function(){

            let id = $(this).data('kue')
            let bayar = $('#bayarInput').val()
            let kembalian = $('.kembalian').text()
            if( bayar == '' ){

                Swal.fire('Sorry', 'Input Uang Pelanggan Dahulu', 'warning')

            }else{

                $.ajax({
                    type: "GET",
                    url: "{{ route('selesai.product') }}",
                    data: {
                        id: id,
                        bayar: bayar,
                        kembalian: kembalian,
                    },
                    success: function (res) {
                        window.location.href = '{{ url('cetak-transaksi') }}?data='+id
                    }
                });

            }

        })


    </script>
@endpush
