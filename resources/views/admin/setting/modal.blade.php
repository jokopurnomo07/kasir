<div class="modal fade" id="modalUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-user">
                    @csrf
                    <div class="mb-3">
                        <input type="text" class="form-control validation" name="name" placeholder="Nama Lengkap">
                        <div class="invalid-feedback ename">
                        </div>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control validation" name="username" placeholder="Username">
                        <div class="invalid-feedback eusername">
                        </div>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control validation" name="alamat" placeholder="Alamat">
                        <div class="invalid-feedback ealamat">
                        </div>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control validation" name="password" placeholder="Password">
                        <div class="invalid-feedback epassword">
                        </div>
                    </div>
                    <div class="mb-3">
                        <select class="form-select" name="jeniskelamin" id="jeniskelamin"
                            aria-label="Default select example">
                            <option selected value="">Jenis Kelamin</option>
                            <option value="Laki-Laki">Laki Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        <div class="invalid-feedback ejeniskelamin">
                        </div>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control validation" name="nomor" placeholder="Nomor Telepon">
                        <div class="invalid-feedback enomor">
                        </div>
                    </div>
                    <div class="mb-3">
                        <select class="form-select" name="status" aria-label="Default select example">
                            <option selected value="">Status</option>
                            <option value="1">Administrator</option>
                            <option value="2">Kasir</option>
                        </select>
                        <div class="invalid-feedback estatus">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary adduser">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        $(".adduser").click(function(e) {
            e.preventDefault();
            var _token = $("input[name='_token']").val();
            var name = $("input[name='name']").val();
            var username = $("input[name='username']").val();
            var password = $("input[name='password']").val();
            var alamat = $("input[name='alamat']").val();
            var jeniskelamin = modal.find('.modal-body #jeniskelamin').val(jeniskelamin);
            var nomor = $("input[name='nomor']").val();
            var status = document.getElementById("status").value;

            $.ajax({
                url: "{{ route('user.add') }}",
                type: 'POST',
                data: {
                    _token: _token,
                    name: name,
                    username: username,
                    password: password,
                    alamat: alamat,
                    jeniskelamin: jeniskelamin,
                    nomor: nomor,
                    status: status,
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
                        printErrorMsg(data.error);
                    }
                }
            });
        });

        function printErrorMsg(msg) {
            $('.validation').addClass('is-invalid');
            $.each(msg, function(key, value) {
                cek(key, value);
            });
        }

        function cek(key, value) {
            if (key === 0) {
                $(".ename").html(value);
            } else if (key === 1) {
                $(".eusername").html(value);
            } else if (key === 2) {
                $(".epassword").html(value);
            } else if (key === 3) {
                $(".ealamat").html(value);
            } else if (key === 4) {
                $(".ejeniskelamin").html(value);
            } else if (key === 5) {
                $(".enomor").html(value);
            } else {
                $(".estatus").html(value);
            }
        }
    </script>
@endpush
