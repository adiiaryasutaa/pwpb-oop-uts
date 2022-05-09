<?php

/**
 * 
 * 
 */
class QueryBuilder
{
	
	/**
	 * 
	 * 
	 */
	public function __construct(private string $query = ""){}

	/**
	 * 
	 * 
	 */
	public function select(string $table, string $column): QueryBuilder
	{
		$this->reset();

		$this->query .= "SELECT $column FROM $table ";

		return $this;
	}

	/**
	 * 
	 * 
	 */
	public function insert(string $table, array $columns = [], int $rowCount = 1, int $colCount = 0): QueryBuilder
	{
		$this->reset();

		$this->query .= "INSERT INTO $table ";

		if (count($columns)) {
			$this->query .= "(";

			foreach ($columns as $column) {
				$this->query .= "$column, ";
			}

			$this->query = substr_replace($this->query, ") ", -2);
		}

		$this->query .= "VALUES ";

		for ($i = 0; $i < $rowCount; $i++) {
			$this->query .= "(";
			for ($j = 0; $j < $colCount; $j++) {
				$this->query .= $j !== $colCount - 1 ? "?, " : "?";
			}
			$this->query .= $i === $rowCount - 1 ? ")" : "), ";
		}

		return $this;
	}

	/**
	 * 
	 * 
	 */
	public function update(string $table): QueryBuilder
	{
		$this->reset();

		$this->query .= "UPDATE $table ";

		return $this;
	}

	/**
	 * 
	 * 
	 */
	public function delete(string $table): QueryBuilder
	{
		$this->reset();

		$this->query .= "DELETE FROM $table ";

		return $this;
	}

	/**
	 * 
	 * 
	 */
	public function set(string $column, string $value): QueryBuilder
	{
		$this->query .= !str_contains($this->query, "SET ") ? "SET $column = $value " : ", $column = $value ";

		return $this;
	}

	/**
	 * 
	 * 
	 */
	public function setFromArrayAssoc(array $columns): QueryBuilder
	{
		foreach ($columns as $column) {
			$this->query .= !str_contains($this->query, "SET") ? "SET $column = ? " : ", $column = ? ";
		}

		return $this;
	}

	/**
	 * 
	 * 
	 */
	public function where(string $column): QueryBuilder
	{
		$this->query .= "WHERE $column = ?";

		return $this;
	}

	/**
	 * 
	 * 
	 */
	public function whereId(?string $id = '?'): QueryBuilder
	{
		$this->query .= "WHERE id = $id";

		return $this;
	}

	/**
	 * 
	 * 
	 */
	public function whereFromArrayAssoc(array $columns): QueryBuilder
	{
		foreach ($columns as $column) {
			$this->query .= !str_contains($this->query, "WHERE") ? "WHERE $column = ? " : "AND $column = ? ";
		}

		return $this;
	}

	/**
	 * 
	 * 
	 */
	public function andWhere(string $column): QueryBuilder
	{
		$this->query .=  " AND $column = ?";

		return $this;
	}

	/**
	 * 
	 * 
	 */
	public function make(): string
	{
		return $this->query;
	}

	/**
	 * 
	 * 
	 */
	public function reset(): void
	{
		$this->query = "";
	}
}

?>