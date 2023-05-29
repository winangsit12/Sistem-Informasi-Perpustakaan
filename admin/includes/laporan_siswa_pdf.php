<?php
//memanggil library pdf
require('../../library/fpdf.php');
require_once '../../config/db.php';

//memberikan pengaturan halaman PDF
$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();

//memberikan pengaturan font untuk judul
$pdf->SetFont('Times', 'B', 13);
$pdf->Cell(200, 10, 'DATA SISWA', 0, 0, 'C');

//memberikan pengaturan font untuk tabel
$pdf->Cell(10, 15, '', 0, 1);
$pdf->SetFont('Times', 'B', 9);

//membuat tabel
$pdf->Cell(10, 7, 'NO', 1, 0, 'C');
$pdf->Cell(60, 7, 'NAMA', 1, 0, 'C');
$pdf->Cell(40, 7, 'NIS', 1, 0, 'C');
$pdf->Cell(40, 7, 'KELAS', 1, 0, 'C');
$pdf->Cell(40, 7, 'JENIS KELAMIN', 1, 0, 'C');

//memberikan pengaturan font untuk isi tabel
$pdf->Cell(10, 7, '', 0, 1);
$pdf->SetFont('Times', '', 10);

//membuat isi dari tabel
$no = 1;
$data = mysqli_query($conn, "SELECT  * FROM users WHERE id_level = 2");
while ($d = mysqli_fetch_array($data)) {
    $pdf->Cell(10, 6, $no++, 1, 0, 'C');
    $pdf->Cell(60, 6, $d['nama'], 1, 0);
    $pdf->Cell(40, 6, $d['username'], 1, 0);
    $pdf->Cell(40, 6, $d['kelas'], 1, 0);
    $pdf->Cell(40, 6, $d['jenis_kelamin'], 1, 1);
}

$pdf->Output();
