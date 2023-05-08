<?php

// menghubungkan ke database crud_php
$conn = mysqli_connect('localhost', 'root', '', 'crud_php');

function queryAll($query) {
  // panggil variabel $conn
  global $conn;
  // jalankan perintah query sesuai parameter $query
  $result = mysqli_query($conn, $query);
  // array kosong
  $rows = [];
  // fetch atau looping data yang didapat lalu masukkan hasilnya ke variabel $rows
  while ($row = mysqli_fetch_assoc($result)) $rows[] = $row;
  // kembalikan nilai berupa data array asosiatif
  return $rows;
}

function view($filename, $data = []) {
  // cek, apakah parameter $filename berisikan karakter tanda titik (.)
  $find = strpos($filename, '.');
  // jika parameter $filename berisikan tanda titik
  if ($find != false) {
    // pecah menjadi beberapa bagian lalu ambil bagian paling awal
    $part = explode('.', $filename);
    return require_once trim($part[0]) . '.php';
  }
  // jika parameter $filename tidak berisikan tanda titik
  return require_once trim($filename) . '.php';
}

function redirect($filename) {
  // cek, apakah parameter $filename berisikan karakter tanda titik (.)
  $find = strpos($filename, '.');
  // jika parameter $filename berisikan tanda titik
  if ($find != false) {
    // pecah menjadi beberapa bagian lalu ambil bagian paling awal
    $part = explode('.', $filename);
    // direct ke file tersebut
    header("Location: " . trim($part[0]) . ".php");
    exit();
  }
  // jika parameter $filename tidak berisikan tanda titik
  header("Location: " . trim($filename));
  exit();
}

function tambah($data) {
  // panggil variabel $conn
  global $conn;
  // berikan keamanan pada tiap input 
  $nama = trim(stripslashes(htmlspecialchars($data["nama"])));
  $nrp = trim(htmlspecialchars($data["nrp"]));
  $email = trim(stripslashes(htmlspecialchars($data["email"])));
  $jurusan = trim(stripslashes(htmlspecialchars($data["jurusan"])));
  // jalankan fungsi upload
  $gambar = upload();
  // jika upload gambar gagal, maka hentikan fungsi tambah()
  if (!$gambar) return false;
  // perintah query
  $query = "INSERT INTO tb_mahasiswa VALUES('', '$nama', '$nrp', '$email', '$jurusan', '$gambar')";
  // jalankan perintah query
  mysqli_query($conn, $query);
  /*
    jika ada perubahan data di database, maka fungsi ini akan menghasilkan nilai 1. tapi apabila tidak ada 
    perubahan sama sekali di database, maka fungsi ini akan menghasilkan nilai 0 atau -1.
  */
  return mysqli_affected_rows($conn);
}

function upload() {
  // inisiasi
  $nama_file = $_FILES["gambar"]["name"];
  $ukuran_file = $_FILES["gambar"]["size"];
  $error = $_FILES["gambar"]["error"];
  $tmp_name = $_FILES["gambar"]["tmp_name"];
  // jika pengguna tidak mengupload sesuatu
  if ($error === 4) {
    echo "<script>alert('upload file gambar terlebih dahulu!')</script>";
    return false;
  }
  // ekstensi file yang diperbolehkan untuk diupload
  $ekstensi_valid = ['jpg', 'jpeg', 'png', 'gif'];
  // pecah nama file menjadi beberapa bagian dan ambil ekstensi file tersebut
  $ekstensi_file = explode('.', $nama_file);
  $ekstensi_file = strtolower(trim(end($ekstensi_file)));
  // jika pengguna mengupload file yang ekstensinya tidak sesuai dengan ekstensi yang diperbolehkan
  if (!in_array($ekstensi_file, $ekstensi_valid)) {
    echo "<script>alert('file yang anda upload bukanlah sebuah gambar!')</script>";
    return false;
  }
  // batasi ukuran file gambar yang diupload 
  // jika ukuran file gambar yang diupload melebihi 5 MegaByte
  if ($ukuran_file > 5000000) {
    echo "<script>alert('ukuran file gambar terlalu besar!')</script>";
    return false;
  }
  // ubah nama file menjadi nama yang acak supaya mencegah gambar dari pengguna lain duplikat
  $nama_file_baru = 'image_crud_' . uniqid();
  $nama_file_baru .= '.';
  $nama_file_baru .= $ekstensi_file;
  // pindahkan gambar yang tadinya ada di direktori sementara ke direktori tertentu
  move_uploaded_file($tmp_name, 'assets/images/' . $nama_file_baru);
  // kembalikan nilai berupa nama file baru
  // nantinya nama file baru inilah yang dimasukkan kedalam database
  return $nama_file_baru;
}

function hapus($id) {
  // panggil variabel $conn
  global $conn;
  // perintah query
  $query = "DELETE FROM tb_mahasiswa WHERE id = '$id'";
  // jalankan perintah query
  mysqli_query($conn, $query);
  /*
    jika ada perubahan data di database, maka fungsi ini akan menghasilkan nilai 1. tapi apabila tidak ada 
    perubahan sama sekali di database, maka fungsi ini akan menghasilkan nilai 0 atau -1.
  */
  return mysqli_affected_rows($conn);
}

function query($query) {
  // panggil variabel $conn
  global $conn;
  // jalankan perintah query
  $result = mysqli_query($conn, $query);
  // fetch data menjadi array asosiatif
  return mysqli_fetch_assoc($result);
}

function ubah($data, $id, $gambar_lama) {
  // panggil variabel $conn
  global $conn;
  // berikan keamanan pada tiap input 
  $nama = trim(stripslashes(htmlspecialchars($data["nama"])));
  $nrp = trim(htmlspecialchars($data["nrp"]));
  $email = trim(stripslashes(htmlspecialchars($data["email"])));
  $jurusan = trim(stripslashes(htmlspecialchars($data["jurusan"])));
  /*
    jika pengguna tidak mengupload sesuatu, maka jadikan nama file gambar lama sebagai value. tapi apabila pengguna
    mengupload sesuatu, maka jadikan nama file gambar tersebut sebagai value.
  */
  $gambar = $_FILES["gambar"]["error"] === 4 ? $gambar_lama : upload();
  // perintah query
  $query = "UPDATE tb_mahasiswa SET 
    nama = '$nama',
    nrp = '$nrp',
    email = '$email',
    jurusan = '$jurusan',
    gambar = '$gambar'
    WHERE id = '$id'
  ";
  // jalankan perintah query
  mysqli_query($conn, $query);
  /*
    jika ada perubahan data di database, maka fungsi ini akan menghasilkan nilai 1. tapi apabila tidak ada 
    perubahan sama sekali di database, maka fungsi ini akan menghasilkan nilai 0 atau -1.
  */
  return mysqli_affected_rows($conn);
}

function cari($keyword) {
  // panggil variabel $conn
  global $conn;
  // perintah query
  $query = "SELECT * FROM tb_mahasiswa WHERE
    nama LIKE '%$keyword%' OR
    nrp LIKE '%$keyword%' OR
    email LIKE '%$keyword%' OR
    jurusan LIKE '%$keyword%'
    ORDER BY id DESC
  ";
  // jalankan perintah query dan tampilkan semua data yang sesuai
  return queryAll($query);
}