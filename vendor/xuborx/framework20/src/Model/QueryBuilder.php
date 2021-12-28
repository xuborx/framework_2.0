<?php
declare(strict_types=1);

namespace Xuborx\Framework\Model;

class QueryBuilder
{
    /**
     * @var string
     */
    private $query;
    /**
     * @var array|null
     */
    private $selectableFields = null;
    /**
     * @var string
     */
    protected $tableName = null;
    /**
     * @var array|null
     */
    private $where = null;
    /**
     * @var int|null
     */
    private $limit = null;
    /**
     * @var int|null
     */
    /**
     * @var bool
     */
    private $asc = true;
    /**
     * @var string|null
     */
    private $orderBy = null;
    /**
     * @var int
     */
    private $mode = \PDO::FETCH_ASSOC;
    /**
     * @var array|null
     */
    private $insert = null;

    /**
     * @param array $fields
     * @return $this
     */
    public function select(array $fields): self
    {
        $this->selectableFields = $fields;
        return $this;
    }

    /**
     * @param string $tableName
     * @return $this
     */
    public function from(string $tableName): self
    {
        $this->tableName = $tableName;
        return $this;
    }

    /**
     * @param string $field
     * @param string $operator
     * @param string $value
     * @return $this
     */
    public function where(string $field, string $operator, string $value): self
    {
        $this->where[] = $field . $operator . '\'' . $value . '\'';
        return $this;
    }

    /**
     * @param int $limit
     * @return $this
     */
    public function limit(int $limit): self
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * @param string $field
     * @return $this
     */
    public function orderBy(string $field): self
    {
        $this->orderBy = $field;
        return $this;
    }

    /**
     * @return $this
     */
    public function desc(): self
    {
        $this->asc = false;
        return $this;
    }

    /**
     * @param int $mode
     * @return $this
     */
    public function setMode(int $mode): self
    {
        $this->mode = $mode;
        return $this;
    }

    /**
     * @return array
     */
    public function runQuery(): array
    {
        //return $this->buildQuery();
        return $this->executeQuery(
            $this->buildQuery()
        );
    }

    /**
     * @param string $column
     * @param $value
     * @return $this
     */
    public function insert(string $column, $value): self
    {
        $this->insert['columns'][] = $column;
        $this->insert['values'][] = '\'' . $value . '\'';
        return $this;
    }

    /**
     * @return string
     */
    private function buildQuery(): string
    {
        if (!empty($this->insert)) {
            $sql = 'INSERT INTO ' . $this->getTableName() . '(';
            $sql .= implode(',', $this->insert['columns']);
            $sql .= ') VALUES (';
            $sql .= implode(',', $this->insert['values']);
            $sql .= ')';
            return $sql;
        }

        $sql = 'SELECT ';

        if (!empty($this->selectableFields)) {
            $sql .= implode(',', $this->selectableFields);
        } else {
            $sql .= '*';
        }

        $sql .= ' FROM ' . $this->getTableName();

        if (!empty($this->where)) {
            $sql .= ' WHERE ' . implode(' AND ', $this->where);
        }

        if (!empty($this->orderBy)) {
            $sql .= ' ORDER BY ' . $this->orderBy;
            if ($this->asc) {
                $sql .= ' ASC';
            } else {
                $sql .= ' DESC';
            }
        }

        if (!empty($this->limit)) {
            $sql .= ' LIMIT ' . $this->limit;
        }

        return $sql;
    }

    /**
     * @param string $query
     * @return array
     */
    public function runCustomQuery(string $query): array
    {
        return $this->executeQuery($query);
    }

    /**
     * @return string
     */
    private function getTableName(): string
    {
        if (!empty($this->tableName)) {
            return $this->tableName;
        }

        $modelClassName =  end(explode('\\', get_class($this)));

        return strtolower(str_replace('Model', '', $modelClassName)) . 's';
    }

    /**
     * @param string $query
     * @return array
     */
    private function executeQuery(string $query): array
    {
        $connection = DBConnection::get();
        $statement  = $connection->query($query);
        $result = $statement->fetchAll($this->mode);
        $connection = null;
        return $result;
    }

}
