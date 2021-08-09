<?php    

include "root.php";
        $query = $koneksi->con->query("select count(id_ket_krit) as jumlah from kriteria");
		$data = $query->fetch_assoc();
		$jumlah_kriteria = $data['jumlah'];
		$no = 1 ;
		$no_array = 0 ;
		?>
        <table>
			<thead>
                <tr>
					<th> Kode </th>
					<?php
					$query2 = $koneksi->con->query("SELECT * FROM kriteria");
					while($data2=$query2->fetch_assoc()){?>
						<th><?php echo $data2['kode_kriteria']; ?></th>
					<?php
					}
					?>
				</tr>
        	</thead>
			<tbody>
			<?php
			$query3 = $koneksi->con->query("SELECT * FROM bobot_kriteria order by kode_banding,kode_pembanding");
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
					$query4 = $koneksi->con->query("SELECT kode_pembanding, SUM(bobot) as jumlah_bobot FROM bobot_kriteria GROUP BY kode_pembanding"); 
					while($data4 = $query4->fetch_assoc()){
						$jumlah_bobot = $data4['jumlah_bobot'];
						echo "<td><b>".$jumlah_bobot."</b></td>" ;
					}
				?>
				</tr>
			<tfoot>	
        </table>
		<?php