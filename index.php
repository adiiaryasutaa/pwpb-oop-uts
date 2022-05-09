<?php

include_once("utils/Connection.php");

$data = $connection->all('rengkingsiswa');

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>PWPB OOP</title>
</head>
<body>
	<a href="/tambah.php">Tambah</a>

	<hr>
	
	<table border="1">
		<tr>
			<th>Id</th>
			<th>Rengking</th>
			<th>NIS</th>
			<th>Nama</th>
			<th>Alamat</th>
			<th>Aksi</th>
		</tr>
<?php foreach ($data as $a): ?>
		<tr>
			<td><?= $a['id'] ?></td>
			<td><?= $a['rengking'] ?></td>
			<td><?= $a['nis'] ?></td>
			<td><?= $a['nama'] ?></td>
			<td><?= $a['alamat'] ?></td>
			<td>
				<a href="edit.php?id=<?= $a['id'] ?>">Edit</a>
				<a href="hapus.php?id=<?= $a['id'] ?>">Hapus</a>
			</td>
		</tr>
<?php endforeach; ?>
	</table>

</body>
</html>
