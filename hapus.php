<?php

// panggil file functions.php
require_once 'function/functions.php';
// tangkap id yang berada di url
$id = mysqli_real_escape_string($conn, $_GET["id"]);

if (hapus($id) > 0) {
  // jika data berhasil dihapus
  echo "
    <script>
      alert('data berhasil dihapus!');
      document.location.href = 'index.php?berhasil';
    </script>
  ";
} else {
  // jika data gagal dihapus
  echo "
    <script>
      alert('data gagal dihapus!');
      document.location.href = 'index.php?gagal';
    </script>
  ";
}