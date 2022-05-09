<?php

include_once("utils/Connection.php");
include_once("utils/Redirect.php");

$error = null;

if (isset($_POST['submit'])) {
	$data = [
		$_POST['rangking'],
		$_POST['nis'],
		$_POST['nama'],
		$_POST['nomor'],
		$_POST['alamat']
	];

	if ($connection->add("rengkingsiswa", $data)) {
		Redirect::to("./");
	} else {
		$error = 'Proses gagal';
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Tambah Data</title>

</head>
<body>
	<a href="/">Tampilkan</a>

	<hr>

	<form action="tambah.php" method="post">

		<table>
			<tr>
				<td>
					<label for="nis">NIS</label>
				</td>
				<td>
					<input name="nis" id="nis" type="text">
				</td>
			</tr>
			<tr>
				<td>
					<label for="nama">Nama</label>
				</td>
				<td>
					<input name="nama" id="nama" type="text">
				</td>
			</tr>
			<tr>
			<tr>
				<td>
					<label for="nomor">Nomor</label>
				</td>
				<td>
					<input name="nomor" id="nomor" type="number">
				</td>
			</tr>
			<tr>
				<td>
					<label for="rangking">Rangking</label>
				</td>
				<td>
					<input name="rangking" id="rangking" type="number">
				</td>
			</tr>
			<tr>
				<td>
					<label for="alamat">Alamat</label>
				</td>
				<td>
					<textarea name="alamat" id="alamat"></textarea>
				</td>
			</tr>
			<tr>
				<td>
					<button type="reset">Reset</button>
				</td>
				<td>
					<button name="submit" type="submit">Kirim</button>
				</td>
			</tr>
		</table>

		<strong><?= $error ? '***** ' . $error . ' *****' : '' ?></strong>

<?php if ($err = $connection->getErrorMessage()): ?>

		<hr>

		<?= $err ?>

<?php endif; ?>

	</form>

</body>
</html>