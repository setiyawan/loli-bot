<?php
	header("Content-type: application/vnd-ms-excel");
 
	// Mendefinisikan nama file ekspor "hasil-export.xls"
	header("Content-Disposition: attachment; filename=Data_tingkat_kemiskinan.xls");

	$header = $this->db->query("select * from ta.v_daerah where idprovinsi = '$idprovinsi' and idkabupaten = '$idkabupaten' and 
								idkecamatan = '$idkecamatan' and iddesa = '$iddesa'")->result_array();
	$header = $header[0];
	$provinsi = $header['namaprovinsi'];
	$kabupaten = $header['namakabupaten'];
	$kecamatan = $header['namakecamatan'];
	$desa = $header['namadesa'];

	$kesejahteraan = $this->db->query("select nama from ta.ms_kesejahteraan where idkesejahteraan = $tk_kemiskinan")->result_array();
	$kesejahteraan = $tk_kemiskinan . "|" . $kesejahteraan[0]['nama'];
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<h1 align="center">Data Tingkat Kemiskinan Masyarakat</h1>
	<h3 align="center"> 
		<table>
			<tr>
				<td> Provinsi </td>
				<td> : </td> 
				<td> <?=$provinsi?></td>
			</tr>
			<tr>
				<td> Kabupaten </td>
				<td> : </td> 
				<td> <?=$kabupaten?></td>
			</tr>
			<tr>
				<td> Kecamatan </td>
				<td> : </td> 
				<td> <?=$kecamatan?></td>
			</tr>
			<tr>
				<td> Desa </td>
				<td> : </td> 
				<td> <?=$desa?></td>
			</tr>
			<tr>
				<td> Kesejahteraan </td>
				<td> : </td> 
				<td> <?=$kesejahteraan?></td>
			</tr>
		</table>
	</h3>
	<table align="center" border="1">
		<thead>
            <tr>
                <th width="40px">No.</th>
                <?php foreach ($input as $key) {
                if($key['hidden']) continue; ?>
                <th> <?= $key['label'] ?></th>
                <?php } ?>
            </tr>
        </thead>
		<tbody>
            <?php $no = 1; if(!empty($data)) foreach ($data as $key) { ?>
            <tr class="odd gradeX">
                <td align="center"><?=$no++?></td>
                <?php foreach ($input as $keys) { 
                    if($keys['hidden']) continue;
                    if($keys['key'] == 'idkeluarga')
                    {
                    	$idkeluarga = $key[$keys['key']];
                    	$sql = $this->db->query("select nama from ta.ms_keluarga where idkeluarga = $idkeluarga")->result_array();
                    	$key[$keys['key']] = $sql[0]['nama'];
                    	$keys['type'] = 'T';
                    }
                ?>
                   	<?php if($keys['type'] == 'S') { ?>
                        <td><?= $keys['option'][$key[$keys['key']]] ?></td>
                    <?php } elseif($keys['type'] == 'N') { ?>
                        <td align="center"><?= $key[$keys['key']] ?></td>
                    <?php } else { ?>
                        <td><?= $key[$keys['key']] ?></td>
                    <?php } ?>
                <?php } ?>
            </tr>
            <?php } ?>
        </tbody>
	</table>
</body>
</html>