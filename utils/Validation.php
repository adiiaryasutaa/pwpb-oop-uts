<?php

/**
 * 
 * 
 */
class Validation
{

	/**
	 * 
	 * 
	 */
	public function __construct(public Connection $connection = new Connection()) {}

	/**
	 * 
	 * 
	 */
	public function validate(string $table, array $data)
	{
		$dataInDB = $this->connection->get($table, $data['id']);

		
	}

	/**
	 * 
	 * 
	 */
	public function updated(string $table, int $id, array $data): array
	{
		$dataInDB = $this->connection->get($table, $id);

		$updated = [];

		if (count($dataInDB)) foreach ($dataInDB as $column => $value) {
			if ($value != $data[$column])
				array_push($updated, $column);
		}

		return $updated;
	}

}

$validation = new Validation();

?>