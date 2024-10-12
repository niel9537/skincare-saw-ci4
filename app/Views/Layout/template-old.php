<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title><?= $title ?></title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- fontawesome -->
  <link rel="stylesheet" href="<?= base_url('fontawesome-free-5.15.4-web/css/all.css') ?>">

  <!-- datatables -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

  <style>
    body {
      font-family: 'monserat', sans-serif;
      padding: 50px;
      background-image: url('/img/bg.png');
    }

    .pastel-silver {
      background-color: #fffadd;
    }

    #menu {
      color: #333;
      border-radius: 4px;
      background: #fff;
      box-shadow: 0 6px 10px rgba(0, 0, 0, .08), 0 0 6px rgba(0, 0, 0, .05);
      transition: .3s transform cubic-bezier(.155, 1.105, .295, 1.12), .3s box-shadow, .3s -webkit-transform cubic-bezier(.155, 1.105, .295, 1.12);
      padding: 7px 40px 9px 18px;
      cursor: pointer;
    }

    #menu:hover {
      transform: scale(1.05);
      box-shadow: 0 10px 20px rgba(0, 0, 0, .12), 0 4px 8px rgba(0, 0, 0, .06);
    }

    @media(max-width: 990px) {
      .card {
        margin: 20px;
      }
    }
  </style>
</head>

