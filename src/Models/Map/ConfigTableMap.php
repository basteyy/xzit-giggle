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
use basteyy\XzitGiggle\Models\Config;
use basteyy\XzitGiggle\Models\ConfigQuery;


/**
 * This class defines the structure of the 'xg_config' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class ConfigTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = '..Map.ConfigTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'xg_config';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Config';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\basteyy\\XzitGiggle\\Models\\Config';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = '..Config';

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
    public const COL_ID = 'xg_config.id';

    /**
     * the column name for the key field
     */
    public const COL_KEY = 'xg_config.key';

    /**
     * the column name for the default field
     */
    public const COL_DEFAULT = 'xg_config.default';

    /**
     * the column name for the value field
     */
    public const COL_VALUE = 'xg_config.value';

    /**
     * the column name for the var_type field
     */
    public const COL_VAR_TYPE = 'xg_config.var_type';

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
        self::TYPE_PHPNAME       => ['Id', 'Key', 'Default', 'Value', 'VarType', ],
        self::TYPE_CAMELNAME     => ['id', 'key', 'default', 'value', 'varType', ],
        self::TYPE_COLNAME       => [ConfigTableMap::COL_ID, ConfigTableMap::COL_KEY, ConfigTableMap::COL_DEFAULT, ConfigTableMap::COL_VALUE, ConfigTableMap::COL_VAR_TYPE, ],
        self::TYPE_FIELDNAME     => ['id', 'key', 'default', 'value', 'var_type', ],
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
        self::TYPE_PHPNAME       => ['Id' => 0, 'Key' => 1, 'Default' => 2, 'Value' => 3, 'VarType' => 4, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'key' => 1, 'default' => 2, 'value' => 3, 'varType' => 4, ],
        self::TYPE_COLNAME       => [ConfigTableMap::COL_ID => 0, ConfigTableMap::COL_KEY => 1, ConfigTableMap::COL_DEFAULT => 2, ConfigTableMap::COL_VALUE => 3, ConfigTableMap::COL_VAR_TYPE => 4, ],
        self::TYPE_FIELDNAME     => ['id' => 0, 'key' => 1, 'default' => 2, 'value' => 3, 'var_type' => 4, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'Config.Id' => 'ID',
        'id' => 'ID',
        'config.id' => 'ID',
        'ConfigTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'xg_config.id' => 'ID',
        'Key' => 'KEY',
        'Config.Key' => 'KEY',
        'key' => 'KEY',
        'config.key' => 'KEY',
        'ConfigTableMap::COL_KEY' => 'KEY',
        'COL_KEY' => 'KEY',
        'xg_config.key' => 'KEY',
        'Default' => 'DEFAULT',
        'Config.Default' => 'DEFAULT',
        'default' => 'DEFAULT',
        'config.default' => 'DEFAULT',
        'ConfigTableMap::COL_DEFAULT' => 'DEFAULT',
        'COL_DEFAULT' => 'DEFAULT',
        'xg_config.default' => 'DEFAULT',
        'Value' => 'VALUE',
        'Config.Value' => 'VALUE',
        'value' => 'VALUE',
        'config.value' => 'VALUE',
        'ConfigTableMap::COL_VALUE' => 'VALUE',
        'COL_VALUE' => 'VALUE',
        'xg_config.value' => 'VALUE',
        'VarType' => 'VAR_TYPE',
        'Config.VarType' => 'VAR_TYPE',
        'varType' => 'VAR_TYPE',
        'config.varType' => 'VAR_TYPE',
        'ConfigTableMap::COL_VAR_TYPE' => 'VAR_TYPE',
        'COL_VAR_TYPE' => 'VAR_TYPE',
        'var_type' => 'VAR_TYPE',
        'xg_config.var_type' => 'VAR_TYPE',
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
        $this->setName('xg_config');
        $this->setPhpName('Config');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\basteyy\\XzitGiggle\\Models\\Config');
        $this->setPackage('.');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('key', 'Key', 'VARCHAR', true, 96, null);
        $this->addColumn('default', 'Default', 'VARCHAR', true, 255, null);
        $this->addColumn('value', 'Value', 'VARCHAR', true, 255, null);
        $this->addColumn('var_type', 'VarType', 'VARCHAR', true, 64, 'string');
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
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
        return $withPrefix ? ConfigTableMap::CLASS_DEFAULT : ConfigTableMap::OM_CLASS;
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
     * @return array (Config object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = ConfigTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ConfigTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ConfigTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ConfigTableMap::OM_CLASS;
            /** @var Config $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ConfigTableMap::addInstanceToPool($obj, $key);
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
            $key = ConfigTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ConfigTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Config $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ConfigTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ConfigTableMap::COL_ID);
            $criteria->addSelectColumn(ConfigTableMap::COL_KEY);
            $criteria->addSelectColumn(ConfigTableMap::COL_DEFAULT);
            $criteria->addSelectColumn(ConfigTableMap::COL_VALUE);
            $criteria->addSelectColumn(ConfigTableMap::COL_VAR_TYPE);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.key');
            $criteria->addSelectColumn($alias . '.default');
            $criteria->addSelectColumn($alias . '.value');
            $criteria->addSelectColumn($alias . '.var_type');
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
            $criteria->removeSelectColumn(ConfigTableMap::COL_ID);
            $criteria->removeSelectColumn(ConfigTableMap::COL_KEY);
            $criteria->removeSelectColumn(ConfigTableMap::COL_DEFAULT);
            $criteria->removeSelectColumn(ConfigTableMap::COL_VALUE);
            $criteria->removeSelectColumn(ConfigTableMap::COL_VAR_TYPE);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.key');
            $criteria->removeSelectColumn($alias . '.default');
            $criteria->removeSelectColumn($alias . '.value');
            $criteria->removeSelectColumn($alias . '.var_type');
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
        return Propel::getServiceContainer()->getDatabaseMap(ConfigTableMap::DATABASE_NAME)->getTable(ConfigTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Config or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Config object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ConfigTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \basteyy\XzitGiggle\Models\Config) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ConfigTableMap::DATABASE_NAME);
            $criteria->add(ConfigTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = ConfigQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ConfigTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ConfigTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the xg_config table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return ConfigQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Config or Criteria object.
     *
     * @param mixed $criteria Criteria or Config object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ConfigTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Config object
        }

        if ($criteria->containsKey(ConfigTableMap::COL_ID) && $criteria->keyContainsValue(ConfigTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ConfigTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = ConfigQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
