<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>


    <div class="print">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title text-center">{{ $toko->nama }}</h5>
                <p class="card-text text-center">{{ $toko->alamat }}</p>
                <p class="card-text text-center">{{ date('d-M-Y H:i') }}</p>
            </div>
            <hr>

            <ul class="list-group list-group-flush">
                @foreach ($transaksi->tr_detail as $item)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            {{ $item->nama }}
                            <small class="form-text text-muted text-small">Rp. {{ $item->harga }}</small>
                        </div>
                        <span class="badge badge-pill">{{ $item->qty }}X</span>
                        <span class="badge badge-pill">Rp. {{ $item->subtotal }}</span>
                    </li>
                @endforeach
            </ul>

            <ul class="list-group list-group-flush mt-4">
                <li class="list-group-item">Total <span class="float-right">{{ $transaksi->total }}</span></li>
                <li class="list-group-item">Tunai <span class="float-right">{{ $transaksi->bayar }}</span></li>
                <li class="list-group-item">Kembalian <span class="float-right">{{ $transaksi->kembalian }}</span>
                </li>
            </ul>

            <hr>
            <div class="card-body mt-3">
                <p class="text-center">Terima Kasih</p>
                <p class="text-center">Kasir {{ auth()->user()->name }}</p>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {


        })
    </script>

</body>

</html>
