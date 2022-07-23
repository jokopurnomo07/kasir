<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>


        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

        <title>Laporan Keuangan Toko {{ $toko->nama }}</title>
    </head>
    <body>
        
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        
                        <div class="table-responsive">

                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama Barang</th>
                                        <th scope="col">Merek</th>
                                        <th scope="col">Qty</th>
                                        <th scope="col">Harga Jual</th>
                                        <th scope="col">Pendapatan</th>
                                        <th scope="col">Laba</th>
                                        <th scope="col">Rugi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($product as $key => $item)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->merek }}</td>
                                            <td>{{ empty($qtyPerbarang) ? '-' : $qtyPerbarang[$key] }}</td>
                                            <td>{{ $item->harga_jual }}</td>
                                            <td>{{ empty($pendapatan) ? '-' : $pendapatan[$key] }}</td>
                                            <td>{{ empty($laba) ? '-' : $laba[$key] }}</td>
                                            <td>{{ empty($rugi) ? '-' : $rugi[$key] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

    </body>
</html>