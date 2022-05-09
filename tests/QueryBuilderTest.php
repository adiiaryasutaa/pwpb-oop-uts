<?php

include_once('./../utils/Connection.php');

function updateTest()
{
	$queryBuilder = new QueryBuilder();
	
	$query = $queryBuilder->update("rengkingsiswa")
	->set("alamat", "'Jalan Nuansa Hijau Utama XXVI'")
	->where("alamat", "'Jalan Yahaha'")
	->andWhere("alamat", "'Jalan yuhuhuh'")
	->make();
	
	echo $query;
}

function updateTest2()
{
	$connection = new Connection();

	$connection->update(
		"rengkingsiswa",
		[
			"nama" => "Cecep",
			"rengking" => 4,
			"nis" => 28810
		],
		[
			"nama" => "I Gusti Ngurah Agung Adi Aryasuta",
			"rengking" => 6
		]
	);
	
}

function updateTest3()
{
	$queryBuilder = new QueryBuilder();

	echo $queryBuilder->insert("rengkingsiswa", ['dd', 'dd', 'hh'], 2, 10)->make();
}

updateTest3();

?>