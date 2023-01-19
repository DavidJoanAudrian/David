<?php
include("header.php");
if(isset($_GET["switch"])){
    $switch = (bool)$_GET["switch"];
    $data_id = $_GET["id"];
    if($switch)
        mysqli_query($conn, "UPDATE data SET sudah_konsultasi = 'belum' WHERE id = $data_id");
    else
        mysqli_query($conn, "UPDATE data SET sudah_konsultasi = 'sudah' WHERE id = $data_id");
}
$tambahan = "";
if(!empty($_GET["rentang_dari"])){
    $dari = $_GET["rentang_dari"];
    $sampai = $_GET["rentang_sampai"];
    if(!empty($sampai)){
        $tambahan = "WHERE tanggal BETWEEN '$dari' AND '$sampai'";
    }else{
        $besok = date('Y-m-d', strtotime('+1 day'));
        $tambahan = "WHERE tanggal BETWEEN '$dari' AND '$besok'";
    }
}
$result = mysqli_query($conn, "SELECT * FROM data $tambahan");
?>
    <div class="main">
    <div class="row justify-content-center">
          <div class="col-12">
            <div class="card shadow-2-strong" style="background-color: #f5f7fa;">
              <div class="card-body">
                <div class="col-6">
                    <form>
                        Filter Rentang Tanggal : 
                        <input type="date" name="rentang_dari" class="form-control w-25">
                        Sampai
                        <input type="date" name="rentang_sampai" class="form-control w-25">
                        <input type="submit" class="btn btn-primary form-control w-25" value="Filter">
                    </form>
                </div>
                <hr>
                <div class="table-responsive">
                  <table class="table table-borderless mb-0">
                    <thead>
                      <tr class="text-center">
                        <?php if(@$_SESSION["role"] == "admin"): ?>
                          <th scope="col">NAMA LENGKAP</th>
                          <th scope="col">NOMOR HANDPHONE</th>
                          <th scope="col">KELUHAN</th>
                          <th scope="col">TANGGAL</th>
                          <th scope="col">WAKTU</th>
                          <th scope="col">KONSULTASI</th>
                        <?php else: ?>
                          <th scope="col">NAMA LENGKAP</th>
                          <th scope="col">TANGGAL</th>
                          <th scope="col">WAKTU</th>
                          <th scope="col">DITERIMA</th>
                        <?php endif ?>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if(@$_SESSION["role"] == "admin"): ?>
                        <?php while($row = mysqli_fetch_assoc($result)): ?>
                        <?php $checked = $row['sudah_konsultasi'] == "sudah" ? "checked" : "" ?>
                            <tr class="text-center">
                                <td><?=$row['nama']?></td>
                                <td><?=$row['nomor']?></td>
                                <td><ul><li><?=implode("</li><li>", json_decode($row['keluhan']))?></li></ul></td>
                                <td><?=$row['tanggal']?></td>
                                <td><?=$row['waktu_from']?>-<?=$row['waktu_to']?></td>
                                <td>
                                  <?php if($row['diterima'] == "belum"): ?>
                                    <div class="form-check form-switch">
                                      <a class="btn btn-primary" href="acc-konsul.php?id=<?=$row['id']?>">Terima</a><a class="btn btn-danger" href="reject-konsul.php?id=<?=$row['id']?>">Tolak</a>
                                    </div>
                                  <?php else: ?>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input konsultasi" type="checkbox" role="switch" id="konsultasi" data-id="<?=$row['id']?>" <?=$checked?>/>
                                        <label class="form-check-label" for="konsultasi">Sudah konsultasi</label>
                                    </div>
                                  <?php endif ?>
                                </td>
                            </tr>
                        <?php endwhile ?>
                      <?php else: ?>
                        <?php while($row = mysqli_fetch_assoc($result)): ?>
                            <tr class="text-center">
                                <td><?=$row['nama']?></td>
                                <td><?=$row['tanggal']?></td>
                                <td><?=$row['waktu_from']?>-<?=$row['waktu_to']?></td>
                                <td>
                                  <?php if($row['diterima'] == "belum"): ?>
                                    <span class="text-secondary">Menunggu</span>
                                  <?php elseif($row['diterima'] == "ya"): ?>
                                    <span class="text-success">Ya</span>
                                  <?php else: ?>
                                    <span class="text-danger">Tidak</span>
                                  <?php endif ?>
                                </td>
                            </tr>
                        <?php endwhile ?>
                      <?php endif ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
<?php
include("footer.php");
?>