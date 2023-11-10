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
use basteyy\XzitGiggle\Models\DialogMessage;
use basteyy\XzitGiggle\Models\DialogMessageQuery;


/**
 * This class defines the structure of the 'xg_dialog_messages' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class DialogMessageTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = '..Map.DialogMessageTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'xg_dialog_messages';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'DialogMessage';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\basteyy\\XzitGiggle\\Models\\DialogMessage';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = '..DialogMessage';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 5;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 5;

    /**
     * the column name for the id field
     */
    public const COL_ID = 'xg_dialog_messages.id';

    /**
     * the column name for the user_id field
     */
    public const COL_USER_ID = 'xg_dialog_messages.user_id';

    /**
     * the column name for the dialog_id field
     */
    public const COL_DIALOG_ID = 'xg_dialog_messages.dialog_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'xg_dialog_messages.created_at';

    /**
     * the column name for the message field
     */
    public const COL_MESSAGE = 'xg_dialog_messages.message';

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
        self::TYPE_PHPNAME       => ['Id', 'UserId', 'DialogId', 'CreatedAt', 'Message', ],
        self::TYPE_CAMELNAME     => ['id', 'userId', 'dialogId', 'createdAt', 'message', ],
        self::TYPE_COLNAME       => [DialogMessageTableMap::COL_ID, DialogMessageTableMap::COL_USER_ID, DialogMessageTableMap::COL_DIALOG_ID, DialogMessageTableMap::COL_CREATED_AT, DialogMessageTableMap::COL_MESSAGE, ],
        self::TYPE_FIELDNAME     => ['id', 'user_id', 'dialog_id', 'created_at', 'message', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, ]
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
        self::TYPE_PHPNAME       => ['Id' => 0, 'UserId' => 1, 'DialogId' => 2, 'CreatedAt' => 3, 'Message' => 4, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'userId' => 1, 'dialogId' => 2, 'createdAt' => 3, 'message' => 4, ],
        self::TYPE_COLNAME       => [DialogMessageTableMap::COL_ID => 0, DialogMessageTableMap::COL_USER_ID => 1, DialogMessageTableMap::COL_DIALOG_ID => 2, DialogMessageTableMap::COL_CREATED_AT => 3, DialogMessageTableMap::COL_MESSAGE => 4, ],
        self::TYPE_FIELDNAME     => ['id' => 0, 'user_id' => 1, 'dialog_id' => 2, 'created_at' => 3, 'message' => 4, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'DialogMessage.Id' => 'ID',
        'id' => 'ID',
        'dialogMessage.id' => 'ID',
        'DialogMessageTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'xg_dialog_messages.id' => 'ID',
        'UserId' => 'USER_ID',
        'DialogMessage.UserId' => 'USER_ID',
        'userId' => 'USER_ID',
        'dialogMessage.userId' => 'USER_ID',
        'DialogMessageTableMap::COL_USER_ID' => 'USER_ID',
        'COL_USER_ID' => 'USER_ID',
        'user_id' => 'USER_ID',
        'xg_dialog_messages.user_id' => 'USER_ID',
        'DialogId' => 'DIALOG_ID',
        'DialogMessage.DialogId' => 'DIALOG_ID',
        'dialogId' => 'DIALOG_ID',
        'dialogMessage.dialogId' => 'DIALOG_ID',
        'DialogMessageTableMap::COL_DIALOG_ID' => 'DIALOG_ID',
        'COL_DIALOG_ID' => 'DIALOG_ID',
        'dialog_id' => 'DIALOG_ID',
        'xg_dialog_messages.dialog_id' => 'DIALOG_ID',
        'CreatedAt' => 'CREATED_AT',
        'DialogMessage.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'dialogMessage.createdAt' => 'CREATED_AT',
        'DialogMessageTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'xg_dialog_messages.created_at' => 'CREATED_AT',
        'Message' => 'MESSAGE',
        'DialogMessage.Message' => 'MESSAGE',
        'message' => 'MESSAGE',
        'dialogMessage.message' => 'MESSAGE',
        'DialogMessageTableMap::COL_MESSAGE' => 'MESSAGE',
        'COL_MESSAGE' => 'MESSAGE',
        'xg_dialog_messages.message' => 'MESSAGE',
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
        $this->setName('xg_dialog_messages');
        $this->setPhpName('DialogMessage');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\basteyy\\XzitGiggle\\Models\\DialogMessage');
        $this->setPackage('.');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('user_id', 'UserId', 'INTEGER', 'xg_users', 'id', true, null, null);
        $this->addForeignKey('dialog_id', 'DialogId', 'INTEGER', 'xg_dialogs', 'id', true, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('message', 'Message', 'VARCHAR', true, 2048, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('User', '\\basteyy\\XzitGiggle\\Models\\User', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':user_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('Dialog', '\\basteyy\\XzitGiggle\\Models\\Dialog', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':dialog_id',
    1 => ':id',
  ),
), null, null, null, false);
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
        return $withPrefix ? DialogMessageTableMap::CLASS_DEFAULT : DialogMessageTableMap::OM_CLASS;
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
     * @return array (DialogMessage object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = DialogMessageTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = DialogMessageTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + DialogMessageTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = DialogMessageTableMap::OM_CLASS;
            /** @var DialogMessage $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            DialogMessageTableMap::addInstanceToPool($obj, $key);
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
            $key = DialogMessageTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = DialogMessageTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var DialogMessage $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                DialogMessageTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(DialogMessageTableMap::COL_ID);
            $criteria->addSelectColumn(DialogMessageTableMap::COL_USER_ID);
            $criteria->addSelectColumn(DialogMessageTableMap::COL_DIALOG_ID);
            $criteria->addSelectColumn(DialogMessageTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(DialogMessageTableMap::COL_MESSAGE);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.user_id');
            $criteria->addSelectColumn($alias . '.dialog_id');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.message');
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
            $criteria->removeSelectColumn(DialogMessageTableMap::COL_ID);
            $criteria->removeSelectColumn(DialogMessageTableMap::COL_USER_ID);
            $criteria->removeSelectColumn(DialogMessageTableMap::COL_DIALOG_ID);
            $criteria->removeSelectColumn(DialogMessageTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(DialogMessageTableMap::COL_MESSAGE);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.user_id');
            $criteria->removeSelectColumn($alias . '.dialog_id');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.message');
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
        return Propel::getServiceContainer()->getDatabaseMap(DialogMessageTableMap::DATABASE_NAME)->getTable(DialogMessageTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a DialogMessage or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or DialogMessage object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(DialogMessageTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \basteyy\XzitGiggle\Models\DialogMessage) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(DialogMessageTableMap::DATABASE_NAME);
            $criteria->add(DialogMessageTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = DialogMessageQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            DialogMessageTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                DialogMessageTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the xg_dialog_messages table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return DialogMessageQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a DialogMessage or Criteria object.
     *
     * @param mixed $criteria Criteria or DialogMessage object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DialogMessageTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from DialogMessage object
        }

        if ($criteria->containsKey(DialogMessageTableMap::COL_ID) && $criteria->keyContainsValue(DialogMessageTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.DialogMessageTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = DialogMessageQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
