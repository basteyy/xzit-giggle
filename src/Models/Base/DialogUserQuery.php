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
use basteyy\XzitGiggle\Models\DialogUser as ChildDialogUser;
use basteyy\XzitGiggle\Models\DialogUserQuery as ChildDialogUserQuery;
use basteyy\XzitGiggle\Models\Map\DialogUserTableMap;

/**
 * Base class that represents a query for the `xg_dialog_users` table.
 *
 * @method     ChildDialogUserQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildDialogUserQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     ChildDialogUserQuery orderByDialogId($order = Criteria::ASC) Order by the dialog_id column
 * @method     ChildDialogUserQuery orderByJoined($order = Criteria::ASC) Order by the joined column
 * @method     ChildDialogUserQuery orderByJoinedAt($order = Criteria::ASC) Order by the joined_at column
 * @method     ChildDialogUserQuery orderByInvitedAt($order = Criteria::ASC) Order by the invited_at column
 * @method     ChildDialogUserQuery orderByInvitedUserId($order = Criteria::ASC) Order by the invited_user_id column
 *
 * @method     ChildDialogUserQuery groupById() Group by the id column
 * @method     ChildDialogUserQuery groupByUserId() Group by the user_id column
 * @method     ChildDialogUserQuery groupByDialogId() Group by the dialog_id column
 * @method     ChildDialogUserQuery groupByJoined() Group by the joined column
 * @method     ChildDialogUserQuery groupByJoinedAt() Group by the joined_at column
 * @method     ChildDialogUserQuery groupByInvitedAt() Group by the invited_at column
 * @method     ChildDialogUserQuery groupByInvitedUserId() Group by the invited_user_id column
 *
 * @method     ChildDialogUserQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildDialogUserQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildDialogUserQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildDialogUserQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildDialogUserQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildDialogUserQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildDialogUserQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     ChildDialogUserQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     ChildDialogUserQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     ChildDialogUserQuery joinWithUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the User relation
 *
 * @method     ChildDialogUserQuery leftJoinWithUser() Adds a LEFT JOIN clause and with to the query using the User relation
 * @method     ChildDialogUserQuery rightJoinWithUser() Adds a RIGHT JOIN clause and with to the query using the User relation
 * @method     ChildDialogUserQuery innerJoinWithUser() Adds a INNER JOIN clause and with to the query using the User relation
 *
 * @method     ChildDialogUserQuery leftJoinInviterUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the InviterUser relation
 * @method     ChildDialogUserQuery rightJoinInviterUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the InviterUser relation
 * @method     ChildDialogUserQuery innerJoinInviterUser($relationAlias = null) Adds a INNER JOIN clause to the query using the InviterUser relation
 *
 * @method     ChildDialogUserQuery joinWithInviterUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the InviterUser relation
 *
 * @method     ChildDialogUserQuery leftJoinWithInviterUser() Adds a LEFT JOIN clause and with to the query using the InviterUser relation
 * @method     ChildDialogUserQuery rightJoinWithInviterUser() Adds a RIGHT JOIN clause and with to the query using the InviterUser relation
 * @method     ChildDialogUserQuery innerJoinWithInviterUser() Adds a INNER JOIN clause and with to the query using the InviterUser relation
 *
 * @method     ChildDialogUserQuery leftJoinDialog($relationAlias = null) Adds a LEFT JOIN clause to the query using the Dialog relation
 * @method     ChildDialogUserQuery rightJoinDialog($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Dialog relation
 * @method     ChildDialogUserQuery innerJoinDialog($relationAlias = null) Adds a INNER JOIN clause to the query using the Dialog relation
 *
 * @method     ChildDialogUserQuery joinWithDialog($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Dialog relation
 *
 * @method     ChildDialogUserQuery leftJoinWithDialog() Adds a LEFT JOIN clause and with to the query using the Dialog relation
 * @method     ChildDialogUserQuery rightJoinWithDialog() Adds a RIGHT JOIN clause and with to the query using the Dialog relation
 * @method     ChildDialogUserQuery innerJoinWithDialog() Adds a INNER JOIN clause and with to the query using the Dialog relation
 *
 * @method     \basteyy\XzitGiggle\Models\UserQuery|\basteyy\XzitGiggle\Models\UserQuery|\basteyy\XzitGiggle\Models\DialogQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildDialogUser|null findOne(?ConnectionInterface $con = null) Return the first ChildDialogUser matching the query
 * @method     ChildDialogUser findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildDialogUser matching the query, or a new ChildDialogUser object populated from the query conditions when no match is found
 *
 * @method     ChildDialogUser|null findOneById(int $id) Return the first ChildDialogUser filtered by the id column
 * @method     ChildDialogUser|null findOneByUserId(int $user_id) Return the first ChildDialogUser filtered by the user_id column
 * @method     ChildDialogUser|null findOneByDialogId(int $dialog_id) Return the first ChildDialogUser filtered by the dialog_id column
 * @method     ChildDialogUser|null findOneByJoined(boolean $joined) Return the first ChildDialogUser filtered by the joined column
 * @method     ChildDialogUser|null findOneByJoinedAt(string $joined_at) Return the first ChildDialogUser filtered by the joined_at column
 * @method     ChildDialogUser|null findOneByInvitedAt(string $invited_at) Return the first ChildDialogUser filtered by the invited_at column
 * @method     ChildDialogUser|null findOneByInvitedUserId(int $invited_user_id) Return the first ChildDialogUser filtered by the invited_user_id column
 *
 * @method     ChildDialogUser requirePk($key, ?ConnectionInterface $con = null) Return the ChildDialogUser by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDialogUser requireOne(?ConnectionInterface $con = null) Return the first ChildDialogUser matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDialogUser requireOneById(int $id) Return the first ChildDialogUser filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDialogUser requireOneByUserId(int $user_id) Return the first ChildDialogUser filtered by the user_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDialogUser requireOneByDialogId(int $dialog_id) Return the first ChildDialogUser filtered by the dialog_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDialogUser requireOneByJoined(boolean $joined) Return the first ChildDialogUser filtered by the joined column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDialogUser requireOneByJoinedAt(string $joined_at) Return the first ChildDialogUser filtered by the joined_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDialogUser requireOneByInvitedAt(string $invited_at) Return the first ChildDialogUser filtered by the invited_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDialogUser requireOneByInvitedUserId(int $invited_user_id) Return the first ChildDialogUser filtered by the invited_user_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDialogUser[]|Collection find(?ConnectionInterface $con = null) Return ChildDialogUser objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildDialogUser> find(?ConnectionInterface $con = null) Return ChildDialogUser objects based on current ModelCriteria
 *
 * @method     ChildDialogUser[]|Collection findById(int|array<int> $id) Return ChildDialogUser objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildDialogUser> findById(int|array<int> $id) Return ChildDialogUser objects filtered by the id column
 * @method     ChildDialogUser[]|Collection findByUserId(int|array<int> $user_id) Return ChildDialogUser objects filtered by the user_id column
 * @psalm-method Collection&\Traversable<ChildDialogUser> findByUserId(int|array<int> $user_id) Return ChildDialogUser objects filtered by the user_id column
 * @method     ChildDialogUser[]|Collection findByDialogId(int|array<int> $dialog_id) Return ChildDialogUser objects filtered by the dialog_id column
 * @psalm-method Collection&\Traversable<ChildDialogUser> findByDialogId(int|array<int> $dialog_id) Return ChildDialogUser objects filtered by the dialog_id column
 * @method     ChildDialogUser[]|Collection findByJoined(boolean|array<boolean> $joined) Return ChildDialogUser objects filtered by the joined column
 * @psalm-method Collection&\Traversable<ChildDialogUser> findByJoined(boolean|array<boolean> $joined) Return ChildDialogUser objects filtered by the joined column
 * @method     ChildDialogUser[]|Collection findByJoinedAt(string|array<string> $joined_at) Return ChildDialogUser objects filtered by the joined_at column
 * @psalm-method Collection&\Traversable<ChildDialogUser> findByJoinedAt(string|array<string> $joined_at) Return ChildDialogUser objects filtered by the joined_at column
 * @method     ChildDialogUser[]|Collection findByInvitedAt(string|array<string> $invited_at) Return ChildDialogUser objects filtered by the invited_at column
 * @psalm-method Collection&\Traversable<ChildDialogUser> findByInvitedAt(string|array<string> $invited_at) Return ChildDialogUser objects filtered by the invited_at column
 * @method     ChildDialogUser[]|Collection findByInvitedUserId(int|array<int> $invited_user_id) Return ChildDialogUser objects filtered by the invited_user_id column
 * @psalm-method Collection&\Traversable<ChildDialogUser> findByInvitedUserId(int|array<int> $invited_user_id) Return ChildDialogUser objects filtered by the invited_user_id column
 *
 * @method     ChildDialogUser[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildDialogUser> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class DialogUserQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \basteyy\XzitGiggle\Models\Base\DialogUserQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\basteyy\\XzitGiggle\\Models\\DialogUser', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildDialogUserQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildDialogUserQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildDialogUserQuery) {
            return $criteria;
        }
        $query = new ChildDialogUserQuery();
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
     * @return ChildDialogUser|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(DialogUserTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = DialogUserTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildDialogUser A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id`, `user_id`, `dialog_id`, `joined`, `joined_at`, `invited_at`, `invited_user_id` FROM `xg_dialog_users` WHERE `id` = :p0';
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
            /** @var ChildDialogUser $obj */
            $obj = new ChildDialogUser();
            $obj->hydrate($row);
            DialogUserTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildDialogUser|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(DialogUserTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(DialogUserTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(DialogUserTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(DialogUserTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DialogUserTableMap::COL_ID, $id, $comparison);

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
                $this->addUsingAlias(DialogUserTableMap::COL_USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(DialogUserTableMap::COL_USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DialogUserTableMap::COL_USER_ID, $userId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the dialog_id column
     *
     * Example usage:
     * <code>
     * $query->filterByDialogId(1234); // WHERE dialog_id = 1234
     * $query->filterByDialogId(array(12, 34)); // WHERE dialog_id IN (12, 34)
     * $query->filterByDialogId(array('min' => 12)); // WHERE dialog_id > 12
     * </code>
     *
     * @see       filterByDialog()
     *
     * @param mixed $dialogId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDialogId($dialogId = null, ?string $comparison = null)
    {
        if (is_array($dialogId)) {
            $useMinMax = false;
            if (isset($dialogId['min'])) {
                $this->addUsingAlias(DialogUserTableMap::COL_DIALOG_ID, $dialogId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dialogId['max'])) {
                $this->addUsingAlias(DialogUserTableMap::COL_DIALOG_ID, $dialogId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DialogUserTableMap::COL_DIALOG_ID, $dialogId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the joined column
     *
     * Example usage:
     * <code>
     * $query->filterByJoined(true); // WHERE joined = true
     * $query->filterByJoined('yes'); // WHERE joined = true
     * </code>
     *
     * @param bool|string $joined The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByJoined($joined = null, ?string $comparison = null)
    {
        if (is_string($joined)) {
            $joined = in_array(strtolower($joined), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(DialogUserTableMap::COL_JOINED, $joined, $comparison);

        return $this;
    }

    /**
     * Filter the query on the joined_at column
     *
     * Example usage:
     * <code>
     * $query->filterByJoinedAt('2011-03-14'); // WHERE joined_at = '2011-03-14'
     * $query->filterByJoinedAt('now'); // WHERE joined_at = '2011-03-14'
     * $query->filterByJoinedAt(array('max' => 'yesterday')); // WHERE joined_at > '2011-03-13'
     * </code>
     *
     * @param mixed $joinedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByJoinedAt($joinedAt = null, ?string $comparison = null)
    {
        if (is_array($joinedAt)) {
            $useMinMax = false;
            if (isset($joinedAt['min'])) {
                $this->addUsingAlias(DialogUserTableMap::COL_JOINED_AT, $joinedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($joinedAt['max'])) {
                $this->addUsingAlias(DialogUserTableMap::COL_JOINED_AT, $joinedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DialogUserTableMap::COL_JOINED_AT, $joinedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the invited_at column
     *
     * Example usage:
     * <code>
     * $query->filterByInvitedAt('2011-03-14'); // WHERE invited_at = '2011-03-14'
     * $query->filterByInvitedAt('now'); // WHERE invited_at = '2011-03-14'
     * $query->filterByInvitedAt(array('max' => 'yesterday')); // WHERE invited_at > '2011-03-13'
     * </code>
     *
     * @param mixed $invitedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByInvitedAt($invitedAt = null, ?string $comparison = null)
    {
        if (is_array($invitedAt)) {
            $useMinMax = false;
            if (isset($invitedAt['min'])) {
                $this->addUsingAlias(DialogUserTableMap::COL_INVITED_AT, $invitedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($invitedAt['max'])) {
                $this->addUsingAlias(DialogUserTableMap::COL_INVITED_AT, $invitedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DialogUserTableMap::COL_INVITED_AT, $invitedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the invited_user_id column
     *
     * Example usage:
     * <code>
     * $query->filterByInvitedUserId(1234); // WHERE invited_user_id = 1234
     * $query->filterByInvitedUserId(array(12, 34)); // WHERE invited_user_id IN (12, 34)
     * $query->filterByInvitedUserId(array('min' => 12)); // WHERE invited_user_id > 12
     * </code>
     *
     * @see       filterByInviterUser()
     *
     * @param mixed $invitedUserId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByInvitedUserId($invitedUserId = null, ?string $comparison = null)
    {
        if (is_array($invitedUserId)) {
            $useMinMax = false;
            if (isset($invitedUserId['min'])) {
                $this->addUsingAlias(DialogUserTableMap::COL_INVITED_USER_ID, $invitedUserId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($invitedUserId['max'])) {
                $this->addUsingAlias(DialogUserTableMap::COL_INVITED_USER_ID, $invitedUserId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DialogUserTableMap::COL_INVITED_USER_ID, $invitedUserId, $comparison);

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
                ->addUsingAlias(DialogUserTableMap::COL_USER_ID, $user->getId(), $comparison);
        } elseif ($user instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(DialogUserTableMap::COL_USER_ID, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);

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
     * Filter the query by a related \basteyy\XzitGiggle\Models\User object
     *
     * @param \basteyy\XzitGiggle\Models\User|ObjectCollection $user The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByInviterUser($user, ?string $comparison = null)
    {
        if ($user instanceof \basteyy\XzitGiggle\Models\User) {
            return $this
                ->addUsingAlias(DialogUserTableMap::COL_INVITED_USER_ID, $user->getId(), $comparison);
        } elseif ($user instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(DialogUserTableMap::COL_INVITED_USER_ID, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByInviterUser() only accepts arguments of type \basteyy\XzitGiggle\Models\User or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the InviterUser relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinInviterUser(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('InviterUser');

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
            $this->addJoinObject($join, 'InviterUser');
        }

        return $this;
    }

    /**
     * Use the InviterUser relation User object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \basteyy\XzitGiggle\Models\UserQuery A secondary query class using the current class as primary query
     */
    public function useInviterUserQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinInviterUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'InviterUser', '\basteyy\XzitGiggle\Models\UserQuery');
    }

    /**
     * Use the InviterUser relation User object
     *
     * @param callable(\basteyy\XzitGiggle\Models\UserQuery):\basteyy\XzitGiggle\Models\UserQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withInviterUserQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useInviterUserQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the InviterUser relation to the User table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \basteyy\XzitGiggle\Models\UserQuery The inner query object of the EXISTS statement
     */
    public function useInviterUserExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \basteyy\XzitGiggle\Models\UserQuery */
        $q = $this->useExistsQuery('InviterUser', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the InviterUser relation to the User table for a NOT EXISTS query.
     *
     * @see useInviterUserExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \basteyy\XzitGiggle\Models\UserQuery The inner query object of the NOT EXISTS statement
     */
    public function useInviterUserNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \basteyy\XzitGiggle\Models\UserQuery */
        $q = $this->useExistsQuery('InviterUser', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the InviterUser relation to the User table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \basteyy\XzitGiggle\Models\UserQuery The inner query object of the IN statement
     */
    public function useInInviterUserQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \basteyy\XzitGiggle\Models\UserQuery */
        $q = $this->useInQuery('InviterUser', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the InviterUser relation to the User table for a NOT IN query.
     *
     * @see useInviterUserInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \basteyy\XzitGiggle\Models\UserQuery The inner query object of the NOT IN statement
     */
    public function useNotInInviterUserQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \basteyy\XzitGiggle\Models\UserQuery */
        $q = $this->useInQuery('InviterUser', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \basteyy\XzitGiggle\Models\Dialog object
     *
     * @param \basteyy\XzitGiggle\Models\Dialog|ObjectCollection $dialog The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDialog($dialog, ?string $comparison = null)
    {
        if ($dialog instanceof \basteyy\XzitGiggle\Models\Dialog) {
            return $this
                ->addUsingAlias(DialogUserTableMap::COL_DIALOG_ID, $dialog->getId(), $comparison);
        } elseif ($dialog instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(DialogUserTableMap::COL_DIALOG_ID, $dialog->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByDialog() only accepts arguments of type \basteyy\XzitGiggle\Models\Dialog or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Dialog relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinDialog(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Dialog');

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
            $this->addJoinObject($join, 'Dialog');
        }

        return $this;
    }

    /**
     * Use the Dialog relation Dialog object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \basteyy\XzitGiggle\Models\DialogQuery A secondary query class using the current class as primary query
     */
    public function useDialogQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinDialog($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Dialog', '\basteyy\XzitGiggle\Models\DialogQuery');
    }

    /**
     * Use the Dialog relation Dialog object
     *
     * @param callable(\basteyy\XzitGiggle\Models\DialogQuery):\basteyy\XzitGiggle\Models\DialogQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withDialogQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useDialogQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Dialog table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \basteyy\XzitGiggle\Models\DialogQuery The inner query object of the EXISTS statement
     */
    public function useDialogExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \basteyy\XzitGiggle\Models\DialogQuery */
        $q = $this->useExistsQuery('Dialog', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Dialog table for a NOT EXISTS query.
     *
     * @see useDialogExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \basteyy\XzitGiggle\Models\DialogQuery The inner query object of the NOT EXISTS statement
     */
    public function useDialogNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \basteyy\XzitGiggle\Models\DialogQuery */
        $q = $this->useExistsQuery('Dialog', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Dialog table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \basteyy\XzitGiggle\Models\DialogQuery The inner query object of the IN statement
     */
    public function useInDialogQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \basteyy\XzitGiggle\Models\DialogQuery */
        $q = $this->useInQuery('Dialog', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Dialog table for a NOT IN query.
     *
     * @see useDialogInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \basteyy\XzitGiggle\Models\DialogQuery The inner query object of the NOT IN statement
     */
    public function useNotInDialogQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \basteyy\XzitGiggle\Models\DialogQuery */
        $q = $this->useInQuery('Dialog', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildDialogUser $dialogUser Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($dialogUser = null)
    {
        if ($dialogUser) {
            $this->addUsingAlias(DialogUserTableMap::COL_ID, $dialogUser->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the xg_dialog_users table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DialogUserTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            DialogUserTableMap::clearInstancePool();
            DialogUserTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(DialogUserTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(DialogUserTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            DialogUserTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            DialogUserTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
