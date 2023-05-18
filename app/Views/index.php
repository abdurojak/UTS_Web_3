<?= $this->extend('uts/templates/base_template') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col">
                <div class="text-secondary fw-bold fs-3">You found me</div>
            </div>
            <div class="col text-end">
                <button class="btn btn-dark" onclick="addForm()">Tambah</button>
            </div>
        </div>
    </div>
    <div class="card-body col-10">
        <table class="table table-responsive table-striped">
            <thead style="border-bottom: 2px solid #000000;">
                <th>I</th>
                <th>Am</th>
                <th>Very</th>
                <th>Sorry</th>
                <th>To</th>
                <th>You</th>
            </thead>
            <tbody id="mainTBody">
            </tbody>
        </table>
    </div>
</div>

<!-- MODAL FORM -->
<div class="modal fade" id="formProdi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-5">
                <form onsubmit="event.preventDefault()" id="mainForm">
                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                    <input type="hidden" name="oldid" value="" />
                    <input type="hidden" name="foto-old" value="" />

                    <div class="mb-3">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" placeholder="Nama" required>
                        <div class="invalid-feedback">Masukan Nama!</div>
                    </div>

                    <div class="mb-3">
                        <label>Nim</label>
                        <input type="text" name="nim" class="form-control" placeholder="Nim" required>
                        <div class="invalid-feedback">Masukan Nim!</div>
                    </div>

                    <div class="mb-3">
                        <label>Prodi</label>
                        <br>
                        <select name="prodi" id="prodiSelect" required>
                        </select>
                        <div class="invalid-feedback">Masukan Prodi!</div>
                    </div>

                    <div class="mb-3">
                        <label>Foto</label>
                        <input class="form-control" type="file" name="foto" id="formFile">
                        <div class="invalid-feedback">Masukan Foto!</div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" onclick="prosesForm()">Tambah</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL EDIT -->
<div class="modal fade" id="formEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Rubah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-5">
                <form onsubmit="event.preventDefault()" id="mainForm">
                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                    <input type="hidden" name="oldid" value="" />
                    <input type="hidden" name="foto-old" value="" />

                    <div class="mb-3">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" placeholder="Nama" required>
                        <div class="invalid-feedback">Masukan Nama!</div>
                    </div>

                    <div class="mb-3">
                        <label>Nim</label>
                        <input type="text" name="nim" class="form-control" placeholder="Nim" required>
                        <div class="invalid-feedback">Masukan Nim!</div>
                    </div>

                    <div class="mb-3">
                        <label>Prodi</label>
                        <br>
                        <select name="prodi" id="prodiEdit" required>
                        </select>
                        <div class="invalid-feedback">Masukan Prodi!</div>
                    </div>

                    <div class="mb-3">
                        <label>Foto</label>
                        <input class="form-control" type="file" name="foto" id="formFile">
                        <!-- <img id="imgEdit" src="" style="height: 100px; width: auto;"> -->
                        <div class="invalid-feedback">Masukan Foto!</div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" onclick="prosesForm()">Perbarui</button>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('jscustom') ?>
<script>
    let act = 'add'
    var myModal = new bootstrap.Modal(document.getElementById("formProdi"), {});
    var editModal = new bootstrap.Modal(document.getElementById("formEdit"), {});
    let datanya = []
    let datanyaProdi = []

    function getDataAll() {
        $.get('/mahasiswa/get-all').then((data) => {
            let htmlTBody = ''
            data.forEach((dt, idx) => {
                htmlTBody += `
                <tr>
                    <td>${idx + 1}</td>
                    <td>
                        <img src="/foto/${dt['foto']}" style="height: auto; width: 50px;" />
                    </td>
                    <td>${dt['nim']}</td>
                    <td>${dt['nama']}</td>
                    <td>${dt['nama_prodi']}</td>
                    <td>
                        <button class="btn btn-success btn-sm" onclick="editForm(${idx})">Rubah</button>
                        <button class="btn btn-danger btn-sm" onclick="deleteForm(${idx})">Hapus</button>
                    </td>
                </tr>
                `
            })
            datanya = data
            $('#mainTBody').html(htmlTBody)
        })
    }

    function getDataProdi() {
        $.get('/prodi/get-all').then((data) => {
            let htmlTBody = ''
            data.forEach((dt, idx) => {
                htmlTBody += `
                <option value="${dt['id']}">${dt['nama_prodi']}</option>
                `
            })
            datanyaProdi = data
            $('#prodiSelect').html(htmlTBody)
            $('#prodiEdit').html(htmlTBody)
        })
    }

    function setData(idx) {
        let datanow = datanya[idx]
        $('input[name="oldid"]').val(datanow['nim'])
        $('input[name="nim"]').val(datanow['nim'])
        $('input[name="nama"]').val(datanow['nama'])
        $('select[name="prodi"]').val(datanow['id_prodi'])
        $('input[name="foto-old"]').val(datanow['foto'])
        $('#imgEdit').attr('src', `/foto/${datanow['foto']}`)
    }

    function clearData() {
        $('input[name="oldid"]').val('')
        $('input[name="nim"]').val('')
        $('input[name="nama"]').val('')
        $('select[name="prodi"]').val('')
        $('input[name="foto"]').val('')
        $('input[name="foto-old"]').val('')
        $('#imgEdit').attr('src', ``)
    }

    function addForm() {
        act = 'add'
        myModal.show();
        clearData()
    }

    function editForm(idx) {
        setData(idx)
        act = 'edit'
        editModal.show();
    }

    function deleteForm(idx) {
        setData(idx)
        act = 'delete'
        Swal.fire({
            title:'I want to ask you',
            text: "Are you sure you still want to be my best friend?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonText: 'Yes, I am',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'No, I dont want to'
        }).then((result) => {
            if (result.isConfirmed) {
                prosesForm()
            }
        })
    }

    function prosesForm() {
        let url = '/mahasiswa/' + act
        let formdata = new FormData(document.getElementById("mainForm"))
        $.ajax({
            url: url,
            method: 'post',
            data: formdata,
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'json',
            success: function(response) {
                console.log(response)
                Swal.fire(
                    'Sorry',
                    'I have become different because I am affraid that I would fallin in 愛 with you',
                    ''
                );
                myModal.hide()
                getDataAll();
            }
        });
    }

    getDataAll();
    getDataProdi()
</script>
<?= $this->endSection() ?>
