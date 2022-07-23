@extends('layouts.header')

@section('content')
    <div class="container-fluid px-4">
        <h2 class="mt-3" style="margin-left: 16px">Tambah Data Barang Kulaan</h2>
        {{-- <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Data Barang</li>
        </ol> --}}
        <div>
            <div class="card-body">
                <form class="form-product">
                    @csrf
                    <div class="mb-3">
                        <input type="text" class="form-control validation" name="nama" placeholder="Nama Barang" autofocus
                            required>
                        <div class="invalid-feedback enama">
                        </div>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control validation" name="merek" placeholder="Merek" required>
                        <div class="invalid-feedback emerek">
                        </div>
                    </div>
                    <div class="mb-2">
                        <select class="form-select validation" name="category_id" id="category_id"
                            aria-label="Default select example" required>
                            <option selected value="">Pilih kategori barang</option>
                            @foreach ($category as $p)
                                <option value="{{ $p->id }}">{{ $p->jenis . ' - ' . $p->kategori }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback ecategory">
                        </div>
                    </div>
                    <div class="mb-3">
                        <input type="number" class="form-control validation" name="hargabeli" placeholder="Harga Beli"
                            required>
                        <div class="invalid-feedback ehargabeli">
                        </div>
                    </div>
                    <div class="mb-3">
                        <input type="number" class="form-control validation" name="hargajual1" placeholder="Harga Jual"
                            required>
                        <div class="invalid-feedback ehargajual1">
                        </div>
                    </div>
                    <div class="mb-3">
                        <input type="number " class="form-control validation" name="hargajual2" id="hargajual2"
                            placeholder="Harga Jual Opsional" disabled>
                        <div class="invalid-feedback ehargajual2">
                        </div>
                    </div>
                    <div class="mb-3">
                        <input type="number" class="form-control validation" name="stok" placeholder="Jumlah Stok" required>
                        <div class="invalid-feedback estok">
                        </div>
                    </div>
                    <a class="btn btn-secondary" href="{{ route('product.index') }}" role="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" style="margin-bottom: 15%"
                            fill="currentColor" class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
                            <path
                                d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
                        </svg>
                    </a>
                    <button type="submit" class="btn btn-primary" id="btnsubmit">Submit</button>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script>
        $(document).ready(function(e) {
            $("#btnsubmit").click(function(e) {
                e.preventDefault();
                var _token = $("input[name='_token']").val();
                var nama = $("input[name='nama']").val();
                var merek = $("input[name='merek']").val();
                var category_id = document.getElementById("category_id").value;
                var hargabeli = $("input[name='hargabeli']").val();
                var hargajual1 = $("input[name='hargajual1']").val();
                var hargajual2 = $("input[name='hargajual2']").val();
                var stok = $("input[name='stok']").val();

                $.ajax({
                    url: "{{ route('product.store') }}",
                    type: 'POST',
                    data: {
                        _token: _token,
                        nama: nama,
                        merek: merek,
                        category_id: category_id,
                        hargabeli: hargabeli,
                        hargajual1: hargajual1,
                        hargajual2: hargajual2,
                        stok: stok,
                    },
                    success: function(data) {
                        if ($.isEmptyObject(data.error)) {
                            // Swal.fire({
                            //     title: 'Success!',
                            //     text: data.success,
                            //     icon: 'success',
                            //     showConfirmButton: false
                            // })
                            // window.setTimeout(function() {
                            //     location.reload();
                            // }, 1000);
                            console.log(data.success)
                        } else {
                            printErrorMsg(data.error);
                            console.log(cek(key, value))
                        }
                    }
                });

                function printErrorMsg(msg) {
                    $('.validation').addClass('is-invalid');
                    $.each(msg, function(key, value) {
                        cek(key, value);
                    });
                }

            });

            function cek(key, value) {
                if (key === 0) {
                    $(".enama").html(value);
                } else if (key === 1) {
                    $(".emerek").html(value);
                } else if (key === 2) {
                    $(".ecategory").html(value);
                } else if (key === 3) {
                    $(".ehargabeli").html(value);
                } else if (key === 4) {
                    $(".ehargajual1").html(value);
                } else {
                    $(".estok").html(value);
                }
            }


            $("#category_id").change(function(e) {

                e.preventDefault();
                var id = $('select[name=category_id] option').filter(':selected').val();

                $.ajax({
                    url: "{{ route('product.validasi') }}",
                    type: 'GET',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        if ($.isEmptyObject(data.error)) {
                            $("#hargajual2").removeAttr('disabled');
                        } else {
                            $("#hargajual2").prop("value", 0);
                            $("#hargajual2").prop("disabled", true);
                        }
                    }
                });

            });

        });
    </script>
@endpush
