<?php

require "database.php";
require "plantilla.php";

if (!empty($_POST)) {

    $id = mysqli_escape_string($mysqli, $_POST['id']);

    $sql = "SELECT a.numero, a.tipo_documento, a.apellidos, a.nombres, a.direccion, a.telefono, a.firma, b.id FROM registrar_personas AS a INNER JOIN registrar_vehiculo AS b ON a.id=b.id WHERE b.id = $id";
    $resultado = $mysqli->query($sql);

    $pdf = new PDF("P", "mm", "letter");
    $pdf->AliasNbPages();
    $pdf->SetMargins(10, 10, 10);
    $pdf->AddPage();

    $pdf->SetFont("Arial", "B", 9);

    $pdf->Cell(10, 5, "numero", 1, 0, "C");
    $pdf->Cell(40, 5, "tipo_documento", 1, 0, "C");
    $pdf->Cell(20, 5, "appelidos", 1, 0, "C");
    $pdf->Cell(40, 5, "nombres", 1, 0, "C");
    $pdf->Cell(30, 5, "direccion", 1, 0, "C");
    $pdf->Cell(50, 5, "telefono", 1, 1, "C");
    $pdf->Cell(30, 5, "firma", 1, 0, "C");
    $pdf->Cell(30, 5, "id", 1, 0, "C");

    $pdf->SetFont("Arial", "", 9);

    while ($fila = $resultado->fetch_assoc()) {
        $pdf->Cell(10, 5, $fila['id'], 1, 0, "C");
        $pdf->Cell(40, 5, utf8_decode($fila['nombre']), 1, 0, "C");
        $pdf->Cell(20, 5, $fila['edad'], 1, 0, "C");
        $pdf->Cell(40, 5, $fila['matricula'], 1, 0, "C");
        $pdf->Cell(30, 5, $fila['grado'], 1, 0, "C");
        $pdf->Cell(50, 5, $fila['correo'], 1, 1, "C");
    }

    $pdf->Output();
}