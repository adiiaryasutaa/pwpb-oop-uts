<?php 

include_once("Database.php");
include_once("QueryBuilder.php");

/**
 * 
 * 
 */
class Connection extends Database
{

	/**
	 * 
	 * 
	 */
	public function __construct(
		private QueryBuilder $queryBuilder = new QueryBuilder()
	) {
		parent::__construct('localhost', '3310', 'db_uts', 'root', null);
	}

	/**
	 * 
	 * 
	 */
	public function getErrorMessage(): string
	{
		return $this->error;
	}

	/**
	 * 
	 * 
	 */
	public function all(string $table): array
	{
		$query = $this->queryBuilder->select($table, "*")->make();

		return $this->fetchAssocAll($query);
	}

	/**
	 * 
	 * 
	 */
	public function get(string $table, int $id): array
	{
		$query = $this->queryBuilder->select($table, "*")->whereId($id)->make();

		return $this->fetchAssoc($query);
	}

	/**
	 * 
	 * 
	 */
	public function add(string $table, array $data): bool
	{
		$query = $this->queryBuilder->insert(
			table: $table,
			columns: ['rengking', 'nis', 'nama', 'nomorabsen', 'alamat'],
			colCount: 5
		)->make();

		return $this->executePreparedStatement($query, $data);
	}

	/**
	 * 
	 *
	 */
	public function update(string $table, array $set, array $data): bool
	{
		$query = $this->queryBuilder->update($table)
																->setFromArrayAssoc($set)
																->whereId()
																->make();

		echo $query;

		return $this->executePreparedStatement(
			$query,
			$data
			//array_merge(array_values($setColumnAndValue), array_values($whereColumnsAndValues))
		);
	}

	/**
	 * 
	 * 
	 */
	public function delete(string $table, int $id)
	{
		$sql = $this->queryBuilder->delete($table)->whereId()->make();

		return $this->executePreparedStatement($sql, [$id]); 
	}

}

$connection = new Connection();
