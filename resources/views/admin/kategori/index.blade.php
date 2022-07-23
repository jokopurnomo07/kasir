@extends('layouts.header')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Kategori</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Kategori</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <a class="btn btn-primary" href="#" role="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="fas fa-plus-circle me-1"></i>
                    Kategori
                </a>
            </div>
            <div class="card-body">
                <table class="text-center" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kategori</th>
                            <th>Jenis</th>
                            <th><i class="fas fa-cog"></i></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Kategori</th>
                            <th>Jenis</th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($category as $k)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $k->kategori }}</td>
                                <td>{{ $k->jenis }}</td>
                                <td>
                                    <form action="{{ route('category.destroy', $k->id) }}" method="POST">
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

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        @csrf
                        <div class="mb-3">
                            <input type="text" class="form-control validation" name="kategori"
                                placeholder="Kategori Barang">
                            <div class="invalid-feedback ekategori">
                            </div>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control validation" name="jenis" placeholder="Jenis Barang">
                            <div class="invalid-feedback ejenis">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" id="btnsubmit">Submit</button>
                    </form>
                </div>
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
                var kategori = $("input[name='kategori']").val();
                var jenis = $("input[name='jenis']").val();

                $.ajax({
                    url: "{{ route('category.store') }}",
                    type: 'POST',
                    data: {
                        _token: _token,
                        kategori: kategori,
                        jenis: jenis,
                    },
                    success: function(data) {
                        if ($.isEmptyObject(data.error)) {
                            Swal.fire({
                                title: 'Success',
                                text: data.success,
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

                function printErrorMsg(msg) {
                    $('.validation').addClass('is-invalid');
                    $.each(msg, function(key, value) {
                        cek(key, value);
                    });
                }

                function cek(key, value) {
                    if (key === 0) {
                        $(".ekategori").html(value);
                    } else {
                        $(".ejenis").html(value);
                    }
                }
            });

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
                                        title: 'Success!',
                                        title: data.success,
                                        icon: 'success',
                                        showConfirmButton: false
                                    })
                                    window.setTimeout(function() {
                                        location.reload();
                                    }, 1000);
                                } else {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: data.error,
                                        icon: 'error',
                                        showConfirmButton: false
                                    })
                                    window.setTimeout(function() {
                                        location.reload();
                                    }, 1000);
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
