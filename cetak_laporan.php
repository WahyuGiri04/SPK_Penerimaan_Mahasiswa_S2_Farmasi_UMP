<?php include "root.php" ?>

<table style="width: 100%;" border="0" align="center">
    <tr>
        <td><img style="width: 100%;" src="images/kop_surat.png"></td>
    </tr>
</table>
<br>
<table style="width: 100%;">
    <tr>
        <td align="center"><font size="4"><b>DATA PENDAFTAR </b></td>
    <tr>
</table>
<br>
<table style="width: 100%;" border="1" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Mahasiswa</th>
            <th>Jenis Kelamin</th>
            <th>Point </th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
        <?php $tampil->cetak_laporan($_GET['tahun_pendaftaran']);?>
    </tbody>
</table>

<script type="text/javascript"> 
  window.addEventListener("load", window.print());
</script>