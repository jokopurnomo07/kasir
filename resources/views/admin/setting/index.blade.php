@extends('layouts.header')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Pengaturan</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Pengaturan</li>
        </ol>
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header">
                        {{-- <h3>Data Kasir</h3> --}}
                        <button class="btn btn-primary" onclick="tampilModal()">
                            <i class="fas fa-plus-circle me-1"></i>
                            Pengguna
                        </button>
                    </div>
                    <div class="card-body">
                        <table class="text-center" id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>No Hp</th>
                                    <th>Status</th>
                                    <th><i class="fas fa-cog"></i></th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>No Hp</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($users as $k)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $k->name }}</td>
                                        <td>{{ $k->no_telepon }}</td>
                                        <td>
                                            @if ($k->status > 1)
                                                Kasir
                                            @else
                                                Administrator
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('category.destroy', $k->id) }}" method="POST">
                                                @csrf
                                                <button class="badge bg-danger btndelete" style="border: 0px;">
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

            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        @if (session()->has('error'))
                            <div class="alert alert-danger">
                                {{ session()->get('error') }}
                            </div>
                        @elseif (session()->has('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                        @foreach ($data as $d)
                            {{-- <form action="{{ route('setting.update', $d->id) }}" method="POST" enctype="multipart/form-data"> --}}
                            <form action="{{ route('setting.update', $d->id) }}" method="POST"
                                enctype="multipart/form-data">
                                {{-- @method('patch') --}}
                                @csrf
                                <input type="hidden" name="id" id="id" value="{{ $d->id }}">
                                <div class="mb-3">
                                    <label for="NamaToko" class="form-label">Nama Toko</label>
                                    <input type="text" class="form-control" id="NamaToko" name="nama"
                                        placeholder="{{ $d->nama }}" required autofocus value="{{ $d->nama }}">
                                </div>
                                <div class=" mb-3">
                                    <label for="Alamat" class="form-label">Alamat</label>
                                    <input type="text" class="form-control" id="Alamat" name="alamat"
                                        placeholder="{{ $d->alamat }}" required value="{{ $d->alamat }}">
                                </div>
                                {{-- <div class="mb-3">
                                <label for="logo" class="form-label">Gambar / Logo Toko</label>
                                <input class="form-control" type="file" id="logo" name="logo" required>
                            </div> --}}
                                <div class="mb-3">
                                    <select class="form-select" id="nota" name="nota"
                                        aria-label="Default select example">
                                        <option selected value="">Ukuran Nota</option>
                                        <option value="1">Kecil</option>
                                        <option value="2">Besar</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary btnsubmit">Simpan</button>
                            </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.setting.modal')

@endsection
@push('script')
    <script>
        $(document).ready(function(e) {
            $(".btnsubmit").click(function(e) {
                e.preventDefault();
                var _token = $("input[name='_token']").val();
                var nama = $("input[name='nama']").val();
                var alamat = $("input[name='alamat']").val();
                // var logo = $('#fileinput').prop('files');
                var nota = $('select[name=nota] option').filter(':selected').val();
                var Url = $(this).parents('form').attr('action');

                $.ajax({
                    type: 'PATCH',
                    url: Url,
                    data: {
                        _token: _token,
                        nama: nama,
                        alamat: alamat,
                        // logo: logo,
                        nota: nota,
                    },
                    success: function(data) {
                        if ($.isEmptyObject(data.error)) {
                            Swal.fire({
                                title: 'Success!',
                                text: data.success,
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

            });

        });

        function tampilModal() {
            $('#modalUser').modal('show');
            console.log('klik')
        }
    </script>
@endpush
