<?php
if(!isset($_REQUEST['id'])){
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Orden confirmada | BandUp</title>
    <meta charset="utf-8">
    <style>
    .container{width: 100%; padding: 50px;}
    p{color: #34a853;font-size: 18px;}
    </style>
</head>
</head>
<body>
<div class="container">
    <form name='pdf' method='post' action='fpdf/formulariopdf.php'>
        <h1>Estatus de la orden</h1>
        <p>Estimado <?php echo $_SESSION["nombre"]; ?>, </p>
        <p>Su orden fue procesada exitosamente. El ID de la orden es #<?php echo $_GET['id']; ?></p>
        <input type='submit' value='Ver recibo generado' />
    </form>
</div>
</body>
</html>