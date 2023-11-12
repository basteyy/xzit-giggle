<?php

namespace basteyy\XzitGiggle\Models\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use basteyy\XzitGiggle\Models\Config as ChildConfig;
use basteyy\XzitGiggle\Models\ConfigQuery as ChildConfigQuery;
use basteyy\XzitGiggle\Models\Map\ConfigTableMap;

/**
 * Base class that represents a query for the `xg_config` table.
 *
 * @method     ChildConfigQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildConfigQuery orderByKey($order = Criteria::ASC) Order by the key column
 * @method     ChildConfigQuery orderByDefault($order = Criteria::ASC) Order by the default column
 * @method     ChildConfigQuery orderByValue($order = Criteria::ASC) Order by the value column
 * @method     ChildConfigQuery orderByVarType($order = Criteria::ASC) Order by the var_type column
 *
 * @method     ChildConfigQuery groupById() Group by the id column
 * @method     ChildConfigQuery groupByKey() Group by the key column
 * @method     ChildConfigQuery groupByDefault() Group by the default column
 * @method     ChildConfigQuery groupByValue() Group by the value column
 * @method     ChildConfigQuery groupByVarType() Group by the var_type column
 *
 * @method     ChildConfigQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildConfigQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildConfigQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildConfigQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildConfigQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildConfigQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildConfig|null findOne(?ConnectionInterface $con = null) Return the first ChildConfig matching the query
 * @method     ChildConfig findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildConfig matching the query, or a new ChildConfig object populated from the query conditions when no match is found
 *
 * @method     ChildConfig|null findOneById(int $id) Return the first ChildConfig filtered by the id column
 * @method     ChildConfig|null findOneByKey(string $key) Return the first ChildConfig filtered by the key column
 * @method     ChildConfig|null findOneByDefault(string $default) Return the first ChildConfig filtered by the default column
 * @method     ChildConfig|null findOneByValue(string $value) Return the first ChildConfig filtered by the value column
 * @method     ChildConfig|null findOneByVarType(string $var_type) Return the first ChildConfig filtered by the var_type column
 *
 * @method     ChildConfig requirePk($key, ?ConnectionInterface $con = null) Return the ChildConfig by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildConfig requireOne(?ConnectionInterface $con = null) Return the first ChildConfig matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildConfig requireOneById(int $id) Return the first ChildConfig filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildConfig requireOneByKey(string $key) Return the first ChildConfig filtered by the key column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildConfig requireOneByDefault(string $default) Return the first ChildConfig filtered by the default column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildConfig requireOneByValue(string $value) Return the first ChildConfig filtered by the value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildConfig requireOneByVarType(string $var_type) Return the first ChildConfig filtered by the var_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildConfig[]|Collection find(?ConnectionInterface $con = null) Return ChildConfig objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildConfig> find(?ConnectionInterface $con = null) Return ChildConfig objects based on current ModelCriteria
 *
 * @method     ChildConfig[]|Collection findById(int|array<int> $id) Return ChildConfig objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildConfig> findById(int|array<int> $id) Return ChildConfig objects filtered by the id column
 * @method     ChildConfig[]|Collection findByKey(string|array<string> $key) Return ChildConfig objects filtered by the key column
 * @psalm-method Collection&\Traversable<ChildConfig> findByKey(string|array<string> $key) Return ChildConfig objects filtered by the key column
 * @method     ChildConfig[]|Collection findByDefault(string|array<string> $default) Return ChildConfig objects filtered by the default column
 * @psalm-method Collection&\Traversable<ChildConfig> findByDefault(string|array<string> $default) Return ChildConfig objects filtered by the default column
 * @method     ChildConfig[]|Collection findByValue(string|array<string> $value) Return ChildConfig objects filtered by the value column
 * @psalm-method Collection&\Traversable<ChildConfig> findByValue(string|array<string> $value) Return ChildConfig objects filtered by the value column
 * @method     ChildConfig[]|Collection findByVarType(string|array<string> $var_type) Return ChildConfig objects filtered by the var_type column
 * @psalm-method Collection&\Traversable<ChildConfig> findByVarType(string|array<string> $var_type) Return ChildConfig objects filtered by the var_type column
 *
 * @method     ChildConfig[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildConfig> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class ConfigQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \basteyy\XzitGiggle\Models\Base\ConfigQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\basteyy\\XzitGiggle\\Models\\Config', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildConfigQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildConfigQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildConfigQuery) {
            return $criteria;
        }
        $query = new ChildConfigQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildConfig|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ConfigTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ConfigTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildConfig A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id`, `key`, `default`, `value`, `var_type` FROM `xg_config` WHERE `id` = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildConfig $obj */
            $obj = new ChildConfig();
            $obj->hydrate($row);
            ConfigTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con A connection object
     *
     * @return ChildConfig|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param array $keys Primary keys to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return Collection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param mixed $key Primary key to use for the query
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        $this->addUsingAlias(ConfigTableMap::COL_ID, $key, Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param array|int $keys The list of primary key to use for the query
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        $this->addUsingAlias(ConfigTableMap::COL_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterById($id = null, ?string $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ConfigTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ConfigTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ConfigTableMap::COL_ID, $id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the key column
     *
     * Example usage:
     * <code>
     * $query->filterByKey('fooValue');   // WHERE key = 'fooValue'
     * $query->filterByKey('%fooValue%', Criteria::LIKE); // WHERE key LIKE '%fooValue%'
     * $query->filterByKey(['foo', 'bar']); // WHERE key IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $key The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByKey($key = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($key)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ConfigTableMap::COL_KEY, $key, $comparison);

        return $this;
    }

    /**
     * Filter the query on the default column
     *
     * Example usage:
     * <code>
     * $query->filterByDefault('fooValue');   // WHERE default = 'fooValue'
     * $query->filterByDefault('%fooValue%', Criteria::LIKE); // WHERE default LIKE '%fooValue%'
     * $query->filterByDefault(['foo', 'bar']); // WHERE default IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $default The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDefault($default = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($default)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ConfigTableMap::COL_DEFAULT, $default, $comparison);

        return $this;
    }

    /**
     * Filter the query on the value column
     *
     * Example usage:
     * <code>
     * $query->filterByValue('fooValue');   // WHERE value = 'fooValue'
     * $query->filterByValue('%fooValue%', Criteria::LIKE); // WHERE value LIKE '%fooValue%'
     * $query->filterByValue(['foo', 'bar']); // WHERE value IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $value The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByValue($value = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($value)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ConfigTableMap::COL_VALUE, $value, $comparison);

        return $this;
    }

    /**
     * Filter the query on the var_type column
     *
     * Example usage:
     * <code>
     * $query->filterByVarType('fooValue');   // WHERE var_type = 'fooValue'
     * $query->filterByVarType('%fooValue%', Criteria::LIKE); // WHERE var_type LIKE '%fooValue%'
     * $query->filterByVarType(['foo', 'bar']); // WHERE var_type IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $varType The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVarType($varType = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($varType)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ConfigTableMap::COL_VAR_TYPE, $varType, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildConfig $config Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($config = null)
    {
        if ($config) {
            $this->addUsingAlias(ConfigTableMap::COL_ID, $config->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the xg_config table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ConfigTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ConfigTableMap::clearInstancePool();
            ConfigTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ConfigTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ConfigTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ConfigTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ConfigTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
