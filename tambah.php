<?php

// memanggil beberapa file
require_once 'function/functions.php';
require_once 'data_jurusan.php';
// kirimkan data ke file header.php
$data["title"] = 'Halaman tambah data';
$data["body"] = 'bg-primary body-center';
// jika tombol submit ditekan
if (isset($_POST["submit"])) {
  if (tambah($_POST) > 0) {
    // jika data berhasil ditambahkan
    echo "
      <script>
        alert('data berhasil ditambahkan!');
        document.location.href = 'index.php?berhasil';
      </script>
    ";
  } else {
    // jika data gagal ditambahkan
    echo "<script>alert('data gagal ditambahkan!')</script>";
  }
}
// panggil file header.php
view('templates/header', $data);

?>
  
  <div class="container">
    <div class="row">
      <div class="col-md-6 mx-auto">
        
        <!-- box start -->
        <div class="bg-white p-4 rounded-1 shadow-sm">
          <h3 class="fw-normal text-black-50 text-center mb-3">Form tambah data</h3>
          <form action="" method="post" enctype="multipart/form-data" class="form">
            <!-- form start -->
            <div class="form-group mb-3">
              <label for="nama" class="form-label fw-light">Nama lengkap</label>
              <input type="text" name="nama" id="nama" class="form-control" required autocomplete="off">
            </div>
            <div class="form-group mb-3">
              <label for="nrp" class="form-label fw-light">Nrp</label>
              <input type="number" name="nrp" id="nrp" class="form-control" required autocomplete="off">
            </div>
            <div class="form-group mb-3">
              <label for="email" class="form-label fw-light">Email</label>
              <input type="text" name="email" id="email" class="form-control" required autocomplete="off">
            </div>
            <div class="form-group mb-3">
              <label for="jurusan" class="form-label fw-light">Jurusan</label>
              <select name="jurusan" id="jurusan" class="form-control">
                <?php foreach ($data_jurusan as $jurusan) : ?>
                <option value="<?= $jurusan; ?>"><?= $jurusan; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group mb-3">
              <div class="image-preview-box mb-3">
                <img width="100" class="img-fluid image-preview">
              </div>
              <label for="gambar" class="form-label fw-light">Gambar</label>
              <input class="form-control" type="file" id="gambar" name="gambar">
            </div>
            <button type="submit" name="submit" class="btn btn-primary rounded-1 py-2 px-3 w-100 mb-1">Tambah data</button>
            <a href="index.php?kembali" class="btn btn-secondary rounded-1 py-2 px-3 w-100">Kembali</a>
            <!-- form end -->
          </form>
        </div>
        <!-- box end -->
        
      </div>
    </div>
  </div>

<?php 

// krimkan data ke file footer.php
$data["javascript"] = "image_preview.js";
// panggil file footer.php di folder templates
view('templates/footer', $data); 

?>