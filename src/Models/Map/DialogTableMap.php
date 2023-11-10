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
use basteyy\XzitGiggle\Models\Dialog;
use basteyy\XzitGiggle\Models\DialogQuery;


/**
 * This class defines the structure of the 'xg_dialogs' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class DialogTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = '..Map.DialogTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'xg_dialogs';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Dialog';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\basteyy\\XzitGiggle\\Models\\Dialog';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = '..Dialog';

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
    public const COL_ID = 'xg_dialogs.id';

    /**
     * the column name for the hash field
     */
    public const COL_HASH = 'xg_dialogs.hash';

    /**
     * the column name for the subject field
     */
    public const COL_SUBJECT = 'xg_dialogs.subject';

    /**
     * the column name for the created_user_id field
     */
    public const COL_CREATED_USER_ID = 'xg_dialogs.created_user_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'xg_dialogs.created_at';

    /**
     * the column name for the active field
     */
    public const COL_ACTIVE = 'xg_dialogs.active';

    /**
     * the column name for the is_private field
     */
    public const COL_IS_PRIVATE = 'xg_dialogs.is_private';

    /**
     * the column name for the last_message field
     */
    public const COL_LAST_MESSAGE = 'xg_dialogs.last_message';

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
        self::TYPE_PHPNAME       => ['Id', 'Hash', 'Subject', 'CreatedUserId', 'CreatedAt', 'Active', 'IsPrivate', 'LastMessage', ],
        self::TYPE_CAMELNAME     => ['id', 'hash', 'subject', 'createdUserId', 'createdAt', 'active', 'isPrivate', 'lastMessage', ],
        self::TYPE_COLNAME       => [DialogTableMap::COL_ID, DialogTableMap::COL_HASH, DialogTableMap::COL_SUBJECT, DialogTableMap::COL_CREATED_USER_ID, DialogTableMap::COL_CREATED_AT, DialogTableMap::COL_ACTIVE, DialogTableMap::COL_IS_PRIVATE, DialogTableMap::COL_LAST_MESSAGE, ],
        self::TYPE_FIELDNAME     => ['id', 'hash', 'subject', 'created_user_id', 'created_at', 'active', 'is_private', 'last_message', ],
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
        self::TYPE_PHPNAME       => ['Id' => 0, 'Hash' => 1, 'Subject' => 2, 'CreatedUserId' => 3, 'CreatedAt' => 4, 'Active' => 5, 'IsPrivate' => 6, 'LastMessage' => 7, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'hash' => 1, 'subject' => 2, 'createdUserId' => 3, 'createdAt' => 4, 'active' => 5, 'isPrivate' => 6, 'lastMessage' => 7, ],
        self::TYPE_COLNAME       => [DialogTableMap::COL_ID => 0, DialogTableMap::COL_HASH => 1, DialogTableMap::COL_SUBJECT => 2, DialogTableMap::COL_CREATED_USER_ID => 3, DialogTableMap::COL_CREATED_AT => 4, DialogTableMap::COL_ACTIVE => 5, DialogTableMap::COL_IS_PRIVATE => 6, DialogTableMap::COL_LAST_MESSAGE => 7, ],
        self::TYPE_FIELDNAME     => ['id' => 0, 'hash' => 1, 'subject' => 2, 'created_user_id' => 3, 'created_at' => 4, 'active' => 5, 'is_private' => 6, 'last_message' => 7, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'Dialog.Id' => 'ID',
        'id' => 'ID',
        'dialog.id' => 'ID',
        'DialogTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'xg_dialogs.id' => 'ID',
        'Hash' => 'HASH',
        'Dialog.Hash' => 'HASH',
        'hash' => 'HASH',
        'dialog.hash' => 'HASH',
        'DialogTableMap::COL_HASH' => 'HASH',
        'COL_HASH' => 'HASH',
        'xg_dialogs.hash' => 'HASH',
        'Subject' => 'SUBJECT',
        'Dialog.Subject' => 'SUBJECT',
        'subject' => 'SUBJECT',
        'dialog.subject' => 'SUBJECT',
        'DialogTableMap::COL_SUBJECT' => 'SUBJECT',
        'COL_SUBJECT' => 'SUBJECT',
        'xg_dialogs.subject' => 'SUBJECT',
        'CreatedUserId' => 'CREATED_USER_ID',
        'Dialog.CreatedUserId' => 'CREATED_USER_ID',
        'createdUserId' => 'CREATED_USER_ID',
        'dialog.createdUserId' => 'CREATED_USER_ID',
        'DialogTableMap::COL_CREATED_USER_ID' => 'CREATED_USER_ID',
        'COL_CREATED_USER_ID' => 'CREATED_USER_ID',
        'created_user_id' => 'CREATED_USER_ID',
        'xg_dialogs.created_user_id' => 'CREATED_USER_ID',
        'CreatedAt' => 'CREATED_AT',
        'Dialog.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'dialog.createdAt' => 'CREATED_AT',
        'DialogTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'xg_dialogs.created_at' => 'CREATED_AT',
        'Active' => 'ACTIVE',
        'Dialog.Active' => 'ACTIVE',
        'active' => 'ACTIVE',
        'dialog.active' => 'ACTIVE',
        'DialogTableMap::COL_ACTIVE' => 'ACTIVE',
        'COL_ACTIVE' => 'ACTIVE',
        'xg_dialogs.active' => 'ACTIVE',
        'IsPrivate' => 'IS_PRIVATE',
        'Dialog.IsPrivate' => 'IS_PRIVATE',
        'isPrivate' => 'IS_PRIVATE',
        'dialog.isPrivate' => 'IS_PRIVATE',
        'DialogTableMap::COL_IS_PRIVATE' => 'IS_PRIVATE',
        'COL_IS_PRIVATE' => 'IS_PRIVATE',
        'is_private' => 'IS_PRIVATE',
        'xg_dialogs.is_private' => 'IS_PRIVATE',
        'LastMessage' => 'LAST_MESSAGE',
        'Dialog.LastMessage' => 'LAST_MESSAGE',
        'lastMessage' => 'LAST_MESSAGE',
        'dialog.lastMessage' => 'LAST_MESSAGE',
        'DialogTableMap::COL_LAST_MESSAGE' => 'LAST_MESSAGE',
        'COL_LAST_MESSAGE' => 'LAST_MESSAGE',
        'last_message' => 'LAST_MESSAGE',
        'xg_dialogs.last_message' => 'LAST_MESSAGE',
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
        $this->setName('xg_dialogs');
        $this->setPhpName('Dialog');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\basteyy\\XzitGiggle\\Models\\Dialog');
        $this->setPackage('.');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('hash', 'Hash', 'VARCHAR', true, 16, 'LEFT(MD5(CURRENT_TIMESTAMP), 16)');
        $this->addColumn('subject', 'Subject', 'VARCHAR', false, 255, 'Chat');
        $this->addForeignKey('created_user_id', 'CreatedUserId', 'INTEGER', 'xg_users', 'id', true, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('active', 'Active', 'BOOLEAN', true, 1, false);
        $this->addColumn('is_private', 'IsPrivate', 'BOOLEAN', true, 1, true);
        $this->addColumn('last_message', 'LastMessage', 'TIMESTAMP', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('CreatedByUser', '\\basteyy\\XzitGiggle\\Models\\User', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':created_user_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('DialogUser', '\\basteyy\\XzitGiggle\\Models\\DialogUser', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':dialog_id',
    1 => ':id',
  ),
), null, null, 'DialogUsers', false);
        $this->addRelation('DialogUsers', '\\basteyy\\XzitGiggle\\Models\\DialogMessage', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':dialog_id',
    1 => ':id',
  ),
), null, null, 'DialogUserss', false);
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
        return $withPrefix ? DialogTableMap::CLASS_DEFAULT : DialogTableMap::OM_CLASS;
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
     * @return array (Dialog object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = DialogTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = DialogTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + DialogTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = DialogTableMap::OM_CLASS;
            /** @var Dialog $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            DialogTableMap::addInstanceToPool($obj, $key);
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
            $key = DialogTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = DialogTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Dialog $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                DialogTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(DialogTableMap::COL_ID);
            $criteria->addSelectColumn(DialogTableMap::COL_HASH);
            $criteria->addSelectColumn(DialogTableMap::COL_SUBJECT);
            $criteria->addSelectColumn(DialogTableMap::COL_CREATED_USER_ID);
            $criteria->addSelectColumn(DialogTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(DialogTableMap::COL_ACTIVE);
            $criteria->addSelectColumn(DialogTableMap::COL_IS_PRIVATE);
            $criteria->addSelectColumn(DialogTableMap::COL_LAST_MESSAGE);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.hash');
            $criteria->addSelectColumn($alias . '.subject');
            $criteria->addSelectColumn($alias . '.created_user_id');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.active');
            $criteria->addSelectColumn($alias . '.is_private');
            $criteria->addSelectColumn($alias . '.last_message');
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
            $criteria->removeSelectColumn(DialogTableMap::COL_ID);
            $criteria->removeSelectColumn(DialogTableMap::COL_HASH);
            $criteria->removeSelectColumn(DialogTableMap::COL_SUBJECT);
            $criteria->removeSelectColumn(DialogTableMap::COL_CREATED_USER_ID);
            $criteria->removeSelectColumn(DialogTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(DialogTableMap::COL_ACTIVE);
            $criteria->removeSelectColumn(DialogTableMap::COL_IS_PRIVATE);
            $criteria->removeSelectColumn(DialogTableMap::COL_LAST_MESSAGE);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.hash');
            $criteria->removeSelectColumn($alias . '.subject');
            $criteria->removeSelectColumn($alias . '.created_user_id');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.active');
            $criteria->removeSelectColumn($alias . '.is_private');
            $criteria->removeSelectColumn($alias . '.last_message');
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
        return Propel::getServiceContainer()->getDatabaseMap(DialogTableMap::DATABASE_NAME)->getTable(DialogTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Dialog or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Dialog object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(DialogTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \basteyy\XzitGiggle\Models\Dialog) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(DialogTableMap::DATABASE_NAME);
            $criteria->add(DialogTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = DialogQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            DialogTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                DialogTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the xg_dialogs table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return DialogQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Dialog or Criteria object.
     *
     * @param mixed $criteria Criteria or Dialog object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DialogTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Dialog object
        }

        if ($criteria->containsKey(DialogTableMap::COL_ID) && $criteria->keyContainsValue(DialogTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.DialogTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = DialogQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
