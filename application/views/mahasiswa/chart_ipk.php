<div class="container">
<div class="page-inner">
    <h2>Grafik IPK Mahasiswa Per Semester</h2>
   
    <canvas id="ipkChart"></canvas>
    
   
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('ipkChart').getContext('2d');
    var ipkData = <?= json_encode($ipk_data); ?>;

    var semesters = ipkData.map(data => 'Semester ' + data.semester_id);
    var ipkValues = ipkData.map(data => data.ipk);

    var chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: semesters,
            datasets: [{
                label: 'IPK',
                data: ipkValues,
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 2,
                fill: false
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    max: 4.0
                }
            }
        }
    });
</script>
<?php if($this->session->userdata('level') === '1') { ?>
        <a href="<?= base_url('Bimbingan/index3')?>"><button type="button" class="btn btn-secondary" style="left: auto;">Kembali</button></a>
        <?php } ?>
<?php if($this->session->userdata('level') === '2') { ?>
        <a href="<?= base_url('Bimbingan/index1')?>"><button type="button" class="btn btn-secondary" style="left: auto;">Kembali</button></a>
        <?php } ?>
        <?php if($this->session->userdata('level') === '3') { ?>
        <a href="<?= base_url('Bimbingan/index')?>"><button type="button" class="btn btn-secondary" style="left: auto;">Kembali</button></a>
        <?php } ?>
</div></div>

