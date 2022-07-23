@extends('layouts.header')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Data Barang</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Data Barang</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <a class="btn btn-primary" href="{{ route('product.create') }}" role="button">
                    <i class="fas fa-plus-circle me-1"></i>
                    Barang
                </a>
            </div>
            <div class="card-body">
                <table class="text-center" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Merek</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Kategori Barang</th>
                            <th>Jenis Barang</th>
                            <th>Stok</th>
                            <th><i class="fas fa-cog"></i></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Merek</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Kategori Barang</th>
                            <th>Jenis Barang</th>
                            <th>Stok</th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($product as $b)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $b->nama }}</td>
                                <td>{{ $b->merek }}</td>
                                <td>{{ $b->harga_beli }}</td>
                                <td>{{ $b->harga_jual }}</td>
                                <td>{{ $b->category->kategori }}</td>
                                <td>{{ $b->category->jenis }}</td>
                                <td>{{ $b->stok }}</td>
                                <td>
                                    <form action="{{ route('product.destroy', $b->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="badge bg-danger btndelete" style="border: 0px;">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $(".btndelete").click(function(e) {
                e.preventDefault();
                var _token = $("input[name='_token']").val();
                var _method = $("input[name='_method']").val();
                var Url = $(this).parents('form').attr('action');

                Swal.fire({
                    title: 'Hapus data?',
                    icon: 'danger',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Delete',
                    denyButtonText: `Close`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: Url,
                            type: 'DELETE',
                            data: {
                                _token: _token
                            },
                            success: function(data) {
                                if ($.isEmptyObject(data.error)) {
                                    Swal.fire({
                                        title: data.success,
                                        icon: 'success',
                                        showConfirmButton: false
                                    })
                                    window.setTimeout(function() {
                                        location.reload();
                                    }, 1000);
                                } else {
                                    printErrorMsg(data.error);
                                }
                            }
                        });
                    }
                })

                function printErrorMsg(msg) {
                    $('.validation').addClass('is-invalid');
                    $.each(msg, function(key, value) {
                        $(".invalid-feedback").html(value);
                    });
                }
            });
        });
    </script>
@endpush
