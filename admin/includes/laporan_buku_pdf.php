<?php
//memanggil library pdf
require('../../library/fpdf.php');
require_once '../../config/db.php';

//memberikan pengaturan halaman PDF
$pdf = new FPDF('L', 'mm', 'A4');
$pdf->AddPage();

//memberikan pengaturan font untuk judul
$pdf->SetFont('Times', 'B', 13);
$pdf->Cell(275, 10, 'DATA BUKU', 0, 0, 'C');

//memberikan pengaturan font untuk tabel
$pdf->Cell(10, 15, '', 0, 1);
$pdf->SetFont('Times', 'B', 9);

//membuat tabel
$pdf->Cell(10, 7, 'NO', 1, 0, 'C');
$pdf->Cell(40, 7, 'JUDUL BUKU', 1, 0, 'C');
$pdf->Cell(40, 7, 'PENGARANG', 1, 0, 'C');
$pdf->Cell(35, 7, 'PENERBIT', 1, 0, 'C');
$pdf->Cell(30, 7, 'TAHUN TERBIT', 1, 0, 'C');
$pdf->Cell(40, 7, 'KATEGORI', 1, 0, 'C');
$pdf->Cell(40, 7, 'DESKRIPSI', 1, 0, 'C');
$pdf->Cell(40, 7, 'SINOPSIS', 1, 0, 'C');

//memberikan pengaturan font untuk isi tabel
$pdf->Cell(10, 7, '', 0, 1);
$pdf->SetFont('Times', '', 10);

//membuat isi dari tabel
$no = 1;
$data = mysqli_query($conn, "SELECT * FROM buku LEFT JOIN kategori ON buku.id_kategori = kategori.id_kategori");
while ($d = mysqli_fetch_array($data)) {
    $pdf->Cell(10, 6, $no++, 1, 0, 'C');
    $pdf->Cell(40, 6, $d['nama_buku'], 1, 0);
    $pdf->Cell(40, 6, $d['pengarang'], 1, 0);
    $pdf->Cell(35, 6, $d['penerbit'], 1, 0);
    $pdf->Cell(30, 6, $d['tahun_terbit'], 1, 0);
    $pdf->Cell(40, 6, $d['kategori'], 1, 0);
    $pdf->Cell(40, 6, $d['deskripsi'], 1, 0);
    $pdf->Cell(40, 6, $d['sinopsis'], 1, 1);
}

$pdf->Output();
