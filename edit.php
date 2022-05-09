<?php

include_once("utils/Connection.php");
include_once("utils/Validation.php");
include_once("utils/Redirect.php");

// Back to index.php when this page opened without id
Redirect::toIf(! isset($_GET['id']) && ! isset($_POST['submit']), "./");

Redirect::toIf(isset($_POST['back']), "./");

$error = null;

$data = $connection->get("rengkingsiswa", $_GET['id']);

if (isset($_POST['submit'])) {
	$data = [
		"id" => $_GET['id'],
		"nis" => $_POST['nis'],
		"rengking" => $_POST['rangking'],
		"nama" => $_POST['nama'],
		"nomorabsen" => $_POST['nomor'],
		"alamat" => $_POST['alamat']
	];

	$updated = $validation->updated("rengkingsiswa", $_GET['id'], $data);
	$set = [];
	
	if (count($updated)) foreach ($updated as $update)
		$set = array_merge($set, [$update => $data[$update]]);

	Redirect::toIf($connection->update("rengkingsiswa", array_keys($set), [$_GET['id'], ...array_values($set)]), "./");

	$error = "Proses gagal";

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edit data</title>
</head>
<body>
	<a href="/">Tampilkan</a>

	<hr>

	<strong>Edit data <?= $data['nama'] ?></strong>

	<form action="edit.php?id=<?= $_GET['id'] ?>" method="post">

		<table>
			<tr>
				<td>
					<label for="nis">NIS</label>
				</td>
				<td>
					<input name="nis" id="nis" type="number" value="<?= $data['nis'] ?>">
				</td>
			</tr>
			<tr>
				<td>
					<label for="nama">Nama</label>
				</td>
				<td>
					<input name="nama" id="nama" type="text" value="<?= $data['nama'] ?>">
				</td>
			</tr>
			<tr>
			<tr>
				<td>
					<label for="nomor">Nomor</label>
				</td>
				<td>
					<input name="nomor" id="nomor" type="number" value="<?= $data['nomorabsen'] ?>">
				</td>
			</tr>
			<tr>
				<td>
					<label for="rangking">Rangking</label>
				</td>
				<td>
					<input name="rangking" id="rangking" type="number" value="<?= $data['rengking'] ?>">
				</td>
			</tr>
			<tr>
				<td>
					<label for="alamat">Alamat</label>
				</td>
				<td>
					<textarea name="alamat" id="alamat"><?= $data['alamat'] ?></textarea>
				</td>
			</tr>
			<tr>
				<td>
					<button name="back" type="submit">Batal</button>
				</td>
				<td>
					<button name="submit" type="submit">Ubah</button>
				</td>
			</tr>
		</table>

	</form>

	<strong><?= $error ? '***** ' . $error . ' *****' : '' ?></strong>

<?php if ($err = $connection->getErrorMessage()): ?>

		<hr>

		<?= $err ?>

<?php endif; ?>

</body>
</html>