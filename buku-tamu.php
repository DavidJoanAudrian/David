<?php
include("header.php");
$result = mysqli_query($conn, "SELECT * FROM data WHERE diterima = 'ya'");
?>
    <a onclick="window.print()" class="btn btn-primary">PRINT</a>
    <a href="export-excel.php" class="btn btn-success">EXCEL</a>
    <div class="main" id="section-to-print">
    <div class="row justify-content-center">
          <div class="col-12">
            <div class="card shadow-2-strong" style="background-color: #f5f7fa;">
              <div class="card-body">
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
                        <?php else: ?>
                          <th scope="col">NAMA LENGKAP</th>
                          <th scope="col">TANGGAL</th>
                          <th scope="col">WAKTU</th>
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
                            </tr>
                        <?php endwhile ?>
                      <?php else: ?>
                        <?php while($row = mysqli_fetch_assoc($result)): ?>
                            <tr class="text-center">
                                <td><?=$row['nama']?></td>
                                <td><?=$row['tanggal']?></td>
                                <td><?=$row['waktu_from']?>-<?=$row['waktu_to']?></td>
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