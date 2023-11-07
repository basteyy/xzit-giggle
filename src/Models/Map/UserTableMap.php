<?php

namespace basteyy\XzitGiggle\Models\Map;

use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;
use basteyy\XzitGiggle\Models\User;
use basteyy\XzitGiggle\Models\UserQuery;


/**
 * This class defines the structure of the 'xg_users' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class UserTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = '..Map.UserTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'xg_users';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'User';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\basteyy\\XzitGiggle\\Models\\User';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = '..User';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 8;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 8;

    /**
     * the column name for the id field
     */
    public const COL_ID = 'xg_users.id';

    /**
     * the column name for the email field
     */
    public const COL_EMAIL = 'xg_users.email';

    /**
     * the column name for the username field
     */
    public const COL_USERNAME = 'xg_users.username';

    /**
     * the column name for the user_role_id field
     */
    public const COL_USER_ROLE_ID = 'xg_users.user_role_id';

    /**
     * the column name for the secret_key field
     */
    public const COL_SECRET_KEY = 'xg_users.secret_key';

    /**
     * the column name for the password_hash field
     */
    public const COL_PASSWORD_HASH = 'xg_users.password_hash';

    /**
     * the column name for the activated field
     */
    public const COL_ACTIVATED = 'xg_users.activated';

    /**
     * the column name for the blocked field
     */
    public const COL_BLOCKED = 'xg_users.blocked';

    /**
     * The default string format for model objects of the related table
     */
    public const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     *
     * @var array<string, mixed>
     */
    protected static $fieldNames = [
        self::TYPE_PHPNAME       => ['Id', 'Email', 'Username', 'UserRoleId', 'SecretKey', 'PasswordHash', 'Activated', 'Blocked', ],
        self::TYPE_CAMELNAME     => ['id', 'email', 'username', 'userRoleId', 'secretKey', 'passwordHash', 'activated', 'blocked', ],
        self::TYPE_COLNAME       => [UserTableMap::COL_ID, UserTableMap::COL_EMAIL, UserTableMap::COL_USERNAME, UserTableMap::COL_USER_ROLE_ID, UserTableMap::COL_SECRET_KEY, UserTableMap::COL_PASSWORD_HASH, UserTableMap::COL_ACTIVATED, UserTableMap::COL_BLOCKED, ],
        self::TYPE_FIELDNAME     => ['id', 'email', 'username', 'user_role_id', 'secret_key', 'password_hash', 'activated', 'blocked', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
    ];

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     *
     * @var array<string, mixed>
     */
    protected static $fieldKeys = [
        self::TYPE_PHPNAME       => ['Id' => 0, 'Email' => 1, 'Username' => 2, 'UserRoleId' => 3, 'SecretKey' => 4, 'PasswordHash' => 5, 'Activated' => 6, 'Blocked' => 7, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'email' => 1, 'username' => 2, 'userRoleId' => 3, 'secretKey' => 4, 'passwordHash' => 5, 'activated' => 6, 'blocked' => 7, ],
        self::TYPE_COLNAME       => [UserTableMap::COL_ID => 0, UserTableMap::COL_EMAIL => 1, UserTableMap::COL_USERNAME => 2, UserTableMap::COL_USER_ROLE_ID => 3, UserTableMap::COL_SECRET_KEY => 4, UserTableMap::COL_PASSWORD_HASH => 5, UserTableMap::COL_ACTIVATED => 6, UserTableMap::COL_BLOCKED => 7, ],
        self::TYPE_FIELDNAME     => ['id' => 0, 'email' => 1, 'username' => 2, 'user_role_id' => 3, 'secret_key' => 4, 'password_hash' => 5, 'activated' => 6, 'blocked' => 7, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'User.Id' => 'ID',
        'id' => 'ID',
        'user.id' => 'ID',
        'UserTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'xg_users.id' => 'ID',
        'Email' => 'EMAIL',
        'User.Email' => 'EMAIL',
        'email' => 'EMAIL',
        'user.email' => 'EMAIL',
        'UserTableMap::COL_EMAIL' => 'EMAIL',
        'COL_EMAIL' => 'EMAIL',
        'xg_users.email' => 'EMAIL',
        'Username' => 'USERNAME',
        'User.Username' => 'USERNAME',
        'username' => 'USERNAME',
        'user.username' => 'USERNAME',
        'UserTableMap::COL_USERNAME' => 'USERNAME',
        'COL_USERNAME' => 'USERNAME',
        'xg_users.username' => 'USERNAME',
        'UserRoleId' => 'USER_ROLE_ID',
        'User.UserRoleId' => 'USER_ROLE_ID',
        'userRoleId' => 'USER_ROLE_ID',
        'user.userRoleId' => 'USER_ROLE_ID',
        'UserTableMap::COL_USER_ROLE_ID' => 'USER_ROLE_ID',
        'COL_USER_ROLE_ID' => 'USER_ROLE_ID',
        'user_role_id' => 'USER_ROLE_ID',
        'xg_users.user_role_id' => 'USER_ROLE_ID',
        'SecretKey' => 'SECRET_KEY',
        'User.SecretKey' => 'SECRET_KEY',
        'secretKey' => 'SECRET_KEY',
        'user.secretKey' => 'SECRET_KEY',
        'UserTableMap::COL_SECRET_KEY' => 'SECRET_KEY',
        'COL_SECRET_KEY' => 'SECRET_KEY',
        'secret_key' => 'SECRET_KEY',
        'xg_users.secret_key' => 'SECRET_KEY',
        'PasswordHash' => 'PASSWORD_HASH',
        'User.PasswordHash' => 'PASSWORD_HASH',
        'passwordHash' => 'PASSWORD_HASH',
        'user.passwordHash' => 'PASSWORD_HASH',
        'UserTableMap::COL_PASSWORD_HASH' => 'PASSWORD_HASH',
        'COL_PASSWORD_HASH' => 'PASSWORD_HASH',
        'password_hash' => 'PASSWORD_HASH',
        'xg_users.password_hash' => 'PASSWORD_HASH',
        'Activated' => 'ACTIVATED',
        'User.Activated' => 'ACTIVATED',
        'activated' => 'ACTIVATED',
        'user.activated' => 'ACTIVATED',
        'UserTableMap::COL_ACTIVATED' => 'ACTIVATED',
        'COL_ACTIVATED' => 'ACTIVATED',
        'xg_users.activated' => 'ACTIVATED',
        'Blocked' => 'BLOCKED',
        'User.Blocked' => 'BLOCKED',
        'blocked' => 'BLOCKED',
        'user.blocked' => 'BLOCKED',
        'UserTableMap::COL_BLOCKED' => 'BLOCKED',
        'COL_BLOCKED' => 'BLOCKED',
        'xg_users.blocked' => 'BLOCKED',
    ];

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function initialize(): void
    {
        // attributes
        $this->setName('xg_users');
        $this->setPhpName('User');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\basteyy\\XzitGiggle\\Models\\User');
        $this->setPackage('.');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('email', 'Email', 'VARCHAR', true, 255, null);
        $this->addColumn('username', 'Username', 'VARCHAR', true, 255, null);
        $this->addForeignKey('user_role_id', 'UserRoleId', 'INTEGER', 'xg_user_roles', 'id', true, null, null);
        $this->addColumn('secret_key', 'SecretKey', 'VARCHAR', false, 128, null);
        $this->addColumn('password_hash', 'PasswordHash', 'VARCHAR', false, 256, null);
        $this->addColumn('activated', 'Activated', 'BOOLEAN', true, 1, false);
        $this->addColumn('blocked', 'Blocked', 'BOOLEAN', true, 1, false);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('UserRole', '\\basteyy\\XzitGiggle\\Models\\UserRole', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':user_role_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('IpPoolUsers', '\\basteyy\\XzitGiggle\\Models\\IpPoolUsers', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':user_id',
    1 => ':id',
  ),
), null, null, 'IpPoolUserss', false);
        $this->addRelation('Domains', '\\basteyy\\XzitGiggle\\Models\\Domain', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':user_id',
    1 => ':id',
  ),
), null, null, 'Domainss', false);
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array $row Resultset row.
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string|null The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): ?string
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array $row Resultset row.
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param bool $withPrefix Whether to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass(bool $withPrefix = true): string
    {
        return $withPrefix ? UserTableMap::CLASS_DEFAULT : UserTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array $row Row returned by DataFetcher->fetch().
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array (User object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = UserTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = UserTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + UserTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = UserTableMap::OM_CLASS;
            /** @var User $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            UserTableMap::addInstanceToPool($obj, $key);
        }

        return [$obj, $col];
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array<object>
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher): array
    {
        $results = [];

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = UserTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = UserTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var User $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                UserTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria Object containing the columns to add.
     * @param string|null $alias Optional table alias
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return void
     */
    public static function addSelectColumns(Criteria $criteria, ?string $alias = null): void
    {
        if (null === $alias) {
            $criteria->addSelectColumn(UserTableMap::COL_ID);
            $criteria->addSelectColumn(UserTableMap::COL_EMAIL);
            $criteria->addSelectColumn(UserTableMap::COL_USERNAME);
            $criteria->addSelectColumn(UserTableMap::COL_USER_ROLE_ID);
            $criteria->addSelectColumn(UserTableMap::COL_SECRET_KEY);
            $criteria->addSelectColumn(UserTableMap::COL_PASSWORD_HASH);
            $criteria->addSelectColumn(UserTableMap::COL_ACTIVATED);
            $criteria->addSelectColumn(UserTableMap::COL_BLOCKED);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.email');
            $criteria->addSelectColumn($alias . '.username');
            $criteria->addSelectColumn($alias . '.user_role_id');
            $criteria->addSelectColumn($alias . '.secret_key');
            $criteria->addSelectColumn($alias . '.password_hash');
            $criteria->addSelectColumn($alias . '.activated');
            $criteria->addSelectColumn($alias . '.blocked');
        }
    }

    /**
     * Remove all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be removed as they are only loaded on demand.
     *
     * @param Criteria $criteria Object containing the columns to remove.
     * @param string|null $alias Optional table alias
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return void
     */
    public static function removeSelectColumns(Criteria $criteria, ?string $alias = null): void
    {
        if (null === $alias) {
            $criteria->removeSelectColumn(UserTableMap::COL_ID);
            $criteria->removeSelectColumn(UserTableMap::COL_EMAIL);
            $criteria->removeSelectColumn(UserTableMap::COL_USERNAME);
            $criteria->removeSelectColumn(UserTableMap::COL_USER_ROLE_ID);
            $criteria->removeSelectColumn(UserTableMap::COL_SECRET_KEY);
            $criteria->removeSelectColumn(UserTableMap::COL_PASSWORD_HASH);
            $criteria->removeSelectColumn(UserTableMap::COL_ACTIVATED);
            $criteria->removeSelectColumn(UserTableMap::COL_BLOCKED);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.email');
            $criteria->removeSelectColumn($alias . '.username');
            $criteria->removeSelectColumn($alias . '.user_role_id');
            $criteria->removeSelectColumn($alias . '.secret_key');
            $criteria->removeSelectColumn($alias . '.password_hash');
            $criteria->removeSelectColumn($alias . '.activated');
            $criteria->removeSelectColumn($alias . '.blocked');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap(): TableMap
    {
        return Propel::getServiceContainer()->getDatabaseMap(UserTableMap::DATABASE_NAME)->getTable(UserTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a User or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or User object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ?ConnectionInterface $con = null): int
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \basteyy\XzitGiggle\Models\User) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(UserTableMap::DATABASE_NAME);
            $criteria->add(UserTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = UserQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            UserTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                UserTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the xg_users table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return UserQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a User or Criteria object.
     *
     * @param mixed $criteria Criteria or User object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from User object
        }

        if ($criteria->containsKey(UserTableMap::COL_ID) && $criteria->keyContainsValue(UserTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.UserTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = UserQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
