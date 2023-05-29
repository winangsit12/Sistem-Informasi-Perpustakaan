<?php
//memanggil library pdf
require('../../library/fpdf.php');
require_once '../../config/db.php';

//memberikan pengaturan halaman PDF
$pdf = new FPDF('L', 'mm', 'A4');
$pdf->AddPage();

//memberikan pengaturan font untuk judul
$pdf->SetFont('Times', 'B', 13);
$pdf->Cell(275, 10, 'DATA PENGEMBALIAN BUKU', 0, 0, 'C');

//memberikan pengaturan font untuk tabel
$pdf->Cell(10, 15, '', 0, 1);
$pdf->SetFont('Times', 'B', 9);

//membuat tabel
$pdf->Cell(10, 7, 'NO', 1, 0, 'C');
$pdf->Cell(35, 7, 'JUDUL BUKU', 1, 0, 'C');
$pdf->Cell(40, 7, 'NAMA PEMINJAM', 1, 0, 'C');
$pdf->Cell(30, 7, 'NIS', 1, 0, 'C');
$pdf->Cell(30, 7, 'KELAS', 1, 0, 'C');
$pdf->Cell(35, 7, 'TANGGAL PINJAM', 1, 0, 'C');
$pdf->Cell(35, 7, 'TANGGAL KEMBALI', 1, 0, 'C');
$pdf->Cell(35, 7, 'KETEPATAN WAKTU', 1, 0, 'C');
$pdf->Cell(30, 7, 'KEADAAN BUKU', 1, 0, 'C');

//memberikan pengaturan font untuk isi tabel
$pdf->Cell(10, 7, '', 0, 1);
$pdf->SetFont('Times', '', 10);

//membuat isi dari tabel
$no = 1;

$bulan = $conn->real_escape_string($_POST['bulan']);
$tahun = $conn->real_escape_string($_POST['tahun']);

$data = mysqli_query($conn, "SELECT tanggal_pinjam, tanggal_kembali, ketepatan_waktu, keadaan_buku, buku.nama_buku, users.nama, users.username, users.kelas FROM pengembalian
    LEFT JOIN buku ON buku.id_buku = pengembalian.id_buku
    LEFT JOIN users ON users.id_user = pengembalian.id_user
    WHERE MONTH(tanggal_kembali) = '$bulan' AND YEAR(tanggal_kembali) = '$tahun'");
while ($d = mysqli_fetch_array($data)) {
    $pdf->Cell(10, 6, $no++, 1, 0, 'C');
    $pdf->Cell(35, 6, $d['nama_buku'], 1, 0);
    $pdf->Cell(40, 6, $d['nama'], 1, 0);
    $pdf->Cell(30, 6, $d['username'], 1, 0);
    $pdf->Cell(30, 6, $d['kelas'], 1, 0);
    $pdf->Cell(35, 6, date('d-m-Y', strtotime($d['tanggal_pinjam'])), 1, 0);
    $pdf->Cell(35, 6, date('d-m-Y', strtotime($d['tanggal_kembali'])), 1, 0);
    $pdf->Cell(35, 6, $d['ketepatan_waktu'], 1, 0);
    $pdf->Cell(30, 6, $d['keadaan_buku'], 1, 1);
}

$pdf->Output();
