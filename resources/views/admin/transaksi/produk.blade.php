<div class="modal fade" id="ModalSearch" tabindex="-1" aria-labelledby="ModalSearchLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="text-center table-produk" id="table-produk">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Merek</th>
                            <th>Harga Jual</th>
                            <th><i class="fas fa-cog"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($product as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->merek }}</td>
                            <td>{{ $item->harga_jual }}</td>
                            <td>
                                <button class="badge bg-primary btn_click" style="border: 0px;" data-id="{{ $item->id }}">
                                    <i class="fas fa-arrow-alt-circle-right"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('script')
    
<script>

    $(document).on('click', '.btn_click', function(){
        let ide = $(this).data('id')
        $.ajax({
            type: "GET",
            url: "{{ route('get.product') }}",
            data: {
                id: ide,
                no: '{{ session()->get('no') }}'
            },
            success: function (res) {
                
                let data = res.data
                
                if( res.status == 1 ){
                    
                    Swal.fire('Sorry', `Data Sudah Ada Ditable`, 'warning')
                    
                }else{

                    let html = `
                    <tr id="tr-${data.id}">
                        <td>${data.nama}</td>
                        <td>${data.merek}</td>
                        <td>${data.harga}</td>
                        <td class="col-1">
                            <input type="number" name="qty" id="qty-${data.id}" data-id="${data.id}" data-product="${data.product_id}" class="form-control w-100 qty-${data.id}" onkeyup="hitungSubtotal(${data.id})" value="1" data-kue="${data.harga}">
                        </td>
                        <td class="harga-${data.id}" data-id="${data.id}">${data.harga}</td>
                        <td>
                            <button class="badge bg-danger btn_hapus" data-transaksi="${data.transactions_id}" data-id="${data.id}" style="border: 0px;">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                    `

                    $('.total_harga').text()
                    $('.body_transaksi').append(html)

                }

            }
        });
        
    })

    $(document).on('click', '.btn_hapus', function(){
        let id = $(this).data('id')
        let transaksi = $(this).data('transaksi')

        $.ajax({
            type: "GET",
            url: "{{ route('delete.product') }}",
            data: {
                id: id,
                transaksi: transaksi,
            },
            success: function (res) {
                $('.total_harga').text(res.total)
            }
        });

        $('#tr-'+id).remove()
    })

    function hitungSubtotal(id){

        if( $('#qty-'+id).val() == '' ){
            $('#qty-'+id).val(0)
        }

        let kue = $('#qty-'+id).data('kue')
        let ide = $('#qty-'+id).data('id')
        let produk = $('#qty-'+id).data('product')
        let val = $('#qty-'+id).val()

        $.ajax({
            type: "GET",
            url: "{{ route('update.product') }}",
            data: {
                id: ide,
                val: val,
                kue: kue,
                produk: produk,
            },
            success: function (res) {

                let data = res.data

                if( res.status == 1 ){

                    $('#qty-'+id).val(1)
                    Swal.fire('Sorry', `Stok Tinggal ${data} `, 'warning')

                }else{

                    $('.harga-'+ide).text(data.subtotal)
                    $('.total_harga').text(res.total_hrg)

                }

            }
        });

    }

</script>

@endpush