<?php

namespace basteyy\XzitGiggle\Models\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use basteyy\XzitGiggle\Models\IpPool as ChildIpPool;
use basteyy\XzitGiggle\Models\IpPoolQuery as ChildIpPoolQuery;
use basteyy\XzitGiggle\Models\Map\IpPoolTableMap;

/**
 * Base class that represents a query for the `xg_ip_pool` table.
 *
 * @method     ChildIpPoolQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildIpPoolQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildIpPoolQuery orderByIpId($order = Criteria::ASC) Order by the ip_id column
 *
 * @method     ChildIpPoolQuery groupById() Group by the id column
 * @method     ChildIpPoolQuery groupByName() Group by the name column
 * @method     ChildIpPoolQuery groupByIpId() Group by the ip_id column
 *
 * @method     ChildIpPoolQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildIpPoolQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildIpPoolQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildIpPoolQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildIpPoolQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildIpPoolQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildIpPoolQuery leftJoinIpAddress($relationAlias = null) Adds a LEFT JOIN clause to the query using the IpAddress relation
 * @method     ChildIpPoolQuery rightJoinIpAddress($relationAlias = null) Adds a RIGHT JOIN clause to the query using the IpAddress relation
 * @method     ChildIpPoolQuery innerJoinIpAddress($relationAlias = null) Adds a INNER JOIN clause to the query using the IpAddress relation
 *
 * @method     ChildIpPoolQuery joinWithIpAddress($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the IpAddress relation
 *
 * @method     ChildIpPoolQuery leftJoinWithIpAddress() Adds a LEFT JOIN clause and with to the query using the IpAddress relation
 * @method     ChildIpPoolQuery rightJoinWithIpAddress() Adds a RIGHT JOIN clause and with to the query using the IpAddress relation
 * @method     ChildIpPoolQuery innerJoinWithIpAddress() Adds a INNER JOIN clause and with to the query using the IpAddress relation
 *
 * @method     ChildIpPoolQuery leftJoinIpPoolUsers($relationAlias = null) Adds a LEFT JOIN clause to the query using the IpPoolUsers relation
 * @method     ChildIpPoolQuery rightJoinIpPoolUsers($relationAlias = null) Adds a RIGHT JOIN clause to the query using the IpPoolUsers relation
 * @method     ChildIpPoolQuery innerJoinIpPoolUsers($relationAlias = null) Adds a INNER JOIN clause to the query using the IpPoolUsers relation
 *
 * @method     ChildIpPoolQuery joinWithIpPoolUsers($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the IpPoolUsers relation
 *
 * @method     ChildIpPoolQuery leftJoinWithIpPoolUsers() Adds a LEFT JOIN clause and with to the query using the IpPoolUsers relation
 * @method     ChildIpPoolQuery rightJoinWithIpPoolUsers() Adds a RIGHT JOIN clause and with to the query using the IpPoolUsers relation
 * @method     ChildIpPoolQuery innerJoinWithIpPoolUsers() Adds a INNER JOIN clause and with to the query using the IpPoolUsers relation
 *
 * @method     \basteyy\XzitGiggle\Models\IpAddressQuery|\basteyy\XzitGiggle\Models\IpPoolUsersQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildIpPool|null findOne(?ConnectionInterface $con = null) Return the first ChildIpPool matching the query
 * @method     ChildIpPool findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildIpPool matching the query, or a new ChildIpPool object populated from the query conditions when no match is found
 *
 * @method     ChildIpPool|null findOneById(int $id) Return the first ChildIpPool filtered by the id column
 * @method     ChildIpPool|null findOneByName(string $name) Return the first ChildIpPool filtered by the name column
 * @method     ChildIpPool|null findOneByIpId(int $ip_id) Return the first ChildIpPool filtered by the ip_id column
 *
 * @method     ChildIpPool requirePk($key, ?ConnectionInterface $con = null) Return the ChildIpPool by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildIpPool requireOne(?ConnectionInterface $con = null) Return the first ChildIpPool matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildIpPool requireOneById(int $id) Return the first ChildIpPool filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildIpPool requireOneByName(string $name) Return the first ChildIpPool filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildIpPool requireOneByIpId(int $ip_id) Return the first ChildIpPool filtered by the ip_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildIpPool[]|Collection find(?ConnectionInterface $con = null) Return ChildIpPool objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildIpPool> find(?ConnectionInterface $con = null) Return ChildIpPool objects based on current ModelCriteria
 *
 * @method     ChildIpPool[]|Collection findById(int|array<int> $id) Return ChildIpPool objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildIpPool> findById(int|array<int> $id) Return ChildIpPool objects filtered by the id column
 * @method     ChildIpPool[]|Collection findByName(string|array<string> $name) Return ChildIpPool objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildIpPool> findByName(string|array<string> $name) Return ChildIpPool objects filtered by the name column
 * @method     ChildIpPool[]|Collection findByIpId(int|array<int> $ip_id) Return ChildIpPool objects filtered by the ip_id column
 * @psalm-method Collection&\Traversable<ChildIpPool> findByIpId(int|array<int> $ip_id) Return ChildIpPool objects filtered by the ip_id column
 *
 * @method     ChildIpPool[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildIpPool> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class IpPoolQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \basteyy\XzitGiggle\Models\Base\IpPoolQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\basteyy\\XzitGiggle\\Models\\IpPool', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildIpPoolQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildIpPoolQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildIpPoolQuery) {
            return $criteria;
        }
        $query = new ChildIpPoolQuery();
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
     * @return ChildIpPool|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(IpPoolTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = IpPoolTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildIpPool A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id`, `name`, `ip_id` FROM `xg_ip_pool` WHERE `id` = :p0';
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
            /** @var ChildIpPool $obj */
            $obj = new ChildIpPool();
            $obj->hydrate($row);
            IpPoolTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildIpPool|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(IpPoolTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(IpPoolTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(IpPoolTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(IpPoolTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(IpPoolTableMap::COL_ID, $id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%', Criteria::LIKE); // WHERE name LIKE '%fooValue%'
     * $query->filterByName(['foo', 'bar']); // WHERE name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $name The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByName($name = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(IpPoolTableMap::COL_NAME, $name, $comparison);

        return $this;
    }

    /**
     * Filter the query on the ip_id column
     *
     * Example usage:
     * <code>
     * $query->filterByIpId(1234); // WHERE ip_id = 1234
     * $query->filterByIpId(array(12, 34)); // WHERE ip_id IN (12, 34)
     * $query->filterByIpId(array('min' => 12)); // WHERE ip_id > 12
     * </code>
     *
     * @see       filterByIpAddress()
     *
     * @param mixed $ipId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIpId($ipId = null, ?string $comparison = null)
    {
        if (is_array($ipId)) {
            $useMinMax = false;
            if (isset($ipId['min'])) {
                $this->addUsingAlias(IpPoolTableMap::COL_IP_ID, $ipId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($ipId['max'])) {
                $this->addUsingAlias(IpPoolTableMap::COL_IP_ID, $ipId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(IpPoolTableMap::COL_IP_ID, $ipId, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \basteyy\XzitGiggle\Models\IpAddress object
     *
     * @param \basteyy\XzitGiggle\Models\IpAddress|ObjectCollection $ipAddress The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIpAddress($ipAddress, ?string $comparison = null)
    {
        if ($ipAddress instanceof \basteyy\XzitGiggle\Models\IpAddress) {
            return $this
                ->addUsingAlias(IpPoolTableMap::COL_IP_ID, $ipAddress->getId(), $comparison);
        } elseif ($ipAddress instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(IpPoolTableMap::COL_IP_ID, $ipAddress->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByIpAddress() only accepts arguments of type \basteyy\XzitGiggle\Models\IpAddress or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the IpAddress relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinIpAddress(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('IpAddress');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'IpAddress');
        }

        return $this;
    }

    /**
     * Use the IpAddress relation IpAddress object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \basteyy\XzitGiggle\Models\IpAddressQuery A secondary query class using the current class as primary query
     */
    public function useIpAddressQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinIpAddress($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'IpAddress', '\basteyy\XzitGiggle\Models\IpAddressQuery');
    }

    /**
     * Use the IpAddress relation IpAddress object
     *
     * @param callable(\basteyy\XzitGiggle\Models\IpAddressQuery):\basteyy\XzitGiggle\Models\IpAddressQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withIpAddressQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useIpAddressQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to IpAddress table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \basteyy\XzitGiggle\Models\IpAddressQuery The inner query object of the EXISTS statement
     */
    public function useIpAddressExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \basteyy\XzitGiggle\Models\IpAddressQuery */
        $q = $this->useExistsQuery('IpAddress', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to IpAddress table for a NOT EXISTS query.
     *
     * @see useIpAddressExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \basteyy\XzitGiggle\Models\IpAddressQuery The inner query object of the NOT EXISTS statement
     */
    public function useIpAddressNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \basteyy\XzitGiggle\Models\IpAddressQuery */
        $q = $this->useExistsQuery('IpAddress', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to IpAddress table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \basteyy\XzitGiggle\Models\IpAddressQuery The inner query object of the IN statement
     */
    public function useInIpAddressQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \basteyy\XzitGiggle\Models\IpAddressQuery */
        $q = $this->useInQuery('IpAddress', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to IpAddress table for a NOT IN query.
     *
     * @see useIpAddressInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \basteyy\XzitGiggle\Models\IpAddressQuery The inner query object of the NOT IN statement
     */
    public function useNotInIpAddressQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \basteyy\XzitGiggle\Models\IpAddressQuery */
        $q = $this->useInQuery('IpAddress', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \basteyy\XzitGiggle\Models\IpPoolUsers object
     *
     * @param \basteyy\XzitGiggle\Models\IpPoolUsers|ObjectCollection $ipPoolUsers the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIpPoolUsers($ipPoolUsers, ?string $comparison = null)
    {
        if ($ipPoolUsers instanceof \basteyy\XzitGiggle\Models\IpPoolUsers) {
            $this
                ->addUsingAlias(IpPoolTableMap::COL_ID, $ipPoolUsers->getPoolId(), $comparison);

            return $this;
        } elseif ($ipPoolUsers instanceof ObjectCollection) {
            $this
                ->useIpPoolUsersQuery()
                ->filterByPrimaryKeys($ipPoolUsers->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByIpPoolUsers() only accepts arguments of type \basteyy\XzitGiggle\Models\IpPoolUsers or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the IpPoolUsers relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinIpPoolUsers(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('IpPoolUsers');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'IpPoolUsers');
        }

        return $this;
    }

    /**
     * Use the IpPoolUsers relation IpPoolUsers object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \basteyy\XzitGiggle\Models\IpPoolUsersQuery A secondary query class using the current class as primary query
     */
    public function useIpPoolUsersQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinIpPoolUsers($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'IpPoolUsers', '\basteyy\XzitGiggle\Models\IpPoolUsersQuery');
    }

    /**
     * Use the IpPoolUsers relation IpPoolUsers object
     *
     * @param callable(\basteyy\XzitGiggle\Models\IpPoolUsersQuery):\basteyy\XzitGiggle\Models\IpPoolUsersQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withIpPoolUsersQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useIpPoolUsersQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to IpPoolUsers table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \basteyy\XzitGiggle\Models\IpPoolUsersQuery The inner query object of the EXISTS statement
     */
    public function useIpPoolUsersExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \basteyy\XzitGiggle\Models\IpPoolUsersQuery */
        $q = $this->useExistsQuery('IpPoolUsers', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to IpPoolUsers table for a NOT EXISTS query.
     *
     * @see useIpPoolUsersExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \basteyy\XzitGiggle\Models\IpPoolUsersQuery The inner query object of the NOT EXISTS statement
     */
    public function useIpPoolUsersNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \basteyy\XzitGiggle\Models\IpPoolUsersQuery */
        $q = $this->useExistsQuery('IpPoolUsers', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to IpPoolUsers table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \basteyy\XzitGiggle\Models\IpPoolUsersQuery The inner query object of the IN statement
     */
    public function useInIpPoolUsersQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \basteyy\XzitGiggle\Models\IpPoolUsersQuery */
        $q = $this->useInQuery('IpPoolUsers', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to IpPoolUsers table for a NOT IN query.
     *
     * @see useIpPoolUsersInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \basteyy\XzitGiggle\Models\IpPoolUsersQuery The inner query object of the NOT IN statement
     */
    public function useNotInIpPoolUsersQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \basteyy\XzitGiggle\Models\IpPoolUsersQuery */
        $q = $this->useInQuery('IpPoolUsers', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildIpPool $ipPool Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($ipPool = null)
    {
        if ($ipPool) {
            $this->addUsingAlias(IpPoolTableMap::COL_ID, $ipPool->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the xg_ip_pool table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(IpPoolTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            IpPoolTableMap::clearInstancePool();
            IpPoolTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(IpPoolTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(IpPoolTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            IpPoolTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            IpPoolTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
