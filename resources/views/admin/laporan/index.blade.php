@extends('layouts.header')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Data Laporan</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Data Laporan</li>
        </ol>
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <label for="laporan">Laporan</label>
                        <select class="form-select" id="laporan" aria-label="Default select example">
                            <option value="">-- Pilih Laporan Berdasarkan--</option>
                            <option value="1">Hari</option>
                            <option value="2">Bulan</option>
                            <option value="3">Tahun</option>
                        </select>
                    </div>
                </div>
                <div class="row d-block">
                    <h2>Laporan <span class="valSelect"></span></h2>

                    <div class="col-md-4">
                        <div class="table-responsive">
                            <table class="table table-bordered w-40">
                                <tr>
                                    <th scope="row">Modal</th>
                                    <td class="modals">Rp. 0</td>
                                </tr>
                                <tr>
                                    <th scope="row">Pendapatan</th>
                                    <td class="pendapatan">Rp. 0</td>
                                </tr>
                                <tr>
                                    <th scope="row">Laba</th>
                                    <td class="laba">Rp. 0</td>
                                </tr>
                                <tr>
                                    <th scope="row">Rugi</th>
                                    <td class="rugi">Rp. 0</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="col-md-2 btn_cetak">
                        <a class="mamadAjg">
                            <button type="button" class="btn btn-primary btn-sm">
                                <i class="fas fa-file-pdf"></i>
                                Download Laporan
                            </button>
                        </a>
                    </div>
                </div>
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
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Merek</th>
                                    <th scope="col">Modal</th>
                                    <th scope="col">Pendapatan</th>
                                    <th scope="col">Laba</th>
                                    <th scope="col">Rugi</th>
                                    <th scope="col">Kasir</th>
                                    <th scope="col">Tanggal</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $('.btn_cetak').hide()
        $('#laporan').on('change', function(){
            
            let val = $(this).val()
            let fill = $('.btn_cetak').val(val)

            if( val == 1 ){
                $('.valSelect').text('Harian')
            }

            if( val == 2 ){
                $('.valSelect').text('Bulanan')
            }

            if( val == 3 ){
                $('.valSelect').text('Tahunan')
            }

            $.ajax({
                type: "GET",
                url: "{{ route('data.laporan') }}",
                data: {
                    val: val,
                },
                success: function (res) {
                    
                    let pendapatan = res.pendapatan ? res.pendapatan : '0'
                    let modal = res.modal ? res.modal : '0'
                    let rugi = res.rugi ? res.rugi : '0'
                    let laba = res.laba ? res.laba : '0'

                    $('.modals').text('Rp. '+modal)
                    $('.rugi').text('Rp. '+rugi)
                    $('.laba').text('Rp. '+laba)
                    $('.pendapatan').text('Rp. '+pendapatan)

                    $('.btn_cetak').show()

                }
            });

        })

        $(document).on('click', '.btn_cetak', function(){
            let val = $(this).val()
            $('.mamadAjg').prop('href', '{{ url('cetak-laporan') }}/'+val)
        })

    </script>
@endpush
