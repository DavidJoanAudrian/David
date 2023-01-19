<?php
include("header.php");
if(isset($_POST["nama"])){
    $nama = $_POST["nama"];
    $nohp = $_POST["nomor"];
    $tgl = $_POST["tanggal"];
    $wf = $_POST["waktu-f"];
    $wt = $_POST["waktu-t"];
    $keluhan = json_encode($_POST["keluhan"], true);
    mysqli_query($conn, "INSERT INTO data (nama, nomor, keluhan, waktu_from, waktu_to, tanggal) VALUES ('$nama', '$nohp', '$keluhan', '$wf', '$wt', '$tgl')");
    $alert = '<div class="alert alert-success" role="alert">Pendaftaran telah dikirim, Terima kasih...</div>';;
}
?>
    <div class="main">
        <div class="row">
            <div class="col">
                <?=@$alert?>
                <form method="POST" class="needs-validation" novalidate>
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama lengkap Anda" required>
                            <div class="invalid-feedback">
                                Mohon masukkan nama lengkap anda.
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="nomor" class="form-label">Nomor Handphone <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="nomor" name="nomor" placeholder="Masukkan nomor HP / Whatsapp Anda" required>
                            <div class="invalid-feedback">
                                Mohon masukkan nomor handphone dengan benar.
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="tanggal" class="form-label">Layanan pada tanggal <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                            <div class="invalid-feedback">
                                Mohon masukkan tanggal.
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <label for="waktu" class="form-label">Waktu diperkirakan konsultasi <span class="text-danger">*</span></label>
                            <div class="row">
                                <div class="col-6">
                                <label for="waktu-f" class="form-label">Dari</label>
                                    <input type="time" class="form-control" id="waktu-f" name="waktu-f" required>
                                    <div class="invalid-feedback">
                                        Mohon masukkan waktu dari.
                                    </div>
                                </div>
                                <div class="col-6">
                                <label for="waktu-t" class="form-label">Sampai</label>
                                    <input type="time" class="form-control" id="waktu-t" name="waktu-t" required>
                                    <div class="invalid-feedback">
                                        Mohon masukkan waktu sampai.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-11">
                            <label for="keluhan" class="form-label">Keluhan</label>
                            <input type="text" class="form-control" id="keluhan" name="keluhan[]" placeholder="Masukkan keluhan Anda (Optional)">
                        </div>
                        <div class="col mt-5">
                            <span></span>
                            <button id="tambah" class="btn btn-primary">Tambah</button>
                        </div>
                    </div>

                    <hr class="my-4">

                    <button class="w-100 btn btn-primary btn-lg" type="submit">Daftar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
include("footer.php");
?>