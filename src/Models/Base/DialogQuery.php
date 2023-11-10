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
use basteyy\XzitGiggle\Models\Dialog as ChildDialog;
use basteyy\XzitGiggle\Models\DialogQuery as ChildDialogQuery;
use basteyy\XzitGiggle\Models\Map\DialogTableMap;

/**
 * Base class that represents a query for the `xg_dialogs` table.
 *
 * @method     ChildDialogQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildDialogQuery orderByHash($order = Criteria::ASC) Order by the hash column
 * @method     ChildDialogQuery orderBySubject($order = Criteria::ASC) Order by the subject column
 * @method     ChildDialogQuery orderByCreatedUserId($order = Criteria::ASC) Order by the created_user_id column
 * @method     ChildDialogQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildDialogQuery orderByActive($order = Criteria::ASC) Order by the active column
 * @method     ChildDialogQuery orderByIsPrivate($order = Criteria::ASC) Order by the is_private column
 * @method     ChildDialogQuery orderByLastMessage($order = Criteria::ASC) Order by the last_message column
 *
 * @method     ChildDialogQuery groupById() Group by the id column
 * @method     ChildDialogQuery groupByHash() Group by the hash column
 * @method     ChildDialogQuery groupBySubject() Group by the subject column
 * @method     ChildDialogQuery groupByCreatedUserId() Group by the created_user_id column
 * @method     ChildDialogQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildDialogQuery groupByActive() Group by the active column
 * @method     ChildDialogQuery groupByIsPrivate() Group by the is_private column
 * @method     ChildDialogQuery groupByLastMessage() Group by the last_message column
 *
 * @method     ChildDialogQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildDialogQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildDialogQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildDialogQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildDialogQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildDialogQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildDialogQuery leftJoinCreatedByUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the CreatedByUser relation
 * @method     ChildDialogQuery rightJoinCreatedByUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CreatedByUser relation
 * @method     ChildDialogQuery innerJoinCreatedByUser($relationAlias = null) Adds a INNER JOIN clause to the query using the CreatedByUser relation
 *
 * @method     ChildDialogQuery joinWithCreatedByUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CreatedByUser relation
 *
 * @method     ChildDialogQuery leftJoinWithCreatedByUser() Adds a LEFT JOIN clause and with to the query using the CreatedByUser relation
 * @method     ChildDialogQuery rightJoinWithCreatedByUser() Adds a RIGHT JOIN clause and with to the query using the CreatedByUser relation
 * @method     ChildDialogQuery innerJoinWithCreatedByUser() Adds a INNER JOIN clause and with to the query using the CreatedByUser relation
 *
 * @method     ChildDialogQuery leftJoinDialogUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the DialogUser relation
 * @method     ChildDialogQuery rightJoinDialogUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the DialogUser relation
 * @method     ChildDialogQuery innerJoinDialogUser($relationAlias = null) Adds a INNER JOIN clause to the query using the DialogUser relation
 *
 * @method     ChildDialogQuery joinWithDialogUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the DialogUser relation
 *
 * @method     ChildDialogQuery leftJoinWithDialogUser() Adds a LEFT JOIN clause and with to the query using the DialogUser relation
 * @method     ChildDialogQuery rightJoinWithDialogUser() Adds a RIGHT JOIN clause and with to the query using the DialogUser relation
 * @method     ChildDialogQuery innerJoinWithDialogUser() Adds a INNER JOIN clause and with to the query using the DialogUser relation
 *
 * @method     ChildDialogQuery leftJoinDialogUsers($relationAlias = null) Adds a LEFT JOIN clause to the query using the DialogUsers relation
 * @method     ChildDialogQuery rightJoinDialogUsers($relationAlias = null) Adds a RIGHT JOIN clause to the query using the DialogUsers relation
 * @method     ChildDialogQuery innerJoinDialogUsers($relationAlias = null) Adds a INNER JOIN clause to the query using the DialogUsers relation
 *
 * @method     ChildDialogQuery joinWithDialogUsers($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the DialogUsers relation
 *
 * @method     ChildDialogQuery leftJoinWithDialogUsers() Adds a LEFT JOIN clause and with to the query using the DialogUsers relation
 * @method     ChildDialogQuery rightJoinWithDialogUsers() Adds a RIGHT JOIN clause and with to the query using the DialogUsers relation
 * @method     ChildDialogQuery innerJoinWithDialogUsers() Adds a INNER JOIN clause and with to the query using the DialogUsers relation
 *
 * @method     \basteyy\XzitGiggle\Models\UserQuery|\basteyy\XzitGiggle\Models\DialogUserQuery|\basteyy\XzitGiggle\Models\DialogMessageQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildDialog|null findOne(?ConnectionInterface $con = null) Return the first ChildDialog matching the query
 * @method     ChildDialog findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildDialog matching the query, or a new ChildDialog object populated from the query conditions when no match is found
 *
 * @method     ChildDialog|null findOneById(int $id) Return the first ChildDialog filtered by the id column
 * @method     ChildDialog|null findOneByHash(string $hash) Return the first ChildDialog filtered by the hash column
 * @method     ChildDialog|null findOneBySubject(string $subject) Return the first ChildDialog filtered by the subject column
 * @method     ChildDialog|null findOneByCreatedUserId(int $created_user_id) Return the first ChildDialog filtered by the created_user_id column
 * @method     ChildDialog|null findOneByCreatedAt(string $created_at) Return the first ChildDialog filtered by the created_at column
 * @method     ChildDialog|null findOneByActive(boolean $active) Return the first ChildDialog filtered by the active column
 * @method     ChildDialog|null findOneByIsPrivate(boolean $is_private) Return the first ChildDialog filtered by the is_private column
 * @method     ChildDialog|null findOneByLastMessage(string $last_message) Return the first ChildDialog filtered by the last_message column
 *
 * @method     ChildDialog requirePk($key, ?ConnectionInterface $con = null) Return the ChildDialog by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDialog requireOne(?ConnectionInterface $con = null) Return the first ChildDialog matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDialog requireOneById(int $id) Return the first ChildDialog filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDialog requireOneByHash(string $hash) Return the first ChildDialog filtered by the hash column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDialog requireOneBySubject(string $subject) Return the first ChildDialog filtered by the subject column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDialog requireOneByCreatedUserId(int $created_user_id) Return the first ChildDialog filtered by the created_user_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDialog requireOneByCreatedAt(string $created_at) Return the first ChildDialog filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDialog requireOneByActive(boolean $active) Return the first ChildDialog filtered by the active column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDialog requireOneByIsPrivate(boolean $is_private) Return the first ChildDialog filtered by the is_private column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDialog requireOneByLastMessage(string $last_message) Return the first ChildDialog filtered by the last_message column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDialog[]|Collection find(?ConnectionInterface $con = null) Return ChildDialog objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildDialog> find(?ConnectionInterface $con = null) Return ChildDialog objects based on current ModelCriteria
 *
 * @method     ChildDialog[]|Collection findById(int|array<int> $id) Return ChildDialog objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildDialog> findById(int|array<int> $id) Return ChildDialog objects filtered by the id column
 * @method     ChildDialog[]|Collection findByHash(string|array<string> $hash) Return ChildDialog objects filtered by the hash column
 * @psalm-method Collection&\Traversable<ChildDialog> findByHash(string|array<string> $hash) Return ChildDialog objects filtered by the hash column
 * @method     ChildDialog[]|Collection findBySubject(string|array<string> $subject) Return ChildDialog objects filtered by the subject column
 * @psalm-method Collection&\Traversable<ChildDialog> findBySubject(string|array<string> $subject) Return ChildDialog objects filtered by the subject column
 * @method     ChildDialog[]|Collection findByCreatedUserId(int|array<int> $created_user_id) Return ChildDialog objects filtered by the created_user_id column
 * @psalm-method Collection&\Traversable<ChildDialog> findByCreatedUserId(int|array<int> $created_user_id) Return ChildDialog objects filtered by the created_user_id column
 * @method     ChildDialog[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildDialog objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildDialog> findByCreatedAt(string|array<string> $created_at) Return ChildDialog objects filtered by the created_at column
 * @method     ChildDialog[]|Collection findByActive(boolean|array<boolean> $active) Return ChildDialog objects filtered by the active column
 * @psalm-method Collection&\Traversable<ChildDialog> findByActive(boolean|array<boolean> $active) Return ChildDialog objects filtered by the active column
 * @method     ChildDialog[]|Collection findByIsPrivate(boolean|array<boolean> $is_private) Return ChildDialog objects filtered by the is_private column
 * @psalm-method Collection&\Traversable<ChildDialog> findByIsPrivate(boolean|array<boolean> $is_private) Return ChildDialog objects filtered by the is_private column
 * @method     ChildDialog[]|Collection findByLastMessage(string|array<string> $last_message) Return ChildDialog objects filtered by the last_message column
 * @psalm-method Collection&\Traversable<ChildDialog> findByLastMessage(string|array<string> $last_message) Return ChildDialog objects filtered by the last_message column
 *
 * @method     ChildDialog[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildDialog> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class DialogQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \basteyy\XzitGiggle\Models\Base\DialogQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\basteyy\\XzitGiggle\\Models\\Dialog', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildDialogQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildDialogQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildDialogQuery) {
            return $criteria;
        }
        $query = new ChildDialogQuery();
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
     * @return ChildDialog|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(DialogTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = DialogTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildDialog A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id`, `hash`, `subject`, `created_user_id`, `created_at`, `active`, `is_private`, `last_message` FROM `xg_dialogs` WHERE `id` = :p0';
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
            /** @var ChildDialog $obj */
            $obj = new ChildDialog();
            $obj->hydrate($row);
            DialogTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildDialog|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(DialogTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(DialogTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(DialogTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(DialogTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DialogTableMap::COL_ID, $id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the hash column
     *
     * Example usage:
     * <code>
     * $query->filterByHash('fooValue');   // WHERE hash = 'fooValue'
     * $query->filterByHash('%fooValue%', Criteria::LIKE); // WHERE hash LIKE '%fooValue%'
     * $query->filterByHash(['foo', 'bar']); // WHERE hash IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $hash The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByHash($hash = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($hash)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DialogTableMap::COL_HASH, $hash, $comparison);

        return $this;
    }

    /**
     * Filter the query on the subject column
     *
     * Example usage:
     * <code>
     * $query->filterBySubject('fooValue');   // WHERE subject = 'fooValue'
     * $query->filterBySubject('%fooValue%', Criteria::LIKE); // WHERE subject LIKE '%fooValue%'
     * $query->filterBySubject(['foo', 'bar']); // WHERE subject IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $subject The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySubject($subject = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($subject)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DialogTableMap::COL_SUBJECT, $subject, $comparison);

        return $this;
    }

    /**
     * Filter the query on the created_user_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedUserId(1234); // WHERE created_user_id = 1234
     * $query->filterByCreatedUserId(array(12, 34)); // WHERE created_user_id IN (12, 34)
     * $query->filterByCreatedUserId(array('min' => 12)); // WHERE created_user_id > 12
     * </code>
     *
     * @see       filterByCreatedByUser()
     *
     * @param mixed $createdUserId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCreatedUserId($createdUserId = null, ?string $comparison = null)
    {
        if (is_array($createdUserId)) {
            $useMinMax = false;
            if (isset($createdUserId['min'])) {
                $this->addUsingAlias(DialogTableMap::COL_CREATED_USER_ID, $createdUserId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdUserId['max'])) {
                $this->addUsingAlias(DialogTableMap::COL_CREATED_USER_ID, $createdUserId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DialogTableMap::COL_CREATED_USER_ID, $createdUserId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the created_at column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedAt('2011-03-14'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt('now'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt(array('max' => 'yesterday')); // WHERE created_at > '2011-03-13'
     * </code>
     *
     * @param mixed $createdAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, ?string $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(DialogTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(DialogTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DialogTableMap::COL_CREATED_AT, $createdAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the active column
     *
     * Example usage:
     * <code>
     * $query->filterByActive(true); // WHERE active = true
     * $query->filterByActive('yes'); // WHERE active = true
     * </code>
     *
     * @param bool|string $active The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByActive($active = null, ?string $comparison = null)
    {
        if (is_string($active)) {
            $active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(DialogTableMap::COL_ACTIVE, $active, $comparison);

        return $this;
    }

    /**
     * Filter the query on the is_private column
     *
     * Example usage:
     * <code>
     * $query->filterByIsPrivate(true); // WHERE is_private = true
     * $query->filterByIsPrivate('yes'); // WHERE is_private = true
     * </code>
     *
     * @param bool|string $isPrivate The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIsPrivate($isPrivate = null, ?string $comparison = null)
    {
        if (is_string($isPrivate)) {
            $isPrivate = in_array(strtolower($isPrivate), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(DialogTableMap::COL_IS_PRIVATE, $isPrivate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the last_message column
     *
     * Example usage:
     * <code>
     * $query->filterByLastMessage('2011-03-14'); // WHERE last_message = '2011-03-14'
     * $query->filterByLastMessage('now'); // WHERE last_message = '2011-03-14'
     * $query->filterByLastMessage(array('max' => 'yesterday')); // WHERE last_message > '2011-03-13'
     * </code>
     *
     * @param mixed $lastMessage The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLastMessage($lastMessage = null, ?string $comparison = null)
    {
        if (is_array($lastMessage)) {
            $useMinMax = false;
            if (isset($lastMessage['min'])) {
                $this->addUsingAlias(DialogTableMap::COL_LAST_MESSAGE, $lastMessage['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastMessage['max'])) {
                $this->addUsingAlias(DialogTableMap::COL_LAST_MESSAGE, $lastMessage['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DialogTableMap::COL_LAST_MESSAGE, $lastMessage, $comparison);

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
    public function filterByCreatedByUser($user, ?string $comparison = null)
    {
        if ($user instanceof \basteyy\XzitGiggle\Models\User) {
            return $this
                ->addUsingAlias(DialogTableMap::COL_CREATED_USER_ID, $user->getId(), $comparison);
        } elseif ($user instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(DialogTableMap::COL_CREATED_USER_ID, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByCreatedByUser() only accepts arguments of type \basteyy\XzitGiggle\Models\User or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CreatedByUser relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinCreatedByUser(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CreatedByUser');

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
            $this->addJoinObject($join, 'CreatedByUser');
        }

        return $this;
    }

    /**
     * Use the CreatedByUser relation User object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \basteyy\XzitGiggle\Models\UserQuery A secondary query class using the current class as primary query
     */
    public function useCreatedByUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCreatedByUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CreatedByUser', '\basteyy\XzitGiggle\Models\UserQuery');
    }

    /**
     * Use the CreatedByUser relation User object
     *
     * @param callable(\basteyy\XzitGiggle\Models\UserQuery):\basteyy\XzitGiggle\Models\UserQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withCreatedByUserQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useCreatedByUserQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the CreatedByUser relation to the User table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \basteyy\XzitGiggle\Models\UserQuery The inner query object of the EXISTS statement
     */
    public function useCreatedByUserExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \basteyy\XzitGiggle\Models\UserQuery */
        $q = $this->useExistsQuery('CreatedByUser', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the CreatedByUser relation to the User table for a NOT EXISTS query.
     *
     * @see useCreatedByUserExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \basteyy\XzitGiggle\Models\UserQuery The inner query object of the NOT EXISTS statement
     */
    public function useCreatedByUserNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \basteyy\XzitGiggle\Models\UserQuery */
        $q = $this->useExistsQuery('CreatedByUser', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the CreatedByUser relation to the User table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \basteyy\XzitGiggle\Models\UserQuery The inner query object of the IN statement
     */
    public function useInCreatedByUserQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \basteyy\XzitGiggle\Models\UserQuery */
        $q = $this->useInQuery('CreatedByUser', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the CreatedByUser relation to the User table for a NOT IN query.
     *
     * @see useCreatedByUserInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \basteyy\XzitGiggle\Models\UserQuery The inner query object of the NOT IN statement
     */
    public function useNotInCreatedByUserQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \basteyy\XzitGiggle\Models\UserQuery */
        $q = $this->useInQuery('CreatedByUser', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \basteyy\XzitGiggle\Models\DialogUser object
     *
     * @param \basteyy\XzitGiggle\Models\DialogUser|ObjectCollection $dialogUser the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDialogUser($dialogUser, ?string $comparison = null)
    {
        if ($dialogUser instanceof \basteyy\XzitGiggle\Models\DialogUser) {
            $this
                ->addUsingAlias(DialogTableMap::COL_ID, $dialogUser->getDialogId(), $comparison);

            return $this;
        } elseif ($dialogUser instanceof ObjectCollection) {
            $this
                ->useDialogUserQuery()
                ->filterByPrimaryKeys($dialogUser->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByDialogUser() only accepts arguments of type \basteyy\XzitGiggle\Models\DialogUser or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the DialogUser relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinDialogUser(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('DialogUser');

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
            $this->addJoinObject($join, 'DialogUser');
        }

        return $this;
    }

    /**
     * Use the DialogUser relation DialogUser object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \basteyy\XzitGiggle\Models\DialogUserQuery A secondary query class using the current class as primary query
     */
    public function useDialogUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinDialogUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'DialogUser', '\basteyy\XzitGiggle\Models\DialogUserQuery');
    }

    /**
     * Use the DialogUser relation DialogUser object
     *
     * @param callable(\basteyy\XzitGiggle\Models\DialogUserQuery):\basteyy\XzitGiggle\Models\DialogUserQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withDialogUserQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useDialogUserQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to DialogUser table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \basteyy\XzitGiggle\Models\DialogUserQuery The inner query object of the EXISTS statement
     */
    public function useDialogUserExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \basteyy\XzitGiggle\Models\DialogUserQuery */
        $q = $this->useExistsQuery('DialogUser', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to DialogUser table for a NOT EXISTS query.
     *
     * @see useDialogUserExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \basteyy\XzitGiggle\Models\DialogUserQuery The inner query object of the NOT EXISTS statement
     */
    public function useDialogUserNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \basteyy\XzitGiggle\Models\DialogUserQuery */
        $q = $this->useExistsQuery('DialogUser', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to DialogUser table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \basteyy\XzitGiggle\Models\DialogUserQuery The inner query object of the IN statement
     */
    public function useInDialogUserQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \basteyy\XzitGiggle\Models\DialogUserQuery */
        $q = $this->useInQuery('DialogUser', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to DialogUser table for a NOT IN query.
     *
     * @see useDialogUserInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \basteyy\XzitGiggle\Models\DialogUserQuery The inner query object of the NOT IN statement
     */
    public function useNotInDialogUserQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \basteyy\XzitGiggle\Models\DialogUserQuery */
        $q = $this->useInQuery('DialogUser', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \basteyy\XzitGiggle\Models\DialogMessage object
     *
     * @param \basteyy\XzitGiggle\Models\DialogMessage|ObjectCollection $dialogMessage the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDialogUsers($dialogMessage, ?string $comparison = null)
    {
        if ($dialogMessage instanceof \basteyy\XzitGiggle\Models\DialogMessage) {
            $this
                ->addUsingAlias(DialogTableMap::COL_ID, $dialogMessage->getDialogId(), $comparison);

            return $this;
        } elseif ($dialogMessage instanceof ObjectCollection) {
            $this
                ->useDialogUsersQuery()
                ->filterByPrimaryKeys($dialogMessage->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByDialogUsers() only accepts arguments of type \basteyy\XzitGiggle\Models\DialogMessage or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the DialogUsers relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinDialogUsers(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('DialogUsers');

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
            $this->addJoinObject($join, 'DialogUsers');
        }

        return $this;
    }

    /**
     * Use the DialogUsers relation DialogMessage object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \basteyy\XzitGiggle\Models\DialogMessageQuery A secondary query class using the current class as primary query
     */
    public function useDialogUsersQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinDialogUsers($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'DialogUsers', '\basteyy\XzitGiggle\Models\DialogMessageQuery');
    }

    /**
     * Use the DialogUsers relation DialogMessage object
     *
     * @param callable(\basteyy\XzitGiggle\Models\DialogMessageQuery):\basteyy\XzitGiggle\Models\DialogMessageQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withDialogUsersQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useDialogUsersQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the DialogUsers relation to the DialogMessage table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \basteyy\XzitGiggle\Models\DialogMessageQuery The inner query object of the EXISTS statement
     */
    public function useDialogUsersExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \basteyy\XzitGiggle\Models\DialogMessageQuery */
        $q = $this->useExistsQuery('DialogUsers', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the DialogUsers relation to the DialogMessage table for a NOT EXISTS query.
     *
     * @see useDialogUsersExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \basteyy\XzitGiggle\Models\DialogMessageQuery The inner query object of the NOT EXISTS statement
     */
    public function useDialogUsersNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \basteyy\XzitGiggle\Models\DialogMessageQuery */
        $q = $this->useExistsQuery('DialogUsers', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the DialogUsers relation to the DialogMessage table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \basteyy\XzitGiggle\Models\DialogMessageQuery The inner query object of the IN statement
     */
    public function useInDialogUsersQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \basteyy\XzitGiggle\Models\DialogMessageQuery */
        $q = $this->useInQuery('DialogUsers', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the DialogUsers relation to the DialogMessage table for a NOT IN query.
     *
     * @see useDialogUsersInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \basteyy\XzitGiggle\Models\DialogMessageQuery The inner query object of the NOT IN statement
     */
    public function useNotInDialogUsersQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \basteyy\XzitGiggle\Models\DialogMessageQuery */
        $q = $this->useInQuery('DialogUsers', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildDialog $dialog Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($dialog = null)
    {
        if ($dialog) {
            $this->addUsingAlias(DialogTableMap::COL_ID, $dialog->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the xg_dialogs table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DialogTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            DialogTableMap::clearInstancePool();
            DialogTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(DialogTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(DialogTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            DialogTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            DialogTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