<body>
  <div class="container <?= $title == 'Login' ? '' : 'shadow-lg rounded-lg border-0 card pastel-silver' ?>">

    <?php if ($title == "Login" || $title == "Simple Additive Weighting") : ?>
      <div>
      <?php else : ?>
        <div class="mx-5 my-3">
          <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page"><?= $title ?></li>
            </ol>
          </nav>
        <?php endif ?>


        <?= $this->renderSection('content') ?>

        </div>
        <!-- footer -->

        <?= $this->include('Layout/footer') ?>



      </div>
      <!-- Option 1: Bootstrap Bundle with Popper -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
      <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
      <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
      <!-- chart -->
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

      <!-- Option 2: Separate Popper and Bootstrap JS -->
      <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
      <script>
        // datatable
        $(document).ready(function() {
          $('#myTable').DataTable();
        });

        // membuat kode untuk kode data barang
        $(document).ready(function() {
          $.ajax({
            url: "<?= site_url('alternatif/kode') ?>",
            type: "GET",
            success: function(hasil) {
              // alert(hasil);
              var obj = $.parseJSON(hasil);
              $('#kodeAlternatif').val(obj);
            }
          });
        });

        // membuat kode untuk kode data barang
        $(document).ready(function() {
          $.ajax({
            url: "<?= site_url('kriteria/kode') ?>",
            type: "GET",
            success: function(hasil) {
              // alert(hasil);
              var obj = $.parseJSON(hasil);
              $('#kodeKriteria').val(obj);
            }
          });
        });
      </script>

      <script>
        document.getElementById('grafikTahun').addEventListener('change', function() {
          const tahun = this.value;
          const barApiUrl = `<?= site_url('dashboard/barChart/') ?>${tahun}`;
          // console.log(barApiUrl);

          fetch(barApiUrl)
            .then(response => response.json())
            .then(data => {
              // console.log(data);
              // Asumsikan data yang dikembalikan adalah array dengan objek untuk setiap bulan
              // yang memiliki properti 'layak' dan 'tidak_layak'
              const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
              const dataLayak = labels.map(label => {
                const monthIndex = labels.indexOf(label) + 1;
                const monthData = data.find(d => parseInt(d.id_bulan) === monthIndex);
                return monthData ? monthData.jumlah_layak : 0;
              });
              // const testData = data.find(d => parseInt(d.id_bulan) === 1);
              // console.log(testData);

              // console.log(dataLayak);
              const dataTidakLayak = labels.map(label => {
                const monthIndex = labels.indexOf(label) + 1;
                const monthData = data.find(d => parseInt(d.id_bulan) === monthIndex);
                return monthData ? monthData.jumlah_tidak_layak : 0;
              });

              const barChartElement = document.getElementById('barChart');
              if (window.barChartInstance) {
                window.barChartInstance.destroy();
              }
              window.barChartInstance = new Chart(barChartElement, {
                type: 'bar',
                data: {
                  labels: labels,
                  datasets: [{
                    label: 'Layak',
                    data: dataLayak,
                    backgroundColor: 'rgba(43,178,242)',
                  }, {
                    label: 'Tidak Layak',
                    data: dataTidakLayak,
                    backgroundColor: 'rgba(235,35,50)',
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
            })
            .catch(error => console.error('Error fetching data:', error));
        });
      </script>

      <script>
        // Contoh URL API
        const pieApiUrl = '<?= site_url('dashboard/pieChart') ?>';

        fetch(pieApiUrl)
          .then(response => response.json())
          .then(data => {
            // Misalkan response dari API adalah objek dengan properti 'layak' dan 'tidakLayak'
            const layak = data.jumlah_layak;
            const tidakLayak = data.jumlah_tidak_layak;

            // Jumlahkan total untuk mendapatkan persentase
            const total = layak + tidakLayak;
            const layakPersen = (layak / total * 100).toFixed(2); // Menggunakan toFixed(2) untuk membatasi dua angka di belakang koma
            const tidakLayakPersen = (tidakLayak / total * 100).toFixed(2);

            const pieChart = document.getElementById('pieChart');
            new Chart(pieChart, {
              type: 'pie',
              data: {
                labels: ['Layak', 'Tidak Layak'],
                datasets: [{
                  data: [layakPersen, tidakLayakPersen],
                  backgroundColor: [
                    'rgba(43,178,242)',
                    'rgba(235,35,50)'
                  ],
                  hoverOffset: 4
                }]
              },
              options: {
                tooltips: {
                  callbacks: {
                    label: function(tooltipItem, data) {
                      let label = data.labels[tooltipItem.index] || '';
                      if (label) {
                        label += ': ';
                      }
                      label += data.datasets[0].data[tooltipItem.index] + '%';
                      return label;
                    }
                  }
                }
              }
            });
          })
          .catch(error => console.error('Error fetching data:', error));
      </script>
      <script>
        // alternatif
        document.getElementById('bulan').onchange = changePeriode;
        document.getElementById('tahun').onchange = changePeriode;

        function changePeriode() {
          var bulan = document.getElementById('bulan').value;
          var tahun = document.getElementById('tahun').value;
          if (bulan != '#' && tahun != '#') {
            window.location.href = `<?= base_url() ?>nasabah/periode/${bulan}/${tahun}`;
          }
        }
      </script>
      <script>
        // penilaian
        document.getElementById('bulanA').onchange = changePeriodeA;
        document.getElementById('tahunA').onchange = changePeriodeA;

        function changePeriodeA() {
          var bulan = document.getElementById('bulanA').value;
          var tahun = document.getElementById('tahunA').value;
          if (bulan != '#' && tahun != '#') {
            window.location.href = `<?= base_url() ?>penilaian/periode/${bulan}/${tahun}`;
          }
        }
      </script>
      <script>
        // perhitungan
        document.getElementById('bulanP').onchange = changePeriodeP;
        document.getElementById('tahunP').onchange = changePeriodeP;

        function changePeriodeP() {
          var bulan = document.getElementById('bulanP').value;
          var tahun = document.getElementById('tahunP').value;
          if (bulan != '#' && tahun != '#') {
            window.location.href = `<?= base_url() ?>perhitungan/periode/${bulan}/${tahun}`;
          }
        }
      </script>
      <script>
        // hasil
        document.getElementById('bulanH').onchange = changePeriodeH;
        document.getElementById('tahunH').onchange = changePeriodeH;

        function changePeriodeH() {
          var bulan = document.getElementById('bulanH').value;
          var tahun = document.getElementById('tahunH').value;
          if (bulan != '#' && tahun != '#') {
            window.location.href = `<?= base_url() ?>hasil/periode/${bulan}/${tahun}`;
          }
        }
      </script>


      <!-- popup confirm perhitungan -->
      <script>
        $(document).ready(function() {
          // Ketika form hendak disubmit
          $('#formHasil').on('submit', function(e) {
            // Mencegah form disubmit secara default
            e.preventDefault();

            // Tampilkan alert konfirmasi
            var confirmSave = confirm("Apakah Anda yakin ingin menyimpan hasil perhitungan?");

            if (confirmSave) {
              // Jika pengguna klik "OK", submit form
              this.submit();
            }
            // Jika pengguna klik "Cancel", tidak terjadi apa-apa
          });
        });
      </script>

</body>

</html>