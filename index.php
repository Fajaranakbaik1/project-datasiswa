<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FORM DATA SISWA-SISWI</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      height: 95vh;
      background-color: #f8f9fa;
    }

    .custom-container {
      overflow-x: auto;
      border: 1px solid #ccc;
      border-radius: 10px;
      padding: 20px;
      background-color: #ffffff;
      max-width: 600px;
      width: 100%;
      /* Ensures the container takes up the full width on small screens */
      box-sizing: border-box;
    }

    .tengah h2 {
      display: flex;
      justify-content: center;
      align-items: center;
    }

    @media print {
      body {
        display: block;
        margin: 0;
        padding: 0;
      }

      .custom-container {
        border: none;
        box-shadow: none;
        width: 100%;
      }

      form,
      h1,
      .btn-success,
      .custom-container h2 {
        display: none;
      }

      .table-responsive {
        width: 100%;
        margin: 0;
        background-color: white;
        color: black;
        padding: 30px;
        font-size: 20px;
      }

      .table-responsive h2 {
        color: black;
        font-size: 30px;
      }

      .table {
        width: 100%;
        border-collapse: collapse;
      }

      .table th,
      .table td {
        font-size: 30px;
        border: 1px solid #000;
        padding: 8px;
        text-align: left;
      }

      .table thead th {
        color: black;
        background-color: #f1f1f1;
      }

      .btn-danger {
        display: none;
      }

      .table tfoot {
        font-weight: bold;
      }
    }

    @media (max-width: 600px) {
      .custom-container {
        padding: 10px;
      }

      h1 {
        font-size: 24px;
      }

      .form-group label {
        font-size: 14px;
      }

      .form-control {
        font-size: 14px;
      }

      .btn {
        font-size: 14px;
        padding: 5px 10px;
      }

      .table-responsive {
        padding: 10px;
      }

      .table th,
      .table td {
        font-size: 14px;
        padding: 5px;
      }
    }

    @media (max-width: 320px){
      .table th,
      .table td {
        font-size: 10px;
        padding: 10px 15px;
      }
      .btn {
        font-size: 10px;
        padding: 5px 5px;
      }
      .table-responsive {
        width: 100%;
      }
    }    
  </style>
</head>

<body>
  <div class="custom-container">
    <h1 class="text-center mb-4">Masukkan Data Siswa</h1>
    <form action="" method="post">
      <div class="form-group">
        <label for="nama">Nama:</label>
        <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama" required>
      </div>
      <div class="form-group">
        <label for="nis">NIS:</label>
        <input type="text" class="form-control" id="nis" name="nis" placeholder="Masukkan NIS" required>
      </div>
      <div class="form-group">
        <label for="rayon">Rayon:</label>
        <input type="text" class="form-control" id="rayon" name="rayon" placeholder="Masukkan Rayon" required>
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary mr-2" name="submit">Kirim</button>
        <button type="button" class="btn btn-success mr-2" onclick="window.print()">Cetak</button>
      </div>
    </form>

    <?php
    // Memulai session
    session_start();

    // Inisialisasi session jika belum ada
    if (!isset($_SESSION['dataSiswa'])) {
      $_SESSION['dataSiswa'] = array();
    }

    // Memproses data jika tombol Kirim ditekan
    if (isset($_POST['submit']) && !empty($_POST['nama']) && !empty($_POST['nis']) && !empty($_POST['rayon'])) {
      $siswa = array(
        "nama" => $_POST['nama'],
        "nis" => $_POST['nis'],
        "rayon" => $_POST['rayon']
      );

      array_push($_SESSION['dataSiswa'], $siswa);
    }

    // Memproses data jika tombol Hapus Data ditekan
    if (isset($_POST['hapus'])) {
      $namaHapus = $_POST['hapus'];
      foreach ($_SESSION['dataSiswa'] as $key => $siswa) {
        if ($siswa['nama'] === $namaHapus) {
          unset($_SESSION['dataSiswa'][$key]); // Menghapus siswa dari session
        }
      }
    }

    // Menampilkan output data siswa dalam tabel jika ada data
    if (!empty($_SESSION['dataSiswa'])) {
      echo "<h2>Data Siswa</h2>";
      echo "<div class='table-responsive'>";
      echo "<table class='table table-bordered'>";
      echo "<thead class='thead-light'>";
      echo "<tr>";
      echo "<th scope='col' class='highlighted-column'>Nama</th>";
      echo "<th scope='col' class='highlighted-column'>NIS</th>";
      echo "<th scope='col' class='highlighted-column'>Rayon</th>";
      echo "<th scope='col'></th>"; // Kolom untuk tombol hapus
      echo "</tr>";
      echo "</thead>";
      echo "<tbody>";
      foreach ($_SESSION['dataSiswa'] as $siswa) {
        echo "<tr>";
        echo "<td class='highlighted-column'>" . $siswa['nama'] . "</td>";
        echo "<td class='highlighted-column'>" . $siswa['nis'] . "</td>";
        echo "<td class='highlighted-column'>" . $siswa['rayon'] . "</td>";
        echo "<td>";
        echo "<form action='' method='post'>";
        echo "<button type='submit' class='btn btn-sm btn-danger' name='hapus' value='" . $siswa['nama'] . "'>Hapus</button>"; // Tombol hapus dengan nilai nama siswa
        echo "</form>";
        echo "</td>";
        echo "</tr>";
      }
      echo "</tbody>";
      echo "</table>";
      echo "</div>"; // Close table-responsive div
    }
    ?>
  </div>
</body>

</html>
