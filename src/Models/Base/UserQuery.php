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
use basteyy\XzitGiggle\Models\User as ChildUser;
use basteyy\XzitGiggle\Models\UserQuery as ChildUserQuery;
use basteyy\XzitGiggle\Models\Map\UserTableMap;

/**
 * Base class that represents a query for the `xg_users` table.
 *
 * @method     ChildUserQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildUserQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildUserQuery orderByUsername($order = Criteria::ASC) Order by the username column
 * @method     ChildUserQuery orderByUserRoleId($order = Criteria::ASC) Order by the user_role_id column
 * @method     ChildUserQuery orderBySecretKey($order = Criteria::ASC) Order by the secret_key column
 * @method     ChildUserQuery orderByPasswordHash($order = Criteria::ASC) Order by the password_hash column
 * @method     ChildUserQuery orderByActivated($order = Criteria::ASC) Order by the activated column
 * @method     ChildUserQuery orderByBlocked($order = Criteria::ASC) Order by the blocked column
 *
 * @method     ChildUserQuery groupById() Group by the id column
 * @method     ChildUserQuery groupByEmail() Group by the email column
 * @method     ChildUserQuery groupByUsername() Group by the username column
 * @method     ChildUserQuery groupByUserRoleId() Group by the user_role_id column
 * @method     ChildUserQuery groupBySecretKey() Group by the secret_key column
 * @method     ChildUserQuery groupByPasswordHash() Group by the password_hash column
 * @method     ChildUserQuery groupByActivated() Group by the activated column
 * @method     ChildUserQuery groupByBlocked() Group by the blocked column
 *
 * @method     ChildUserQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUserQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUserQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUserQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildUserQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildUserQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildUserQuery leftJoinUserRole($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserRole relation
 * @method     ChildUserQuery rightJoinUserRole($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserRole relation
 * @method     ChildUserQuery innerJoinUserRole($relationAlias = null) Adds a INNER JOIN clause to the query using the UserRole relation
 *
 * @method     ChildUserQuery joinWithUserRole($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the UserRole relation
 *
 * @method     ChildUserQuery leftJoinWithUserRole() Adds a LEFT JOIN clause and with to the query using the UserRole relation
 * @method     ChildUserQuery rightJoinWithUserRole() Adds a RIGHT JOIN clause and with to the query using the UserRole relation
 * @method     ChildUserQuery innerJoinWithUserRole() Adds a INNER JOIN clause and with to the query using the UserRole relation
 *
 * @method     ChildUserQuery leftJoinIpPoolUsers($relationAlias = null) Adds a LEFT JOIN clause to the query using the IpPoolUsers relation
 * @method     ChildUserQuery rightJoinIpPoolUsers($relationAlias = null) Adds a RIGHT JOIN clause to the query using the IpPoolUsers relation
 * @method     ChildUserQuery innerJoinIpPoolUsers($relationAlias = null) Adds a INNER JOIN clause to the query using the IpPoolUsers relation
 *
 * @method     ChildUserQuery joinWithIpPoolUsers($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the IpPoolUsers relation
 *
 * @method     ChildUserQuery leftJoinWithIpPoolUsers() Adds a LEFT JOIN clause and with to the query using the IpPoolUsers relation
 * @method     ChildUserQuery rightJoinWithIpPoolUsers() Adds a RIGHT JOIN clause and with to the query using the IpPoolUsers relation
 * @method     ChildUserQuery innerJoinWithIpPoolUsers() Adds a INNER JOIN clause and with to the query using the IpPoolUsers relation
 *
 * @method     ChildUserQuery leftJoinDomains($relationAlias = null) Adds a LEFT JOIN clause to the query using the Domains relation
 * @method     ChildUserQuery rightJoinDomains($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Domains relation
 * @method     ChildUserQuery innerJoinDomains($relationAlias = null) Adds a INNER JOIN clause to the query using the Domains relation
 *
 * @method     ChildUserQuery joinWithDomains($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Domains relation
 *
 * @method     ChildUserQuery leftJoinWithDomains() Adds a LEFT JOIN clause and with to the query using the Domains relation
 * @method     ChildUserQuery rightJoinWithDomains() Adds a RIGHT JOIN clause and with to the query using the Domains relation
 * @method     ChildUserQuery innerJoinWithDomains() Adds a INNER JOIN clause and with to the query using the Domains relation
 *
 * @method     \basteyy\XzitGiggle\Models\UserRoleQuery|\basteyy\XzitGiggle\Models\IpPoolUsersQuery|\basteyy\XzitGiggle\Models\DomainQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildUser|null findOne(?ConnectionInterface $con = null) Return the first ChildUser matching the query
 * @method     ChildUser findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildUser matching the query, or a new ChildUser object populated from the query conditions when no match is found
 *
 * @method     ChildUser|null findOneById(int $id) Return the first ChildUser filtered by the id column
 * @method     ChildUser|null findOneByEmail(string $email) Return the first ChildUser filtered by the email column
 * @method     ChildUser|null findOneByUsername(string $username) Return the first ChildUser filtered by the username column
 * @method     ChildUser|null findOneByUserRoleId(int $user_role_id) Return the first ChildUser filtered by the user_role_id column
 * @method     ChildUser|null findOneBySecretKey(string $secret_key) Return the first ChildUser filtered by the secret_key column
 * @method     ChildUser|null findOneByPasswordHash(string $password_hash) Return the first ChildUser filtered by the password_hash column
 * @method     ChildUser|null findOneByActivated(boolean $activated) Return the first ChildUser filtered by the activated column
 * @method     ChildUser|null findOneByBlocked(boolean $blocked) Return the first ChildUser filtered by the blocked column
 *
 * @method     ChildUser requirePk($key, ?ConnectionInterface $con = null) Return the ChildUser by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOne(?ConnectionInterface $con = null) Return the first ChildUser matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUser requireOneById(int $id) Return the first ChildUser filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByEmail(string $email) Return the first ChildUser filtered by the email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByUsername(string $username) Return the first ChildUser filtered by the username column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByUserRoleId(int $user_role_id) Return the first ChildUser filtered by the user_role_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneBySecretKey(string $secret_key) Return the first ChildUser filtered by the secret_key column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByPasswordHash(string $password_hash) Return the first ChildUser filtered by the password_hash column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByActivated(boolean $activated) Return the first ChildUser filtered by the activated column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByBlocked(boolean $blocked) Return the first ChildUser filtered by the blocked column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUser[]|Collection find(?ConnectionInterface $con = null) Return ChildUser objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildUser> find(?ConnectionInterface $con = null) Return ChildUser objects based on current ModelCriteria
 *
 * @method     ChildUser[]|Collection findById(int|array<int> $id) Return ChildUser objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildUser> findById(int|array<int> $id) Return ChildUser objects filtered by the id column
 * @method     ChildUser[]|Collection findByEmail(string|array<string> $email) Return ChildUser objects filtered by the email column
 * @psalm-method Collection&\Traversable<ChildUser> findByEmail(string|array<string> $email) Return ChildUser objects filtered by the email column
 * @method     ChildUser[]|Collection findByUsername(string|array<string> $username) Return ChildUser objects filtered by the username column
 * @psalm-method Collection&\Traversable<ChildUser> findByUsername(string|array<string> $username) Return ChildUser objects filtered by the username column
 * @method     ChildUser[]|Collection findByUserRoleId(int|array<int> $user_role_id) Return ChildUser objects filtered by the user_role_id column
 * @psalm-method Collection&\Traversable<ChildUser> findByUserRoleId(int|array<int> $user_role_id) Return ChildUser objects filtered by the user_role_id column
 * @method     ChildUser[]|Collection findBySecretKey(string|array<string> $secret_key) Return ChildUser objects filtered by the secret_key column
 * @psalm-method Collection&\Traversable<ChildUser> findBySecretKey(string|array<string> $secret_key) Return ChildUser objects filtered by the secret_key column
 * @method     ChildUser[]|Collection findByPasswordHash(string|array<string> $password_hash) Return ChildUser objects filtered by the password_hash column
 * @psalm-method Collection&\Traversable<ChildUser> findByPasswordHash(string|array<string> $password_hash) Return ChildUser objects filtered by the password_hash column
 * @method     ChildUser[]|Collection findByActivated(boolean|array<boolean> $activated) Return ChildUser objects filtered by the activated column
 * @psalm-method Collection&\Traversable<ChildUser> findByActivated(boolean|array<boolean> $activated) Return ChildUser objects filtered by the activated column
 * @method     ChildUser[]|Collection findByBlocked(boolean|array<boolean> $blocked) Return ChildUser objects filtered by the blocked column
 * @psalm-method Collection&\Traversable<ChildUser> findByBlocked(boolean|array<boolean> $blocked) Return ChildUser objects filtered by the blocked column
 *
 * @method     ChildUser[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildUser> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class UserQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \basteyy\XzitGiggle\Models\Base\UserQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\basteyy\\XzitGiggle\\Models\\User', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUserQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUserQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildUserQuery) {
            return $criteria;
        }
        $query = new ChildUserQuery();
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
     * @return ChildUser|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UserTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = UserTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildUser A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id`, `email`, `username`, `user_role_id`, `secret_key`, `password_hash`, `activated`, `blocked` FROM `xg_users` WHERE `id` = :p0';
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
            /** @var ChildUser $obj */
            $obj = new ChildUser();
            $obj->hydrate($row);
            UserTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildUser|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(UserTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(UserTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(UserTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(UserTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UserTableMap::COL_ID, $id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the email column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE email = 'fooValue'
     * $query->filterByEmail('%fooValue%', Criteria::LIKE); // WHERE email LIKE '%fooValue%'
     * $query->filterByEmail(['foo', 'bar']); // WHERE email IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $email The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmail($email = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UserTableMap::COL_EMAIL, $email, $comparison);

        return $this;
    }

    /**
     * Filter the query on the username column
     *
     * Example usage:
     * <code>
     * $query->filterByUsername('fooValue');   // WHERE username = 'fooValue'
     * $query->filterByUsername('%fooValue%', Criteria::LIKE); // WHERE username LIKE '%fooValue%'
     * $query->filterByUsername(['foo', 'bar']); // WHERE username IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $username The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUsername($username = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($username)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UserTableMap::COL_USERNAME, $username, $comparison);

        return $this;
    }

    /**
     * Filter the query on the user_role_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUserRoleId(1234); // WHERE user_role_id = 1234
     * $query->filterByUserRoleId(array(12, 34)); // WHERE user_role_id IN (12, 34)
     * $query->filterByUserRoleId(array('min' => 12)); // WHERE user_role_id > 12
     * </code>
     *
     * @see       filterByUserRole()
     *
     * @param mixed $userRoleId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUserRoleId($userRoleId = null, ?string $comparison = null)
    {
        if (is_array($userRoleId)) {
            $useMinMax = false;
            if (isset($userRoleId['min'])) {
                $this->addUsingAlias(UserTableMap::COL_USER_ROLE_ID, $userRoleId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userRoleId['max'])) {
                $this->addUsingAlias(UserTableMap::COL_USER_ROLE_ID, $userRoleId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UserTableMap::COL_USER_ROLE_ID, $userRoleId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the secret_key column
     *
     * Example usage:
     * <code>
     * $query->filterBySecretKey('fooValue');   // WHERE secret_key = 'fooValue'
     * $query->filterBySecretKey('%fooValue%', Criteria::LIKE); // WHERE secret_key LIKE '%fooValue%'
     * $query->filterBySecretKey(['foo', 'bar']); // WHERE secret_key IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $secretKey The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySecretKey($secretKey = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($secretKey)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UserTableMap::COL_SECRET_KEY, $secretKey, $comparison);

        return $this;
    }

    /**
     * Filter the query on the password_hash column
     *
     * Example usage:
     * <code>
     * $query->filterByPasswordHash('fooValue');   // WHERE password_hash = 'fooValue'
     * $query->filterByPasswordHash('%fooValue%', Criteria::LIKE); // WHERE password_hash LIKE '%fooValue%'
     * $query->filterByPasswordHash(['foo', 'bar']); // WHERE password_hash IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $passwordHash The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPasswordHash($passwordHash = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($passwordHash)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UserTableMap::COL_PASSWORD_HASH, $passwordHash, $comparison);

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

        $this->addUsingAlias(UserTableMap::COL_ACTIVATED, $activated, $comparison);

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

        $this->addUsingAlias(UserTableMap::COL_BLOCKED, $blocked, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \basteyy\XzitGiggle\Models\UserRole object
     *
     * @param \basteyy\XzitGiggle\Models\UserRole|ObjectCollection $userRole The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUserRole($userRole, ?string $comparison = null)
    {
        if ($userRole instanceof \basteyy\XzitGiggle\Models\UserRole) {
            return $this
                ->addUsingAlias(UserTableMap::COL_USER_ROLE_ID, $userRole->getId(), $comparison);
        } elseif ($userRole instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(UserTableMap::COL_USER_ROLE_ID, $userRole->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByUserRole() only accepts arguments of type \basteyy\XzitGiggle\Models\UserRole or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UserRole relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinUserRole(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UserRole');

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
            $this->addJoinObject($join, 'UserRole');
        }

        return $this;
    }

    /**
     * Use the UserRole relation UserRole object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \basteyy\XzitGiggle\Models\UserRoleQuery A secondary query class using the current class as primary query
     */
    public function useUserRoleQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUserRole($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UserRole', '\basteyy\XzitGiggle\Models\UserRoleQuery');
    }

    /**
     * Use the UserRole relation UserRole object
     *
     * @param callable(\basteyy\XzitGiggle\Models\UserRoleQuery):\basteyy\XzitGiggle\Models\UserRoleQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withUserRoleQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useUserRoleQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to UserRole table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \basteyy\XzitGiggle\Models\UserRoleQuery The inner query object of the EXISTS statement
     */
    public function useUserRoleExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \basteyy\XzitGiggle\Models\UserRoleQuery */
        $q = $this->useExistsQuery('UserRole', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to UserRole table for a NOT EXISTS query.
     *
     * @see useUserRoleExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \basteyy\XzitGiggle\Models\UserRoleQuery The inner query object of the NOT EXISTS statement
     */
    public function useUserRoleNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \basteyy\XzitGiggle\Models\UserRoleQuery */
        $q = $this->useExistsQuery('UserRole', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to UserRole table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \basteyy\XzitGiggle\Models\UserRoleQuery The inner query object of the IN statement
     */
    public function useInUserRoleQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \basteyy\XzitGiggle\Models\UserRoleQuery */
        $q = $this->useInQuery('UserRole', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to UserRole table for a NOT IN query.
     *
     * @see useUserRoleInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \basteyy\XzitGiggle\Models\UserRoleQuery The inner query object of the NOT IN statement
     */
    public function useNotInUserRoleQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \basteyy\XzitGiggle\Models\UserRoleQuery */
        $q = $this->useInQuery('UserRole', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(UserTableMap::COL_ID, $ipPoolUsers->getUserId(), $comparison);

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
     * Filter the query by a related \basteyy\XzitGiggle\Models\Domain object
     *
     * @param \basteyy\XzitGiggle\Models\Domain|ObjectCollection $domain the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDomains($domain, ?string $comparison = null)
    {
        if ($domain instanceof \basteyy\XzitGiggle\Models\Domain) {
            $this
                ->addUsingAlias(UserTableMap::COL_ID, $domain->getUserId(), $comparison);

            return $this;
        } elseif ($domain instanceof ObjectCollection) {
            $this
                ->useDomainsQuery()
                ->filterByPrimaryKeys($domain->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByDomains() only accepts arguments of type \basteyy\XzitGiggle\Models\Domain or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Domains relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinDomains(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Domains');

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
            $this->addJoinObject($join, 'Domains');
        }

        return $this;
    }

    /**
     * Use the Domains relation Domain object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \basteyy\XzitGiggle\Models\DomainQuery A secondary query class using the current class as primary query
     */
    public function useDomainsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinDomains($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Domains', '\basteyy\XzitGiggle\Models\DomainQuery');
    }

    /**
     * Use the Domains relation Domain object
     *
     * @param callable(\basteyy\XzitGiggle\Models\DomainQuery):\basteyy\XzitGiggle\Models\DomainQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withDomainsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useDomainsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the Domains relation to the Domain table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \basteyy\XzitGiggle\Models\DomainQuery The inner query object of the EXISTS statement
     */
    public function useDomainsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \basteyy\XzitGiggle\Models\DomainQuery */
        $q = $this->useExistsQuery('Domains', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the Domains relation to the Domain table for a NOT EXISTS query.
     *
     * @see useDomainsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \basteyy\XzitGiggle\Models\DomainQuery The inner query object of the NOT EXISTS statement
     */
    public function useDomainsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \basteyy\XzitGiggle\Models\DomainQuery */
        $q = $this->useExistsQuery('Domains', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the Domains relation to the Domain table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \basteyy\XzitGiggle\Models\DomainQuery The inner query object of the IN statement
     */
    public function useInDomainsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \basteyy\XzitGiggle\Models\DomainQuery */
        $q = $this->useInQuery('Domains', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the Domains relation to the Domain table for a NOT IN query.
     *
     * @see useDomainsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \basteyy\XzitGiggle\Models\DomainQuery The inner query object of the NOT IN statement
     */
    public function useNotInDomainsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \basteyy\XzitGiggle\Models\DomainQuery */
        $q = $this->useInQuery('Domains', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildUser $user Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($user = null)
    {
        if ($user) {
            $this->addUsingAlias(UserTableMap::COL_ID, $user->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the xg_users table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UserTableMap::clearInstancePool();
            UserTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(UserTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UserTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UserTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UserTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
