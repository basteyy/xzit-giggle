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
use basteyy\XzitGiggle\Models\IpAddress as ChildIpAddress;
use basteyy\XzitGiggle\Models\IpAddressQuery as ChildIpAddressQuery;
use basteyy\XzitGiggle\Models\Map\IpAddressTableMap;

/**
 * Base class that represents a query for the `xg_ip` table.
 *
 * @method     ChildIpAddressQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildIpAddressQuery orderByAddress($order = Criteria::ASC) Order by the address column
 * @method     ChildIpAddressQuery orderByIpv4($order = Criteria::ASC) Order by the ipv4 column
 * @method     ChildIpAddressQuery orderByIpv6($order = Criteria::ASC) Order by the ipv6 column
 * @method     ChildIpAddressQuery orderByCanAssign($order = Criteria::ASC) Order by the can_assign column
 * @method     ChildIpAddressQuery orderByExclusive($order = Criteria::ASC) Order by the exclusive column
 *
 * @method     ChildIpAddressQuery groupById() Group by the id column
 * @method     ChildIpAddressQuery groupByAddress() Group by the address column
 * @method     ChildIpAddressQuery groupByIpv4() Group by the ipv4 column
 * @method     ChildIpAddressQuery groupByIpv6() Group by the ipv6 column
 * @method     ChildIpAddressQuery groupByCanAssign() Group by the can_assign column
 * @method     ChildIpAddressQuery groupByExclusive() Group by the exclusive column
 *
 * @method     ChildIpAddressQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildIpAddressQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildIpAddressQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildIpAddressQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildIpAddressQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildIpAddressQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildIpAddressQuery leftJoinipPool($relationAlias = null) Adds a LEFT JOIN clause to the query using the ipPool relation
 * @method     ChildIpAddressQuery rightJoinipPool($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ipPool relation
 * @method     ChildIpAddressQuery innerJoinipPool($relationAlias = null) Adds a INNER JOIN clause to the query using the ipPool relation
 *
 * @method     ChildIpAddressQuery joinWithipPool($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ipPool relation
 *
 * @method     ChildIpAddressQuery leftJoinWithipPool() Adds a LEFT JOIN clause and with to the query using the ipPool relation
 * @method     ChildIpAddressQuery rightJoinWithipPool() Adds a RIGHT JOIN clause and with to the query using the ipPool relation
 * @method     ChildIpAddressQuery innerJoinWithipPool() Adds a INNER JOIN clause and with to the query using the ipPool relation
 *
 * @method     \basteyy\XzitGiggle\Models\IpPoolQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildIpAddress|null findOne(?ConnectionInterface $con = null) Return the first ChildIpAddress matching the query
 * @method     ChildIpAddress findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildIpAddress matching the query, or a new ChildIpAddress object populated from the query conditions when no match is found
 *
 * @method     ChildIpAddress|null findOneById(int $id) Return the first ChildIpAddress filtered by the id column
 * @method     ChildIpAddress|null findOneByAddress(string $address) Return the first ChildIpAddress filtered by the address column
 * @method     ChildIpAddress|null findOneByIpv4(int $ipv4) Return the first ChildIpAddress filtered by the ipv4 column
 * @method     ChildIpAddress|null findOneByIpv6(string $ipv6) Return the first ChildIpAddress filtered by the ipv6 column
 * @method     ChildIpAddress|null findOneByCanAssign(boolean $can_assign) Return the first ChildIpAddress filtered by the can_assign column
 * @method     ChildIpAddress|null findOneByExclusive(boolean $exclusive) Return the first ChildIpAddress filtered by the exclusive column
 *
 * @method     ChildIpAddress requirePk($key, ?ConnectionInterface $con = null) Return the ChildIpAddress by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildIpAddress requireOne(?ConnectionInterface $con = null) Return the first ChildIpAddress matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildIpAddress requireOneById(int $id) Return the first ChildIpAddress filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildIpAddress requireOneByAddress(string $address) Return the first ChildIpAddress filtered by the address column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildIpAddress requireOneByIpv4(int $ipv4) Return the first ChildIpAddress filtered by the ipv4 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildIpAddress requireOneByIpv6(string $ipv6) Return the first ChildIpAddress filtered by the ipv6 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildIpAddress requireOneByCanAssign(boolean $can_assign) Return the first ChildIpAddress filtered by the can_assign column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildIpAddress requireOneByExclusive(boolean $exclusive) Return the first ChildIpAddress filtered by the exclusive column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildIpAddress[]|Collection find(?ConnectionInterface $con = null) Return ChildIpAddress objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildIpAddress> find(?ConnectionInterface $con = null) Return ChildIpAddress objects based on current ModelCriteria
 *
 * @method     ChildIpAddress[]|Collection findById(int|array<int> $id) Return ChildIpAddress objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildIpAddress> findById(int|array<int> $id) Return ChildIpAddress objects filtered by the id column
 * @method     ChildIpAddress[]|Collection findByAddress(string|array<string> $address) Return ChildIpAddress objects filtered by the address column
 * @psalm-method Collection&\Traversable<ChildIpAddress> findByAddress(string|array<string> $address) Return ChildIpAddress objects filtered by the address column
 * @method     ChildIpAddress[]|Collection findByIpv4(int|array<int> $ipv4) Return ChildIpAddress objects filtered by the ipv4 column
 * @psalm-method Collection&\Traversable<ChildIpAddress> findByIpv4(int|array<int> $ipv4) Return ChildIpAddress objects filtered by the ipv4 column
 * @method     ChildIpAddress[]|Collection findByIpv6(string|array<string> $ipv6) Return ChildIpAddress objects filtered by the ipv6 column
 * @psalm-method Collection&\Traversable<ChildIpAddress> findByIpv6(string|array<string> $ipv6) Return ChildIpAddress objects filtered by the ipv6 column
 * @method     ChildIpAddress[]|Collection findByCanAssign(boolean|array<boolean> $can_assign) Return ChildIpAddress objects filtered by the can_assign column
 * @psalm-method Collection&\Traversable<ChildIpAddress> findByCanAssign(boolean|array<boolean> $can_assign) Return ChildIpAddress objects filtered by the can_assign column
 * @method     ChildIpAddress[]|Collection findByExclusive(boolean|array<boolean> $exclusive) Return ChildIpAddress objects filtered by the exclusive column
 * @psalm-method Collection&\Traversable<ChildIpAddress> findByExclusive(boolean|array<boolean> $exclusive) Return ChildIpAddress objects filtered by the exclusive column
 *
 * @method     ChildIpAddress[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildIpAddress> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class IpAddressQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \basteyy\XzitGiggle\Models\Base\IpAddressQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\basteyy\\XzitGiggle\\Models\\IpAddress', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildIpAddressQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildIpAddressQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildIpAddressQuery) {
            return $criteria;
        }
        $query = new ChildIpAddressQuery();
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
     * @return ChildIpAddress|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(IpAddressTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = IpAddressTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildIpAddress A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id`, `address`, `ipv4`, `ipv6`, `can_assign`, `exclusive` FROM `xg_ip` WHERE `id` = :p0';
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
            /** @var ChildIpAddress $obj */
            $obj = new ChildIpAddress();
            $obj->hydrate($row);
            IpAddressTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildIpAddress|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(IpAddressTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(IpAddressTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(IpAddressTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(IpAddressTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(IpAddressTableMap::COL_ID, $id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the address column
     *
     * Example usage:
     * <code>
     * $query->filterByAddress('fooValue');   // WHERE address = 'fooValue'
     * $query->filterByAddress('%fooValue%', Criteria::LIKE); // WHERE address LIKE '%fooValue%'
     * $query->filterByAddress(['foo', 'bar']); // WHERE address IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $address The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAddress($address = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($address)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(IpAddressTableMap::COL_ADDRESS, $address, $comparison);

        return $this;
    }

    /**
     * Filter the query on the ipv4 column
     *
     * Example usage:
     * <code>
     * $query->filterByIpv4(1234); // WHERE ipv4 = 1234
     * $query->filterByIpv4(array(12, 34)); // WHERE ipv4 IN (12, 34)
     * $query->filterByIpv4(array('min' => 12)); // WHERE ipv4 > 12
     * </code>
     *
     * @param mixed $ipv4 The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIpv4($ipv4 = null, ?string $comparison = null)
    {
        if (is_array($ipv4)) {
            $useMinMax = false;
            if (isset($ipv4['min'])) {
                $this->addUsingAlias(IpAddressTableMap::COL_IPV4, $ipv4['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($ipv4['max'])) {
                $this->addUsingAlias(IpAddressTableMap::COL_IPV4, $ipv4['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(IpAddressTableMap::COL_IPV4, $ipv4, $comparison);

        return $this;
    }

    /**
     * Filter the query on the ipv6 column
     *
     * Example usage:
     * <code>
     * $query->filterByIpv6('fooValue');   // WHERE ipv6 = 'fooValue'
     * $query->filterByIpv6('%fooValue%', Criteria::LIKE); // WHERE ipv6 LIKE '%fooValue%'
     * $query->filterByIpv6(['foo', 'bar']); // WHERE ipv6 IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $ipv6 The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIpv6($ipv6 = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ipv6)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(IpAddressTableMap::COL_IPV6, $ipv6, $comparison);

        return $this;
    }

    /**
     * Filter the query on the can_assign column
     *
     * Example usage:
     * <code>
     * $query->filterByCanAssign(true); // WHERE can_assign = true
     * $query->filterByCanAssign('yes'); // WHERE can_assign = true
     * </code>
     *
     * @param bool|string $canAssign The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCanAssign($canAssign = null, ?string $comparison = null)
    {
        if (is_string($canAssign)) {
            $canAssign = in_array(strtolower($canAssign), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(IpAddressTableMap::COL_CAN_ASSIGN, $canAssign, $comparison);

        return $this;
    }

    /**
     * Filter the query on the exclusive column
     *
     * Example usage:
     * <code>
     * $query->filterByExclusive(true); // WHERE exclusive = true
     * $query->filterByExclusive('yes'); // WHERE exclusive = true
     * </code>
     *
     * @param bool|string $exclusive The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExclusive($exclusive = null, ?string $comparison = null)
    {
        if (is_string($exclusive)) {
            $exclusive = in_array(strtolower($exclusive), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(IpAddressTableMap::COL_EXCLUSIVE, $exclusive, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \basteyy\XzitGiggle\Models\IpPool object
     *
     * @param \basteyy\XzitGiggle\Models\IpPool|ObjectCollection $ipPool the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByipPool($ipPool, ?string $comparison = null)
    {
        if ($ipPool instanceof \basteyy\XzitGiggle\Models\IpPool) {
            $this
                ->addUsingAlias(IpAddressTableMap::COL_ID, $ipPool->getIpId(), $comparison);

            return $this;
        } elseif ($ipPool instanceof ObjectCollection) {
            $this
                ->useipPoolQuery()
                ->filterByPrimaryKeys($ipPool->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByipPool() only accepts arguments of type \basteyy\XzitGiggle\Models\IpPool or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ipPool relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinipPool(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ipPool');

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
            $this->addJoinObject($join, 'ipPool');
        }

        return $this;
    }

    /**
     * Use the ipPool relation IpPool object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \basteyy\XzitGiggle\Models\IpPoolQuery A secondary query class using the current class as primary query
     */
    public function useipPoolQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinipPool($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ipPool', '\basteyy\XzitGiggle\Models\IpPoolQuery');
    }

    /**
     * Use the ipPool relation IpPool object
     *
     * @param callable(\basteyy\XzitGiggle\Models\IpPoolQuery):\basteyy\XzitGiggle\Models\IpPoolQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withipPoolQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useipPoolQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the ipPool relation to the IpPool table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \basteyy\XzitGiggle\Models\IpPoolQuery The inner query object of the EXISTS statement
     */
    public function useipPoolExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \basteyy\XzitGiggle\Models\IpPoolQuery */
        $q = $this->useExistsQuery('ipPool', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the ipPool relation to the IpPool table for a NOT EXISTS query.
     *
     * @see useipPoolExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \basteyy\XzitGiggle\Models\IpPoolQuery The inner query object of the NOT EXISTS statement
     */
    public function useipPoolNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \basteyy\XzitGiggle\Models\IpPoolQuery */
        $q = $this->useExistsQuery('ipPool', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the ipPool relation to the IpPool table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \basteyy\XzitGiggle\Models\IpPoolQuery The inner query object of the IN statement
     */
    public function useInipPoolQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \basteyy\XzitGiggle\Models\IpPoolQuery */
        $q = $this->useInQuery('ipPool', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the ipPool relation to the IpPool table for a NOT IN query.
     *
     * @see useipPoolInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \basteyy\XzitGiggle\Models\IpPoolQuery The inner query object of the NOT IN statement
     */
    public function useNotInipPoolQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \basteyy\XzitGiggle\Models\IpPoolQuery */
        $q = $this->useInQuery('ipPool', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildIpAddress $ipAddress Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($ipAddress = null)
    {
        if ($ipAddress) {
            $this->addUsingAlias(IpAddressTableMap::COL_ID, $ipAddress->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the xg_ip table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(IpAddressTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            IpAddressTableMap::clearInstancePool();
            IpAddressTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(IpAddressTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(IpAddressTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            IpAddressTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            IpAddressTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
