<?php
$rootPath = '';
$scriptDir = dirname($_SERVER['SCRIPT_NAME']);
$depth = substr_count(trim($scriptDir, '/'), '/');
if ($depth >= 1) {
    $rootPath = str_repeat('../', $depth);
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <title>SGA</title>

    <link rel="stylesheet"
          href="<?php echo $rootPath; ?>assets/style.css">

</head>

<body>