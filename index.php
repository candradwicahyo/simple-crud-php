<?php

// panggil file functions.php
require 'function/functions.php';
// ambil semua data yang ada di tabel "tb_mahasiswa"
$result = queryAll("SELECT * FROM tb_mahasiswa ORDER BY id DESC");
// kirimkan data berupa judul ke templates header.php
$data["title"] = 'crud php';
// panggil file header.php yang berada di folder templates
view('templates/header', $data);

?>

<div class="container my-4">
  <div class="row">
    <div class="col-md mx-auto">

      <div class="row">
        <div class="col-md mt-2">
          <a href="tambah.php" class="btn btn-primary rounded-1">Tambah data</a>
        </div>
        <div class="col-md-5 mt-2">
          <form action="" method="post">
            <input type="text" class="form-control search-input" placeholder="masukkan data ..." autocomplete="off">
          </form>
        </div>
      </div>

      <!-- table start -->
      <div class="table-container">
        <div class="table-responsive my-3">
          <table class="table table-hover" cellspacing="0">
            <thead class="bg-light">
              <tr>
                <th class="p-3 fw-normal">Nomor</th>
                <th class="p-3 fw-normal">Nama</th>
                <th class="p-3 fw-normal">Nrp</th>
                <th class="p-3 fw-normal">Email</th>
                <th class="p-3 fw-normal">Jurusan</th>
                <th class="p-3 fw-normal">Gambar</th>
                <th class="p-3 fw-normal">Opsi</th>
              </tr>
            </thead>
            <tbody>

              <!-- jika ada data, maka tampilkan semua data tersebut -->
              <?php $no = 1; ?>
              <?php foreach ($result as $data) : ?>
              <tr>
                <td class="p-3 fw-light text-black-50"><?= $no; ?></td>
                <td class="p-3 fw-light text-black-50"><?= $data["nama"]; ?></td>
                <td class="p-3 fw-light text-black-50"><?= $data["nrp"]; ?></td>
                <td class="p-3 fw-light text-black-50"><?= $data["email"]; ?></td>
                <td class="p-3 fw-light text-black-50"><?= $data["jurusan"]; ?></td>
                <td class="p-3 fw-light text-black-50">
                  <img src="assets/images/<?= $data["gambar"]; ?>" width="50" alt="image profile" class="img-fluid rounded-1">
                </td>
                <td class="p-3 fw-light">
                  <a href="ubah.php?id=<?= $data["id"]; ?>" class="btn btn-success btn-sm rounded-0 btn-edit m-1">Ubah</a>
                  <a href="#" class="btn btn-danger btn-sm rounded-0 btn-delete m-1" data-id="<?= $data["id"]; ?>">Hapus</a>
                </td>
              </tr>
              <?php $no++; ?>
              <?php endforeach; ?>

              <!-- jika tidak ada data sama sekali -->
              <?php if (count($result) === 0) : ?>
              <tr>
                <td colspan="7">
                  <div class="row">
                    <div class="col-md-8 my-3 mx-auto">
                      <div class="alert alert-warning" role="alert">
                        <span class="fw-normal">Tidak ada data sama sekali!</span>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
              <?php endif; ?>

            </tbody>
          </table>
        </div>
      </div>
      <!-- table end -->

      <!-- footer start -->
      <footer class="mt-5">
        <div class="d-flex justify-content-center align-items-center">
          <span class="fw-light">Created by <a href="https://instagram.com/candradwicahyo18" target="_blank" class="fw-semibold text-primary text-decoration-none">Candra Dwi Cahyo</a></span>
        </div>
      </footer>
      <!-- footer end -->

    </div>
  </div>
</div>

<?php

// kirimkan data ke file footer.php
$data["javascript"] = "script.js";
// panggil file footer.php yang berada di folder templates
view('templates/footer', $data);

?>