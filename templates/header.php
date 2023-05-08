<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.2/sweetalert2.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <title><?= $data["title"]; ?></title>
</head>
<?php if (isset($data["body"])) : ?>
<body class="<?= $data["body"]; ?>">
<?php else : ?>
<body>
<?php endif; ?>