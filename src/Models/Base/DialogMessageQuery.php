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
use basteyy\XzitGiggle\Models\DialogMessage as ChildDialogMessage;
use basteyy\XzitGiggle\Models\DialogMessageQuery as ChildDialogMessageQuery;
use basteyy\XzitGiggle\Models\Map\DialogMessageTableMap;

/**
 * Base class that represents a query for the `xg_dialog_messages` table.
 *
 * @method     ChildDialogMessageQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildDialogMessageQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     ChildDialogMessageQuery orderByDialogId($order = Criteria::ASC) Order by the dialog_id column
 * @method     ChildDialogMessageQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildDialogMessageQuery orderByMessage($order = Criteria::ASC) Order by the message column
 *
 * @method     ChildDialogMessageQuery groupById() Group by the id column
 * @method     ChildDialogMessageQuery groupByUserId() Group by the user_id column
 * @method     ChildDialogMessageQuery groupByDialogId() Group by the dialog_id column
 * @method     ChildDialogMessageQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildDialogMessageQuery groupByMessage() Group by the message column
 *
 * @method     ChildDialogMessageQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildDialogMessageQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildDialogMessageQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildDialogMessageQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildDialogMessageQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildDialogMessageQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildDialogMessageQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     ChildDialogMessageQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     ChildDialogMessageQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     ChildDialogMessageQuery joinWithUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the User relation
 *
 * @method     ChildDialogMessageQuery leftJoinWithUser() Adds a LEFT JOIN clause and with to the query using the User relation
 * @method     ChildDialogMessageQuery rightJoinWithUser() Adds a RIGHT JOIN clause and with to the query using the User relation
 * @method     ChildDialogMessageQuery innerJoinWithUser() Adds a INNER JOIN clause and with to the query using the User relation
 *
 * @method     ChildDialogMessageQuery leftJoinDialog($relationAlias = null) Adds a LEFT JOIN clause to the query using the Dialog relation
 * @method     ChildDialogMessageQuery rightJoinDialog($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Dialog relation
 * @method     ChildDialogMessageQuery innerJoinDialog($relationAlias = null) Adds a INNER JOIN clause to the query using the Dialog relation
 *
 * @method     ChildDialogMessageQuery joinWithDialog($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Dialog relation
 *
 * @method     ChildDialogMessageQuery leftJoinWithDialog() Adds a LEFT JOIN clause and with to the query using the Dialog relation
 * @method     ChildDialogMessageQuery rightJoinWithDialog() Adds a RIGHT JOIN clause and with to the query using the Dialog relation
 * @method     ChildDialogMessageQuery innerJoinWithDialog() Adds a INNER JOIN clause and with to the query using the Dialog relation
 *
 * @method     \basteyy\XzitGiggle\Models\UserQuery|\basteyy\XzitGiggle\Models\DialogQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildDialogMessage|null findOne(?ConnectionInterface $con = null) Return the first ChildDialogMessage matching the query
 * @method     ChildDialogMessage findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildDialogMessage matching the query, or a new ChildDialogMessage object populated from the query conditions when no match is found
 *
 * @method     ChildDialogMessage|null findOneById(int $id) Return the first ChildDialogMessage filtered by the id column
 * @method     ChildDialogMessage|null findOneByUserId(int $user_id) Return the first ChildDialogMessage filtered by the user_id column
 * @method     ChildDialogMessage|null findOneByDialogId(int $dialog_id) Return the first ChildDialogMessage filtered by the dialog_id column
 * @method     ChildDialogMessage|null findOneByCreatedAt(string $created_at) Return the first ChildDialogMessage filtered by the created_at column
 * @method     ChildDialogMessage|null findOneByMessage(string $message) Return the first ChildDialogMessage filtered by the message column
 *
 * @method     ChildDialogMessage requirePk($key, ?ConnectionInterface $con = null) Return the ChildDialogMessage by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDialogMessage requireOne(?ConnectionInterface $con = null) Return the first ChildDialogMessage matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDialogMessage requireOneById(int $id) Return the first ChildDialogMessage filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDialogMessage requireOneByUserId(int $user_id) Return the first ChildDialogMessage filtered by the user_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDialogMessage requireOneByDialogId(int $dialog_id) Return the first ChildDialogMessage filtered by the dialog_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDialogMessage requireOneByCreatedAt(string $created_at) Return the first ChildDialogMessage filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDialogMessage requireOneByMessage(string $message) Return the first ChildDialogMessage filtered by the message column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDialogMessage[]|Collection find(?ConnectionInterface $con = null) Return ChildDialogMessage objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildDialogMessage> find(?ConnectionInterface $con = null) Return ChildDialogMessage objects based on current ModelCriteria
 *
 * @method     ChildDialogMessage[]|Collection findById(int|array<int> $id) Return ChildDialogMessage objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildDialogMessage> findById(int|array<int> $id) Return ChildDialogMessage objects filtered by the id column
 * @method     ChildDialogMessage[]|Collection findByUserId(int|array<int> $user_id) Return ChildDialogMessage objects filtered by the user_id column
 * @psalm-method Collection&\Traversable<ChildDialogMessage> findByUserId(int|array<int> $user_id) Return ChildDialogMessage objects filtered by the user_id column
 * @method     ChildDialogMessage[]|Collection findByDialogId(int|array<int> $dialog_id) Return ChildDialogMessage objects filtered by the dialog_id column
 * @psalm-method Collection&\Traversable<ChildDialogMessage> findByDialogId(int|array<int> $dialog_id) Return ChildDialogMessage objects filtered by the dialog_id column
 * @method     ChildDialogMessage[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildDialogMessage objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildDialogMessage> findByCreatedAt(string|array<string> $created_at) Return ChildDialogMessage objects filtered by the created_at column
 * @method     ChildDialogMessage[]|Collection findByMessage(string|array<string> $message) Return ChildDialogMessage objects filtered by the message column
 * @psalm-method Collection&\Traversable<ChildDialogMessage> findByMessage(string|array<string> $message) Return ChildDialogMessage objects filtered by the message column
 *
 * @method     ChildDialogMessage[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildDialogMessage> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class DialogMessageQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \basteyy\XzitGiggle\Models\Base\DialogMessageQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\basteyy\\XzitGiggle\\Models\\DialogMessage', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildDialogMessageQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildDialogMessageQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildDialogMessageQuery) {
            return $criteria;
        }
        $query = new ChildDialogMessageQuery();
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
     * @return ChildDialogMessage|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(DialogMessageTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = DialogMessageTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildDialogMessage A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id`, `user_id`, `dialog_id`, `created_at`, `message` FROM `xg_dialog_messages` WHERE `id` = :p0';
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
            /** @var ChildDialogMessage $obj */
            $obj = new ChildDialogMessage();
            $obj->hydrate($row);
            DialogMessageTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildDialogMessage|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(DialogMessageTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(DialogMessageTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(DialogMessageTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(DialogMessageTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DialogMessageTableMap::COL_ID, $id, $comparison);

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
                $this->addUsingAlias(DialogMessageTableMap::COL_USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(DialogMessageTableMap::COL_USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DialogMessageTableMap::COL_USER_ID, $userId, $comparison);

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
                $this->addUsingAlias(DialogMessageTableMap::COL_DIALOG_ID, $dialogId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dialogId['max'])) {
                $this->addUsingAlias(DialogMessageTableMap::COL_DIALOG_ID, $dialogId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DialogMessageTableMap::COL_DIALOG_ID, $dialogId, $comparison);

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
                $this->addUsingAlias(DialogMessageTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(DialogMessageTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DialogMessageTableMap::COL_CREATED_AT, $createdAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the message column
     *
     * Example usage:
     * <code>
     * $query->filterByMessage('fooValue');   // WHERE message = 'fooValue'
     * $query->filterByMessage('%fooValue%', Criteria::LIKE); // WHERE message LIKE '%fooValue%'
     * $query->filterByMessage(['foo', 'bar']); // WHERE message IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $message The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMessage($message = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($message)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DialogMessageTableMap::COL_MESSAGE, $message, $comparison);

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
                ->addUsingAlias(DialogMessageTableMap::COL_USER_ID, $user->getId(), $comparison);
        } elseif ($user instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(DialogMessageTableMap::COL_USER_ID, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);

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
                ->addUsingAlias(DialogMessageTableMap::COL_DIALOG_ID, $dialog->getId(), $comparison);
        } elseif ($dialog instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(DialogMessageTableMap::COL_DIALOG_ID, $dialog->toKeyValue('PrimaryKey', 'Id'), $comparison);

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
     * @param ChildDialogMessage $dialogMessage Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($dialogMessage = null)
    {
        if ($dialogMessage) {
            $this->addUsingAlias(DialogMessageTableMap::COL_ID, $dialogMessage->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the xg_dialog_messages table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DialogMessageTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            DialogMessageTableMap::clearInstancePool();
            DialogMessageTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(DialogMessageTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(DialogMessageTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            DialogMessageTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            DialogMessageTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
