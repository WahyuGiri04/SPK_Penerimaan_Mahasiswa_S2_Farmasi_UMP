<?php include "root.php" ?>

<table style="width: 100%;" border="0" align="center">
    <tr>
        <td rowspan ="3"><img src="images/ump.png" height="100px"></td>
        <td valign="baseline" align="center"><font size="5"><b>UNIVERSITAS MUHAMMADIYAH PURWOKERTO</b></td>
    </tr>
    <tr>
        <td align="center"> Kampus I : Jl. Raya Dukuhwaluh PO.Box 202 Purwokerto 53182 Telp. (0281)636751,630 Fax. (0281) 637239 </td>
    </tr>
    <tr>
        <td align="center">Kampus II: Jl. Letjend Soepardjo Roestam Km. 7 PO. Box 229 Purwokerto 53181 Telp. (0281)6844252,6844253 Fax. (0281) 637239</td>
    </tr>
</table>
<hr size="2px" color="black">
<hr>
<table style="width: 100%;">
    <tr>
        <td align="right">Purwokerto , <?php echo date('d / M / Y'); ?></td>
    <tr>
</table>
<br>
<table style="width: 100%;">
    <tr>
        <td align="center"><font size="4"><b>DATA HASIL PERANGKINGAN CALON MAHASISWA</b></td>
    <tr>
</table>
<br>
<table style="width: 100%;" border="1" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Mahasiswa</th>
            <th>Jenis Kelamin</th>
            <th>Nilai Preferensi</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
        <?php $tampil->cetak_laporan_gelombang($_GET['id_pendaftaran']);?>
    </tbody>
</table>

<script type="text/javascript"> 
  window.addEventListener("load", window.print());
</script>