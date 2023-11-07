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
use basteyy\XzitGiggle\Models\Domain as ChildDomain;
use basteyy\XzitGiggle\Models\DomainQuery as ChildDomainQuery;
use basteyy\XzitGiggle\Models\Map\DomainTableMap;

/**
 * Base class that represents a query for the `xg_domains` table.
 *
 * @method     ChildDomainQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildDomainQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     ChildDomainQuery orderByTld($order = Criteria::ASC) Order by the tld column
 * @method     ChildDomainQuery orderByDomain($order = Criteria::ASC) Order by the domain column
 * @method     ChildDomainQuery orderByRegistered($order = Criteria::ASC) Order by the registered column
 * @method     ChildDomainQuery orderByWwwAlias($order = Criteria::ASC) Order by the www_alias column
 * @method     ChildDomainQuery orderByLetsEncrypt($order = Criteria::ASC) Order by the lets_encrypt column
 * @method     ChildDomainQuery orderByIpv4($order = Criteria::ASC) Order by the ipv4 column
 * @method     ChildDomainQuery orderByIpv6($order = Criteria::ASC) Order by the ipv6 column
 * @method     ChildDomainQuery orderByMountingPoint($order = Criteria::ASC) Order by the mounting_point column
 * @method     ChildDomainQuery orderByActivated($order = Criteria::ASC) Order by the activated column
 * @method     ChildDomainQuery orderByBlocked($order = Criteria::ASC) Order by the blocked column
 *
 * @method     ChildDomainQuery groupById() Group by the id column
 * @method     ChildDomainQuery groupByUserId() Group by the user_id column
 * @method     ChildDomainQuery groupByTld() Group by the tld column
 * @method     ChildDomainQuery groupByDomain() Group by the domain column
 * @method     ChildDomainQuery groupByRegistered() Group by the registered column
 * @method     ChildDomainQuery groupByWwwAlias() Group by the www_alias column
 * @method     ChildDomainQuery groupByLetsEncrypt() Group by the lets_encrypt column
 * @method     ChildDomainQuery groupByIpv4() Group by the ipv4 column
 * @method     ChildDomainQuery groupByIpv6() Group by the ipv6 column
 * @method     ChildDomainQuery groupByMountingPoint() Group by the mounting_point column
 * @method     ChildDomainQuery groupByActivated() Group by the activated column
 * @method     ChildDomainQuery groupByBlocked() Group by the blocked column
 *
 * @method     ChildDomainQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildDomainQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildDomainQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildDomainQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildDomainQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildDomainQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildDomainQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     ChildDomainQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     ChildDomainQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     ChildDomainQuery joinWithUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the User relation
 *
 * @method     ChildDomainQuery leftJoinWithUser() Adds a LEFT JOIN clause and with to the query using the User relation
 * @method     ChildDomainQuery rightJoinWithUser() Adds a RIGHT JOIN clause and with to the query using the User relation
 * @method     ChildDomainQuery innerJoinWithUser() Adds a INNER JOIN clause and with to the query using the User relation
 *
 * @method     \basteyy\XzitGiggle\Models\UserQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildDomain|null findOne(?ConnectionInterface $con = null) Return the first ChildDomain matching the query
 * @method     ChildDomain findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildDomain matching the query, or a new ChildDomain object populated from the query conditions when no match is found
 *
 * @method     ChildDomain|null findOneById(int $id) Return the first ChildDomain filtered by the id column
 * @method     ChildDomain|null findOneByUserId(int $user_id) Return the first ChildDomain filtered by the user_id column
 * @method     ChildDomain|null findOneByTld(string $tld) Return the first ChildDomain filtered by the tld column
 * @method     ChildDomain|null findOneByDomain(string $domain) Return the first ChildDomain filtered by the domain column
 * @method     ChildDomain|null findOneByRegistered(string $registered) Return the first ChildDomain filtered by the registered column
 * @method     ChildDomain|null findOneByWwwAlias(boolean $www_alias) Return the first ChildDomain filtered by the www_alias column
 * @method     ChildDomain|null findOneByLetsEncrypt(boolean $lets_encrypt) Return the first ChildDomain filtered by the lets_encrypt column
 * @method     ChildDomain|null findOneByIpv4(int $ipv4) Return the first ChildDomain filtered by the ipv4 column
 * @method     ChildDomain|null findOneByIpv6(int $ipv6) Return the first ChildDomain filtered by the ipv6 column
 * @method     ChildDomain|null findOneByMountingPoint(string $mounting_point) Return the first ChildDomain filtered by the mounting_point column
 * @method     ChildDomain|null findOneByActivated(boolean $activated) Return the first ChildDomain filtered by the activated column
 * @method     ChildDomain|null findOneByBlocked(boolean $blocked) Return the first ChildDomain filtered by the blocked column
 *
 * @method     ChildDomain requirePk($key, ?ConnectionInterface $con = null) Return the ChildDomain by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDomain requireOne(?ConnectionInterface $con = null) Return the first ChildDomain matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDomain requireOneById(int $id) Return the first ChildDomain filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDomain requireOneByUserId(int $user_id) Return the first ChildDomain filtered by the user_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDomain requireOneByTld(string $tld) Return the first ChildDomain filtered by the tld column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDomain requireOneByDomain(string $domain) Return the first ChildDomain filtered by the domain column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDomain requireOneByRegistered(string $registered) Return the first ChildDomain filtered by the registered column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDomain requireOneByWwwAlias(boolean $www_alias) Return the first ChildDomain filtered by the www_alias column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDomain requireOneByLetsEncrypt(boolean $lets_encrypt) Return the first ChildDomain filtered by the lets_encrypt column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDomain requireOneByIpv4(int $ipv4) Return the first ChildDomain filtered by the ipv4 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDomain requireOneByIpv6(int $ipv6) Return the first ChildDomain filtered by the ipv6 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDomain requireOneByMountingPoint(string $mounting_point) Return the first ChildDomain filtered by the mounting_point column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDomain requireOneByActivated(boolean $activated) Return the first ChildDomain filtered by the activated column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDomain requireOneByBlocked(boolean $blocked) Return the first ChildDomain filtered by the blocked column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDomain[]|Collection find(?ConnectionInterface $con = null) Return ChildDomain objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildDomain> find(?ConnectionInterface $con = null) Return ChildDomain objects based on current ModelCriteria
 *
 * @method     ChildDomain[]|Collection findById(int|array<int> $id) Return ChildDomain objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildDomain> findById(int|array<int> $id) Return ChildDomain objects filtered by the id column
 * @method     ChildDomain[]|Collection findByUserId(int|array<int> $user_id) Return ChildDomain objects filtered by the user_id column
 * @psalm-method Collection&\Traversable<ChildDomain> findByUserId(int|array<int> $user_id) Return ChildDomain objects filtered by the user_id column
 * @method     ChildDomain[]|Collection findByTld(string|array<string> $tld) Return ChildDomain objects filtered by the tld column
 * @psalm-method Collection&\Traversable<ChildDomain> findByTld(string|array<string> $tld) Return ChildDomain objects filtered by the tld column
 * @method     ChildDomain[]|Collection findByDomain(string|array<string> $domain) Return ChildDomain objects filtered by the domain column
 * @psalm-method Collection&\Traversable<ChildDomain> findByDomain(string|array<string> $domain) Return ChildDomain objects filtered by the domain column
 * @method     ChildDomain[]|Collection findByRegistered(string|array<string> $registered) Return ChildDomain objects filtered by the registered column
 * @psalm-method Collection&\Traversable<ChildDomain> findByRegistered(string|array<string> $registered) Return ChildDomain objects filtered by the registered column
 * @method     ChildDomain[]|Collection findByWwwAlias(boolean|array<boolean> $www_alias) Return ChildDomain objects filtered by the www_alias column
 * @psalm-method Collection&\Traversable<ChildDomain> findByWwwAlias(boolean|array<boolean> $www_alias) Return ChildDomain objects filtered by the www_alias column
 * @method     ChildDomain[]|Collection findByLetsEncrypt(boolean|array<boolean> $lets_encrypt) Return ChildDomain objects filtered by the lets_encrypt column
 * @psalm-method Collection&\Traversable<ChildDomain> findByLetsEncrypt(boolean|array<boolean> $lets_encrypt) Return ChildDomain objects filtered by the lets_encrypt column
 * @method     ChildDomain[]|Collection findByIpv4(int|array<int> $ipv4) Return ChildDomain objects filtered by the ipv4 column
 * @psalm-method Collection&\Traversable<ChildDomain> findByIpv4(int|array<int> $ipv4) Return ChildDomain objects filtered by the ipv4 column
 * @method     ChildDomain[]|Collection findByIpv6(int|array<int> $ipv6) Return ChildDomain objects filtered by the ipv6 column
 * @psalm-method Collection&\Traversable<ChildDomain> findByIpv6(int|array<int> $ipv6) Return ChildDomain objects filtered by the ipv6 column
 * @method     ChildDomain[]|Collection findByMountingPoint(string|array<string> $mounting_point) Return ChildDomain objects filtered by the mounting_point column
 * @psalm-method Collection&\Traversable<ChildDomain> findByMountingPoint(string|array<string> $mounting_point) Return ChildDomain objects filtered by the mounting_point column
 * @method     ChildDomain[]|Collection findByActivated(boolean|array<boolean> $activated) Return ChildDomain objects filtered by the activated column
 * @psalm-method Collection&\Traversable<ChildDomain> findByActivated(boolean|array<boolean> $activated) Return ChildDomain objects filtered by the activated column
 * @method     ChildDomain[]|Collection findByBlocked(boolean|array<boolean> $blocked) Return ChildDomain objects filtered by the blocked column
 * @psalm-method Collection&\Traversable<ChildDomain> findByBlocked(boolean|array<boolean> $blocked) Return ChildDomain objects filtered by the blocked column
 *
 * @method     ChildDomain[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildDomain> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class DomainQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \basteyy\XzitGiggle\Models\Base\DomainQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\basteyy\\XzitGiggle\\Models\\Domain', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildDomainQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildDomainQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildDomainQuery) {
            return $criteria;
        }
        $query = new ChildDomainQuery();
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
     * @return ChildDomain|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(DomainTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = DomainTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildDomain A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id`, `user_id`, `tld`, `domain`, `registered`, `www_alias`, `lets_encrypt`, `ipv4`, `ipv6`, `mounting_point`, `activated`, `blocked` FROM `xg_domains` WHERE `id` = :p0';
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
            /** @var ChildDomain $obj */
            $obj = new ChildDomain();
            $obj->hydrate($row);
            DomainTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildDomain|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(DomainTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(DomainTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(DomainTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(DomainTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DomainTableMap::COL_ID, $id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the user_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUserId(1234); // WHERE user_id = 1234
     * $query->filterByUserId(array(12, 34)); // WHERE user_id IN (12, 34)
     * $query->filterByUserId(array('min' => 12)); // WHERE user_id > 12
     * </code>
     *
     * @see       filterByUser()
     *
     * @param mixed $userId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUserId($userId = null, ?string $comparison = null)
    {
        if (is_array($userId)) {
            $useMinMax = false;
            if (isset($userId['min'])) {
                $this->addUsingAlias(DomainTableMap::COL_USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(DomainTableMap::COL_USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DomainTableMap::COL_USER_ID, $userId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the tld column
     *
     * Example usage:
     * <code>
     * $query->filterByTld('fooValue');   // WHERE tld = 'fooValue'
     * $query->filterByTld('%fooValue%', Criteria::LIKE); // WHERE tld LIKE '%fooValue%'
     * $query->filterByTld(['foo', 'bar']); // WHERE tld IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $tld The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTld($tld = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tld)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DomainTableMap::COL_TLD, $tld, $comparison);

        return $this;
    }

    /**
     * Filter the query on the domain column
     *
     * Example usage:
     * <code>
     * $query->filterByDomain('fooValue');   // WHERE domain = 'fooValue'
     * $query->filterByDomain('%fooValue%', Criteria::LIKE); // WHERE domain LIKE '%fooValue%'
     * $query->filterByDomain(['foo', 'bar']); // WHERE domain IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $domain The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDomain($domain = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($domain)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DomainTableMap::COL_DOMAIN, $domain, $comparison);

        return $this;
    }

    /**
     * Filter the query on the registered column
     *
     * Example usage:
     * <code>
     * $query->filterByRegistered('2011-03-14'); // WHERE registered = '2011-03-14'
     * $query->filterByRegistered('now'); // WHERE registered = '2011-03-14'
     * $query->filterByRegistered(array('max' => 'yesterday')); // WHERE registered > '2011-03-13'
     * </code>
     *
     * @param mixed $registered The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRegistered($registered = null, ?string $comparison = null)
    {
        if (is_array($registered)) {
            $useMinMax = false;
            if (isset($registered['min'])) {
                $this->addUsingAlias(DomainTableMap::COL_REGISTERED, $registered['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($registered['max'])) {
                $this->addUsingAlias(DomainTableMap::COL_REGISTERED, $registered['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DomainTableMap::COL_REGISTERED, $registered, $comparison);

        return $this;
    }

    /**
     * Filter the query on the www_alias column
     *
     * Example usage:
     * <code>
     * $query->filterByWwwAlias(true); // WHERE www_alias = true
     * $query->filterByWwwAlias('yes'); // WHERE www_alias = true
     * </code>
     *
     * @param bool|string $wwwAlias The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWwwAlias($wwwAlias = null, ?string $comparison = null)
    {
        if (is_string($wwwAlias)) {
            $wwwAlias = in_array(strtolower($wwwAlias), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(DomainTableMap::COL_WWW_ALIAS, $wwwAlias, $comparison);

        return $this;
    }

    /**
     * Filter the query on the lets_encrypt column
     *
     * Example usage:
     * <code>
     * $query->filterByLetsEncrypt(true); // WHERE lets_encrypt = true
     * $query->filterByLetsEncrypt('yes'); // WHERE lets_encrypt = true
     * </code>
     *
     * @param bool|string $letsEncrypt The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLetsEncrypt($letsEncrypt = null, ?string $comparison = null)
    {
        if (is_string($letsEncrypt)) {
            $letsEncrypt = in_array(strtolower($letsEncrypt), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(DomainTableMap::COL_LETS_ENCRYPT, $letsEncrypt, $comparison);

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
                $this->addUsingAlias(DomainTableMap::COL_IPV4, $ipv4['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($ipv4['max'])) {
                $this->addUsingAlias(DomainTableMap::COL_IPV4, $ipv4['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DomainTableMap::COL_IPV4, $ipv4, $comparison);

        return $this;
    }

    /**
     * Filter the query on the ipv6 column
     *
     * Example usage:
     * <code>
     * $query->filterByIpv6(1234); // WHERE ipv6 = 1234
     * $query->filterByIpv6(array(12, 34)); // WHERE ipv6 IN (12, 34)
     * $query->filterByIpv6(array('min' => 12)); // WHERE ipv6 > 12
     * </code>
     *
     * @param mixed $ipv6 The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIpv6($ipv6 = null, ?string $comparison = null)
    {
        if (is_array($ipv6)) {
            $useMinMax = false;
            if (isset($ipv6['min'])) {
                $this->addUsingAlias(DomainTableMap::COL_IPV6, $ipv6['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($ipv6['max'])) {
                $this->addUsingAlias(DomainTableMap::COL_IPV6, $ipv6['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DomainTableMap::COL_IPV6, $ipv6, $comparison);

        return $this;
    }

    /**
     * Filter the query on the mounting_point column
     *
     * Example usage:
     * <code>
     * $query->filterByMountingPoint('fooValue');   // WHERE mounting_point = 'fooValue'
     * $query->filterByMountingPoint('%fooValue%', Criteria::LIKE); // WHERE mounting_point LIKE '%fooValue%'
     * $query->filterByMountingPoint(['foo', 'bar']); // WHERE mounting_point IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $mountingPoint The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMountingPoint($mountingPoint = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($mountingPoint)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DomainTableMap::COL_MOUNTING_POINT, $mountingPoint, $comparison);

        return $this;
    }

    /**
     * Filter the query on the activated column
     *
     * Example usage:
     * <code>
     * $query->filterByActivated(true); // WHERE activated = true
     * $query->filterByActivated('yes'); // WHERE activated = true
     * </code>
     *
     * @param bool|string $activated The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByActivated($activated = null, ?string $comparison = null)
    {
        if (is_string($activated)) {
            $activated = in_array(strtolower($activated), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(DomainTableMap::COL_ACTIVATED, $activated, $comparison);

        return $this;
    }

    /**
     * Filter the query on the blocked column
     *
     * Example usage:
     * <code>
     * $query->filterByBlocked(true); // WHERE blocked = true
     * $query->filterByBlocked('yes'); // WHERE blocked = true
     * </code>
     *
     * @param bool|string $blocked The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBlocked($blocked = null, ?string $comparison = null)
    {
        if (is_string($blocked)) {
            $blocked = in_array(strtolower($blocked), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(DomainTableMap::COL_BLOCKED, $blocked, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \basteyy\XzitGiggle\Models\User object
     *
     * @param \basteyy\XzitGiggle\Models\User|ObjectCollection $user The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUser($user, ?string $comparison = null)
    {
        if ($user instanceof \basteyy\XzitGiggle\Models\User) {
            return $this
                ->addUsingAlias(DomainTableMap::COL_USER_ID, $user->getId(), $comparison);
        } elseif ($user instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(DomainTableMap::COL_USER_ID, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByUser() only accepts arguments of type \basteyy\XzitGiggle\Models\User or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the User relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinUser(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('User');

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
            $this->addJoinObject($join, 'User');
        }

        return $this;
    }

    /**
     * Use the User relation User object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \basteyy\XzitGiggle\Models\UserQuery A secondary query class using the current class as primary query
     */
    public function useUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'User', '\basteyy\XzitGiggle\Models\UserQuery');
    }

    /**
     * Use the User relation User object
     *
     * @param callable(\basteyy\XzitGiggle\Models\UserQuery):\basteyy\XzitGiggle\Models\UserQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withUserQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useUserQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to User table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \basteyy\XzitGiggle\Models\UserQuery The inner query object of the EXISTS statement
     */
    public function useUserExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \basteyy\XzitGiggle\Models\UserQuery */
        $q = $this->useExistsQuery('User', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to User table for a NOT EXISTS query.
     *
     * @see useUserExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \basteyy\XzitGiggle\Models\UserQuery The inner query object of the NOT EXISTS statement
     */
    public function useUserNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \basteyy\XzitGiggle\Models\UserQuery */
        $q = $this->useExistsQuery('User', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to User table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \basteyy\XzitGiggle\Models\UserQuery The inner query object of the IN statement
     */
    public function useInUserQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \basteyy\XzitGiggle\Models\UserQuery */
        $q = $this->useInQuery('User', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to User table for a NOT IN query.
     *
     * @see useUserInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \basteyy\XzitGiggle\Models\UserQuery The inner query object of the NOT IN statement
     */
    public function useNotInUserQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \basteyy\XzitGiggle\Models\UserQuery */
        $q = $this->useInQuery('User', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildDomain $domain Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($domain = null)
    {
        if ($domain) {
            $this->addUsingAlias(DomainTableMap::COL_ID, $domain->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the xg_domains table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DomainTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            DomainTableMap::clearInstancePool();
            DomainTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(DomainTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(DomainTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            DomainTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            DomainTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
