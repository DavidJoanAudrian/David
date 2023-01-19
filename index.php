<?php
include("header.php");
$d = mysqli_query($conn, "SELECT tanggal, count(*) as jumlah FROM data GROUP BY tanggal");
$arr = [];
$jml = [];
while($chart = mysqli_fetch_array($d)){
    $arr[] = $chart["tanggal"];
    $jml[] = $chart["jumlah"];
}
$lbl = json_encode($arr, true);
$data = json_encode($jml, true);
?>
    <div class="main">
        <div class="row">
            <div class="col">
                <center>
                    <div style="width: 800px;" class="align-middle text-center"><canvas id="chart"></canvas></div>
                </center>
            </div>
        </div>
    </div>
    <script>
        const ctx = document.getElementById('chart');

        new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?=$lbl?>,
            datasets: [{
            label: 'Jumlah Konsultasi',
            data: <?=$data?>,
            borderWidth: 1
            }]
        },
        options: {
                scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
        });
    </script>
<?php
include("footer.php");
?>