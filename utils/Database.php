<?php

/**
 * 
 * 
 */
class Database extends mysqli
{

	/**
	 * 
	 * 
	 */
	public function __construct(?string $host, ?string $port, ?string $database, ?string $username, ?string $password)
	{
		try {
			parent::__construct($host, $username, $password, $database, $port);
		} catch (Exception $e) {
			throw $e;
		}
	}

	/**
	 * 
	 * 
	 */
	public function executePreparedStatement(string $sql, array $data): bool
	{
		$statement = $this->prepare($sql);

		return $statement->execute($data);
	}

	/**
	 * 
	 * 
	 */
	public function fetchAssocAll(string $sql): array
	{
		$result = $this->query($sql);
		
		if ($result->num_rows < 0) 
			return [];

		return $result->fetch_all(MYSQLI_ASSOC);
	}

	/**
	 * 
	 * 
	 */
	public function fetchAssoc(string $sql): array
	{
		$result = $this->query($sql, MYSQLI_ASSOC);

		if ($result->num_rows < 0) 
			return [];

		return $result->fetch_assoc();
	}
}

?>