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
use basteyy\XzitGiggle\Models\Domain;
use basteyy\XzitGiggle\Models\DomainQuery;


/**
 * This class defines the structure of the 'xg_domains' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class DomainTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = '..Map.DomainTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'xg_domains';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Domain';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\basteyy\\XzitGiggle\\Models\\Domain';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = '..Domain';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 17;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 17;

    /**
     * the column name for the id field
     */
    public const COL_ID = 'xg_domains.id';

    /**
     * the column name for the user_id field
     */
    public const COL_USER_ID = 'xg_domains.user_id';

    /**
     * the column name for the tld field
     */
    public const COL_TLD = 'xg_domains.tld';

    /**
     * the column name for the domain field
     */
    public const COL_DOMAIN = 'xg_domains.domain';

    /**
     * the column name for the registered field
     */
    public const COL_REGISTERED = 'xg_domains.registered';

    /**
     * the column name for the www_alias field
     */
    public const COL_WWW_ALIAS = 'xg_domains.www_alias';

    /**
     * the column name for the lets_encrypt field
     */
    public const COL_LETS_ENCRYPT = 'xg_domains.lets_encrypt';

    /**
     * the column name for the ipv4 field
     */
    public const COL_IPV4 = 'xg_domains.ipv4';

    /**
     * the column name for the ipv6 field
     */
    public const COL_IPV6 = 'xg_domains.ipv6';

    /**
     * the column name for the mounting_point field
     */
    public const COL_MOUNTING_POINT = 'xg_domains.mounting_point';

    /**
     * the column name for the php_version field
     */
    public const COL_PHP_VERSION = 'xg_domains.php_version';

    /**
     * the column name for the php_pool_name field
     */
    public const COL_PHP_POOL_NAME = 'xg_domains.php_pool_name';

    /**
     * the column name for the php_pool_sock_path field
     */
    public const COL_PHP_POOL_SOCK_PATH = 'xg_domains.php_pool_sock_path';

    /**
     * the column name for the activated field
     */
    public const COL_ACTIVATED = 'xg_domains.activated';

    /**
     * the column name for the blocked field
     */
    public const COL_BLOCKED = 'xg_domains.blocked';

    /**
     * the column name for the processed field
     */
    public const COL_PROCESSED = 'xg_domains.processed';

    /**
     * the column name for the processed_at field
     */
    public const COL_PROCESSED_AT = 'xg_domains.processed_at';

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
        self::TYPE_PHPNAME       => ['Id', 'UserId', 'Tld', 'Domain', 'Registered', 'WwwAlias', 'LetsEncrypt', 'Ipv4', 'Ipv6', 'MountingPoint', 'PhpVersion', 'PhpPoolName', 'PhpPoolSockPath', 'Activated', 'Blocked', 'Processed', 'ProcessedAt', ],
        self::TYPE_CAMELNAME     => ['id', 'userId', 'tld', 'domain', 'registered', 'wwwAlias', 'letsEncrypt', 'ipv4', 'ipv6', 'mountingPoint', 'phpVersion', 'phpPoolName', 'phpPoolSockPath', 'activated', 'blocked', 'processed', 'processedAt', ],
        self::TYPE_COLNAME       => [DomainTableMap::COL_ID, DomainTableMap::COL_USER_ID, DomainTableMap::COL_TLD, DomainTableMap::COL_DOMAIN, DomainTableMap::COL_REGISTERED, DomainTableMap::COL_WWW_ALIAS, DomainTableMap::COL_LETS_ENCRYPT, DomainTableMap::COL_IPV4, DomainTableMap::COL_IPV6, DomainTableMap::COL_MOUNTING_POINT, DomainTableMap::COL_PHP_VERSION, DomainTableMap::COL_PHP_POOL_NAME, DomainTableMap::COL_PHP_POOL_SOCK_PATH, DomainTableMap::COL_ACTIVATED, DomainTableMap::COL_BLOCKED, DomainTableMap::COL_PROCESSED, DomainTableMap::COL_PROCESSED_AT, ],
        self::TYPE_FIELDNAME     => ['id', 'user_id', 'tld', 'domain', 'registered', 'www_alias', 'lets_encrypt', 'ipv4', 'ipv6', 'mounting_point', 'php_version', 'php_pool_name', 'php_pool_sock_path', 'activated', 'blocked', 'processed', 'processed_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, ]
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
        self::TYPE_PHPNAME       => ['Id' => 0, 'UserId' => 1, 'Tld' => 2, 'Domain' => 3, 'Registered' => 4, 'WwwAlias' => 5, 'LetsEncrypt' => 6, 'Ipv4' => 7, 'Ipv6' => 8, 'MountingPoint' => 9, 'PhpVersion' => 10, 'PhpPoolName' => 11, 'PhpPoolSockPath' => 12, 'Activated' => 13, 'Blocked' => 14, 'Processed' => 15, 'ProcessedAt' => 16, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'userId' => 1, 'tld' => 2, 'domain' => 3, 'registered' => 4, 'wwwAlias' => 5, 'letsEncrypt' => 6, 'ipv4' => 7, 'ipv6' => 8, 'mountingPoint' => 9, 'phpVersion' => 10, 'phpPoolName' => 11, 'phpPoolSockPath' => 12, 'activated' => 13, 'blocked' => 14, 'processed' => 15, 'processedAt' => 16, ],
        self::TYPE_COLNAME       => [DomainTableMap::COL_ID => 0, DomainTableMap::COL_USER_ID => 1, DomainTableMap::COL_TLD => 2, DomainTableMap::COL_DOMAIN => 3, DomainTableMap::COL_REGISTERED => 4, DomainTableMap::COL_WWW_ALIAS => 5, DomainTableMap::COL_LETS_ENCRYPT => 6, DomainTableMap::COL_IPV4 => 7, DomainTableMap::COL_IPV6 => 8, DomainTableMap::COL_MOUNTING_POINT => 9, DomainTableMap::COL_PHP_VERSION => 10, DomainTableMap::COL_PHP_POOL_NAME => 11, DomainTableMap::COL_PHP_POOL_SOCK_PATH => 12, DomainTableMap::COL_ACTIVATED => 13, DomainTableMap::COL_BLOCKED => 14, DomainTableMap::COL_PROCESSED => 15, DomainTableMap::COL_PROCESSED_AT => 16, ],
        self::TYPE_FIELDNAME     => ['id' => 0, 'user_id' => 1, 'tld' => 2, 'domain' => 3, 'registered' => 4, 'www_alias' => 5, 'lets_encrypt' => 6, 'ipv4' => 7, 'ipv6' => 8, 'mounting_point' => 9, 'php_version' => 10, 'php_pool_name' => 11, 'php_pool_sock_path' => 12, 'activated' => 13, 'blocked' => 14, 'processed' => 15, 'processed_at' => 16, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'Domain.Id' => 'ID',
        'id' => 'ID',
        'domain.id' => 'ID',
        'DomainTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'xg_domains.id' => 'ID',
        'UserId' => 'USER_ID',
        'Domain.UserId' => 'USER_ID',
        'userId' => 'USER_ID',
        'domain.userId' => 'USER_ID',
        'DomainTableMap::COL_USER_ID' => 'USER_ID',
        'COL_USER_ID' => 'USER_ID',
        'user_id' => 'USER_ID',
        'xg_domains.user_id' => 'USER_ID',
        'Tld' => 'TLD',
        'Domain.Tld' => 'TLD',
        'tld' => 'TLD',
        'domain.tld' => 'TLD',
        'DomainTableMap::COL_TLD' => 'TLD',
        'COL_TLD' => 'TLD',
        'xg_domains.tld' => 'TLD',
        'Domain' => 'DOMAIN',
        'Domain.Domain' => 'DOMAIN',
        'domain' => 'DOMAIN',
        'domain.domain' => 'DOMAIN',
        'DomainTableMap::COL_DOMAIN' => 'DOMAIN',
        'COL_DOMAIN' => 'DOMAIN',
        'xg_domains.domain' => 'DOMAIN',
        'Registered' => 'REGISTERED',
        'Domain.Registered' => 'REGISTERED',
        'registered' => 'REGISTERED',
        'domain.registered' => 'REGISTERED',
        'DomainTableMap::COL_REGISTERED' => 'REGISTERED',
        'COL_REGISTERED' => 'REGISTERED',
        'xg_domains.registered' => 'REGISTERED',
        'WwwAlias' => 'WWW_ALIAS',
        'Domain.WwwAlias' => 'WWW_ALIAS',
        'wwwAlias' => 'WWW_ALIAS',
        'domain.wwwAlias' => 'WWW_ALIAS',
        'DomainTableMap::COL_WWW_ALIAS' => 'WWW_ALIAS',
        'COL_WWW_ALIAS' => 'WWW_ALIAS',
        'www_alias' => 'WWW_ALIAS',
        'xg_domains.www_alias' => 'WWW_ALIAS',
        'LetsEncrypt' => 'LETS_ENCRYPT',
        'Domain.LetsEncrypt' => 'LETS_ENCRYPT',
        'letsEncrypt' => 'LETS_ENCRYPT',
        'domain.letsEncrypt' => 'LETS_ENCRYPT',
        'DomainTableMap::COL_LETS_ENCRYPT' => 'LETS_ENCRYPT',
        'COL_LETS_ENCRYPT' => 'LETS_ENCRYPT',
        'lets_encrypt' => 'LETS_ENCRYPT',
        'xg_domains.lets_encrypt' => 'LETS_ENCRYPT',
        'Ipv4' => 'IPV4',
        'Domain.Ipv4' => 'IPV4',
        'ipv4' => 'IPV4',
        'domain.ipv4' => 'IPV4',
        'DomainTableMap::COL_IPV4' => 'IPV4',
        'COL_IPV4' => 'IPV4',
        'xg_domains.ipv4' => 'IPV4',
        'Ipv6' => 'IPV6',
        'Domain.Ipv6' => 'IPV6',
        'ipv6' => 'IPV6',
        'domain.ipv6' => 'IPV6',
        'DomainTableMap::COL_IPV6' => 'IPV6',
        'COL_IPV6' => 'IPV6',
        'xg_domains.ipv6' => 'IPV6',
        'MountingPoint' => 'MOUNTING_POINT',
        'Domain.MountingPoint' => 'MOUNTING_POINT',
        'mountingPoint' => 'MOUNTING_POINT',
        'domain.mountingPoint' => 'MOUNTING_POINT',
        'DomainTableMap::COL_MOUNTING_POINT' => 'MOUNTING_POINT',
        'COL_MOUNTING_POINT' => 'MOUNTING_POINT',
        'mounting_point' => 'MOUNTING_POINT',
        'xg_domains.mounting_point' => 'MOUNTING_POINT',
        'PhpVersion' => 'PHP_VERSION',
        'Domain.PhpVersion' => 'PHP_VERSION',
        'phpVersion' => 'PHP_VERSION',
        'domain.phpVersion' => 'PHP_VERSION',
        'DomainTableMap::COL_PHP_VERSION' => 'PHP_VERSION',
        'COL_PHP_VERSION' => 'PHP_VERSION',
        'php_version' => 'PHP_VERSION',
        'xg_domains.php_version' => 'PHP_VERSION',
        'PhpPoolName' => 'PHP_POOL_NAME',
        'Domain.PhpPoolName' => 'PHP_POOL_NAME',
        'phpPoolName' => 'PHP_POOL_NAME',
        'domain.phpPoolName' => 'PHP_POOL_NAME',
        'DomainTableMap::COL_PHP_POOL_NAME' => 'PHP_POOL_NAME',
        'COL_PHP_POOL_NAME' => 'PHP_POOL_NAME',
        'php_pool_name' => 'PHP_POOL_NAME',
        'xg_domains.php_pool_name' => 'PHP_POOL_NAME',
        'PhpPoolSockPath' => 'PHP_POOL_SOCK_PATH',
        'Domain.PhpPoolSockPath' => 'PHP_POOL_SOCK_PATH',
        'phpPoolSockPath' => 'PHP_POOL_SOCK_PATH',
        'domain.phpPoolSockPath' => 'PHP_POOL_SOCK_PATH',
        'DomainTableMap::COL_PHP_POOL_SOCK_PATH' => 'PHP_POOL_SOCK_PATH',
        'COL_PHP_POOL_SOCK_PATH' => 'PHP_POOL_SOCK_PATH',
        'php_pool_sock_path' => 'PHP_POOL_SOCK_PATH',
        'xg_domains.php_pool_sock_path' => 'PHP_POOL_SOCK_PATH',
        'Activated' => 'ACTIVATED',
        'Domain.Activated' => 'ACTIVATED',
        'activated' => 'ACTIVATED',
        'domain.activated' => 'ACTIVATED',
        'DomainTableMap::COL_ACTIVATED' => 'ACTIVATED',
        'COL_ACTIVATED' => 'ACTIVATED',
        'xg_domains.activated' => 'ACTIVATED',
        'Blocked' => 'BLOCKED',
        'Domain.Blocked' => 'BLOCKED',
        'blocked' => 'BLOCKED',
        'domain.blocked' => 'BLOCKED',
        'DomainTableMap::COL_BLOCKED' => 'BLOCKED',
        'COL_BLOCKED' => 'BLOCKED',
        'xg_domains.blocked' => 'BLOCKED',
        'Processed' => 'PROCESSED',
        'Domain.Processed' => 'PROCESSED',
        'processed' => 'PROCESSED',
        'domain.processed' => 'PROCESSED',
        'DomainTableMap::COL_PROCESSED' => 'PROCESSED',
        'COL_PROCESSED' => 'PROCESSED',
        'xg_domains.processed' => 'PROCESSED',
        'ProcessedAt' => 'PROCESSED_AT',
        'Domain.ProcessedAt' => 'PROCESSED_AT',
        'processedAt' => 'PROCESSED_AT',
        'domain.processedAt' => 'PROCESSED_AT',
        'DomainTableMap::COL_PROCESSED_AT' => 'PROCESSED_AT',
        'COL_PROCESSED_AT' => 'PROCESSED_AT',
        'processed_at' => 'PROCESSED_AT',
        'xg_domains.processed_at' => 'PROCESSED_AT',
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
        $this->setName('xg_domains');
        $this->setPhpName('Domain');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\basteyy\\XzitGiggle\\Models\\Domain');
        $this->setPackage('.');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('user_id', 'UserId', 'INTEGER', 'xg_users', 'id', true, null, null);
        $this->addColumn('tld', 'Tld', 'VARCHAR', true, 255, null);
        $this->addColumn('domain', 'Domain', 'VARCHAR', true, 255, null);
        $this->addColumn('registered', 'Registered', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('www_alias', 'WwwAlias', 'BOOLEAN', true, 1, false);
        $this->addColumn('lets_encrypt', 'LetsEncrypt', 'BOOLEAN', true, 1, false);
        $this->addColumn('ipv4', 'Ipv4', 'INTEGER', true, null, null);
        $this->addColumn('ipv6', 'Ipv6', 'INTEGER', false, null, null);
        $this->addColumn('mounting_point', 'MountingPoint', 'VARCHAR', true, 255, null);
        $this->addColumn('php_version', 'PhpVersion', 'VARCHAR', true, 256, null);
        $this->addColumn('php_pool_name', 'PhpPoolName', 'VARCHAR', true, 256, null);
        $this->addColumn('php_pool_sock_path', 'PhpPoolSockPath', 'VARCHAR', true, 256, null);
        $this->addColumn('activated', 'Activated', 'BOOLEAN', true, 1, true);
        $this->addColumn('blocked', 'Blocked', 'BOOLEAN', true, 1, false);
        $this->addColumn('processed', 'Processed', 'BOOLEAN', true, 1, false);
        $this->addColumn('processed_at', 'ProcessedAt', 'TIMESTAMP', false, null, null);
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
        return $withPrefix ? DomainTableMap::CLASS_DEFAULT : DomainTableMap::OM_CLASS;
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
     * @return array (Domain object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = DomainTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = DomainTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + DomainTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = DomainTableMap::OM_CLASS;
            /** @var Domain $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            DomainTableMap::addInstanceToPool($obj, $key);
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
            $key = DomainTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = DomainTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Domain $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                DomainTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(DomainTableMap::COL_ID);
            $criteria->addSelectColumn(DomainTableMap::COL_USER_ID);
            $criteria->addSelectColumn(DomainTableMap::COL_TLD);
            $criteria->addSelectColumn(DomainTableMap::COL_DOMAIN);
            $criteria->addSelectColumn(DomainTableMap::COL_REGISTERED);
            $criteria->addSelectColumn(DomainTableMap::COL_WWW_ALIAS);
            $criteria->addSelectColumn(DomainTableMap::COL_LETS_ENCRYPT);
            $criteria->addSelectColumn(DomainTableMap::COL_IPV4);
            $criteria->addSelectColumn(DomainTableMap::COL_IPV6);
            $criteria->addSelectColumn(DomainTableMap::COL_MOUNTING_POINT);
            $criteria->addSelectColumn(DomainTableMap::COL_PHP_VERSION);
            $criteria->addSelectColumn(DomainTableMap::COL_PHP_POOL_NAME);
            $criteria->addSelectColumn(DomainTableMap::COL_PHP_POOL_SOCK_PATH);
            $criteria->addSelectColumn(DomainTableMap::COL_ACTIVATED);
            $criteria->addSelectColumn(DomainTableMap::COL_BLOCKED);
            $criteria->addSelectColumn(DomainTableMap::COL_PROCESSED);
            $criteria->addSelectColumn(DomainTableMap::COL_PROCESSED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.user_id');
            $criteria->addSelectColumn($alias . '.tld');
            $criteria->addSelectColumn($alias . '.domain');
            $criteria->addSelectColumn($alias . '.registered');
            $criteria->addSelectColumn($alias . '.www_alias');
            $criteria->addSelectColumn($alias . '.lets_encrypt');
            $criteria->addSelectColumn($alias . '.ipv4');
            $criteria->addSelectColumn($alias . '.ipv6');
            $criteria->addSelectColumn($alias . '.mounting_point');
            $criteria->addSelectColumn($alias . '.php_version');
            $criteria->addSelectColumn($alias . '.php_pool_name');
            $criteria->addSelectColumn($alias . '.php_pool_sock_path');
            $criteria->addSelectColumn($alias . '.activated');
            $criteria->addSelectColumn($alias . '.blocked');
            $criteria->addSelectColumn($alias . '.processed');
            $criteria->addSelectColumn($alias . '.processed_at');
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
            $criteria->removeSelectColumn(DomainTableMap::COL_ID);
            $criteria->removeSelectColumn(DomainTableMap::COL_USER_ID);
            $criteria->removeSelectColumn(DomainTableMap::COL_TLD);
            $criteria->removeSelectColumn(DomainTableMap::COL_DOMAIN);
            $criteria->removeSelectColumn(DomainTableMap::COL_REGISTERED);
            $criteria->removeSelectColumn(DomainTableMap::COL_WWW_ALIAS);
            $criteria->removeSelectColumn(DomainTableMap::COL_LETS_ENCRYPT);
            $criteria->removeSelectColumn(DomainTableMap::COL_IPV4);
            $criteria->removeSelectColumn(DomainTableMap::COL_IPV6);
            $criteria->removeSelectColumn(DomainTableMap::COL_MOUNTING_POINT);
            $criteria->removeSelectColumn(DomainTableMap::COL_PHP_VERSION);
            $criteria->removeSelectColumn(DomainTableMap::COL_PHP_POOL_NAME);
            $criteria->removeSelectColumn(DomainTableMap::COL_PHP_POOL_SOCK_PATH);
            $criteria->removeSelectColumn(DomainTableMap::COL_ACTIVATED);
            $criteria->removeSelectColumn(DomainTableMap::COL_BLOCKED);
            $criteria->removeSelectColumn(DomainTableMap::COL_PROCESSED);
            $criteria->removeSelectColumn(DomainTableMap::COL_PROCESSED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.user_id');
            $criteria->removeSelectColumn($alias . '.tld');
            $criteria->removeSelectColumn($alias . '.domain');
            $criteria->removeSelectColumn($alias . '.registered');
            $criteria->removeSelectColumn($alias . '.www_alias');
            $criteria->removeSelectColumn($alias . '.lets_encrypt');
            $criteria->removeSelectColumn($alias . '.ipv4');
            $criteria->removeSelectColumn($alias . '.ipv6');
            $criteria->removeSelectColumn($alias . '.mounting_point');
            $criteria->removeSelectColumn($alias . '.php_version');
            $criteria->removeSelectColumn($alias . '.php_pool_name');
            $criteria->removeSelectColumn($alias . '.php_pool_sock_path');
            $criteria->removeSelectColumn($alias . '.activated');
            $criteria->removeSelectColumn($alias . '.blocked');
            $criteria->removeSelectColumn($alias . '.processed');
            $criteria->removeSelectColumn($alias . '.processed_at');
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
        return Propel::getServiceContainer()->getDatabaseMap(DomainTableMap::DATABASE_NAME)->getTable(DomainTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Domain or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Domain object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(DomainTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \basteyy\XzitGiggle\Models\Domain) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(DomainTableMap::DATABASE_NAME);
            $criteria->add(DomainTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = DomainQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            DomainTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                DomainTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the xg_domains table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return DomainQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Domain or Criteria object.
     *
     * @param mixed $criteria Criteria or Domain object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DomainTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Domain object
        }

        if ($criteria->containsKey(DomainTableMap::COL_ID) && $criteria->keyContainsValue(DomainTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.DomainTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = DomainQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
