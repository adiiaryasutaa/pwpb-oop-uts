<?php 

include_once("utils/Connection.php");
include_once("utils/Redirect.php");

$error = null;

// Back to index.php when this page opened without id
Redirect::toIf(! isset($_GET['id']) && ! isset($_POST['submit']), "./");
Redirect::toIf(isset($_POST['back']), "./");


if (isset($_POST['submit'])) {
	Redirect::toIf($connection->delete("rengkingsiswa", $_GET['id']), "./");
	
	$error = "Proses gagal";
}

$data = $connection->get("rengkingsiswa", $_GET['id']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Hapus Data</title>
</head>
<body>

	<strong>Apakah anda yakin ingin menghapus data ini?</strong>

	<table>
		<tr>
			<td><hr></td>
			<td><hr></td>
			<td><hr></td>
		</tr>

<?php foreach ($data as $column => $value): ?>
		<tr>
			<td><?= $column ?></td>
			<td>:</td>
			<td><?= $value ?></td>
		</tr>
<?php endforeach; ?>

		<tr>
			<td><hr></td>
			<td><hr></td>
			<td><hr></td>
		</tr>

		<form action="hapus.php?id=<?= $_GET['id'] ?>" method="post">
			<tr>
				<td>
					<button name="back" type="submit">Tidak</button>
				</td>
				<td></td>
				<td>
					<button name="submit" type="submit">Ya</button>
				</td>
			</tr>
		</form>

	</table>

	<strong><?= $error ? '***** ' . $error . ' *****' : '' ?></strong>

<?php if ($err = $connection->getErrorMessage()): ?>

		<hr>

		<?= $err ?>

<?php endif; ?>

</body>
</html>