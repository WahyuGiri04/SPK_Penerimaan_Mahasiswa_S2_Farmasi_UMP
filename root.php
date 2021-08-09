<?php 
error_reporting(0);
//class untuk koneksi dengan databases
interface connect{
	function __construct();
	function __destruct();
	function alert($text);
	function redirect($url);
	function go_back();
 }

class koneksi implements connect
{
	public $con;
	function __construct()
	{
		$this->con=new mysqli("localhost","root","","spk_tiara");
	}
	function __destruct()
	{
		$this->con->close();
	}

	function alert($text){
		?><script type="text/javascript">
            alert( "<?= $text ?>" );
        </script>
        <?php
	}

	function redirect($url){
		?>
		<script type="text/javascript">
		window.location.href="<?= $url ?>";
		</script>
		<?php
	}
	function go_back(){
		?>
		<script type="text/javascript">
		window.history.back();
		</script>
		<?php
	}
	function login($username,$password,$loginas){

		if (trim($username)=="") {
			$error[]="username";
		}
		if (trim($password)=="") {
			$error[]="password";
		}
		if (isset($error)) {
            echo "<div class='alert alert-danger alert-mg-b-0' role='alert'>
              Maaf sepertinya ".implode(' dan ', $error)." anda kosong !!!
            </div>"; 
		}else{
		$password=sha1($password);
		$query=$this->con->query("select * from user where username='$username' and password='$password'");

		if ($query->num_rows > 0) {
			echo "<div class='alert alert-success alert-mg-b-0' role='alert'>
              <p align='center'>Login berhasil, Silahkan tunggu </p>
            </div>";
			$data=$query->fetch_assoc();
			session_start();
			$_SESSION['username']=$data['username'];
			$_SESSION['level']=$data['level'];
			$_SESSION['id']=$data['id'];
            $this->redirect("home.php");
		}else{
			echo "<div class='alert alert-danger alert-mg-b-0' role='alert'>
              <p align='center'>Maaf password atau userame salah !!! </p>
            </div>";
		}
		}
    }
}
class tampil extends koneksi{ 
	function tampil_kriteria(){
		$query=$this->con->query("SELECT * FROM kriteria left join atribut on atribut.id_atribut=kriteria.id_atribut");
		$no=1;
		if ($query->num_rows > 0) {
			while ($data=$query->fetch_assoc()) {
			$id_kriteria = $data['id_ket_krit'];	
			?>
				<tr>
					<td> <?php echo $no++; ?> </td>
					<td><?php echo $data['kode_kriteria'] ?></td>
					<td><?php echo $data['nama_ket_krit']?></td>
					<td><?php echo $data['nama_atribut']?></td>
					<td>
						<div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
							<a href="edit_kriteria.php?id_kriteria=<?php echo $id_kriteria ?>" class="btn btn-amber amber-icon-notika btn-reco-mg btn-button-mg" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
							<a href="handler.php?action=hapus_kriteria&id_ket_krit=<?php echo $id_kriteria ?>" onclick="return confirm('Apakah anda yakin ?');" class="btn btn-danger danger-icon-notika btn-reco-mg btn-button-mg" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash"></i></a>
                        </div>
					</td>
				</tr>
             <?php  }
		}else{
			echo "<td></td><td colspan='5'>Maaf, data tidak ada!</td>";
		}
	}
	function tampil_fix_kriteria(){
		$query1 = $this->con->query("SELECT * FROM fix_kriteria ORDER BY fix_kriteria DESC LIMIT 1");
		$data1 = $query1->fetch_assoc();
		$fix_kriteria = $data1['fix_kriteria'];
		$query=$this->con->query("SELECT * FROM fix_kriteria left join atribut on atribut.id_atribut=fix_kriteria.id_atribut LEFT JOIN pv ON fix_kriteria.id_ket_krit=pv.id_pv where fix_kriteria.fix_kriteria = '$fix_kriteria' ");
		$no=1;
		if ($query->num_rows > 0) {
			while ($data=$query->fetch_assoc()) {
			?>
				<tr>
					<td> <?php echo $no++; ?> </td>
					<td><?php echo $data['kode_kriteria'] ?></td>
					<td><?php echo $data['nama_ket_krit']?></td>
					<td><?php echo $data['nama_atribut']?></td>
					<td><?php echo $data['pv'] * 100?> % </td>
				</tr>
             <?php  }
		}else{
			echo "<td></td><td colspan='5'>Maaf, data tidak ada!</td>";
		}
	}
	function tampil_pembobotan_kriteria(){
		$query = $this->con->query("select count(id_ket_krit) as jumlah from kriteria");
		$data = $query->fetch_assoc();
		$jumlah_kriteria = $data['jumlah'];
		$no = 1 ;
		$no_array = 0 ;
		?>
			<thead>
                <tr>
					<th> Kode </th>
					<?php
					$query2 = $this->con->query("SELECT * FROM kriteria");
					while($data2=$query2->fetch_assoc()){?>
						<th><?php echo $data2['kode_kriteria']; ?></th>
					<?php
					}
					?>
				</tr>
        	</thead>
			<tbody>
			<?php
			$query3 = $this->con->query("SELECT * FROM bobot_kriteria order by kode_banding,kode_pembanding");
			while($data3 = $query3->fetch_assoc()){
				$array_bobot[] = $data3['bobot'];
			}
			
			for($i=1; $i<=$jumlah_kriteria; $i++){
				echo "<tr>";
				echo "<td><b> C".$no++."</b></td>";
				for($j=1; $j<=$jumlah_kriteria; $j++){
					echo "<td><b>";
					$bobot[$i][$j] = $array_bobot[$no_array];
					echo round($bobot[$i][$j],2);
					echo "</b></td>";
					$no_array++;
				}
			}

			?>
			</tbody>
			<tfoot>
				<tr>
					<td>Jumlah</td>
				<?php
					$query4 = $this->con->query("SELECT kode_pembanding, SUM(bobot) as jumlah_bobot FROM bobot_kriteria GROUP BY kode_pembanding"); 
					while($data4 = $query4->fetch_assoc()){
						$jumlah_bobot = $data4['jumlah_bobot'];
						echo "<td><b>".$jumlah_bobot."</b></td>" ;
					}
				?>
				</tr>
			<tfoot>	
		<?php
	}
	function tampil_hitung_prioritas_vektor(){
		$query = $this->con->query("select count(id_ket_krit) as jumlah from kriteria");
		$data = $query->fetch_assoc();
		$jumlah_kriteria = $data['jumlah'] ;
		$no = 1 ;
		$no_array = 0 ;
		?>
			<thead>
                <tr>
					<th> Kode </th>
					<?php
					$query2 = $this->con->query("SELECT * FROM kriteria");
					while($data2=$query2->fetch_assoc()){?>
						<th><?php echo $data2['kode_kriteria']; ?></th>
					<?php
					}
					?>
				</tr>
        	</thead>
			<tbody>
			<?php
			$query3 = $this->con->query("SELECT * FROM bobot_kriteria order by kode_banding,kode_pembanding");
			while($data3 = $query3->fetch_assoc()){
				$array_bobot[] = $data3['bobot'];
			}
			$query4 = $this->con->query("SELECT kode_pembanding, SUM(bobot) as jumlah_bobot FROM bobot_kriteria GROUP BY kode_pembanding"); 
			while($data4 = $query4->fetch_assoc()){
				$jumlah_bobot[] = $data4['jumlah_bobot'];
			}
			
			for($i=0; $i< $jumlah_kriteria; $i++){
				echo "<tr>";
				echo "<td><b> C".$no++."</b></td>";
				for($j=0; $j< $jumlah_kriteria; $j++){
					echo "<td><b>";
					$bobot[$i][$j] = $array_bobot[$no_array];
					$jumlah_b[$i][$j] = $jumlah_bobot[$j];

					$hasil[$i][$j] = $bobot[$i][$j]/$jumlah_b[$i][$j] ;
					echo round($hasil[$i][$j],2);
					echo "</b></td>";
					$no_array++;

					$hasil2[$j][$i] = $hasil[$i][$j];
				}
			}

			?>
			</tbody>
			<tfoot>
				<tr>
					<td>Jumlah</td>
				<?php
					for($l=0;$l<$jumlah_kriteria;$l++){
						echo "<td>";
						$jum[$l] = array_sum($hasil2[$l]);
						echo round($jum[$l],4);
						echo "</td>";
					}
				?>
				</tr>
			<tfoot>	
		<?php
	}
	function tampil_hasil_prioritas_vektor(){
		$query = $this->con->query("select count(id_ket_krit) as jumlah from kriteria");
		$data = $query->fetch_assoc();
		$jumlah_kriteria = $data['jumlah'] ;
		$no = 1 ;
		$no_array = 0 ;
		$query3 = $this->con->query("SELECT * FROM bobot_kriteria order by kode_banding,kode_pembanding");
		while($data3 = $query3->fetch_assoc()){
			$array_bobot[] = $data3['bobot'];
		}
		$query4 = $this->con->query("SELECT kode_pembanding, SUM(bobot) as jumlah_bobot FROM bobot_kriteria GROUP BY kode_pembanding"); 
		while($data4 = $query4->fetch_assoc()){
			$jumlah_bobot[] = $data4['jumlah_bobot'];
		}
		
		for($i=0; $i< $jumlah_kriteria; $i++){
			for($j=0; $j< $jumlah_kriteria; $j++){
				$bobot[$i][$j] = $array_bobot[$no_array];
				$jumlah_b[$i][$j] = $jumlah_bobot[$j];
				$hasil[$i][$j] = $bobot[$i][$j]/$jumlah_b[$i][$j] ;
				$no_array++;
			}
		}
		?>
		<thead>
            <tr>
				<th> Prioritas Vektor </th>
			</tr>
    	</thead>
		<tbody>
		<?php
		for($l=0;$l<$jumlah_kriteria;$l++){
			echo "<tr>";
			echo "<td>";
			$jum[$l] = array_sum($hasil[$l]);
			$pv[$l] = $jum[$l]/$jumlah_kriteria ;
			echo round($pv[$l],3);
			echo "</td>";
			echo "</tr>";
		}
		?>
		</body>
		<?php
	}
	function tampil_hasil_matrix_konsistensi(){
		$query = $this->con->query("select count(id_ket_krit) as jumlah from kriteria");
		$data = $query->fetch_assoc();
		$jumlah_kriteria = $data['jumlah'] ;
		$no = 1 ;
		$no_array = 0 ;
        $query3 = $this->con->query("SELECT * FROM bobot_kriteria order by kode_banding,kode_pembanding");
			while($data3 = $query3->fetch_assoc()){
				$array_bobot[] = $data3['bobot'];
			}
			$query4 = $this->con->query("SELECT kode_pembanding, SUM(bobot) as jumlah_bobot FROM bobot_kriteria GROUP BY kode_pembanding"); 
			while($data4 = $query4->fetch_assoc()){
				$jumlah_bobot[] = $data4['jumlah_bobot'];
			}
			for($i=0; $i<$jumlah_kriteria; $i++){
				for($j=0; $j<$jumlah_kriteria; $j++){
                    $bobot[$i][$j] = $array_bobot[$no_array];
                    $jumlah_b[$i][$j] = $jumlah_bobot[$j];
                    $bbt[$j][$i] = $bobot[$i][$j];

                    $hasil[$i][$j] = $bobot[$i][$j]/$jumlah_b[$i][$j] ;
                    $no_array++;   
                }
            }
            for($l=0;$l<$jumlah_kriteria;$l++){
                $jum[$l] = array_sum($hasil[$l]);
                $pv[0][$l] = $jum[$l]/$jumlah_kriteria ;
            }
        for($baris = 0 ; $baris < $jumlah_kriteria ; $baris++){
            for($kolom = 0 ; $kolom < $jumlah_kriteria ; $kolom++){
                $bbt[$baris][$kolom] = $bobot[$baris][$kolom];
                $prioritas[0][$kolom] = $pv[0][$kolom];
                $konsistensi[$baris][$kolom] = ($bbt[$baris][$kolom] * $prioritas[0][$kolom]);
            }

		}
		echo "<thead>
		<tr>
			<th> Matrix Konsistensi </th>
		</tr>
		</thead>
		<tbody>";
        for($bar = 0 ; $bar < $jumlah_kriteria ; $bar++){
            echo "<tr>";
            echo "<td>";
            $sum_konsistensi[$bar] = array_sum($konsistensi[$bar]);
            echo round($sum_konsistensi[$bar],3) ; 
            echo "</td>";
            echo "</tr>";
		}
		echo "</tbody>";
	}
	function eigen_max(){
		$query = $this->con->query("select count(id_ket_krit) as jumlah from kriteria");
		$data = $query->fetch_assoc();
		$jumlah_kriteria = $data['jumlah'] ;
		$no = 1 ;
		$no_array = 0 ;
        $query3 = $this->con->query("SELECT * FROM bobot_kriteria order by kode_banding,kode_pembanding");
			while($data3 = $query3->fetch_assoc()){
				$array_bobot[] = $data3['bobot'];
			}
			$query4 = $this->con->query("SELECT kode_pembanding, SUM(bobot) as jumlah_bobot FROM bobot_kriteria GROUP BY kode_pembanding"); 
			while($data4 = $query4->fetch_assoc()){
				$jumlah_bobot[] = $data4['jumlah_bobot'];
			}
            
			for($i=0; $i<$jumlah_kriteria; $i++){
				for($j=0; $j<$jumlah_kriteria; $j++){
                    $bobot[$i][$j] = $array_bobot[$no_array];
                    $jumlah_b[$i][$j] = $jumlah_bobot[$j];
                    $bbt[$j][$i] = $bobot[$i][$j];

                    $hasil[$i][$j] = $bobot[$i][$j]/$jumlah_b[$i][$j] ;
                    $no_array++;   
                }
            }

            for($l=0;$l<$jumlah_kriteria;$l++){

                $jum[$l] = array_sum($hasil[$l]);
                $pv[0][$l] = $jum[$l]/$jumlah_kriteria ;

            }

        for($baris = 0 ; $baris < $jumlah_kriteria ; $baris++){

            for($kolom = 0 ; $kolom < $jumlah_kriteria ; $kolom++){
                $bbt[$baris][$kolom] = $bobot[$baris][$kolom];
                $prioritas[0][$kolom] = $pv[0][$kolom];
                $konsistensi[$baris][$kolom] = ($bbt[$baris][$kolom] * $prioritas[0][$kolom]);

            }

        }

        for($bar = 0 ; $bar < $jumlah_kriteria ; $bar++){

            $sum_konsistensi[$bar] = array_sum($konsistensi[$bar]);
            $prio_v[0][$bar] = $prioritas[0][$bar];
            $eigen_max[$bar] = $sum_konsistensi[$bar] /  $prio_v[0][$bar] ; 

        }
		echo "<thead>";
		echo "<tr>";
		echo "<td><font size='6' >&lambda;Max</font></td>";
		echo "<td><font size='6' > = </font></td>";
		echo "<td><font size='6' >";
        $hasil_eigen_max = (array_sum($eigen_max))/$jumlah_kriteria;
		echo $hasil_eigen_max ; 
		echo "</font></td>";
		echo "</tr>";
		echo "</thead>";
	}
	function ci(){
		$query = $this->con->query("select count(id_ket_krit) as jumlah from kriteria");
		$data = $query->fetch_assoc();
		$jumlah_kriteria = $data['jumlah'] ;
		$no = 1 ;
		$no_array = 0 ;
        $query3 = $this->con->query("SELECT * FROM bobot_kriteria order by kode_banding,kode_pembanding");
			while($data3 = $query3->fetch_assoc()){
				$array_bobot[] = $data3['bobot'];
			}
			$query4 = $this->con->query("SELECT kode_pembanding, SUM(bobot) as jumlah_bobot FROM bobot_kriteria GROUP BY kode_pembanding"); 
			while($data4 = $query4->fetch_assoc()){
				$jumlah_bobot[] = $data4['jumlah_bobot'];
			}
            
			for($i=0; $i<$jumlah_kriteria; $i++){
				for($j=0; $j<$jumlah_kriteria; $j++){
                    $bobot[$i][$j] = $array_bobot[$no_array];
                    $jumlah_b[$i][$j] = $jumlah_bobot[$j];
                    $bbt[$j][$i] = $bobot[$i][$j];

                    $hasil[$i][$j] = $bobot[$i][$j]/$jumlah_b[$i][$j] ;
                    $no_array++;   
                }
            }

            for($l=0;$l<$jumlah_kriteria;$l++){

                $jum[$l] = array_sum($hasil[$l]);
                $pv[0][$l] = $jum[$l]/$jumlah_kriteria ;

            }

        for($baris = 0 ; $baris < $jumlah_kriteria ; $baris++){

            for($kolom = 0 ; $kolom < $jumlah_kriteria ; $kolom++){
                $bbt[$baris][$kolom] = $bobot[$baris][$kolom];
                $prioritas[0][$kolom] = $pv[0][$kolom];
                $konsistensi[$baris][$kolom] = ($bbt[$baris][$kolom] * $prioritas[0][$kolom]);

            }

        }

        for($bar = 0 ; $bar < $jumlah_kriteria ; $bar++){

            $sum_konsistensi[$bar] = array_sum($konsistensi[$bar]);
            $prio_v[0][$bar] = $prioritas[0][$bar];
            $eigen_max[$bar] = $sum_konsistensi[$bar] /  $prio_v[0][$bar] ; 

        }
		echo "<thead>";
		echo "<tr>";
		echo "<td><font size='6' > CI </font></td>";
		echo "<td><font size='6' > = </font></td>";
		echo "<td><font size='6' >";
        $hasil_eigen_max = (array_sum($eigen_max))/$jumlah_kriteria;
        $ci = ($hasil_eigen_max-$jumlah_kriteria) / ($jumlah_kriteria - 1);
        echo $ci ; 
		echo "</font></td>";
		echo "</tr>";
		echo "</thead>";
         
	}
	function cr(){
		$query = $this->con->query("select count(id_ket_krit) as jumlah from kriteria");
		$data = $query->fetch_assoc();
		$jumlah_kriteria = $data['jumlah'] ;
		$no = 1 ;
		$no_array = 0 ;
        $query3 = $this->con->query("SELECT * FROM bobot_kriteria order by kode_banding,kode_pembanding");
			while($data3 = $query3->fetch_assoc()){
				$array_bobot[] = $data3['bobot'];
			}
			$query4 = $this->con->query("SELECT kode_pembanding, SUM(bobot) as jumlah_bobot FROM bobot_kriteria GROUP BY kode_pembanding"); 
			while($data4 = $query4->fetch_assoc()){
				$jumlah_bobot[] = $data4['jumlah_bobot'];
			}
            
			for($i=0; $i<$jumlah_kriteria; $i++){
				for($j=0; $j<$jumlah_kriteria; $j++){
                    $bobot[$i][$j] = $array_bobot[$no_array];
                    $jumlah_b[$i][$j] = $jumlah_bobot[$j];
                    $bbt[$j][$i] = $bobot[$i][$j];

                    $hasil[$i][$j] = $bobot[$i][$j]/$jumlah_b[$i][$j] ;
                    $no_array++;   
                }
            }

            for($l=0;$l<$jumlah_kriteria;$l++){

                $jum[$l] = array_sum($hasil[$l]);
                $pv[0][$l] = $jum[$l]/$jumlah_kriteria ;

            }

        for($baris = 0 ; $baris < $jumlah_kriteria ; $baris++){

            for($kolom = 0 ; $kolom < $jumlah_kriteria ; $kolom++){
                $bbt[$baris][$kolom] = $bobot[$baris][$kolom];
                $prioritas[0][$kolom] = $pv[0][$kolom];
                $konsistensi[$baris][$kolom] = ($bbt[$baris][$kolom] * $prioritas[0][$kolom]);

            }

        }

        for($bar = 0 ; $bar < $jumlah_kriteria ; $bar++){

            $sum_konsistensi[$bar] = array_sum($konsistensi[$bar]);
            $prio_v[0][$bar] = $prioritas[0][$bar];
            $eigen_max[$bar] = $sum_konsistensi[$bar] /  $prio_v[0][$bar] ; 

        }

        $query5 = $this->con->query("SELECT * FROM tabel_cr WHERE n = '$jumlah_kriteria' ");
        $data5 = $query5->fetch_assoc();
        $index_konsistensi = $data5['ci'];

        $hasil_eigen_max = (array_sum($eigen_max))/$jumlah_kriteria;
        $ci = ($hasil_eigen_max-$jumlah_kriteria) / ($jumlah_kriteria - 1);

		global $cr ,$keterangan,$tombol,$script ;
		$cr = $ci / $index_konsistensi ;
		if($cr < 0){
			$keterangan = 'TIDAK KONSISTEN (karena bernilai NEGATIF)' ;
			$tombol = "<td align='right'><a href='setting_bobot.php' class='btn btn-danger notika-btn-danger' ><i class='fa fa-backward'></i> Kembali ke Setting Bobot kriteria</a></td>";
			$script = "<script>$('#myModol').modal('show');</script>" ;
		}
		elseif($cr<=0.1){
			$keterangan = 'KONSISTEN' ;
			$tombol = "<td align='left'><a href='handler.php?action=simpan_kriteria' class='btn btn-primary notika-btn-primary' ><i class='fa fa-save'></i> Simpan Data kriteria </a></td>";
			$script = "<script>$('#myModalfourteen').modal('show');</script>" ;
		}
		else{
			$keterangan = 'TIDAK KONSISTEN' ;
			$tombol = "<td align='right'><a href='setting_bobot.php' class='btn btn-danger notika-btn-danger' ><i class='fa fa-backward'></i> Kembali ke Setting Bobot kriteria</a></td>";
			$script = "<script>$('#myModalnine').modal('show');</script>" ;
		}
	}
	function tampil_pembobotan_fix_kriteria(){
		$query1 = $this->con->query("SELECT * FROM fix_kriteria ORDER BY fix_kriteria DESC LIMIT 1");
		$data1 = $query1->fetch_assoc();
		$fix_kriteria = $data1['fix_kriteria'];
		$query = $this->con->query("select count(id_ket_krit) as jumlah from fix_kriteria where fix_kriteria = '$fix_kriteria' ");
		$data = $query->fetch_assoc();
		$jumlah_kriteria = $data['jumlah'];
		$no = 1 ;
		$no_array = 0 ;
		?>
			<thead>
                <tr>
					<th> Kode </th>
					<?php
					$query2 = $this->con->query("SELECT * FROM fix_kriteria where fix_kriteria = '$fix_kriteria' ");
					while($data2=$query2->fetch_assoc()){?>
						<th><?php echo $data2['kode_kriteria']; ?></th>
					<?php
					}
					?>
				</tr>
        	</thead>
			<tbody>
			<?php
			$query3 = $this->con->query("SELECT * FROM fix_bobot_kriteria where fix_bobot = '$fix_kriteria' order by kode_banding,kode_pembanding");
			while($data3 = $query3->fetch_assoc()){
				$array_bobot[] = $data3['bobot'];
			}
			
			for($i=1; $i<=$jumlah_kriteria; $i++){
				echo "<tr>";
				echo "<td><b> C".$no++."</b></td>";
				for($j=1; $j<=$jumlah_kriteria; $j++){
					echo "<td><b>";
					$bobot[$i][$j] = $array_bobot[$no_array];
					echo round($bobot[$i][$j],2);
					echo "</b></td>";
					$no_array++;
				}
			}

			?>
			</tbody>
			<tfoot>
				<tr>
					<td>Jumlah</td>
				<?php
					$query4 = $this->con->query("SELECT kode_pembanding, SUM(bobot) as jumlah_bobot FROM fix_bobot_kriteria where fix_bobot ='$fix_kriteria' GROUP BY kode_pembanding"); 
					while($data4 = $query4->fetch_assoc()){
						$jumlah_bobot = $data4['jumlah_bobot'];
						echo "<td><b>".$jumlah_bobot."</b></td>" ;
					}
				?>
				</tr>
			<tfoot>	
		<?php
	}
	function tampil_hitung_fix_prioritas_vektor(){
		$query_kriteria = $this->con->query("SELECT * FROM fix_kriteria ORDER BY fix_kriteria DESC LIMIT 1");
		$data_kriteria = $query_kriteria->fetch_assoc();
		$fix_kriteria = $data_kriteria['fix_kriteria'];
		$query = $this->con->query("select count(id_ket_krit) as jumlah from fix_kriteria where fix_kriteria = '$fix_kriteria' ");
		$data = $query->fetch_assoc();
		$jumlah_kriteria = $data['jumlah'] ;
		$no = 1 ;
		$no_array = 0 ;
		?>
			<thead>
                <tr>
					<th> Kode </th>
					<?php
					$query2 = $this->con->query("SELECT * FROM fix_kriteria where fix_kriteria = '$fix_kriteria'");
					while($data2=$query2->fetch_assoc()){?>
						<th><?php echo $data2['kode_kriteria']; ?></th>
					<?php
					}
					?>
				</tr>
        	</thead>
			<tbody>
			<?php
			$query3 = $this->con->query("SELECT * FROM fix_bobot_kriteria  where fix_bobot = '$fix_kriteria' order by kode_banding,kode_pembanding");
			while($data3 = $query3->fetch_assoc()){
				$array_bobot[] = $data3['bobot'];
			}
			$query4 = $this->con->query("SELECT kode_pembanding, SUM(bobot) as jumlah_bobot FROM fix_bobot_kriteria where fix_bobot = '$fix_kriteria' GROUP BY kode_pembanding"); 
			while($data4 = $query4->fetch_assoc()){
				$jumlah_bobot[] = $data4['jumlah_bobot'];
			}
			
			for($i=0; $i< $jumlah_kriteria; $i++){
				echo "<tr>";
				echo "<td><b> C".$no++."</b></td>";
				for($j=0; $j< $jumlah_kriteria; $j++){
					echo "<td><b>";
					$bobot[$i][$j] = $array_bobot[$no_array];
					$jumlah_b[$i][$j] = $jumlah_bobot[$j];

					$hasil[$i][$j] = $bobot[$i][$j]/$jumlah_b[$i][$j] ;
					echo round($hasil[$i][$j],2);
					echo "</b></td>";
					$no_array++;

					$hasil2[$j][$i] = $hasil[$i][$j];
				}
			}

			?>
			</tbody>
			<tfoot>
				<tr>
					<td>Jumlah</td>
				<?php
					for($l=0;$l<$jumlah_kriteria;$l++){
						echo "<td>";
						$jum[$l] = array_sum($hasil2[$l]);
						echo round($jum[$l],4);
						echo "</td>";
					}
				?>
				</tr>
			<tfoot>	
		<?php
	}
	function tampil_hasil_fix_prioritas_vektor(){
		$query_kriteria = $this->con->query("SELECT * FROM fix_kriteria ORDER BY fix_kriteria DESC LIMIT 1");
		$data_kriteria = $query_kriteria->fetch_assoc();
		$fix_kriteria = $data_kriteria['fix_kriteria'];
		$query = $this->con->query("select count(id_ket_krit) as jumlah from fix_kriteria where fix_kriteria = '$fix_kriteria'");
		$data = $query->fetch_assoc();
		$jumlah_kriteria = $data['jumlah'] ;
		$no = 1 ;
		$no_array = 0 ;
		$query3 = $this->con->query("SELECT * FROM fix_bobot_kriteria where fix_bobot = '$fix_kriteria' order by kode_banding,kode_pembanding");
		while($data3 = $query3->fetch_assoc()){
			$array_bobot[] = $data3['bobot'];
		}
		$query4 = $this->con->query("SELECT kode_pembanding, SUM(bobot) as jumlah_bobot FROM fix_bobot_kriteria where fix_bobot = '$fix_kriteria' GROUP BY kode_pembanding"); 
		while($data4 = $query4->fetch_assoc()){
			$jumlah_bobot[] = $data4['jumlah_bobot'];
		}
		
		for($i=0; $i< $jumlah_kriteria; $i++){
			for($j=0; $j< $jumlah_kriteria; $j++){
				$bobot[$i][$j] = $array_bobot[$no_array];
				$jumlah_b[$i][$j] = $jumlah_bobot[$j];
				$hasil[$i][$j] = $bobot[$i][$j]/$jumlah_b[$i][$j] ;
				$no_array++;
			}
		}
		?>
		<thead>
            <tr>
				<th> Prioritas Vektor </th>
			</tr>
    	</thead>
		<tbody>
		<?php
		for($l=0;$l<$jumlah_kriteria;$l++){
			echo "<tr>";
			echo "<td>";
			$jum[$l] = array_sum($hasil[$l]);
			$pv[$l] = $jum[$l]/$jumlah_kriteria ;
			echo round($pv[$l],3);
			echo "</td>";
			echo "</tr>";
		}
		?>
		</tbody>
		<tfoot>
			<td><?php echo array_sum($pv)?><td>
		</tfoot>
		<?php
	}
	function tampil_hasil_fix_matrix_konsistensi(){
		$query_kriteria = $this->con->query("SELECT * FROM fix_kriteria ORDER BY fix_kriteria DESC LIMIT 1");
		$data_kriteria = $query_kriteria->fetch_assoc();
		$fix_kriteria = $data_kriteria['fix_kriteria'];
		$query = $this->con->query("select count(id_ket_krit) as jumlah from fix_kriteria where fix_kriteria = '$fix_kriteria'");
		$data = $query->fetch_assoc();
		$jumlah_kriteria = $data['jumlah'] ;
		$no = 1 ;
		$no_array = 0 ;
        $query3 = $this->con->query("SELECT * FROM fix_bobot_kriteria where fix_bobot = '$fix_kriteria' order by kode_banding,kode_pembanding");
			while($data3 = $query3->fetch_assoc()){
				$array_bobot[] = $data3['bobot'];
			}
			$query4 = $this->con->query("SELECT kode_pembanding, SUM(bobot) as jumlah_bobot FROM fix_bobot_kriteria where fix_bobot = '$fix_kriteria' GROUP BY kode_pembanding"); 
			while($data4 = $query4->fetch_assoc()){
				$jumlah_bobot[] = $data4['jumlah_bobot'];
			}
			for($i=0; $i<$jumlah_kriteria; $i++){
				for($j=0; $j<$jumlah_kriteria; $j++){
                    $bobot[$i][$j] = $array_bobot[$no_array];
                    $jumlah_b[$i][$j] = $jumlah_bobot[$j];
                    $bbt[$j][$i] = $bobot[$i][$j];

                    $hasil[$i][$j] = $bobot[$i][$j]/$jumlah_b[$i][$j] ;
                    $no_array++;   
                }
            }
            for($l=0;$l<$jumlah_kriteria;$l++){
                $jum[$l] = array_sum($hasil[$l]);
                $pv[0][$l] = $jum[$l]/$jumlah_kriteria ;
            }
        for($baris = 0 ; $baris < $jumlah_kriteria ; $baris++){
            for($kolom = 0 ; $kolom < $jumlah_kriteria ; $kolom++){
                $bbt[$baris][$kolom] = $bobot[$baris][$kolom];
                $prioritas[0][$kolom] = $pv[0][$kolom];
                $konsistensi[$baris][$kolom] = ($bbt[$baris][$kolom] * $prioritas[0][$kolom]);
            }

		}
		echo "<thead>
		<tr>
			<th> Matrix Konsistensi </th>
		</tr>
		</thead>
		<tbody>";
        for($bar = 0 ; $bar < $jumlah_kriteria ; $bar++){
            echo "<tr>";
            echo "<td>";
            $sum_konsistensi[$bar] = array_sum($konsistensi[$bar]);
            echo round($sum_konsistensi[$bar],3); 
            echo "</td>";
            echo "</tr>";
		}
		echo "</tbody>";
	}
	function fix_eigen_max(){
		$query_kriteria = $this->con->query("SELECT * FROM fix_kriteria ORDER BY fix_kriteria DESC LIMIT 1");
		$data_kriteria = $query_kriteria->fetch_assoc();
		$fix_kriteria = $data_kriteria['fix_kriteria'];
		$query = $this->con->query("select count(id_ket_krit) as jumlah from fix_kriteria where fix_kriteria = '$fix_kriteria'");
		$data = $query->fetch_assoc();
		$jumlah_kriteria = $data['jumlah'] ;
		$no = 1 ;
		$no_array = 0 ;
        $query3 = $this->con->query("SELECT * FROM fix_bobot_kriteria where fix_bobot = '$fix_kriteria' order by kode_banding,kode_pembanding");
			while($data3 = $query3->fetch_assoc()){
				$array_bobot[] = $data3['bobot'];
			}
			$query4 = $this->con->query("SELECT kode_pembanding, SUM(bobot) as jumlah_bobot FROM fix_bobot_kriteria where fix_bobot = '$fix_kriteria' GROUP BY kode_pembanding"); 
			while($data4 = $query4->fetch_assoc()){
				$jumlah_bobot[] = $data4['jumlah_bobot'];
			}
            
			for($i=0; $i<$jumlah_kriteria; $i++){
				for($j=0; $j<$jumlah_kriteria; $j++){
                    $bobot[$i][$j] = $array_bobot[$no_array];
                    $jumlah_b[$i][$j] = $jumlah_bobot[$j];
                    $bbt[$j][$i] = $bobot[$i][$j];

                    $hasil[$i][$j] = $bobot[$i][$j]/$jumlah_b[$i][$j] ;
                    $no_array++;   
                }
            }

            for($l=0;$l<$jumlah_kriteria;$l++){

                $jum[$l] = array_sum($hasil[$l]);
                $pv[0][$l] = $jum[$l]/$jumlah_kriteria ;

            }

        for($baris = 0 ; $baris < $jumlah_kriteria ; $baris++){

            for($kolom = 0 ; $kolom < $jumlah_kriteria ; $kolom++){
                $bbt[$baris][$kolom] = $bobot[$baris][$kolom];
                $prioritas[0][$kolom] = $pv[0][$kolom];
                $konsistensi[$baris][$kolom] = ($bbt[$baris][$kolom] * $prioritas[0][$kolom]);

            }

        }

        for($bar = 0 ; $bar < $jumlah_kriteria ; $bar++){

            $sum_konsistensi[$bar] = array_sum($konsistensi[$bar]);
            $prio_v[0][$bar] = $prioritas[0][$bar];
            $eigen_max[$bar] = $sum_konsistensi[$bar] /  $prio_v[0][$bar] ; 

        }
		echo "<thead>";
		echo "<tr>";
		echo "<td><font size='6' >&lambda;Max</font></td>";
		echo "<td><font size='6' > = </font></td>";
		echo "<td><font size='6' >";
        $hasil_eigen_max = (array_sum($eigen_max))/$jumlah_kriteria;
		echo $hasil_eigen_max ; 
		echo "</font></td>";
		echo "</tr>";
		echo "</thead>";
	}
	function fix_ci(){
		$query_kriteria = $this->con->query("SELECT * FROM fix_kriteria ORDER BY fix_kriteria DESC LIMIT 1");
		$data_kriteria = $query_kriteria->fetch_assoc();
		$fix_kriteria = $data_kriteria['fix_kriteria'];
		$query = $this->con->query("select count(id_ket_krit) as jumlah from fix_kriteria  where fix_kriteria = '$fix_kriteria' ");
		$data = $query->fetch_assoc();
		$jumlah_kriteria = $data['jumlah'] ;
		$no = 1 ;
		$no_array = 0 ;
        $query3 = $this->con->query("SELECT * FROM fix_bobot_kriteria where fix_bobot = '$fix_kriteria' order by kode_banding,kode_pembanding");
			while($data3 = $query3->fetch_assoc()){
				$array_bobot[] = $data3['bobot'];
			}
			$query4 = $this->con->query("SELECT kode_pembanding, SUM(bobot) as jumlah_bobot FROM fix_bobot_kriteria where fix_bobot = '$fix_kriteria' GROUP BY kode_pembanding"); 
			while($data4 = $query4->fetch_assoc()){
				$jumlah_bobot[] = $data4['jumlah_bobot'];
			}
            
			for($i=0; $i<$jumlah_kriteria; $i++){
				for($j=0; $j<$jumlah_kriteria; $j++){
                    $bobot[$i][$j] = $array_bobot[$no_array];
                    $jumlah_b[$i][$j] = $jumlah_bobot[$j];
                    $bbt[$j][$i] = $bobot[$i][$j];

                    $hasil[$i][$j] = $bobot[$i][$j]/$jumlah_b[$i][$j] ;
                    $no_array++;   
                }
            }

            for($l=0;$l<$jumlah_kriteria;$l++){

                $jum[$l] = array_sum($hasil[$l]);
                $pv[0][$l] = $jum[$l]/$jumlah_kriteria ;

            }

        for($baris = 0 ; $baris < $jumlah_kriteria ; $baris++){

            for($kolom = 0 ; $kolom < $jumlah_kriteria ; $kolom++){
                $bbt[$baris][$kolom] = $bobot[$baris][$kolom];
                $prioritas[0][$kolom] = $pv[0][$kolom];
                $konsistensi[$baris][$kolom] = ($bbt[$baris][$kolom] * $prioritas[0][$kolom]);

            }

        }

        for($bar = 0 ; $bar < $jumlah_kriteria ; $bar++){

            $sum_konsistensi[$bar] = array_sum($konsistensi[$bar]);
            $prio_v[0][$bar] = $prioritas[0][$bar];
            $eigen_max[$bar] = $sum_konsistensi[$bar] /  $prio_v[0][$bar] ; 

        }
		echo "<thead>";
		echo "<tr>";
		echo "<td><font size='6' > CI </font></td>";
		echo "<td><font size='6' > = </font></td>";
		echo "<td><font size='6' >";
        $hasil_eigen_max = (array_sum($eigen_max))/$jumlah_kriteria;
        $ci = ($hasil_eigen_max-$jumlah_kriteria) / ($jumlah_kriteria - 1);
        echo $ci ; 
		echo "</font></td>";
		echo "</tr>";
		echo "</thead>";
         
	}
	function fix_cr(){
		$query_kriteria = $this->con->query("SELECT * FROM fix_kriteria ORDER BY fix_kriteria DESC LIMIT 1");
		$data_kriteria = $query_kriteria->fetch_assoc();
		$fix_kriteria = $data_kriteria['fix_kriteria'];
		$query = $this->con->query("select count(id_ket_krit) as jumlah from fix_kriteria where fix_kriteria = '$fix_kriteria' ");
		$data = $query->fetch_assoc();
		$jumlah_kriteria = $data['jumlah'] ;
		$no = 1 ;
		$no_array = 0 ;
        $query3 = $this->con->query("SELECT * FROM fix_bobot_kriteria where fix_bobot = '$fix_kriteria' order by kode_banding,kode_pembanding");
			while($data3 = $query3->fetch_assoc()){
				$array_bobot[] = $data3['bobot'];
			}
			$query4 = $this->con->query("SELECT kode_pembanding, SUM(bobot) as jumlah_bobot FROM fix_bobot_kriteria where fix_bobot = '$fix_kriteria' GROUP BY kode_pembanding"); 
			while($data4 = $query4->fetch_assoc()){
				$jumlah_bobot[] = $data4['jumlah_bobot'];
			}
            
			for($i=0; $i<$jumlah_kriteria; $i++){
				for($j=0; $j<$jumlah_kriteria; $j++){
                    $bobot[$i][$j] = $array_bobot[$no_array];
                    $jumlah_b[$i][$j] = $jumlah_bobot[$j];
                    $bbt[$j][$i] = $bobot[$i][$j];

                    $hasil[$i][$j] = $bobot[$i][$j]/$jumlah_b[$i][$j] ;
                    $no_array++;   
                }
            }

            for($l=0;$l<$jumlah_kriteria;$l++){

                $jum[$l] = array_sum($hasil[$l]);
                $pv[0][$l] = $jum[$l]/$jumlah_kriteria ;

            }

        for($baris = 0 ; $baris < $jumlah_kriteria ; $baris++){

            for($kolom = 0 ; $kolom < $jumlah_kriteria ; $kolom++){
                $bbt[$baris][$kolom] = $bobot[$baris][$kolom];
                $prioritas[0][$kolom] = $pv[0][$kolom];
                $konsistensi[$baris][$kolom] = ($bbt[$baris][$kolom] * $prioritas[0][$kolom]);

            }

        }

        for($bar = 0 ; $bar < $jumlah_kriteria ; $bar++){

            $sum_konsistensi[$bar] = array_sum($konsistensi[$bar]);
            $prio_v[0][$bar] = $prioritas[0][$bar];
            $eigen_max[$bar] = $sum_konsistensi[$bar] /  $prio_v[0][$bar] ; 

        }

        $query5 = $this->con->query("SELECT * FROM tabel_cr WHERE n = '$jumlah_kriteria' ");
        $data5 = $query5->fetch_assoc();
        $index_konsistensi = $data5['ci'];

        $hasil_eigen_max = (array_sum($eigen_max))/$jumlah_kriteria;
        $ci = ($hasil_eigen_max-$jumlah_kriteria) / ($jumlah_kriteria - 1);

		global $cr ,$keterangan;
		$cr = $ci / $index_konsistensi ;
		if($cr<=0.1){
			$keterangan = 'KONSISTEN' ;
		}else{
			$keterangan = 'TIDAK KONSISTEN' ;
		}
	}
	function tampil_data_mahasiswa($id_pendaftaran){
		$query=$this->con->query("select * from data_mahasiswa INNER JOIN perangkingan on data_mahasiswa.no_mahasiswa=perangkingan.no_mahasiswa where data_mahasiswa.id_pendaftaran='$id_pendaftaran' group by data_mahasiswa.no_mahasiswa");
		$no=1;
		if ($query->num_rows > 0) {
			while ($data=$query->fetch_assoc()) {
				$id_mahasiswa = $data['id_mahasiswa'];
				$no_mahasiswa = $data['no_mahasiswa'];
				?>
				<tr>
					<td> <?php echo $no++; ?> </td>
					<td><?php echo $data['no_mahasiswa'] ?></td>
					<td><?php echo $data['nama_mahasiswa'] ?></td>
					<td><?php echo $data['jenis_kelamin']?></td>
					<td><?php echo $data['asal_ptn']?></td>
					<td><?php echo $data['nilai_preferensi'] ?> </td>
					<td><?php echo $data['tanggal_pendaftaran'] ?> </td>
					<td>
						<div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
							<a href="detail_data_mahasiswa.php?no_mahasiswa=<?php echo $no_mahasiswa ?>"  class="btn btn-primary primary-icon-notika btn-reco-mg btn-button-mg" data-toggle="tooltip" data-placement="top" title="Detail Data Mahasiswa"><i class="fa fa-file"></i></a>
							<button type="button" class="btn btn-success success-icon-notika btn-reco-mg btn-button-mg" data-id="<?php echo $data['no_mahasiswa'] ?>" data-toggle="modal" data-target="#modal_data" ><i class="fa fa-info-circle"></i></button>
							<a href="edit_mahasiswa.php?no_mahasiswa=<?php echo $no_mahasiswa ?>"  class="btn btn-amber amber-icon-notika btn-reco-mg btn-button-mg" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
							<a href="handler.php?action=hapus_mahasiswa&no_mahasiswa=<?php echo $no_mahasiswa ?>&id_pendaftaran=<?php echo $id_pendaftaran ?>" onclick="return confirm('Apakah anda yakin ?');" class="btn btn-danger danger-icon-notika btn-reco-mg btn-button-mg" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash"></i></a>
                        </div>
					</td>
				</tr>
             <?php  }
		}else{
			echo "<td></td><td colspan='5'>Maaf, data tidak ada!</td>";
		}	
	}//belum (kurang hapus dan edit)
	function tampil_penilaian(){
		$query = $this->con->query("select * from kriteria");
		while($data=$query->fetch_assoc()){
			echo "<table class='table table-sc-e'>";
			echo "<thead>";
			echo "<th> Kode kriteria </th>";
			echo "<th> Nama kriteria </th>";
			echo "<th> Nilai Awal </th>";
			echo "<th> Nilai Akhir </th>";
			echo "<th> Keterangan </th>";
			echo "</thead>";
			echo "<tbody>" ;
			$query1 = $this->con->query("select * from keterangan_penilaian");
			while($data1=$query1->fetch_assoc()){
				$id_penilaian = $data1['id_penilaian'];
				$kode = $data['kode_kriteria'];
				$keterangan = $data1['keterangan'];
				$nama_kriteria = $data['nama_ket_krit'];
				echo "<tr>";
					echo "<td>"; echo $kode ; echo "<input hidden type='text' value = '$kode' required class='form-control input-sm' name='kode[]'>";echo "</td>";
					echo "<td>"; echo $nama_kriteria ; echo "<input hidden type='text' value = '$nama_kriteria' required class='form-control input-sm' name='nama_kriteria[]'>"; echo "</td>";
					echo "<td>"; echo "<input type='text' required class='form-control input-sm' name='nilai_awal[]'>"; echo "</td>";
					echo "<td>"; echo "<input type='text' required class='form-control input-sm' name='nilai_akhir[]'>"; echo "</td>";
					echo "<td>"; echo $keterangan ; echo "<input hidden type='text' value = '$id_penilaian' required class='form-control input-sm' name='id_penilaian[]'>"; echo "</td>";
				echo "</tr>";
			}
			echo "</tbody>" ;
			echo "</table>";
			echo "<br>";
		}
	}
	function tampil_detail_penilaian(){
		$query_kriteria = $this->con->query("SELECT * FROM fix_kriteria ORDER BY fix_kriteria DESC LIMIT 1");
		$data_kriteria = $query_kriteria->fetch_assoc();
		$fix_kriteria = $data_kriteria['fix_kriteria'];
        $query = $this->con->query("select * from range_penilaian inner join fix_kriteria on range_penilaian.kode_kriteria=fix_kriteria.kode_kriteria WHERE range_penilaian.fix_kriteria='$fix_kriteria' and fix_kriteria.fix_kriteria='$fix_kriteria' group by range_penilaian.kode_kriteria");
        echo "<table class='table table-sc-e'>";
        echo "<thead>";
		echo "<th> Kode kriteria </th>";
		echo "<th> Nama kriteria </th>";
		echo "<th> Nilai Awal </th>";
		echo "<th> Nilai Akhir </th>";
		echo "<th> Keterangan </th>";
		echo "</thead>";
		echo "<tbody>" ;
		while($data=$query->fetch_assoc()){
            $kode = $data['kode_kriteria'];
            $nama_kriteria = $data['nama_ket_krit'];
		    echo "<tr>";
			echo "<td>"; echo $kode ; echo "<input hidden type='text' value = '$kode' required class='form-control input-sm' name='kode[]'>";echo "</td>";
			echo "<td>"; echo $nama_kriteria ; echo "<input hidden type='text' value = '$nama_kriteria' required class='form-control input-sm' name='nama_kriteria[]'>"; echo "</td>";
            echo "<td>";
                echo "<table class='table table-sc-e'>";  
                $query2 = $this->con->query("select * from range_penilaian where kode_kriteria = '$kode' and range_penilaian.fix_kriteria='$fix_kriteria'");
                while($data2=$query2->fetch_assoc()){
                    $nilai_awal = $data2['nilai_awal'];
                    echo "<tr>";
                    echo "<td>"; echo round($nilai_awal,4) ; echo "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            echo "</td>";
            echo "<td>";
                echo "<table class='table table-sc-e'>";  
                $query2 = $this->con->query("select * from range_penilaian where kode_kriteria = '$kode' and range_penilaian.fix_kriteria='$fix_kriteria'");
                while($data2=$query2->fetch_assoc()){
                    $nilai_akhir = $data2['nilai_akhir'];
                    echo "<tr>";
                    echo "<td>"; echo round($nilai_akhir,4) ; echo "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            echo "</td>";
            echo "<td>";
                echo "<table class='table table-sc-e'>";  
                $query2 = $this->con->query("select * from range_penilaian left join keterangan_penilaian on range_penilaian.id_penilaian=keterangan_penilaian.id_penilaian where kode_kriteria = '$kode' and range_penilaian.fix_kriteria='$fix_kriteria'");
                while($data2=$query2->fetch_assoc()){
                    $id_penilaian = $data2['id_penilaian'];
                    $keterangan = $data2['keterangan'];
                    echo "<tr>";
                    echo "<td>"; echo $id_penilaian ; echo "</td>";
                    echo "<td>"; echo $keterangan ; echo "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            echo "</td>";
            echo "</tr>";
		}
        echo "</tbody>" ;
        echo "</table>";
	}
	function tahun_gelombang($id_pendaftaran){
		$query1=$this->con->query("select * from tb_pendaftaran where id_pendaftaran='$id_pendaftaran'");
		$data1=$query1->fetch_assoc();
		global $tahun,$gelombang;
		$tahun = $data1['tahun_pendaftaran'];
		$gelombang = $data1['gelombang'];
	}
	function data_pendaftaran(){// menmpilkan tabel data pendaftaran per gelombang
		$query=$this->con->query("SELECT * FROM `tb_pendaftaran` ORDER BY tahun_pendaftaran DESC");
		$no=1;
		if ($query->num_rows > 0) {
			while ($data=$query->fetch_assoc()) {
				$id_pendaftaran = $data['id_pendaftaran'];
				?>
				<tr>
					<td> <?php echo $no++; ?> </td>
					<td><?php echo $data['tahun_pendaftaran'] ?></td>
					<td>
						<div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
							<a href="data_mahasiswa.php?id_pendaftaran=<?php echo $id_pendaftaran ?>" class="btn btn-success success-icon-notika btn-reco-mg btn-button-mg" data-toggle="tooltip" data-placement="top" title="Lihat Data Calon Mahasiwa"><i class="fa fa-database"></i></a>
							<a href="handler.php?action=hapus_pendaftaran&id_pendaftaran=<?php echo $id_pendaftaran ?>" onclick="return confirm('Apakah anda yakin ?');" class="btn btn-danger danger-icon-notika btn-reco-mg btn-button-mg" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash"></i></a>
                        </div>
					</td>
				</tr>
             <?php  }
		}else{
			echo "<td></td><td colspan='5'>Maaf, data tidak ada!</td>";
		}
	}//belum selesai (hapus dan edit data)
	function detail_mahasiswa($no_mahasiswa){ //untuk menampilkan detali mahasiswa menggunakan modal pop up
		$query=$this->con->query("SELECT * FROM `data_mahasiswa` where no_mahasiswa='$no_mahasiswa'");
		$data=$query->fetch_assoc();
		if ($query->num_rows > 0) {?>
		<h2 align="center">Detail Mahasiswa</h2><br>
			<table style="width:100%;" class="table table-condensed">
				<tr>
					<td  style="width:45%;">Nomer Pendaftaran </td>
					<td  style="width:5%;"> : </td>
					<td  style="width:50%;"><b> <?php echo $data['no_mahasiswa']; ?></b> </td>
				</tr>
				<tr>
					<td  style="width:45%;">Nama Mahasiswa </td>
					<td  style="width:5%;"> : </td>
					<td  style="width:50%;"><b> <?php echo $data['nama_mahasiswa']; ?></b> </td>
				</tr>
				<tr>
					<td  style="width:45%;">Jenis Kelamin </td>
					<td  style="width:5%;"> : </td>
					<td  style="width:50%;"><b> <?php echo $data['jenis_kelamin']; ?> </b></td>
				</tr>
				<?php
					$query1 = $this->con->query("SELECT count(id_mahasiswa) as jumlah, fix_kriteria FROM `data_mahasiswa` where no_mahasiswa='$no_mahasiswa'");
					$data1 = $query1->fetch_assoc();
					$jumlah_data = $data1['jumlah'];
					$fix_kriteria = $data1['fix_kriteria'];
					$query4 = $this->con->query("SELECT count(id_ket_krit) as jumlah FROM `fix_kriteria` where fix_kriteria = '$fix_kriteria' ");
					$data4 = $query4->fetch_assoc();
					$jumlah_kriteria = $data4['jumlah'];
					
					$query2 = $this->con->query("SELECT * FROM `data_mahasiswa` where no_mahasiswa='$no_mahasiswa'");
					while($data2=$query2->fetch_assoc()){
						$nilai_kriteria[] = $data2['nilai_kriteria'];
					}
					$query3 = $this->con->query("SELECT * FROM `fix_kriteria` where fix_kriteria='$fix_kriteria' ");
					while($data3=$query3->fetch_assoc()){
						$nama_kriteria[] = $data3['nama_ket_krit'];
					}
					for($i = 0; $i < $jumlah_data ; $i++){
						echo "<tr>";
						for($j = 0; $j < 1 ; $j++){
							$nama_krit[$i][$j] = $nama_kriteria[$i];
							$nilai_krit[$i][$j] = $nilai_kriteria[$i];
						?>
							<td  style="width:45%;"><?php echo $nama_krit[$i][$j]; ?>  </td>
							<td  style="width:5%;"> : </td>
							<td  style="width:50%;"><b> <?php echo round($nilai_krit[$i][$j],2) ; ?> </b></td>  
						<?php
						}
						echo "</tr>";
					}
					
				?>
			</table>
			
		<?php }
	}
	function data_nilai_mahasiswa_konvert($id_pendaftaran){ 
		$query1 = $this->con->query("SELECT * FROM tb_pendaftaran where id_pendaftaran = '$id_pendaftaran'");
		$data1 = $query1->fetch_assoc();
		$fix_kriteria = $data1['fix_kriteria'];
		$query = $this->con->query("select count(id_ket_krit) as jumlah from fix_kriteria where fix_kriteria = '$fix_kriteria' ");
		$data = $query->fetch_assoc();
		$jumlah_kriteria = $data['jumlah'];
		$no = 1 ;
		$no_array = 0 ;
		?>
			<thead>
                <tr>
					<th> Nama Mahasiswa </th>
					<?php
					$query2 = $this->con->query("SELECT * FROM fix_kriteria where fix_kriteria = '$fix_kriteria' ");
					while($data2=$query2->fetch_assoc()){?>
						<th><?php echo $data2['kode_kriteria']; ?></th>
					<?php
					}
					?>
				</tr>
        	</thead>
			<tbody>
			<?php
			$query3 = $this->con->query("SELECT * FROM data_konversi_data_mahasiswa where id_pendaftaran = '$id_pendaftaran' ORDER BY `no_mahasiswa`,kode_kriteria");
			while($data3 = $query3->fetch_assoc()){
                $array_nilai[] = $data3['nilai_kriteria'];
                $nama_mahasiswa[] = $data3['nama_mahasiswa'];
			}
			$query4 = $this->con->query("SELECT count(id_mahasiswa) as jumlah FROM data_konversi_data_mahasiswa where id_pendaftaran = '$id_pendaftaran' ");
            $data4 = $query4->fetch_assoc();
            $jumlah_mahasiswa = $data4['jumlah'] / $jumlah_kriteria;
            $no = 1 ;

            for($i=1; $i<=$jumlah_mahasiswa; $i++){
				echo "<tr>";
				echo "<td><b> ".$nama_mahasiswa[$no_array]."</b></td>";
				for($j=1; $j<=$jumlah_kriteria; $j++){
					echo "<td><b>";
					$nilai[$i][$j] = $array_nilai[$no_array];
					echo round($nilai[$i][$j],2);
					echo "</b></td>";
					$no_array++;
				}
			}

			?>
			</tbody>
		<?php
	}
	function matrik_normalisasi($id_pendaftaran){
		$query1 = $this->con->query("SELECT * FROM tb_pendaftaran where id_pendaftaran = '$id_pendaftaran'");
		$data1 = $query1->fetch_assoc();
		$fix_kriteria = $data1['fix_kriteria'];
		$query = $this->con->query("select count(id_ket_krit) as jumlah from fix_kriteria where fix_kriteria = '$fix_kriteria' ");
		$data = $query->fetch_assoc();
		$jumlah_kriteria = $data['jumlah'];
		$no = 1 ;
		$no_array = 0 ;
		?>
			<thead>
                <tr>
					<th> Nama Mahasiswa </th>
					<?php
					$query2 = $this->con->query("SELECT * FROM fix_kriteria where fix_kriteria = '$fix_kriteria' ");
					while($data2=$query2->fetch_assoc()){?>
						<th><?php echo $data2['kode_kriteria']; ?></th>
					<?php
					}
					?>
				</tr>
        	</thead>
			<tbody>
			<?php
			$query3 = $this->con->query("SELECT * FROM data_konversi_data_mahasiswa where id_pendaftaran = '$id_pendaftaran' ORDER BY `no_mahasiswa`,kode_kriteria");
			while($data3 = $query3->fetch_assoc()){
                $array_nilai[] = $data3['nilai_kriteria'];
                $nama_mahasiswa[] = $data3['nama_mahasiswa'];
			}
			$query4 = $this->con->query("SELECT count(id_mahasiswa) as jumlah FROM data_konversi_data_mahasiswa where id_pendaftaran = '$id_pendaftaran' ");
            $data4 = $query4->fetch_assoc();
            $jumlah_mahasiswa = $data4['jumlah'] / $jumlah_kriteria;
            $no = 0 ;

            for($i=1; $i<=$jumlah_mahasiswa; $i++){
				for($j=1; $j<=$jumlah_kriteria; $j++){
					$nilai[$i][$j] = $array_nilai[$no_array];
					$nilai_pangkat[$i][$j] =  pow($nilai[$i][$j],2) ;
					$no_array++;
					$nilai1[$j][$i] = $nilai_pangkat[$i][$j];
				}
			}

			for($l=1;$l<=$jumlah_kriteria;$l++){
				$jum[$l] = array_sum($nilai1[$l]);
				$akar_jum[$l] = sqrt($jum[$l]);
			}

			
            for($m=1; $m<=$jumlah_mahasiswa; $m++){
				echo "<tr>";
				echo "<td><b> ".$nama_mahasiswa[$no]."</b></td>";
				for($n=1; $n<=$jumlah_kriteria; $n++){
					echo "<td><b>";
					$nilai1[$m][$n] = $nilai[$m][$n];
					$hasil[$m][$n] = $nilai1[$m][$n] / $akar_jum[$n] ;
					echo round($hasil[$m][$n],4);
					echo "</b></td>";
					$no++ ;
				}
			}
	}
	function matrik_normalisasi_terbobot($id_pendaftaran){
		$query1 = $this->con->query("SELECT * FROM tb_pendaftaran where id_pendaftaran = '$id_pendaftaran'");
		$data1 = $query1->fetch_assoc();
		$fix_kriteria = $data1['fix_kriteria'];
		$query = $this->con->query("select count(id_ket_krit) as jumlah from fix_kriteria where fix_kriteria = '$fix_kriteria' ");
		$data = $query->fetch_assoc();
		$jumlah_kriteria = $data['jumlah'];
		$no = 1 ;
		$no_array = 0 ;
		?>
			<thead>
                <tr>
					<th> Nama Mahasiswa </th>
					<?php
					$query2 = $this->con->query("SELECT * FROM fix_kriteria where fix_kriteria = '$fix_kriteria' ");
					while($data2=$query2->fetch_assoc()){?>
						<th><?php echo $data2['kode_kriteria']; ?></th>
					<?php
					}
					?>
				</tr>
        	</thead>
			<tbody>
			<?php
			$query3 = $this->con->query("SELECT * FROM data_konversi_data_mahasiswa where id_pendaftaran = '$id_pendaftaran' ORDER BY `no_mahasiswa`,kode_kriteria");
			while($data3 = $query3->fetch_assoc()){
                $array_nilai[] = $data3['nilai_kriteria'];
                $nama_mahasiswa[] = $data3['nama_mahasiswa'];
			}
			$query4 = $this->con->query("SELECT count(id_mahasiswa) as jumlah FROM data_konversi_data_mahasiswa where id_pendaftaran = '$id_pendaftaran' ");
            $data4 = $query4->fetch_assoc();
            $jumlah_mahasiswa = $data4['jumlah'] / $jumlah_kriteria;
            $no = 0 ;

            for($i=0; $i<$jumlah_mahasiswa; $i++){
				for($j=0; $j<$jumlah_kriteria; $j++){
					$nilai[$i][$j] = $array_nilai[$no_array];
					$nilai_pangkat[$i][$j] =  pow($nilai[$i][$j],2) ;
					$no_array++;
					$nilai1[$j][$i] = $nilai_pangkat[$i][$j];
				}
			}

			for($l=0;$l<$jumlah_kriteria;$l++){
				$jum[$l] = array_sum($nilai1[$l]);
				$akar_jum[$l] = sqrt($jum[$l]);
			}

			$query5 = $this->con->query("SELECT * FROM pv where fix_pv = '$fix_kriteria' ");
            while($data5 = $query5->fetch_array()){
				$pv[] = $data5['pv'];
			}
            for($m=0; $m<$jumlah_mahasiswa; $m++){
				echo "<tr>";
				echo "<td><b> ".$nama_mahasiswa[$no]."</b></td>";
				for($n=0; $n<$jumlah_kriteria; $n++){
					echo "<td><b>";
					$nilai1[$m][$n] = $nilai[$m][$n];
					$hasil[$m][$n] = $nilai1[$m][$n] / $akar_jum[$n] ;
					$hasil_terbobot[$m][$n] = $hasil[$m][$n] * $pv[$n];
					echo round($hasil_terbobot[$m][$n],6)  ;
					echo "</b></td>";
					$no++ ;
				}
			}
	}
	function solusi_ideal($id_pendaftaran){
		$query1 = $this->con->query("SELECT * FROM tb_pendaftaran where id_pendaftaran = '$id_pendaftaran'");
		$data1 = $query1->fetch_assoc();
		$fix_kriteria = $data1['fix_kriteria'];
		$query = $this->con->query("select count(id_ket_krit) as jumlah from fix_kriteria where fix_kriteria = '$fix_kriteria' ");
		$data = $query->fetch_assoc();
		$jumlah_kriteria = $data['jumlah'];
		$no = 1 ;
		$no_array = 0 ;
		?>
			<thead>
                <tr>
					<th> Solusi Ideal </th>
					<?php
					$query2 = $this->con->query("SELECT * FROM fix_kriteria where fix_kriteria = '$fix_kriteria' ");
					while($data2=$query2->fetch_assoc()){
						$id_atribut[] = $data2['id_atribut'];
						?>
						<th><?php echo $data2['kode_kriteria']; ?></th>
					<?php
					}
					?>
				</tr>
        	</thead>
			<tbody>
			<?php
			$query3 = $this->con->query("SELECT * FROM data_konversi_data_mahasiswa where id_pendaftaran = '$id_pendaftaran' ORDER BY `no_mahasiswa`,kode_kriteria");
			while($data3 = $query3->fetch_assoc()){
                $array_nilai[] = $data3['nilai_kriteria'];
                $nama_mahasiswa[] = $data3['nama_mahasiswa'];
			}
			$query4 = $this->con->query("SELECT count(id_mahasiswa) as jumlah FROM data_konversi_data_mahasiswa where id_pendaftaran = '$id_pendaftaran' ");
            $data4 = $query4->fetch_assoc();
            $jumlah_mahasiswa = $data4['jumlah'] / $jumlah_kriteria;
            $no = 0 ;

            for($i=0; $i<$jumlah_mahasiswa; $i++){
				for($j=0; $j<$jumlah_kriteria; $j++){
					$nilai[$i][$j] = $array_nilai[$no_array];
					$nilai_pangkat[$i][$j] =  pow($nilai[$i][$j],2) ;
					$no_array++;
					$nilai1[$j][$i] = $nilai_pangkat[$i][$j];
				}
			}

			for($l=0;$l<$jumlah_kriteria;$l++){
				$jum[$l] = array_sum($nilai1[$l]);
				$akar_jum[$l] = sqrt($jum[$l]);
			}

			$query5 = $this->con->query("SELECT * FROM pv where fix_pv = '$fix_kriteria' ");
            while($data5 = $query5->fetch_array()){
				$pv[] = $data5['pv'];
			}
            for($m=0; $m<$jumlah_mahasiswa; $m++){
				for($n=0; $n<$jumlah_kriteria; $n++){
					$nilai1[$m][$n] = $nilai[$m][$n];
					$hasil[$m][$n] = $nilai1[$m][$n] / $akar_jum[$n] ;
					$hasil_terbobot[$m][$n] = $hasil[$m][$n] * $pv[$n];

					$hasil_terbobot_matrik[$n][$m] = $hasil_terbobot[$m][$n];
					$no++ ;
				}
			}
			
		?>
			<tbody>
				<tr>
					<th> Positif (+)</th>
					<?php
					for($o = 0; $o < $jumlah_kriteria; $o++){
						$id_att[$o] = $id_atribut[$o];
						if($id_att[$o] == 1){
							$positif[$o] = max($hasil_terbobot_matrik[$o]);
						}else{
							$positif[$o] = min($hasil_terbobot_matrik[$o]);
						}
						echo "<td>";
						echo round($positif[$o],3);
						echo "</td>";
					}
					?>
				</tr>
				<tr>
					<th> Negatif (-)</th>
					<?php
					for($p = 0; $p < $jumlah_kriteria; $p++){
						$id_att[$p] = $id_atribut[$p];
						if($id_att[$p] == 1){
							$negatif[$p] = min($hasil_terbobot_matrik[$p]);
						}else{
							$negatif[$p] = max($hasil_terbobot_matrik[$p]);
						}
						echo "<td>";
						echo round($negatif[$p],3);
						echo "</td>";
					}
					?>
				</tr>
			</tbody>
		<?php
	}
	function jarak_alternatif($id_pendaftaran){
		$query1 = $this->con->query("SELECT * FROM tb_pendaftaran where id_pendaftaran = '$id_pendaftaran'");
		$data1 = $query1->fetch_assoc();
		$fix_kriteria = $data1['fix_kriteria'];
		$query = $this->con->query("select count(id_ket_krit) as jumlah from fix_kriteria where fix_kriteria = '$fix_kriteria' ");
		$data = $query->fetch_assoc();
		$jumlah_kriteria = $data['jumlah'];
		$no = 1 ;
		$no_array = 0 ;

		$query2 = $this->con->query("SELECT * FROM fix_kriteria where fix_kriteria = '$fix_kriteria' ");
		while($data2=$query2->fetch_assoc()){
			$id_atribut[] = $data2['id_atribut'];
		}
		
		$query3 = $this->con->query("SELECT * FROM data_konversi_data_mahasiswa where id_pendaftaran = '$id_pendaftaran' ORDER BY `no_mahasiswa`,kode_kriteria");
		while($data3 = $query3->fetch_assoc()){
            $array_nilai[] = $data3['nilai_kriteria'];
            $nama_mahasiswa[] = $data3['nama_mahasiswa'];
		}
		$query4 = $this->con->query("SELECT count(id_mahasiswa) as jumlah FROM data_konversi_data_mahasiswa where id_pendaftaran = '$id_pendaftaran' ");
        $data4 = $query4->fetch_assoc();
        $jumlah_mahasiswa = $data4['jumlah'] / $jumlah_kriteria;
        $no = 0 ;
        for($i=0; $i<$jumlah_mahasiswa; $i++){
			for($j=0; $j<$jumlah_kriteria; $j++){
				$nilai[$i][$j] = $array_nilai[$no_array];
				$nilai_pangkat[$i][$j] =  pow($nilai[$i][$j],2) ;
				$no_array++;
				$nilai1[$j][$i] = $nilai_pangkat[$i][$j];
			}
		}

		for($l=0;$l<$jumlah_kriteria;$l++){
			$jum[$l] = array_sum($nilai1[$l]);
			$akar_jum[$l] = sqrt($jum[$l]);
		}

		$query5 = $this->con->query("SELECT * FROM pv where fix_pv = '$fix_kriteria' ");
        while($data5 = $query5->fetch_array()){
			$pv[] = $data5['pv'];
		}
        for($m=0; $m<$jumlah_mahasiswa; $m++){
			for($n=0; $n<$jumlah_kriteria; $n++){
				$nilai1[$m][$n] = $nilai[$m][$n];
				$hasil[$m][$n] = $nilai1[$m][$n] / $akar_jum[$n] ;
				$hasil_terbobot[$m][$n] = $hasil[$m][$n] * $pv[$n];

				$hasil_terbobot_matrik[$n][$m] = $hasil_terbobot[$m][$n];
				$no++ ;
			}
		}
			

		for($o = 0; $o < $jumlah_kriteria; $o++){
			$id_att[$o] = $id_atribut[$o];
			if($id_att[$o] == 1){
				$positif[$o] = max($hasil_terbobot_matrik[$o]);
			}else{
				$positif[$o] = min($hasil_terbobot_matrik[$o]);
			}
			}
			
		for($p = 0; $p < $jumlah_kriteria; $p++){
			$id_att[$p] = $id_atribut[$p];
			if($id_att[$p] == 1){
				$negatif[$p] = min($hasil_terbobot_matrik[$p]);
			}else{
				$negatif[$p] = max($hasil_terbobot_matrik[$p]);
			}
		}
					
		$wk = 0 ;
		for($a=0; $a<$jumlah_mahasiswa; $a++){
			for($b=0; $b<$jumlah_kriteria; $b++){
				$hasil_terbobot1[$a][$b] = $hasil_terbobot[$a][$b];
				$positif1[$a][$b] = $positif[$b];
				$hasil_1_positif[$a][$b] = $positif1[$a][$b] - $hasil_terbobot1[$a][$b];
				$hasil_positif[$a][$b] = pow($hasil_1_positif[$a][$b],2);
				$negatif1[$a][$b] = $negatif[$b];
				$hasil_1_negatif[$a][$b] = $hasil_terbobot1[$a][$b] - $negatif1[$a][$b];
				$hasil_negatif[$a][$b] = pow($hasil_1_negatif[$a][$b],2);
				$wk++ ;
			}
		}
		?>
		<?php
		$wkk = 0 ;
		$nomer = 1 ;
		for($a1=0; $a1<$jumlah_mahasiswa; $a1++){
			echo "<tr>";
			echo "<td><b> ".$nomer++."</b></td>";
			echo "<td><b> ".$nama_mahasiswa[$wkk]."</b></td>";
				$hasil_positif_1[$a1] = array_sum($hasil_positif[$a1]);
				$jarak_solusi_positif[$a1] = sqrt($hasil_positif_1[$a1]);
				$hasil_negatif_1[$a1] = array_sum($hasil_negatif[$a1]);
				$jarak_solusi_negatif[$a1] = sqrt($hasil_negatif_1[$a1]);
				echo "<td><b> ";
				echo $jarak_solusi_positif[$a1];
				echo "</td></b> ";
				echo "<td><b> ";
				echo $jarak_solusi_negatif[$a1];
				echo "</td></b> ";
				echo "</tr>";
				$wkk = $wkk + $jumlah_kriteria ;
				
		}
	}
	function perangkingan($id_pendaftaran){
        $query1 = $this->con->query("SELECT * FROM tb_pendaftaran where id_pendaftaran = '$id_pendaftaran'");
		$data1 = $query1->fetch_assoc();
		$fix_kriteria = $data1['fix_kriteria'];
		$query = $this->con->query("select count(id_ket_krit) as jumlah from fix_kriteria where fix_kriteria = '$fix_kriteria' ");
		$data = $query->fetch_assoc();
		$jumlah_kriteria = $data['jumlah'];
		$no = 1 ;
		$no_array = 0 ;

		$query2 = $this->con->query("SELECT * FROM fix_kriteria where fix_kriteria = '$fix_kriteria' ");
		while($data2=$query2->fetch_assoc()){
			$id_atribut[] = $data2['id_atribut'];
		}
		
		$query3 = $this->con->query("SELECT * FROM data_konversi_data_mahasiswa where id_pendaftaran = '$id_pendaftaran' ORDER BY `no_mahasiswa`,kode_kriteria");
		while($data3 = $query3->fetch_assoc()){
            $array_nilai[] = $data3['nilai_kriteria'];
			$nama_mahasiswa[] = $data3['nama_mahasiswa'];
			$no_mhs[] = $data3['no_mahasiswa'];
		}
		$query4 = $this->con->query("SELECT count(id_mahasiswa) as jumlah FROM data_konversi_data_mahasiswa where id_pendaftaran = '$id_pendaftaran' ");
        $data4 = $query4->fetch_assoc();
        $jumlah_mahasiswa = $data4['jumlah'] / $jumlah_kriteria;
        $no = 0 ;
        for($i=0; $i<$jumlah_mahasiswa; $i++){
			for($j=0; $j<$jumlah_kriteria; $j++){
				$nilai[$i][$j] = $array_nilai[$no_array];
				$nilai_pangkat[$i][$j] =  pow($nilai[$i][$j],2) ;
				$no_array++;
				$nilai1[$j][$i] = $nilai_pangkat[$i][$j];
			}
		}

		for($l=0;$l<$jumlah_kriteria;$l++){
			$jum[$l] = array_sum($nilai1[$l]);
			$akar_jum[$l] = sqrt($jum[$l]);
		}

		$query5 = $this->con->query("SELECT * FROM pv where fix_pv = '$fix_kriteria' ");
        while($data5 = $query5->fetch_array()){
			$pv[] = $data5['pv'];
		}
        for($m=0; $m<$jumlah_mahasiswa; $m++){
			for($n=0; $n<$jumlah_kriteria; $n++){
				$nilai1[$m][$n] = $nilai[$m][$n];
				$hasil[$m][$n] = $nilai1[$m][$n] / $akar_jum[$n] ;
				$hasil_terbobot[$m][$n] = $hasil[$m][$n] * $pv[$n];

				$hasil_terbobot_matrik[$n][$m] = $hasil_terbobot[$m][$n];
				$no++ ;
			}
		}
			

		for($o = 0; $o < $jumlah_kriteria; $o++){
			$id_att[$o] = $id_atribut[$o];
			if($id_att[$o] == 1){
				$positif[$o] = max($hasil_terbobot_matrik[$o]);
			}else{
				$positif[$o] = min($hasil_terbobot_matrik[$o]);
			}
			}
			
		for($p = 0; $p < $jumlah_kriteria; $p++){
			$id_att[$p] = $id_atribut[$p];
			if($id_att[$p] == 1){
				$negatif[$p] = min($hasil_terbobot_matrik[$p]);
			}else{
				$negatif[$p] = max($hasil_terbobot_matrik[$p]);
			}
		}
					
		$wk = 0 ;
		for($a=0; $a<$jumlah_mahasiswa; $a++){
			for($b=0; $b<$jumlah_kriteria; $b++){
				$hasil_terbobot1[$a][$b] = $hasil_terbobot[$a][$b];
				$positif1[$a][$b] = $positif[$b];
				$hasil_1_positif[$a][$b] = $positif1[$a][$b] - $hasil_terbobot1[$a][$b];
				$hasil_positif[$a][$b] = pow($hasil_1_positif[$a][$b],2);
				$negatif1[$a][$b] = $negatif[$b];
				$hasil_1_negatif[$a][$b] = $hasil_terbobot1[$a][$b] - $negatif1[$a][$b];
				$hasil_negatif[$a][$b] = pow($hasil_1_negatif[$a][$b],2);
				$wk++ ;
			}
		}
		$query_nilai_minimum = $this->con->query("SELECT * FROM nilai_minimum_preferensi where fix_kriteria = '$fix_kriteria'");
		$data_nilai_minimum = $query_nilai_minimum->fetch_assoc();
		$nilai_minimum = $data_nilai_minimum['nilai_minimum'];

		$wkk = 0 ;
		for($a1=0; $a1<$jumlah_mahasiswa; $a1++){
			$hasil_positif_1[$a1] = array_sum($hasil_positif[$a1]);
			$jarak_solusi_positif[$a1] = sqrt($hasil_positif_1[$a1]);
			$hasil_negatif_1[$a1] = array_sum($hasil_negatif[$a1]);
			$jarak_solusi_negatif[$a1] = sqrt($hasil_negatif_1[$a1]);
			$nilai_preferensi[$a1] = $jarak_solusi_negatif[$a1]/($jarak_solusi_negatif[$a1] + $jarak_solusi_positif[$a1]);
			if($nilai_preferensi[$a1] >= $nilai_minimum){
				$keterangan[$a1] = 1 ;
			}else{
				$keterangan[$a1] = 2 ;
			}
			$query_update = $this->con->query("update perangkingan set nilai_preferensi = '$nilai_preferensi[$a1]', keterangan = '$keterangan[$a1]' where id_pendaftaran = '$id_pendaftaran' and no_mahasiswa = '$no_mhs[$wkk]' ");

			$wkk = $wkk + $jumlah_kriteria ;
				
		}
		$n = 1 ;
		$query_perangkingan=$this->con->query("SELECT * FROM `perangkingan` WHERE id_pendaftaran = $id_pendaftaran ORDER BY nilai_preferensi DESC");
		while ($data_perangkingan=$query_perangkingan->fetch_assoc()) {
			if($data_perangkingan['keterangan']==1){
				$keterangan = "DITERIMA";
			}else{
				$keterangan ="DITOLAK";
			}
			?>
			<tr>
				<td> <?php echo $n++; ?> </td>
				<td><?php echo $data_perangkingan['nama_mahasiswa'] ?></td>
				<td><?php echo round((($data_perangkingan['nilai_preferensi'])*100),2)  ; ?> %</td>
				<td><?php echo $keterangan ; ?></td>
			</tr>
		<?php 
		}

	}
	function detail_pendaftaran($id_pendaftaran){
		$query=$this->con->query("select * from tb_pendaftaran where id_pendaftaran='$id_pendaftaran'");
		$data=$query->fetch_assoc();
		return $data;
	}
	function tampil_pendaftaran_semua(){
		$query=$this->con->query("SELECT * FROM tb_pendaftaran GROUP BY tahun_pendaftaran");
		$no=1;
			if ($query->num_rows > 0) {
				while ($data=$query->fetch_assoc()) {
				$id_pendaftaran = $data['id_pendaftaran'];
				$tahun = $data['tahun_pendaftaran'];
				?>
				<tr>
					<td> <?php echo $no++; ?> </td>
					<td><?php echo $data['tahun_pendaftaran'] ?></td>
					<td>
						<div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
							<a href="perangkingan_semua_mahasiswa.php?tahun_pendaftaran=<?php echo $tahun ?>" class="btn btn-primary primary-icon-notika btn-reco-mg btn-button-mg" data-toggle="tooltip" data-placement="top" title="Lihat Hasil Perangkingan Tahun <?php echo $tahun ?>"><i class="fa fa-database"></i></a>
							<a href="hasil_perangkingan_tahun.php?tahun_pendaftaran=<?php echo $tahun ?>" class="btn btn-success success-icon-notika btn-reco-mg btn-button-mg" data-toggle="tooltip" data-placement="top" title="Lihat Data Pendaftaran Tahun <?php echo $tahun ?>"><i class="fa fa-info-circle"></i></a>
						</div>
					</td>
				</tr>
	<?php  }
		}
	}
	function tampil_pendaftaran_tahun($tahun_pendaftaran){
		$query=$this->con->query("SELECT * FROM tb_pendaftaran WHERE tahun_pendaftaran = '$tahun_pendaftaran' ");
		$no=1;
			if ($query->num_rows > 0) {
				while ($data=$query->fetch_assoc()) {
				$id_pendaftaran = $data['id_pendaftaran'];
				$gelombang = $data['gelombang'];
				$tahun = $data['tahun_pendaftaran'];
				?>
				<tr>
					<td> <?php echo $no++; ?> </td>
					<td> Gelombang <?php echo $data['gelombang'] ?></td>
					<td>
						<div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
							<a href="hasil_perangkingan_gelombang.php?id_pendaftaran=<?php echo $id_pendaftaran ?>" class="btn btn-success success-icon-notika btn-reco-mg btn-button-mg" data-toggle="tooltip" data-placement="top" title="Lihat Perangkingan Gelombang <?php echo $gelombang ?> Tahun <?php echo $tahun ?>"><i class="fa fa-database"></i></a>
						</div>
					</td>
				</tr>
	<?php  }
		}
	}

	function semua_perangkingan($tahun_pendaftaran){
		$query5=$this->con->query("SELECT * FROM `fix_perangkingan` INNER JOIN tb_pendaftaran on tb_pendaftaran.id_pendaftaran=fix_perangkingan.id_pendaftaran WHERE tahun_pendaftaran='$tahun_pendaftaran' ORDER BY nilai_preferensi DESC");
		$no = 1;
			while ($data5=$query5->fetch_assoc()) {
				$id_perangkingan = $data5['id_perangkingan'];
				$no_mahasiswa = $data5['no_mahasiswa'];
				if($data5['keterangan']==1){
					$keterangan = "DITERIMA";
				}else{
					$keterangan ="DITOLAK";
				}
			?>
				<tr>
					<td> <?php echo $no++; ?> </td>
					<td><?php echo $data5['nama_mahasiswa'] ?></td>
					<td><?php echo round((($data5['nilai_preferensi'])*100),2)  ; ?> %</td>
					<td><?php echo $keterangan ; ?></td>
					<td>
						<div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
						<button type="button" class="btn btn-success success-icon-notika btn-reco-mg btn-button-mg" data-id="<?php echo $no_mahasiswa ?>" data-toggle="modal" data-target="#modal_data" ><i class="fa fa-info-circle"></i></button>
						</div>
					</td>
					<td>
						<div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
							<a href="handler.php?action=ubah_keputusan&id_perangkingan=<?php echo $id_perangkingan ?>" onclick="return confirm('Apakah anda yakin ubah keputusan ?');" class="btn btn-danger danger-icon-notika btn-reco-mg btn-button-mg" data-toggle="tooltip" data-placement="top" title="Ubag Hasil Keputusan <?php echo $nama_mahasiswa ?>"><i class="fa fa-edit"></i></a>
						</div>
					</td>
				</tr>
	<?php	}
	}
	function semua_perangkingan_gelombang($id_pendaftaran){
		$query5=$this->con->query("SELECT * FROM `fix_perangkingan`  WHERE id_pendaftaran='$id_pendaftaran' ORDER BY nilai_preferensi DESC");
		$no = 1;
			while ($data5=$query5->fetch_assoc()) {
				$nama_mahasiswa = $data5['nama_mahasiswa'];
				$id_perangkingan = $data5['id_perangkingan'] ;
				$no_mahasiswa = $data5['no_mahasiswa'];
				if($data5['keterangan']==1){
					$keterangan = "DITERIMA";
				}else{
					$keterangan ="DITOLAK";
				}
			?>
				<tr>
					<td> <?php echo $no++; ?> </td>
					<td><?php echo $data5['nama_mahasiswa'] ?></td>
					<td><?php echo round((($data5['nilai_preferensi'])*100),2)  ; ?> %</td>
					<td><?php echo $keterangan ; ?></td>
					<td>
						<div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
						<button type="button" class="btn btn-success success-icon-notika btn-reco-mg btn-button-mg" data-id="<?php echo $no_mahasiswa ?>" data-toggle="modal" data-target="#modal_data" ><i class="fa fa-info-circle"></i></button>
						</div>
					</td>
					<td>
						<div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
							<a href="handler.php?action=ubah_keputusan&id_perangkingan=<?php echo $id_perangkingan ?>" onclick="return confirm('Apakah anda yakin ubah keputusan ?');" class="btn btn-danger danger-icon-notika btn-reco-mg btn-button-mg" data-toggle="tooltip" data-placement="top" title="Ubag Hasil Keputusan <?php echo $nama_mahasiswa ?>"><i class="fa fa-edit"></i></a>
						</div>
					</td>
				</tr>
	<?php	}
	}
	function semua_perangkingan_admin($id_pendaftaran){
		$query5=$this->con->query("SELECT * FROM `fix_perangkingan`  WHERE id_pendaftaran='$id_pendaftaran' ORDER BY nilai_preferensi DESC");
		$no = 1;
			while ($data5=$query5->fetch_assoc()) {
				$nama_mahasiswa = $data5['nama_mahasiswa'];
				$id_perangkingan = $data5['id_perangkingan'] ;
				$no_mahasiswa = $data5['no_mahasiswa'];
				if($data5['keterangan']==1){
					$keterangan = "DITERIMA";
				}else{
					$keterangan ="DITOLAK";
				}
			?>
				<tr>
					<td> <?php echo $no++; ?> </td>
					<td><?php echo $data5['nama_mahasiswa'] ?></td>
					<td><?php echo round((($data5['nilai_preferensi'])*100),2)  ; ?> %</td>
					<td><?php echo $keterangan ; ?></td>
					<td>
						<div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
						<button type="button" class="btn btn-success success-icon-notika btn-reco-mg btn-button-mg" data-id="<?php echo $no_mahasiswa ?>" data-toggle="modal" data-target="#modal_data" ><i class="fa fa-info-circle"></i></button>
						</div>
					</td>
				</tr>
	<?php	}
	}
	function tampil_pembobotan_fix_kriteria_1($id_pendaftaran){
		$query1 = $this->con->query("SELECT * FROM tb_pendaftaran WHERE id_pendaftaran = '$id_pendaftaran'");
		$data1 = $query1->fetch_assoc();
		$fix_kriteria = $data1['fix_kriteria'];
		$query = $this->con->query("select count(id_ket_krit) as jumlah from fix_kriteria where fix_kriteria = '$fix_kriteria' ");
		$data = $query->fetch_assoc();
		$jumlah_kriteria = $data['jumlah'];
		$no = 1 ;
		$no_array = 0 ;
		?>
			<thead>
                <tr>
					<th> Kode </th>
					<?php
					$query2 = $this->con->query("SELECT * FROM fix_kriteria where fix_kriteria = '$fix_kriteria' ");
					while($data2=$query2->fetch_assoc()){?>
						<th><?php echo $data2['kode_kriteria']; ?></th>
					<?php
					}
					?>
				</tr>
        	</thead>
			<tbody>
			<?php
			$query3 = $this->con->query("SELECT * FROM fix_bobot_kriteria where fix_bobot = '$fix_kriteria' order by kode_banding,kode_pembanding");
			while($data3 = $query3->fetch_assoc()){
				$array_bobot[] = $data3['bobot'];
			}
			
			for($i=1; $i<=$jumlah_kriteria; $i++){
				echo "<tr>";
				echo "<td><b> C".$no++."</b></td>";
				for($j=1; $j<=$jumlah_kriteria; $j++){
					echo "<td><b>";
					$bobot[$i][$j] = $array_bobot[$no_array];
					echo round($bobot[$i][$j],2);
					echo "</b></td>";
					$no_array++;
				}
			}

			?>
			</tbody>
			<tfoot>
				<tr>
					<td>Jumlah</td>
				<?php
					$query4 = $this->con->query("SELECT kode_pembanding, SUM(bobot) as jumlah_bobot FROM fix_bobot_kriteria where fix_bobot ='$fix_kriteria' GROUP BY kode_pembanding"); 
					while($data4 = $query4->fetch_assoc()){
						$jumlah_bobot = $data4['jumlah_bobot'];
						echo "<td><b>".$jumlah_bobot."</b></td>" ;
					}
				?>
				</tr>
			<tfoot>	
		<?php
	}
	function tampil_hitung_fix_prioritas_vektor_1($id_pendaftaran){
		$query_kriteria = $this->con->query("SELECT * FROM tb_pendaftaran WHERE id_pendaftaran = '$id_pendaftaran'");
		$data_kriteria = $query_kriteria->fetch_assoc();
		$fix_kriteria = $data_kriteria['fix_kriteria'];
		$query = $this->con->query("select count(id_ket_krit) as jumlah from fix_kriteria where fix_kriteria = '$fix_kriteria' ");
		$data = $query->fetch_assoc();
		$jumlah_kriteria = $data['jumlah'] ;
		$no = 1 ;
		$no_array = 0 ;
		?>
			<thead>
                <tr>
					<th> Kode </th>
					<?php
					$query2 = $this->con->query("SELECT * FROM fix_kriteria where fix_kriteria = '$fix_kriteria'");
					while($data2=$query2->fetch_assoc()){?>
						<th><?php echo $data2['kode_kriteria']; ?></th>
					<?php
					}
					?>
				</tr>
        	</thead>
			<tbody>
			<?php
			$query3 = $this->con->query("SELECT * FROM fix_bobot_kriteria  where fix_bobot = '$fix_kriteria' order by kode_banding,kode_pembanding");
			while($data3 = $query3->fetch_assoc()){
				$array_bobot[] = $data3['bobot'];
			}
			$query4 = $this->con->query("SELECT kode_pembanding, SUM(bobot) as jumlah_bobot FROM fix_bobot_kriteria where fix_bobot = '$fix_kriteria' GROUP BY kode_pembanding"); 
			while($data4 = $query4->fetch_assoc()){
				$jumlah_bobot[] = $data4['jumlah_bobot'];
			}
			
			for($i=0; $i< $jumlah_kriteria; $i++){
				echo "<tr>";
				echo "<td><b> C".$no++."</b></td>";
				for($j=0; $j< $jumlah_kriteria; $j++){
					echo "<td><b>";
					$bobot[$i][$j] = $array_bobot[$no_array];
					$jumlah_b[$i][$j] = $jumlah_bobot[$j];

					$hasil[$i][$j] = $bobot[$i][$j]/$jumlah_b[$i][$j] ;
					echo round($hasil[$i][$j],2);
					echo "</b></td>";
					$no_array++;

					$hasil2[$j][$i] = $hasil[$i][$j];
				}
			}

			?>
			</tbody>
			<tfoot>
				<tr>
					<td>Jumlah</td>
				<?php
					for($l=0;$l<$jumlah_kriteria;$l++){
						echo "<td>";
						$jum[$l] = array_sum($hasil2[$l]);
						echo round($jum[$l],4);
						echo "</td>";
					}
				?>
				</tr>
			<tfoot>	
		<?php
	}
	function tampil_hasil_fix_prioritas_vektor_1($id_pendaftaran){
		$query_kriteria = $this->con->query("SELECT * FROM tb_pendaftaran WHERE id_pendaftaran = '$id_pendaftaran'");
		$data_kriteria = $query_kriteria->fetch_assoc();
		$fix_kriteria = $data_kriteria['fix_kriteria'];
		$query = $this->con->query("select count(id_ket_krit) as jumlah from fix_kriteria where fix_kriteria = '$fix_kriteria'");
		$data = $query->fetch_assoc();
		$jumlah_kriteria = $data['jumlah'] ;
		$no = 1 ;
		$no_array = 0 ;
		$query3 = $this->con->query("SELECT * FROM fix_bobot_kriteria where fix_bobot = '$fix_kriteria' order by kode_banding,kode_pembanding");
		while($data3 = $query3->fetch_assoc()){
			$array_bobot[] = $data3['bobot'];
		}
		$query4 = $this->con->query("SELECT kode_pembanding, SUM(bobot) as jumlah_bobot FROM fix_bobot_kriteria where fix_bobot = '$fix_kriteria' GROUP BY kode_pembanding"); 
		while($data4 = $query4->fetch_assoc()){
			$jumlah_bobot[] = $data4['jumlah_bobot'];
		}
		
		for($i=0; $i< $jumlah_kriteria; $i++){
			for($j=0; $j< $jumlah_kriteria; $j++){
				$bobot[$i][$j] = $array_bobot[$no_array];
				$jumlah_b[$i][$j] = $jumlah_bobot[$j];
				$hasil[$i][$j] = $bobot[$i][$j]/$jumlah_b[$i][$j] ;
				$no_array++;
			}
		}
		?>
		<thead>
            <tr>
				<th> Prioritas Vektor </th>
			</tr>
    	</thead>
		<tbody>
		<?php
		for($l=0;$l<$jumlah_kriteria;$l++){
			echo "<tr>";
			echo "<td>";
			$jum[$l] = array_sum($hasil[$l]);
			$pv[$l] = $jum[$l]/$jumlah_kriteria ;
			echo round($pv[$l],3);
			echo "</td>";
			echo "</tr>";
		}
		?>
		</body>
		<?php
	}
	function tampil_hasil_fix_matrix_konsistensi_1($id_pendaftaran){
		$query_kriteria = $this->con->query("SELECT * FROM tb_pendaftaran WHERE id_pendaftaran = '$id_pendaftaran'");
		$data_kriteria = $query_kriteria->fetch_assoc();
		$fix_kriteria = $data_kriteria['fix_kriteria'];
		$query = $this->con->query("select count(id_ket_krit) as jumlah from fix_kriteria where fix_kriteria = '$fix_kriteria'");
		$data = $query->fetch_assoc();
		$jumlah_kriteria = $data['jumlah'] ;
		$no = 1 ;
		$no_array = 0 ;
        $query3 = $this->con->query("SELECT * FROM fix_bobot_kriteria where fix_bobot = '$fix_kriteria' order by kode_banding,kode_pembanding");
			while($data3 = $query3->fetch_assoc()){
				$array_bobot[] = $data3['bobot'];
			}
			$query4 = $this->con->query("SELECT kode_pembanding, SUM(bobot) as jumlah_bobot FROM fix_bobot_kriteria where fix_bobot = '$fix_kriteria' GROUP BY kode_pembanding"); 
			while($data4 = $query4->fetch_assoc()){
				$jumlah_bobot[] = $data4['jumlah_bobot'];
			}
			for($i=0; $i<$jumlah_kriteria; $i++){
				for($j=0; $j<$jumlah_kriteria; $j++){
                    $bobot[$i][$j] = $array_bobot[$no_array];
                    $jumlah_b[$i][$j] = $jumlah_bobot[$j];
                    $bbt[$j][$i] = $bobot[$i][$j];

                    $hasil[$i][$j] = $bobot[$i][$j]/$jumlah_b[$i][$j] ;
                    $no_array++;   
                }
            }
            for($l=0;$l<$jumlah_kriteria;$l++){
                $jum[$l] = array_sum($hasil[$l]);
                $pv[0][$l] = $jum[$l]/$jumlah_kriteria ;
            }
        for($baris = 0 ; $baris < $jumlah_kriteria ; $baris++){
            for($kolom = 0 ; $kolom < $jumlah_kriteria ; $kolom++){
                $bbt[$baris][$kolom] = $bobot[$baris][$kolom];
                $prioritas[0][$kolom] = $pv[0][$kolom];
                $konsistensi[$baris][$kolom] = ($bbt[$baris][$kolom] * $prioritas[0][$kolom]);
            }

		}
		echo "<thead>
		<tr>
			<th> Matrix Konsistensi </th>
		</tr>
		</thead>
		<tbody>";
        for($bar = 0 ; $bar < $jumlah_kriteria ; $bar++){
            echo "<tr>";
            echo "<td>";
            $sum_konsistensi[$bar] = array_sum($konsistensi[$bar]);
            echo round($sum_konsistensi[$bar],3) ; 
            echo "</td>";
            echo "</tr>";
		}
		echo "</tbody>";
	}
	function fix_eigen_max_1($id_pendaftaran){
		$query_kriteria = $this->con->query("SELECT * FROM tb_pendaftaran WHERE id_pendaftaran = '$id_pendaftaran'");
		$data_kriteria = $query_kriteria->fetch_assoc();
		$fix_kriteria = $data_kriteria['fix_kriteria'];
		$query = $this->con->query("select count(id_ket_krit) as jumlah from fix_kriteria where fix_kriteria = '$fix_kriteria'");
		$data = $query->fetch_assoc();
		$jumlah_kriteria = $data['jumlah'] ;
		$no = 1 ;
		$no_array = 0 ;
        $query3 = $this->con->query("SELECT * FROM fix_bobot_kriteria where fix_bobot = '$fix_kriteria' order by kode_banding,kode_pembanding");
			while($data3 = $query3->fetch_assoc()){
				$array_bobot[] = $data3['bobot'];
			}
			$query4 = $this->con->query("SELECT kode_pembanding, SUM(bobot) as jumlah_bobot FROM fix_bobot_kriteria where fix_bobot = '$fix_kriteria' GROUP BY kode_pembanding"); 
			while($data4 = $query4->fetch_assoc()){
				$jumlah_bobot[] = $data4['jumlah_bobot'];
			}
            
			for($i=0; $i<$jumlah_kriteria; $i++){
				for($j=0; $j<$jumlah_kriteria; $j++){
                    $bobot[$i][$j] = $array_bobot[$no_array];
                    $jumlah_b[$i][$j] = $jumlah_bobot[$j];
                    $bbt[$j][$i] = $bobot[$i][$j];

                    $hasil[$i][$j] = $bobot[$i][$j]/$jumlah_b[$i][$j] ;
                    $no_array++;   
                }
            }

            for($l=0;$l<$jumlah_kriteria;$l++){

                $jum[$l] = array_sum($hasil[$l]);
                $pv[0][$l] = $jum[$l]/$jumlah_kriteria ;

            }

        for($baris = 0 ; $baris < $jumlah_kriteria ; $baris++){

            for($kolom = 0 ; $kolom < $jumlah_kriteria ; $kolom++){
                $bbt[$baris][$kolom] = $bobot[$baris][$kolom];
                $prioritas[0][$kolom] = $pv[0][$kolom];
                $konsistensi[$baris][$kolom] = ($bbt[$baris][$kolom] * $prioritas[0][$kolom]);

            }

        }

        for($bar = 0 ; $bar < $jumlah_kriteria ; $bar++){

            $sum_konsistensi[$bar] = array_sum($konsistensi[$bar]);
            $prio_v[0][$bar] = $prioritas[0][$bar];
            $eigen_max[$bar] = $sum_konsistensi[$bar] /  $prio_v[0][$bar] ; 

        }
		echo "<thead>";
		echo "<tr>";
		echo "<td><font size='6' >&lambda;Max</font></td>";
		echo "<td><font size='6' > = </font></td>";
		echo "<td><font size='6' >";
        $hasil_eigen_max = (array_sum($eigen_max))/$jumlah_kriteria;
		echo $hasil_eigen_max ; 
		echo "</font></td>";
		echo "</tr>";
		echo "</thead>";
	}
	function fix_ci_1($id_pendaftaran){
		$query_kriteria = $this->con->query("SELECT * FROM tb_pendaftaran WHERE id_pendaftaran = '$id_pendaftaran'");
		$data_kriteria = $query_kriteria->fetch_assoc();
		$fix_kriteria = $data_kriteria['fix_kriteria'];
		$query = $this->con->query("select count(id_ket_krit) as jumlah from fix_kriteria  where fix_kriteria = '$fix_kriteria' ");
		$data = $query->fetch_assoc();
		$jumlah_kriteria = $data['jumlah'] ;
		$no = 1 ;
		$no_array = 0 ;
        $query3 = $this->con->query("SELECT * FROM fix_bobot_kriteria where fix_bobot = '$fix_kriteria' order by kode_banding,kode_pembanding");
			while($data3 = $query3->fetch_assoc()){
				$array_bobot[] = $data3['bobot'];
			}
			$query4 = $this->con->query("SELECT kode_pembanding, SUM(bobot) as jumlah_bobot FROM fix_bobot_kriteria where fix_bobot = '$fix_kriteria' GROUP BY kode_pembanding"); 
			while($data4 = $query4->fetch_assoc()){
				$jumlah_bobot[] = $data4['jumlah_bobot'];
			}
            
			for($i=0; $i<$jumlah_kriteria; $i++){
				for($j=0; $j<$jumlah_kriteria; $j++){
                    $bobot[$i][$j] = $array_bobot[$no_array];
                    $jumlah_b[$i][$j] = $jumlah_bobot[$j];
                    $bbt[$j][$i] = $bobot[$i][$j];

                    $hasil[$i][$j] = $bobot[$i][$j]/$jumlah_b[$i][$j] ;
                    $no_array++;   
                }
            }

            for($l=0;$l<$jumlah_kriteria;$l++){

                $jum[$l] = array_sum($hasil[$l]);
                $pv[0][$l] = $jum[$l]/$jumlah_kriteria ;

            }

        for($baris = 0 ; $baris < $jumlah_kriteria ; $baris++){

            for($kolom = 0 ; $kolom < $jumlah_kriteria ; $kolom++){
                $bbt[$baris][$kolom] = $bobot[$baris][$kolom];
                $prioritas[0][$kolom] = $pv[0][$kolom];
                $konsistensi[$baris][$kolom] = ($bbt[$baris][$kolom] * $prioritas[0][$kolom]);

            }

        }

        for($bar = 0 ; $bar < $jumlah_kriteria ; $bar++){

            $sum_konsistensi[$bar] = array_sum($konsistensi[$bar]);
            $prio_v[0][$bar] = $prioritas[0][$bar];
            $eigen_max[$bar] = $sum_konsistensi[$bar] /  $prio_v[0][$bar] ; 

        }
		echo "<thead>";
		echo "<tr>";
		echo "<td><font size='6' > CI </font></td>";
		echo "<td><font size='6' > = </font></td>";
		echo "<td><font size='6' >";
        $hasil_eigen_max = (array_sum($eigen_max))/$jumlah_kriteria;
        $ci = ($hasil_eigen_max-$jumlah_kriteria) / ($jumlah_kriteria - 1);
        echo $ci ; 
		echo "</font></td>";
		echo "</tr>";
		echo "</thead>";
         
	}
	function fix_cr_1($id_pendaftaran){
		$query_kriteria = $this->con->query("SELECT * FROM tb_pendaftaran WHERE id_pendaftaran = '$id_pendaftaran'");
		$data_kriteria = $query_kriteria->fetch_assoc();
		$fix_kriteria = $data_kriteria['fix_kriteria'];
		$query = $this->con->query("select count(id_ket_krit) as jumlah from fix_kriteria where fix_kriteria = '$fix_kriteria' ");
		$data = $query->fetch_assoc();
		$jumlah_kriteria = $data['jumlah'] ;
		$no = 1 ;
		$no_array = 0 ;
        $query3 = $this->con->query("SELECT * FROM fix_bobot_kriteria where fix_bobot = '$fix_kriteria' order by kode_banding,kode_pembanding");
			while($data3 = $query3->fetch_assoc()){
				$array_bobot[] = $data3['bobot'];
			}
			$query4 = $this->con->query("SELECT kode_pembanding, SUM(bobot) as jumlah_bobot FROM fix_bobot_kriteria where fix_bobot = '$fix_kriteria' GROUP BY kode_pembanding"); 
			while($data4 = $query4->fetch_assoc()){
				$jumlah_bobot[] = $data4['jumlah_bobot'];
			}
            
			for($i=0; $i<$jumlah_kriteria; $i++){
				for($j=0; $j<$jumlah_kriteria; $j++){
                    $bobot[$i][$j] = $array_bobot[$no_array];
                    $jumlah_b[$i][$j] = $jumlah_bobot[$j];
                    $bbt[$j][$i] = $bobot[$i][$j];

                    $hasil[$i][$j] = $bobot[$i][$j]/$jumlah_b[$i][$j] ;
                    $no_array++;   
                }
            }

            for($l=0;$l<$jumlah_kriteria;$l++){

                $jum[$l] = array_sum($hasil[$l]);
                $pv[0][$l] = $jum[$l]/$jumlah_kriteria ;

            }

        for($baris = 0 ; $baris < $jumlah_kriteria ; $baris++){

            for($kolom = 0 ; $kolom < $jumlah_kriteria ; $kolom++){
                $bbt[$baris][$kolom] = $bobot[$baris][$kolom];
                $prioritas[0][$kolom] = $pv[0][$kolom];
                $konsistensi[$baris][$kolom] = ($bbt[$baris][$kolom] * $prioritas[0][$kolom]);

            }

        }

        for($bar = 0 ; $bar < $jumlah_kriteria ; $bar++){

            $sum_konsistensi[$bar] = array_sum($konsistensi[$bar]);
            $prio_v[0][$bar] = $prioritas[0][$bar];
            $eigen_max[$bar] = $sum_konsistensi[$bar] /  $prio_v[0][$bar] ; 

        }

        $query5 = $this->con->query("SELECT * FROM tabel_cr WHERE n = '$jumlah_kriteria' ");
        $data5 = $query5->fetch_assoc();
        $index_konsistensi = $data5['ci'];

        $hasil_eigen_max = (array_sum($eigen_max))/$jumlah_kriteria;
        $ci = ($hasil_eigen_max-$jumlah_kriteria) / ($jumlah_kriteria - 1);

		global $cr ,$keterangan;
		$cr = $ci / $index_konsistensi ;
		if($cr<=0.1){
			$keterangan = 'KONSISTEN' ;
		}else{
			$keterangan = 'TIDAK KONSISTEN' ;
		}
	}
	function tampil_fix_kriteria_1($id_pendaftaran){
		$query1 = $this->con->query("SELECT * FROM tb_pendaftaran WHERE id_pendaftaran = '$id_pendaftaran'");
		$data1 = $query1->fetch_assoc();
		$fix_kriteria = $data1['fix_kriteria'];
		$query=$this->con->query("SELECT * FROM fix_kriteria left join atribut on atribut.id_atribut=fix_kriteria.id_atribut LEFT JOIN pv ON fix_kriteria.id_ket_krit=pv.id_pv where fix_kriteria.fix_kriteria = '$fix_kriteria' ");
		$no=1;
		if ($query->num_rows > 0) {
			while ($data=$query->fetch_assoc()) {
			?>
				<tr>
					<td> <?php echo $no++; ?> </td>
					<td><?php echo $data['kode_kriteria'] ?></td>
					<td><?php echo $data['nama_ket_krit']?></td>
					<td><?php echo $data['nama_atribut']?></td>
					<td><?php echo $data['pv'] * 100?> %</td>
				</tr>
             <?php  }
		}else{
			echo "<td></td><td colspan='5'>Maaf, data tidak ada!</td>";
		}
	}
	function tampil_detail_penilaian_1($id_pendaftaran){
		$query_kriteria = $this->con->query("SELECT * FROM tb_pendaftaran WHERE id_pendaftaran = '$id_pendaftaran'");
		$data_kriteria = $query_kriteria->fetch_assoc();
		$fix_kriteria = $data_kriteria['fix_kriteria'];
        $query = $this->con->query("select * from range_penilaian left join fix_kriteria on range_penilaian.kode_kriteria=fix_kriteria.kode_kriteria WHERE range_penilaian.fix_kriteria='$fix_kriteria' and fix_kriteria.fix_kriteria = '$fix_kriteria' group by range_penilaian.kode_kriteria");
        echo "<table class='table table-sc-e'>";
        echo "<thead>";
		echo "<th> Kode kriteria </th>";
		echo "<th> Nama kriteria </th>";
		echo "<th> Nilai Awal </th>";
		echo "<th> Nilai Akhir </th>";
		echo "<th> Keterangan </th>";
		echo "</thead>";
		echo "<tbody>" ;
		while($data=$query->fetch_assoc()){
            $kode = $data['kode_kriteria'];
            $nama_kriteria = $data['nama_ket_krit'];
		    echo "<tr>";
			echo "<td>"; echo $kode ; echo "<input hidden type='text' value = '$kode' required class='form-control input-sm' name='kode[]'>";echo "</td>";
			echo "<td>"; echo $nama_kriteria ; echo "<input hidden type='text' value = '$nama_kriteria' required class='form-control input-sm' name='nama_kriteria[]'>"; echo "</td>";
            echo "<td>";
                echo "<table class='table table-sc-e'>";  
                $query2 = $this->con->query("select * from range_penilaian where kode_kriteria = '$kode' and range_penilaian.fix_kriteria='$fix_kriteria'");
                while($data2=$query2->fetch_assoc()){
                    $nilai_awal = $data2['nilai_awal'];
                    echo "<tr>";
                    echo "<td>"; echo round($nilai_awal,4) ; echo "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            echo "</td>";
            echo "<td>";
                echo "<table class='table table-sc-e'>";  
                $query2 = $this->con->query("select * from range_penilaian where kode_kriteria = '$kode' and range_penilaian.fix_kriteria='$fix_kriteria'");
                while($data2=$query2->fetch_assoc()){
                    $nilai_akhir = $data2['nilai_akhir'];
                    echo "<tr>";
                    echo "<td>"; echo round($nilai_akhir,4) ; echo "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            echo "</td>";
            echo "<td>";
                echo "<table class='table table-sc-e'>";  
                $query2 = $this->con->query("select * from range_penilaian left join keterangan_penilaian on range_penilaian.id_penilaian=keterangan_penilaian.id_penilaian where kode_kriteria = '$kode' and range_penilaian.fix_kriteria='$fix_kriteria'");
                while($data2=$query2->fetch_assoc()){
                    $id_penilaian = $data2['id_penilaian'];
                    $keterangan = $data2['keterangan'];
                    echo "<tr>";
                    echo "<td>"; echo $id_penilaian ; echo "</td>";
                    echo "<td>"; echo $keterangan ; echo "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            echo "</td>";
            echo "</tr>";
		}
        echo "</tbody>" ;
        echo "</table>";
	}
	function tampil_laporan(){
		$query=$this->con->query("SELECT * FROM tb_pendaftaran GROUP BY tahun_pendaftaran");
		$no=1;
			if ($query->num_rows > 0) {
				while ($data=$query->fetch_assoc()) {
				$id_pendaftaran = $data['id_pendaftaran'];
				$tahun = $data['tahun_pendaftaran'];
				?>
				<tr>
					<td> <?php echo $no++; ?> </td>
					<td><?php echo $data['tahun_pendaftaran'] ?></td>
					<td>
						<div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
							<a href="detail_laporan.php?tahun_pendaftaran=<?php echo $tahun ?>" class="btn btn-primary primary-icon-notika btn-reco-mg btn-button-mg" data-toggle="tooltip" data-placement="top" title="Lihat Laporan Hasil Perangkingan Tahun <?php echo $tahun ?>"><i class="fa fa-database"></i></a>
							<a target="_blank" href="cetak_laporan.php?tahun_pendaftaran=<?php echo $tahun ?>" class="btn btn-amber amber-icon-notika btn-reco-mg btn-button-mg" data-toggle="tooltip" data-placement="top" title="Cetak Laporan Pendaftaran Tahun <?php echo $tahun ?>"><i class="fa fa-print"></i></a>
						</div>
					</td>
				</tr>
	<?php  }
		}
	}
	function tampil_semua_laporan($tahun_pendaftaran){
		$query5=$this->con->query("SELECT * FROM `perangkingan` INNER JOIN tb_pendaftaran on tb_pendaftaran.id_pendaftaran=perangkingan.id_pendaftaran WHERE tahun_pendaftaran='$tahun_pendaftaran' ORDER BY nilai_preferensi DESC");
		$no = 1;
			while ($data5=$query5->fetch_assoc()) {
				$id_perangkingan = $data5['id_perangkingan'];
				$no_mahasiswa = $data5['no_mahasiswa'];
				if($data5['keterangan']==1){
					$keterangan = "DITERIMA";
				}else{
					$keterangan ="DITOLAK";
				}
			?>
				<tr>
					<td> <?php echo $no++; ?> </td>
					<td><?php echo $data5['nama_mahasiswa'] ?></td>
					<td><?php echo round((($data5['nilai_preferensi'])),3)  ; ?> Point</td>
					<td><?php echo $keterangan ; ?></td>
					<td>
						<div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
						<button type="button" class="btn btn-success success-icon-notika btn-reco-mg btn-button-mg" data-id="<?php echo $no_mahasiswa ?>" data-toggle="modal" data-target="#modal_data" ><i class="fa fa-info-circle"></i></button>
						</div>
					</td>
				</tr>
	<?php	}
	}
	function tampil_laporan_gelombang($tahun_pendaftaran){
		$query=$this->con->query("SELECT * FROM tb_pendaftaran WHERE tahun_pendaftaran = '$tahun_pendaftaran' ");
		$no=1;
			if ($query->num_rows > 0) {
				while ($data=$query->fetch_assoc()) {
				$id_pendaftaran = $data['id_pendaftaran'];
				$gelombang = $data['gelombang'];
				$tahun = $data['tahun_pendaftaran'];
				?>
				<tr>
					<td> <?php echo $no++; ?> </td>
					<td> Gelombang <?php echo $data['gelombang'] ?></td>
					<td>
						<div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
							<a href="detail_laporan_gelombang.php?id_pendaftaran=<?php echo $id_pendaftaran ?>" class="btn btn-primary primary-icon-notika btn-reco-mg btn-button-mg" data-toggle="tooltip" data-placement="top" title="Lihat Perangkingan Gelombang <?php echo $gelombang ?> Tahun <?php echo $tahun ?>"><i class="fa fa-database"></i></a>
							<a target="_blank" href="cetak_laporan_gelombang.php?id_pendaftaran=<?php echo $id_pendaftaran ?>" class="btn btn-amber amber-icon-notika btn-reco-mg btn-button-mg" data-toggle="tooltip" data-placement="top" title="Cetak Laporan Pendaftaran Tahun <?php echo $tahun ?>"><i class="fa fa-print"></i></a>
						</div>
					</td>
				</tr>
	<?php  }
		}
	}
	function detail_laporan_gelombang($id_pendaftaran){
		$query5=$this->con->query("SELECT * FROM `fix_perangkingan`  WHERE id_pendaftaran='$id_pendaftaran' ORDER BY nilai_preferensi DESC");
		$no = 1;
			while ($data5=$query5->fetch_assoc()) {
				$nama_mahasiswa = $data5['nama_mahasiswa'];
				$id_perangkingan = $data5['id_perangkingan'] ;
				$no_mahasiswa = $data5['no_mahasiswa'];
				if($data5['keterangan']==1){
					$keterangan = "DITERIMA";
				}else{
					$keterangan ="DITOLAK";
				}
			?>
				<tr>
					<td> <?php echo $no++; ?> </td>
					<td><?php echo $data5['nama_mahasiswa'] ?></td>
					<td><?php echo round((($data5['nilai_preferensi'])*100),2)  ; ?> %</td>
					<td><?php echo $keterangan ; ?></td>
					<td>
						<div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
						<button type="button" class="btn btn-success success-icon-notika btn-reco-mg btn-button-mg" data-id="<?php echo $no_mahasiswa ?>" data-toggle="modal" data-target="#modal_data" ><i class="fa fa-info-circle"></i></button>
						</div>
					</td>
				</tr>
	<?php	}
	}
	function cetak_laporan($tahun_pendaftaran){ // menampilkan perangkingan berdasarkan tahun pendaftaran
		$query5=$this->con->query("SELECT * FROM `perangkingan`inner join data_mahasiswa on data_mahasiswa.no_mahasiswa=perangkingan.no_mahasiswa INNER JOIN tb_pendaftaran on tb_pendaftaran.id_pendaftaran=perangkingan.id_pendaftaran WHERE tahun_pendaftaran='$tahun_pendaftaran'  GROUP BY data_mahasiswa.no_mahasiswa  ORDER BY nilai_preferensi DESC");
		if ($query5->num_rows > 0) {
			$no = 1;
			while ($data5=$query5->fetch_assoc()) {
				if($data5['keterangan']==1){
					$keterangan = "DITERIMA";
				}else{
					$keterangan ="DITOLAK";
				}
			?>
				<tr>
					<td> <?php echo $no++; ?> </td>
					<td><?php echo $data5['nama_mahasiswa'] ?></td>
					<td><?php echo $data5['jenis_kelamin'] ?></td>
					<td><?php echo round((($data5['nilai_preferensi'])),3)  ; ?> Point</td>
					<td><?php echo $keterangan ; ?></td>
				</tr>
	<?php	}
		}
		else{
			echo "<td></td><td colspan='5'>Maaf, data tidak ada!</td>";
		}
	}
	function cetak_laporan_gelombang($id_pendaftaran){ // menampilkan laporan perangkingan berdasarkan gelombang
		$query5=$this->con->query("SELECT * FROM `fix_perangkingan` inner join data_mahasiswa on data_mahasiswa.no_mahasiswa=fix_perangkingan.no_mahasiswa WHERE fix_perangkingan.id_pendaftaran = $id_pendaftaran GROUP BY data_mahasiswa.no_mahasiswa ORDER BY nilai_preferensi DESC");
		$no = 1;
			while ($data5=$query5->fetch_assoc()) {
			if($data5['keterangan']==1){
				$keterangan = "DITERIMA";
			}else{
				$keterangan ="DITOLAK";
			}
			?>
				<tr>
					<td> <?php echo $no++; ?> </td>
					<td><?php echo $data5['nama_mahasiswa'] ?></td>
					<td><?php echo $data5['jenis_kelamin'] ?></td>
					<td><?php echo round((($data5['nilai_preferensi'])*100),2)  ; ?> %</td>
					<td><?php echo $keterangan ; ?></td>
				</tr>
	<?php	}
	}
}
class tambah extends koneksi{
	function tambah_kriteria($kriteria,$atribut){
		$query=$this->con->query("SELECT COUNT(id_ket_krit) as jumlah from kriteria");
		$data = $query->fetch_assoc();
		$jumlah = $data['jumlah'] + 1;
		$kode = "C".$jumlah;
		$query2=$this->con->query("insert into kriteria set kode_kriteria='$kode',nama_ket_krit='$kriteria',id_atribut='$atribut'");

		$query3 = $this->con->query("select count(id_ket_krit) as jumlah from kriteria");
		$data3 = $query3->fetch_assoc();
		$jumlah1 = $data3['jumlah'];
		$kode1 = $jumlah1 - 1 ; 

		$query4 = $this->con->query("delete from bobot_kriteria");

		for($i=1; $i<=$jumlah1 ; $i++){
			for($j=1; $j<=$jumlah1; $j++){
				$kode_banding1 = "C".$i;
				$kode_pembanding1 = "C".$j;
				$query5=$this->con->query("insert into bobot_kriteria set kode_banding='$kode_banding1', kode_pembanding='$kode_pembanding1',bobot=0");
			}
		}

		for($k=0;$k<=$jumlah1;$k++){
			$kode_b = "C".$k;
			$kode_p = "C".$k;
			$query_update=$this->con->query("Update bobot_kriteria set bobot=1 where kode_banding='$kode_b' and kode_pembanding='$kode_p' ");
		}
		if ($query5===TRUE) {
			$this->alert("Data kriteria Berhasil Ditambahkan");
			$this->redirect("kriteria.php");
		}
		else{
			$this->alert("Data kriteria Gagal Ditambahkan");
			$this->redirect("tambah_kriteria.php");
		}
	}
	function simpan_kriteria(){
		$no_array = 0 ;
        $query1 = $this->con->query("select count(id_ket_krit) as jumlah from kriteria");
        $data1 = $query1->fetch_assoc();
        $jumlah_kriteria = $data1['jumlah'];
        $query2 = $this->con->query("SELECT * FROM fix_kriteria ORDER BY fix_kriteria DESC LIMIT 1");
        $data2 = $query2->fetch_assoc();
        $fix_kriteria = $data2['fix_kriteria'] + 1;
        
        $query = $this->con->query("select * from kriteria");
        while($data=$query->fetch_assoc()){
            $kode_kriteria[]=$data['kode_kriteria'];
            $nama_ket_krit[]=$data['nama_ket_krit'];
            $id_atribut[]=$data['id_atribut'];
        }
        
        for($i = 0 ; $i < $jumlah_kriteria ; $i++){
            $query3 = $this->con->query("insert into fix_kriteria set kode_kriteria = '$kode_kriteria[$i]',nama_ket_krit = '$nama_ket_krit[$i]',id_atribut = '$id_atribut[$i]',fix_kriteria = '$fix_kriteria' ");
        }

        $query4 = $this->con->query("SELECT * FROM bobot_kriteria order by kode_banding,kode_pembanding");
        while($data4 = $query4->fetch_assoc()){
            $kode_banding[] = $data4['kode_banding'];
            $kode_pembanding[] = $data4['kode_pembanding'];
            $bobot[] = $data4['bobot'];
        }
        $query5 = $this->con->query("select count(id_bobot) as jumlah from bobot_kriteria");
        $data5 = $query5->fetch_assoc();
        $jumlah_bobot = $data5['jumlah'];
        for($j=0; $j < $jumlah_bobot ; $j++){
			$query6=$this->con->query("insert into fix_bobot_kriteria set bobot = '$bobot[$j]', kode_banding = '$kode_banding[$j]', kode_pembanding = '$kode_pembanding[$j]',fix_bobot = '$fix_kriteria'");
		}
		
		if ($query6===TRUE) {
			$this->alert("Data kriteria Berhasil Di Simpan");
			$this->redirect("setting_nilai_preferensi.php");
		}
		else{
			$this->alert("Data kriteria Gagal Di Simpan");
			$this->redirect("hasil_analisis.php");
		}
	}
	function simpan_bobot_kriteria(){
		$no_array = 0 ;
        $query1 = $this->con->query("select count(id_ket_krit) as jumlah from kriteria");
        $data1 = $query1->fetch_assoc();
        $jumlah_kriteria = $data1['jumlah'];
        $query2 = $this->con->query("SELECT * FROM fix_kriteria ORDER BY fix_kriteria DESC LIMIT 1");
        $data2 = $query2->fetch_assoc();
        $fix_kriteria = $data2['fix_kriteria'];
		$query8 = $this->con->query("SELECT * FROM bobot_kriteria order by kode_banding,kode_pembanding");
		while($data8 = $query8->fetch_assoc()){
			$array_bobot[] = $data8['bobot'];
		}
		$query9 = $this->con->query("SELECT kode_pembanding, SUM(bobot) as jumlah_bobot FROM bobot_kriteria GROUP BY kode_pembanding"); 
		while($data9 = $query9->fetch_assoc()){
			$jumlah_bobot[] = $data9['jumlah_bobot'];
		}
		
		for($k=0; $k< $jumlah_kriteria; $k++){
			for($l=0; $l< $jumlah_kriteria; $l++){
				$bobot[$k][$l] = $array_bobot[$no_array];
				$jumlah_b[$k][$l] = $jumlah_bobot[$l];
				$hasil[$k][$l] = $bobot[$k][$l]/$jumlah_b[$k][$l] ;
				$no_array++;
			}
		}
		for($m=0;$m<$jumlah_kriteria;$m++){
			$jum[$m] = array_sum($hasil[$m]);
            $pv[$m] = $jum[$m]/$jumlah_kriteria ;
            $query10 = $this->con->query("insert into pv set pv = '$pv[$m]', fix_pv = '$fix_kriteria' "); 
        }
	}
	function tambah_pendaftaran($tahun_pendaftaran){ // menambahkan data pendaftaran
		$query_kriteria = $this->con->query("SELECT * FROM fix_kriteria ORDER BY fix_kriteria DESC LIMIT 1");
		$data_kriteria = $query_kriteria->fetch_assoc();
		$fix_kriteria = $data_kriteria['fix_kriteria'];

		$query=$this->con->query("select * from tb_pendaftaran where tahun_pendaftaran='$tahun_pendaftaran'");
		if ($query->num_rows > 0) {
			
		}
		else{
			$query2=$this->con->query("insert into tb_pendaftaran set tahun_pendaftaran='$tahun_pendaftaran', fix_kriteria = '$fix_kriteria' ");
		}
	}
	function tambah_nilai_minimum_preferensi($nilai_minimum_preferensi){
		$query_kriteria = $this->con->query("SELECT * FROM fix_kriteria ORDER BY fix_kriteria DESC LIMIT 1");
		$data_kriteria = $query_kriteria->fetch_assoc();
		$fix_kriteria = $data_kriteria['fix_kriteria'];
		$hasil_nilai_minimum = $nilai_minimum_preferensi;
		$query2=$this->con->query("insert into nilai_minimum_preferensi set nilai_minimum='$hasil_nilai_minimum' ,fix_kriteria = '$fix_kriteria' ");
		if ($query2===TRUE) {
			$this->alert("Data Berhasil di Simpan");
			$this->redirect("fix_kriteria.php");
		}
		else{
			$this->alert("Data Gagal di Simpan");
			$this->go_back();
		}
	}
	function simpan_hasil_perangkingan($id_pendaftaran){
		$query_hapus = $this->con->query("DELETE FROM fix_perangkingan where id_pendaftaran = '$id_pendaftaran'");
		$query = $this->con->query("SELECT * FROM perangkingan where id_pendaftaran = '$id_pendaftaran'");
		while($data = $query->fetch_assoc()){
			$no_mahasiswa = $data['no_mahasiswa'];
			$nama_mahasiswa = $data['nama_mahasiswa'];
			$nilai_preferensi = $data['nilai_preferensi'];
			$keterangan = $data['keterangan'];

			$query1 = $this->con->query("INSERT INTO fix_perangkingan set id_pendaftaran = '$id_pendaftaran' , no_mahasiswa = '$no_mahasiswa' , nama_mahasiswa = '$nama_mahasiswa' ,nilai_preferensi = '$nilai_preferensi', keterangan ='$keterangan'");
			
		}
		if ($query1===TRUE) {
			$this->alert("Data Perangkingan Berhasil Di Simpan");
			$this->redirect("hasil_perangkingan_admin.php?id_pendaftaran=$id_pendaftaran");
		}
		else{
			$this->alert("Data Perangkingan Gagal Di Simpan");
			$this->go_back();
		}
	}
}
class edit extends koneksi{
	function edit_kriteria($id_kriteria,$kriteria,$atribut){
		$query=$this->con->query("select * from kriteria where nama_ket_krit='$kriteria' and id_atribut='$atribut'");
		if ($query->num_rows > 0) {
			$this->alert("Data kriteria sudah ada dan GAGAL di Ubah!!!!!");
			$this->go_back();
		}
		else{
			$query2=$this->con->query("update kriteria set nama_ket_krit='$kriteria',id_atribut='$atribut' where id_ket_krit='$id_kriteria'");
			if ($query2===TRUE) {
				$this->alert("Data kriteria Berhasil Diubah");
				$this->redirect("kriteria.php");
			}
			else{
				$this->alert("Data kriteria Gagal Diubah");
				$this->go_back();
			}
		}
	}
	function edit_matrix_pairwise($kode_banding,$kode_pembanding,$tingkat_kepentingan){
		$nilai_kepentingan_1 = $tingkat_kepentingan / 1 ;
		$nilai_kepentingan_2 = 1 / $tingkat_kepentingan ;

		$query=$this->con->query("update bobot_kriteria set bobot ='$nilai_kepentingan_1' where kode_banding = '$kode_banding' and kode_pembanding = '$kode_pembanding' ");
		$query1=$this->con->query("update bobot_kriteria set bobot ='$nilai_kepentingan_2' where kode_banding = '$kode_pembanding' and kode_pembanding = '$kode_banding' ");
		if ($query===TRUE) {
			$this->alert("Nilai Matrix '$kode_banding' banding '$kode_pembanding' Berhasil Diubah");
			$this->redirect("setting_bobot.php");
		}
		else{
			$this->alert("Nilai Matrix '$kode_banding' banding '$kode_pembanding' Gagal Diubah");
			$this->go_back();
		}
	}
	function edit_pendaftaran($tahun_pendaftaran,$gelombang,$id_pendaftaran){ // edit data pendaftaran
		$query=$this->con->query("select * from tb_pendaftaran where tahun_pendaftaran='$tahun_pendaftaran' and gelombang='$gelombang'");
		if ($query->num_rows > 0) {
			$this->alert("Data tahun pendaftaran dan gelombang sudah ada dan GAGAL di Ubah!!!!!");
			$this->go_back();
		}
		else{
			$query2=$this->con->query("update tb_pendaftaran set tahun_pendaftaran='$tahun_pendaftaran',gelombang='$gelombang' where id_pendaftaran ='$id_pendaftaran' ");
			if ($query2===TRUE) {
				$this->alert("Data Tahun Pendaftaran Berhasil Diubah");
				$this->redirect("data_pendaftaran.php");
			}
			else{
				$this->alert("Data Tahun Pendaftaran Gagal Diubah");
				$this->go_back();
			}
		}
	}
	function edit_password($id,$username,$password,$konfir_password){ //ubah password
		if (empty($password)) { // jika password kosong maka yang di ubah hanya username
			$query=$this->con->query("update user set username='$username' where id = '$id'");
			if ($query===TRUE) {
				$this->alert("Password berhasil diubah");
				$this->redirect("handler.php?action=logout");
				}
				else{
				$this->alert("Password Gagal di Ubah");
				$this->redirect("setting_akun.php");
				}		
		}else{ // jika password tidak bernilai kosong(empty) maka ubah ubah password dan username
			// jika pasword sama dengan konfirmasi password makaa dilakukan perubahan password
			if($password==$konfir_password){
				// password dienkripsi menggunakan sha1
				$password1=sha1($password);
				$query2=$this->con->query("update user set username='$username',password='$password1' where id = '$id'");
				if ($query2===TRUE) {
					$this->alert("Password berhasil diubah");
					$this->redirect("handler.php?action=logout");
					}
					else{
					$this->alert("Password Gagal di Ubah");
					$this->redirect("setting_akun.php");
					}
			}else{// jika password dan konfirmasi password tidak sama maka akan kembali ke shalam setting akun
				$this->alert("Password dan Konfirmasi Password tidak sama");
				$this->redirect("setting_akun.php");
			}
		}
	}
	function ubah_keputusan($id_perangkingan){
		$query = $this->con->query("SELECT * FROM fix_perangkingan where id_perangkingan = '$id_perangkingan' ");
		$data = $query->fetch_assoc();
		$keterangan = $data['keterangan'];
		$id_pendaftaran = $data['id_pendaftaran'];
		if($keterangan==1){
			$query1 = $this->con->query("UPDATE fix_perangkingan set keterangan = 2 where id_perangkingan = '$id_perangkingan' ");
			if ($query1===TRUE) {
				$this->alert("Keputusan Berhasil di Ubah");
				$this->redirect("hasil_perangkingan_gelombang.php?id_pendaftaran=$id_pendaftaran");
				}
				else{
				$this->alert("Keputusan Gagal di Ubag");
				$this->go_back();
				}
		}else{
			$query1 = $this->con->query("UPDATE fix_perangkingan set keterangan = 1 where id_perangkingan = '$id_perangkingan' ");
			if ($query1===TRUE) {
				$this->alert("Keputusan Berhasil di Ubah");
				$this->redirect("hasil_perangkingan_gelombang.php?id_pendaftaran=$id_pendaftaran");
				}
				else{
				$this->alert("Keputusan Gagal di Ubag");
				$this->go_back();
				}
		}
	}
}
class hapus extends koneksi{
	function hapus_kriteria($id_kriteria){
		$query=$this->con->query("delete from kriteria where id_ket_krit='$id_kriteria'");

		$jumlah =  1;
		$query2 = $this->con->query("select * from kriteria");
		while ($data2=$query2->fetch_assoc()){
			$kode = "C".$jumlah++ ;
			$nama_ket_krit = $data2['nama_ket_krit'];
			$query7 = $this ->con ->query("update kriteria set kode_kriteria = '$kode' where nama_ket_krit='$nama_ket_krit' ");
		}

		$query3 = $this->con->query("select count(id_ket_krit) as jumlah from kriteria");
		$data3 = $query3->fetch_assoc();
		$jumlah1 = $data3['jumlah']; 

		$query4 = $this->con->query("delete from bobot_kriteria");

		for($i=1; $i<=$jumlah1 ; $i++){
			for($j=1; $j<=$jumlah1; $j++){
				$kode_banding1 = "C".$i;
				$kode_pembanding1 = "C".$j;
				$query5=$this->con->query("insert into bobot_kriteria set kode_banding='$kode_banding1', kode_pembanding='$kode_pembanding1',bobot=0");
			}
		}

		for($k=0;$k<=$jumlah1;$k++){
			$kode_b = "C".$k;
			$kode_p = "C".$k;
			$query_update=$this->con->query("Update bobot_kriteria set bobot=1 where kode_banding='$kode_b' and kode_pembanding='$kode_p' ");
		}
		
		if ($query7===TRUE) {
			$this->alert("Data kriteria Berhasil Dihapus");
			$this->redirect("kriteria.php");
		}
		else{
			$this->alert("Data kriteria Gagal Dihapus");
			$this->go_back();
		}
	}
	function hapus_pendaftaran($id_pendaftaran){
		$query3=$this->con->query("delete from tb_pendaftaran where id_pendaftaran='$id_pendaftaran'");
		$query2=$this->con->query("delete from data_mahasiswa where id_pendaftaran='$id_pendaftaran'");
		$query1=$this->con->query("delete from data_konversi_data_mahasiswa where id_pendaftaran='$id_pendaftaran'");
		$query=$this->con->query("delete from perangkingan where id_pendaftaran='$id_pendaftaran'");
		$query4=$this->con->query("delete from fix_perangkingan where id_pendaftaran='$id_pendaftaran'");
		if ($query1===TRUE&&$query2===TRUE&&$query===TRUE) {
			$this->alert("Data Mahasiswa Berhasil Dihapus");
			$this->redirect("data_pendaftaran.php");
		}
		else{
			$this->alert("Data mahasiswa Gagal Dihapus");
			$this->go_back();
		}
	}
	function hapus_mahasiswa($no_mahasiswa,$id_pendaftaran){
		$query2=$this->con->query("delete from data_mahasiswa where no_mahasiswa='$no_mahasiswa'");
		$query1=$this->con->query("delete from data_konversi_data_mahasiswa where no_mahasiswa='$no_mahasiswa'");
		$query=$this->con->query("delete from perangkingan where no_mahasiswa='$no_mahasiswa'");
		$query3=$this->con->query("delete from fix_perangkingan where no_mahasiswa='$no_mahasiswa'");
		if ($query1===TRUE&&$query2===TRUE&&$query===TRUE) {
			$this->alert("Data Mahasiswa Berhasil Dihapus");
			$this->redirect("data_mahasiswa.php?id_pendaftaran=$id_pendaftaran");
		}
		else{
			$this->alert("Data mahasiswa Gagal Dihapus");
			$this->go_back();
		}
	}
}

$koneksi=new koneksi();
$tampil=new tampil();
$tambah=new tambah();
$edit=new edit();
$hapus=new hapus();
?>
