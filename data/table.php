<?php

// panggil file functions.php
require_once '../function/functions.php';
// tangkap keyword yang berada di url 
$keyword = mysqli_real_escape_string($conn, $_GET["keyword"]);
// ambil data yang sesuai dengan isi variabel $keyword
$result = cari($keyword);

?>
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
                <span class="fw-normal">Tidak ada data sama sekali di database!</span>
              </div>
            </div>
          </div>
        </td>
      </tr>
      <?php endif; ?>

    </tbody>
  </table>
</div>