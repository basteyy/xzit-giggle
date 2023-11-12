<?php

namespace basteyy\XzitGiggle\Models\Base;

use \DateTime;
use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;
use basteyy\XzitGiggle\Models\DomainQuery as ChildDomainQuery;
use basteyy\XzitGiggle\Models\User as ChildUser;
use basteyy\XzitGiggle\Models\UserQuery as ChildUserQuery;
use basteyy\XzitGiggle\Models\Map\DomainTableMap;

/**
 * Base class that represents a row from the 'xg_domains' table.
 *
 *
 *
 * @package    propel.generator...Base
 */
abstract class Domain implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\basteyy\\XzitGiggle\\Models\\Map\\DomainTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var bool
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var bool
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = [];

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = [];

    /**
     * The value for the id field.
     *
     * @var        int
     */
    protected $id;

    /**
     * The value for the user_id field.
     *
     * @var        int
     */
    protected $user_id;

    /**
     * The value for the tld field.
     *
     * @var        string
     */
    protected $tld;

    /**
     * The value for the domain field.
     *
     * @var        string
     */
    protected $domain;

    /**
     * The value for the registered field.
     *
     * Note: this column has a database default value of: (expression) CURRENT_TIMESTAMP
     * @var        DateTime
     */
    protected $registered;

    /**
     * The value for the www_alias field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $www_alias;

    /**
     * The value for the lets_encrypt field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $lets_encrypt;

    /**
     * The value for the ipv4 field.
     *
     * @var        int
     */
    protected $ipv4;

    /**
     * The value for the ipv6 field.
     *
     * @var        int|null
     */
    protected $ipv6;

    /**
     * The value for the mounting_point field.
     *
     * @var        string
     */
    protected $mounting_point;

    /**
     * The value for the php_version field.
     *
     * @var        string
     */
    protected $php_version;

    /**
     * The value for the php_pool_name field.
     *
     * @var        string
     */
    protected $php_pool_name;

    /**
     * The value for the php_pool_sock_path field.
     *
     * @var        string
     */
    protected $php_pool_sock_path;

    /**
     * The value for the activated field.
     *
     * Note: this column has a database default value of: true
     * @var        boolean
     */
    protected $activated;

    /**
     * The value for the blocked field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $blocked;

    /**
     * The value for the processed field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $processed;

    /**
     * The value for the processed_at field.
     *
     * @var        DateTime|null
     */
    protected $processed_at;

    /**
     * @var        ChildUser
     */
    protected $aUser;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->www_alias = false;
        $this->lets_encrypt = false;
        $this->activated = true;
        $this->blocked = false;
        $this->processed = false;
    }

    /**
     * Initializes internal state of basteyy\XzitGiggle\Models\Base\Domain object.
     * @see applyDefaults()
     */
    public function __construct()
    {
        $this->applyDefaultValues();
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return bool True if the object has been modified.
     */
    public function isModified(): bool
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param string $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return bool True if $col has been modified.
     */
    public function isColumnModified(string $col): bool
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns(): array
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return bool True, if the object has never been persisted.
     */
    public function isNew(): bool
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param bool $b the state of the object.
     */
    public function setNew(bool $b): void
    {
        $this->new = $b;
    }

    /**
     * Whether this object has been deleted.
     * @return bool The deleted state of this object.
     */
    public function isDeleted(): bool
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param bool $b The deleted state of this object.
     * @return void
     */
    public function setDeleted(bool $b): void
    {
        $this->deleted = $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified(?string $col = null): void
    {
        if (null !== $col) {
            unset($this->modifiedColumns[$col]);
        } else {
            $this->modifiedColumns = [];
        }
    }

    /**
     * Compares this with another <code>Domain</code> instance.  If
     * <code>obj</code> is an instance of <code>Domain</code>, delegates to
     * <code>equals(Domain)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param mixed $obj The object to compare to.
     * @return bool Whether equal to the object specified.
     */
    public function equals($obj): bool
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns(): array
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param string $name The virtual column name
     * @return bool
     */
    public function hasVirtualColumn(string $name): bool
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param string $name The virtual column name
     * @return mixed
     *
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getVirtualColumn(string $name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of nonexistent virtual column `%s`.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name The virtual column name
     * @param mixed $value The value to give to the virtual column
     *
     * @return $this The current object, for fluid interface
     */
    public function setVirtualColumn(string $name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param string $msg
     * @param int $priority One of the Propel::LOG_* logging levels
     * @return void
     */
    protected function log(string $msg, int $priority = Propel::LOG_INFO): void
    {
        Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param \Propel\Runtime\Parser\AbstractParser|string $parser An AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param bool $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @param string $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME, TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM. Defaults to TableMap::TYPE_PHPNAME.
     * @return string The exported data
     */
    public function exportTo($parser, bool $includeLazyLoadColumns = true, string $keyType = TableMap::TYPE_PHPNAME): string
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray($keyType, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     *
     * @return array<string>
     */
    public function __sleep(): array
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the [user_id] column value.
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Get the [tld] column value.
     *
     * @return string
     */
    public function getTld()
    {
        return $this->tld;
    }

    /**
     * Get the [domain] column value.
     *
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * Get the [optionally formatted] temporal [registered] column value.
     *
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), and 0 if column value is 0000-00-00 00:00:00.
     *
     * @throws \Propel\Runtime\Exception\PropelException - if unable to parse/validate the date/time value.
     *
     * @psalm-return ($format is null ? DateTime : string)
     */
    public function getRegistered($format = null)
    {
        if ($format === null) {
            return $this->registered;
        } else {
            return $this->registered instanceof \DateTimeInterface ? $this->registered->format($format) : null;
        }
    }

    /**
     * Get the [www_alias] column value.
     *
     * @return boolean
     */
    public function getWwwAlias()
    {
        return $this->www_alias;
    }

    /**
     * Get the [www_alias] column value.
     *
     * @return boolean
     */
    public function isWwwAlias()
    {
        return $this->getWwwAlias();
    }

    /**
     * Get the [lets_encrypt] column value.
     *
     * @return boolean
     */
    public function getLetsEncrypt()
    {
        return $this->lets_encrypt;
    }

    /**
     * Get the [lets_encrypt] column value.
     *
     * @return boolean
     */
    public function isLetsEncrypt()
    {
        return $this->getLetsEncrypt();
    }

    /**
     * Get the [ipv4] column value.
     *
     * @return int
     */
    public function getIpv4()
    {
        return $this->ipv4;
    }

    /**
     * Get the [ipv6] column value.
     *
     * @return int|null
     */
    public function getIpv6()
    {
        return $this->ipv6;
    }

    /**
     * Get the [mounting_point] column value.
     *
     * @return string
     */
    public function getMountingPoint()
    {
        return $this->mounting_point;
    }

    /**
     * Get the [php_version] column value.
     *
     * @return string
     */
    public function getPhpVersion()
    {
        return $this->php_version;
    }

    /**
     * Get the [php_pool_name] column value.
     *
     * @return string
     */
    public function getPhpPoolName()
    {
        return $this->php_pool_name;
    }

    /**
     * Get the [php_pool_sock_path] column value.
     *
     * @return string
     */
    public function getPhpPoolSockPath()
    {
        return $this->php_pool_sock_path;
    }

    /**
     * Get the [activated] column value.
     *
     * @return boolean
     */
    public function getActivated()
    {
        return $this->activated;
    }

    /**
     * Get the [activated] column value.
     *
     * @return boolean
     */
    public function isActivated()
    {
        return $this->getActivated();
    }

    /**
     * Get the [blocked] column value.
     *
     * @return boolean
     */
    public function getBlocked()
    {
        return $this->blocked;
    }

    /**
     * Get the [blocked] column value.
     *
     * @return boolean
     */
    public function isBlocked()
    {
        return $this->getBlocked();
    }

    /**
     * Get the [processed] column value.
     *
     * @return boolean
     */
    public function getProcessed()
    {
        return $this->processed;
    }

    /**
     * Get the [processed] column value.
     *
     * @return boolean
     */
    public function isProcessed()
    {
        return $this->getProcessed();
    }

    /**
     * Get the [optionally formatted] temporal [processed_at] column value.
     *
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime|null Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00.
     *
     * @throws \Propel\Runtime\Exception\PropelException - if unable to parse/validate the date/time value.
     *
     * @psalm-return ($format is null ? DateTime|null : string|null)
     */
    public function getProcessedAt($format = null)
    {
        if ($format === null) {
            return $this->processed_at;
        } else {
            return $this->processed_at instanceof \DateTimeInterface ? $this->processed_at->format($format) : null;
        }
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[DomainTableMap::COL_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [user_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setUserId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->user_id !== $v) {
            $this->user_id = $v;
            $this->modifiedColumns[DomainTableMap::COL_USER_ID] = true;
        }

        if ($this->aUser !== null && $this->aUser->getId() !== $v) {
            $this->aUser = null;
        }

        return $this;
    }

    /**
     * Set the value of [tld] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setTld($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->tld !== $v) {
            $this->tld = $v;
            $this->modifiedColumns[DomainTableMap::COL_TLD] = true;
        }

        return $this;
    }

    /**
     * Set the value of [domain] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDomain($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->domain !== $v) {
            $this->domain = $v;
            $this->modifiedColumns[DomainTableMap::COL_DOMAIN] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [registered] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setRegistered($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->registered !== null || $dt !== null) {
            if ($this->registered === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->registered->format("Y-m-d H:i:s.u")) {
                $this->registered = $dt === null ? null : clone $dt;
                $this->modifiedColumns[DomainTableMap::COL_REGISTERED] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Sets the value of the [www_alias] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param bool|integer|string $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setWwwAlias($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->www_alias !== $v) {
            $this->www_alias = $v;
            $this->modifiedColumns[DomainTableMap::COL_WWW_ALIAS] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [lets_encrypt] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param bool|integer|string $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setLetsEncrypt($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->lets_encrypt !== $v) {
            $this->lets_encrypt = $v;
            $this->modifiedColumns[DomainTableMap::COL_LETS_ENCRYPT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [ipv4] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIpv4($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->ipv4 !== $v) {
            $this->ipv4 = $v;
            $this->modifiedColumns[DomainTableMap::COL_IPV4] = true;
        }

        return $this;
    }

    /**
     * Set the value of [ipv6] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIpv6($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->ipv6 !== $v) {
            $this->ipv6 = $v;
            $this->modifiedColumns[DomainTableMap::COL_IPV6] = true;
        }

        return $this;
    }

    /**
     * Set the value of [mounting_point] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setMountingPoint($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->mounting_point !== $v) {
            $this->mounting_point = $v;
            $this->modifiedColumns[DomainTableMap::COL_MOUNTING_POINT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [php_version] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPhpVersion($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->php_version !== $v) {
            $this->php_version = $v;
            $this->modifiedColumns[DomainTableMap::COL_PHP_VERSION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [php_pool_name] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPhpPoolName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->php_pool_name !== $v) {
            $this->php_pool_name = $v;
            $this->modifiedColumns[DomainTableMap::COL_PHP_POOL_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [php_pool_sock_path] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPhpPoolSockPath($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->php_pool_sock_path !== $v) {
            $this->php_pool_sock_path = $v;
            $this->modifiedColumns[DomainTableMap::COL_PHP_POOL_SOCK_PATH] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [activated] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param bool|integer|string $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setActivated($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->activated !== $v) {
            $this->activated = $v;
            $this->modifiedColumns[DomainTableMap::COL_ACTIVATED] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [blocked] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param bool|integer|string $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setBlocked($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->blocked !== $v) {
            $this->blocked = $v;
            $this->modifiedColumns[DomainTableMap::COL_BLOCKED] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [processed] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param bool|integer|string $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setProcessed($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->processed !== $v) {
            $this->processed = $v;
            $this->modifiedColumns[DomainTableMap::COL_PROCESSED] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [processed_at] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setProcessedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->processed_at !== null || $dt !== null) {
            if ($this->processed_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->processed_at->format("Y-m-d H:i:s.u")) {
                $this->processed_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[DomainTableMap::COL_PROCESSED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return bool Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues(): bool
    {
            if ($this->www_alias !== false) {
                return false;
            }

            if ($this->lets_encrypt !== false) {
                return false;
            }

            if ($this->activated !== true) {
                return false;
            }

            if ($this->blocked !== false) {
                return false;
            }

            if ($this->processed !== false) {
                return false;
            }

        // otherwise, everything was equal, so return TRUE
        return true;
    }

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array $row The row returned by DataFetcher->fetch().
     * @param int $startcol 0-based offset column which indicates which resultset column to start with.
     * @param bool $rehydrate Whether this object is being re-hydrated from the database.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int next starting column
     * @throws \Propel\Runtime\Exception\PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate(array $row, int $startcol = 0, bool $rehydrate = false, string $indexType = TableMap::TYPE_NUM): int
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : DomainTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : DomainTableMap::translateFieldName('UserId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->user_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : DomainTableMap::translateFieldName('Tld', TableMap::TYPE_PHPNAME, $indexType)];
            $this->tld = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : DomainTableMap::translateFieldName('Domain', TableMap::TYPE_PHPNAME, $indexType)];
            $this->domain = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : DomainTableMap::translateFieldName('Registered', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->registered = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : DomainTableMap::translateFieldName('WwwAlias', TableMap::TYPE_PHPNAME, $indexType)];
            $this->www_alias = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : DomainTableMap::translateFieldName('LetsEncrypt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->lets_encrypt = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : DomainTableMap::translateFieldName('Ipv4', TableMap::TYPE_PHPNAME, $indexType)];
            $this->ipv4 = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : DomainTableMap::translateFieldName('Ipv6', TableMap::TYPE_PHPNAME, $indexType)];
            $this->ipv6 = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : DomainTableMap::translateFieldName('MountingPoint', TableMap::TYPE_PHPNAME, $indexType)];
            $this->mounting_point = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : DomainTableMap::translateFieldName('PhpVersion', TableMap::TYPE_PHPNAME, $indexType)];
            $this->php_version = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : DomainTableMap::translateFieldName('PhpPoolName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->php_pool_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : DomainTableMap::translateFieldName('PhpPoolSockPath', TableMap::TYPE_PHPNAME, $indexType)];
            $this->php_pool_sock_path = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : DomainTableMap::translateFieldName('Activated', TableMap::TYPE_PHPNAME, $indexType)];
            $this->activated = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : DomainTableMap::translateFieldName('Blocked', TableMap::TYPE_PHPNAME, $indexType)];
            $this->blocked = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : DomainTableMap::translateFieldName('Processed', TableMap::TYPE_PHPNAME, $indexType)];
            $this->processed = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : DomainTableMap::translateFieldName('ProcessedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->processed_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 17; // 17 = DomainTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\basteyy\\XzitGiggle\\Models\\Domain'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function ensureConsistency(): void
    {
        if ($this->aUser !== null && $this->user_id !== $this->aUser->getId()) {
            $this->aUser = null;
        }
    }

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param bool $deep (optional) Whether to also de-associated any related objects.
     * @param ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload(bool $deep = false, ?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(DomainTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildDomainQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aUser = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see Domain::setDeleted()
     * @see Domain::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(DomainTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildDomainQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param ConnectionInterface $con
     * @return int The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws \Propel\Runtime\Exception\PropelException
     * @see doSave()
     */
    public function save(?ConnectionInterface $con = null): int
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($this->alreadyInSave) {
            return 0;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(DomainTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                DomainTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param ConnectionInterface $con
     * @return int The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws \Propel\Runtime\Exception\PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con): int
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aUser !== null) {
                if ($this->aUser->isModified() || $this->aUser->isNew()) {
                    $affectedRows += $this->aUser->save($con);
                }
                $this->setUser($this->aUser);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    }

    /**
     * Insert the row in the database.
     *
     * @param ConnectionInterface $con
     *
     * @throws \Propel\Runtime\Exception\PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con): void
    {
        $modifiedColumns = [];
        $index = 0;

        $this->modifiedColumns[DomainTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . DomainTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(DomainTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(DomainTableMap::COL_USER_ID)) {
            $modifiedColumns[':p' . $index++]  = '`user_id`';
        }
        if ($this->isColumnModified(DomainTableMap::COL_TLD)) {
            $modifiedColumns[':p' . $index++]  = '`tld`';
        }
        if ($this->isColumnModified(DomainTableMap::COL_DOMAIN)) {
            $modifiedColumns[':p' . $index++]  = '`domain`';
        }
        if ($this->isColumnModified(DomainTableMap::COL_REGISTERED)) {
            $modifiedColumns[':p' . $index++]  = '`registered`';
        }
        if ($this->isColumnModified(DomainTableMap::COL_WWW_ALIAS)) {
            $modifiedColumns[':p' . $index++]  = '`www_alias`';
        }
        if ($this->isColumnModified(DomainTableMap::COL_LETS_ENCRYPT)) {
            $modifiedColumns[':p' . $index++]  = '`lets_encrypt`';
        }
        if ($this->isColumnModified(DomainTableMap::COL_IPV4)) {
            $modifiedColumns[':p' . $index++]  = '`ipv4`';
        }
        if ($this->isColumnModified(DomainTableMap::COL_IPV6)) {
            $modifiedColumns[':p' . $index++]  = '`ipv6`';
        }
        if ($this->isColumnModified(DomainTableMap::COL_MOUNTING_POINT)) {
            $modifiedColumns[':p' . $index++]  = '`mounting_point`';
        }
        if ($this->isColumnModified(DomainTableMap::COL_PHP_VERSION)) {
            $modifiedColumns[':p' . $index++]  = '`php_version`';
        }
        if ($this->isColumnModified(DomainTableMap::COL_PHP_POOL_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`php_pool_name`';
        }
        if ($this->isColumnModified(DomainTableMap::COL_PHP_POOL_SOCK_PATH)) {
            $modifiedColumns[':p' . $index++]  = '`php_pool_sock_path`';
        }
        if ($this->isColumnModified(DomainTableMap::COL_ACTIVATED)) {
            $modifiedColumns[':p' . $index++]  = '`activated`';
        }
        if ($this->isColumnModified(DomainTableMap::COL_BLOCKED)) {
            $modifiedColumns[':p' . $index++]  = '`blocked`';
        }
        if ($this->isColumnModified(DomainTableMap::COL_PROCESSED)) {
            $modifiedColumns[':p' . $index++]  = '`processed`';
        }
        if ($this->isColumnModified(DomainTableMap::COL_PROCESSED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`processed_at`';
        }

        $sql = sprintf(
            'INSERT INTO `xg_domains` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`id`':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);

                        break;
                    case '`user_id`':
                        $stmt->bindValue($identifier, $this->user_id, PDO::PARAM_INT);

                        break;
                    case '`tld`':
                        $stmt->bindValue($identifier, $this->tld, PDO::PARAM_STR);

                        break;
                    case '`domain`':
                        $stmt->bindValue($identifier, $this->domain, PDO::PARAM_STR);

                        break;
                    case '`registered`':
                        $stmt->bindValue($identifier, $this->registered ? $this->registered->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case '`www_alias`':
                        $stmt->bindValue($identifier, (int) $this->www_alias, PDO::PARAM_INT);

                        break;
                    case '`lets_encrypt`':
                        $stmt->bindValue($identifier, (int) $this->lets_encrypt, PDO::PARAM_INT);

                        break;
                    case '`ipv4`':
                        $stmt->bindValue($identifier, $this->ipv4, PDO::PARAM_INT);

                        break;
                    case '`ipv6`':
                        $stmt->bindValue($identifier, $this->ipv6, PDO::PARAM_INT);

                        break;
                    case '`mounting_point`':
                        $stmt->bindValue($identifier, $this->mounting_point, PDO::PARAM_STR);

                        break;
                    case '`php_version`':
                        $stmt->bindValue($identifier, $this->php_version, PDO::PARAM_STR);

                        break;
                    case '`php_pool_name`':
                        $stmt->bindValue($identifier, $this->php_pool_name, PDO::PARAM_STR);

                        break;
                    case '`php_pool_sock_path`':
                        $stmt->bindValue($identifier, $this->php_pool_sock_path, PDO::PARAM_STR);

                        break;
                    case '`activated`':
                        $stmt->bindValue($identifier, (int) $this->activated, PDO::PARAM_INT);

                        break;
                    case '`blocked`':
                        $stmt->bindValue($identifier, (int) $this->blocked, PDO::PARAM_INT);

                        break;
                    case '`processed`':
                        $stmt->bindValue($identifier, (int) $this->processed, PDO::PARAM_INT);

                        break;
                    case '`processed_at`':
                        $stmt->bindValue($identifier, $this->processed_at ? $this->processed_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param ConnectionInterface $con
     *
     * @return int Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con): int
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param string $name name
     * @param string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName(string $name, string $type = TableMap::TYPE_PHPNAME)
    {
        $pos = DomainTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos Position in XML schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition(int $pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();

            case 1:
                return $this->getUserId();

            case 2:
                return $this->getTld();

            case 3:
                return $this->getDomain();

            case 4:
                return $this->getRegistered();

            case 5:
                return $this->getWwwAlias();

            case 6:
                return $this->getLetsEncrypt();

            case 7:
                return $this->getIpv4();

            case 8:
                return $this->getIpv6();

            case 9:
                return $this->getMountingPoint();

            case 10:
                return $this->getPhpVersion();

            case 11:
                return $this->getPhpPoolName();

            case 12:
                return $this->getPhpPoolSockPath();

            case 13:
                return $this->getActivated();

            case 14:
                return $this->getBlocked();

            case 15:
                return $this->getProcessed();

            case 16:
                return $this->getProcessedAt();

            default:
                return null;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param string $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param bool $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param bool $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array An associative array containing the field names (as keys) and field values
     */
    public function toArray(string $keyType = TableMap::TYPE_PHPNAME, bool $includeLazyLoadColumns = true, array $alreadyDumpedObjects = [], bool $includeForeignObjects = false): array
    {
        if (isset($alreadyDumpedObjects['Domain'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['Domain'][$this->hashCode()] = true;
        $keys = DomainTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getId(),
            $keys[1] => $this->getUserId(),
            $keys[2] => $this->getTld(),
            $keys[3] => $this->getDomain(),
            $keys[4] => $this->getRegistered(),
            $keys[5] => $this->getWwwAlias(),
            $keys[6] => $this->getLetsEncrypt(),
            $keys[7] => $this->getIpv4(),
            $keys[8] => $this->getIpv6(),
            $keys[9] => $this->getMountingPoint(),
            $keys[10] => $this->getPhpVersion(),
            $keys[11] => $this->getPhpPoolName(),
            $keys[12] => $this->getPhpPoolSockPath(),
            $keys[13] => $this->getActivated(),
            $keys[14] => $this->getBlocked(),
            $keys[15] => $this->getProcessed(),
            $keys[16] => $this->getProcessedAt(),
        ];
        if ($result[$keys[4]] instanceof \DateTimeInterface) {
            $result[$keys[4]] = $result[$keys[4]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[16]] instanceof \DateTimeInterface) {
            $result[$keys[16]] = $result[$keys[16]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aUser) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'user';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'xg_users';
                        break;
                    default:
                        $key = 'User';
                }

                $result[$key] = $this->aUser->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param string $name
     * @param mixed $value field value
     * @param string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this
     */
    public function setByName(string $name, $value, string $type = TableMap::TYPE_PHPNAME)
    {
        $pos = DomainTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        $this->setByPosition($pos, $value);

        return $this;
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @param mixed $value field value
     * @return $this
     */
    public function setByPosition(int $pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setUserId($value);
                break;
            case 2:
                $this->setTld($value);
                break;
            case 3:
                $this->setDomain($value);
                break;
            case 4:
                $this->setRegistered($value);
                break;
            case 5:
                $this->setWwwAlias($value);
                break;
            case 6:
                $this->setLetsEncrypt($value);
                break;
            case 7:
                $this->setIpv4($value);
                break;
            case 8:
                $this->setIpv6($value);
                break;
            case 9:
                $this->setMountingPoint($value);
                break;
            case 10:
                $this->setPhpVersion($value);
                break;
            case 11:
                $this->setPhpPoolName($value);
                break;
            case 12:
                $this->setPhpPoolSockPath($value);
                break;
            case 13:
                $this->setActivated($value);
                break;
            case 14:
                $this->setBlocked($value);
                break;
            case 15:
                $this->setProcessed($value);
                break;
            case 16:
                $this->setProcessedAt($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param array $arr An array to populate the object from.
     * @param string $keyType The type of keys the array uses.
     * @return $this
     */
    public function fromArray(array $arr, string $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = DomainTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setUserId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setTld($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setDomain($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setRegistered($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setWwwAlias($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setLetsEncrypt($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setIpv4($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setIpv6($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setMountingPoint($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setPhpVersion($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setPhpPoolName($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setPhpPoolSockPath($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setActivated($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setBlocked($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setProcessed($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setProcessedAt($arr[$keys[16]]);
        }

        return $this;
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this The current object, for fluid interface
     */
    public function importFrom($parser, string $data, string $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return \Propel\Runtime\ActiveQuery\Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria(): Criteria
    {
        $criteria = new Criteria(DomainTableMap::DATABASE_NAME);

        if ($this->isColumnModified(DomainTableMap::COL_ID)) {
            $criteria->add(DomainTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(DomainTableMap::COL_USER_ID)) {
            $criteria->add(DomainTableMap::COL_USER_ID, $this->user_id);
        }
        if ($this->isColumnModified(DomainTableMap::COL_TLD)) {
            $criteria->add(DomainTableMap::COL_TLD, $this->tld);
        }
        if ($this->isColumnModified(DomainTableMap::COL_DOMAIN)) {
            $criteria->add(DomainTableMap::COL_DOMAIN, $this->domain);
        }
        if ($this->isColumnModified(DomainTableMap::COL_REGISTERED)) {
            $criteria->add(DomainTableMap::COL_REGISTERED, $this->registered);
        }
        if ($this->isColumnModified(DomainTableMap::COL_WWW_ALIAS)) {
            $criteria->add(DomainTableMap::COL_WWW_ALIAS, $this->www_alias);
        }
        if ($this->isColumnModified(DomainTableMap::COL_LETS_ENCRYPT)) {
            $criteria->add(DomainTableMap::COL_LETS_ENCRYPT, $this->lets_encrypt);
        }
        if ($this->isColumnModified(DomainTableMap::COL_IPV4)) {
            $criteria->add(DomainTableMap::COL_IPV4, $this->ipv4);
        }
        if ($this->isColumnModified(DomainTableMap::COL_IPV6)) {
            $criteria->add(DomainTableMap::COL_IPV6, $this->ipv6);
        }
        if ($this->isColumnModified(DomainTableMap::COL_MOUNTING_POINT)) {
            $criteria->add(DomainTableMap::COL_MOUNTING_POINT, $this->mounting_point);
        }
        if ($this->isColumnModified(DomainTableMap::COL_PHP_VERSION)) {
            $criteria->add(DomainTableMap::COL_PHP_VERSION, $this->php_version);
        }
        if ($this->isColumnModified(DomainTableMap::COL_PHP_POOL_NAME)) {
            $criteria->add(DomainTableMap::COL_PHP_POOL_NAME, $this->php_pool_name);
        }
        if ($this->isColumnModified(DomainTableMap::COL_PHP_POOL_SOCK_PATH)) {
            $criteria->add(DomainTableMap::COL_PHP_POOL_SOCK_PATH, $this->php_pool_sock_path);
        }
        if ($this->isColumnModified(DomainTableMap::COL_ACTIVATED)) {
            $criteria->add(DomainTableMap::COL_ACTIVATED, $this->activated);
        }
        if ($this->isColumnModified(DomainTableMap::COL_BLOCKED)) {
            $criteria->add(DomainTableMap::COL_BLOCKED, $this->blocked);
        }
        if ($this->isColumnModified(DomainTableMap::COL_PROCESSED)) {
            $criteria->add(DomainTableMap::COL_PROCESSED, $this->processed);
        }
        if ($this->isColumnModified(DomainTableMap::COL_PROCESSED_AT)) {
            $criteria->add(DomainTableMap::COL_PROCESSED_AT, $this->processed_at);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return \Propel\Runtime\ActiveQuery\Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria(): Criteria
    {
        $criteria = ChildDomainQuery::create();
        $criteria->add(DomainTableMap::COL_ID, $this->id);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int|string Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getId();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \basteyy\XzitGiggle\Models\Domain (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setUserId($this->getUserId());
        $copyObj->setTld($this->getTld());
        $copyObj->setDomain($this->getDomain());
        $copyObj->setRegistered($this->getRegistered());
        $copyObj->setWwwAlias($this->getWwwAlias());
        $copyObj->setLetsEncrypt($this->getLetsEncrypt());
        $copyObj->setIpv4($this->getIpv4());
        $copyObj->setIpv6($this->getIpv6());
        $copyObj->setMountingPoint($this->getMountingPoint());
        $copyObj->setPhpVersion($this->getPhpVersion());
        $copyObj->setPhpPoolName($this->getPhpPoolName());
        $copyObj->setPhpPoolSockPath($this->getPhpPoolSockPath());
        $copyObj->setActivated($this->getActivated());
        $copyObj->setBlocked($this->getBlocked());
        $copyObj->setProcessed($this->getProcessed());
        $copyObj->setProcessedAt($this->getProcessedAt());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \basteyy\XzitGiggle\Models\Domain Clone of current object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function copy(bool $deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Declares an association between this object and a ChildUser object.
     *
     * @param ChildUser $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setUser(ChildUser $v = null)
    {
        if ($v === null) {
            $this->setUserId(NULL);
        } else {
            $this->setUserId($v->getId());
        }

        $this->aUser = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildUser object, it will not be re-added.
        if ($v !== null) {
            $v->addDomains($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildUser object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildUser The associated ChildUser object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getUser(?ConnectionInterface $con = null)
    {
        if ($this->aUser === null && ($this->user_id != 0)) {
            $this->aUser = ChildUserQuery::create()->findPk($this->user_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aUser->addDomainss($this);
             */
        }

        return $this->aUser;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     *
     * @return $this
     */
    public function clear()
    {
        if (null !== $this->aUser) {
            $this->aUser->removeDomains($this);
        }
        $this->id = null;
        $this->user_id = null;
        $this->tld = null;
        $this->domain = null;
        $this->registered = null;
        $this->www_alias = null;
        $this->lets_encrypt = null;
        $this->ipv4 = null;
        $this->ipv6 = null;
        $this->mounting_point = null;
        $this->php_version = null;
        $this->php_pool_name = null;
        $this->php_pool_sock_path = null;
        $this->activated = null;
        $this->blocked = null;
        $this->processed = null;
        $this->processed_at = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);

        return $this;
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param bool $deep Whether to also clear the references on all referrer objects.
     * @return $this
     */
    public function clearAllReferences(bool $deep = false)
    {
        if ($deep) {
        } // if ($deep)

        $this->aUser = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(DomainTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param ConnectionInterface|null $con
     * @return bool
     */
    public function preSave(?ConnectionInterface $con = null): bool
    {
                return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface|null $con
     * @return void
     */
    public function postSave(?ConnectionInterface $con = null): void
    {
            }

    /**
     * Code to be run before inserting to database
     * @param ConnectionInterface|null $con
     * @return bool
     */
    public function preInsert(?ConnectionInterface $con = null): bool
    {
                return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface|null $con
     * @return void
     */
    public function postInsert(?ConnectionInterface $con = null): void
    {
            }

    /**
     * Code to be run before updating the object in database
     * @param ConnectionInterface|null $con
     * @return bool
     */
    public function preUpdate(?ConnectionInterface $con = null): bool
    {
                return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface|null $con
     * @return void
     */
    public function postUpdate(?ConnectionInterface $con = null): void
    {
            }

    /**
     * Code to be run before deleting the object in database
     * @param ConnectionInterface|null $con
     * @return bool
     */
    public function preDelete(?ConnectionInterface $con = null): bool
    {
                return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface|null $con
     * @return void
     */
    public function postDelete(?ConnectionInterface $con = null): void
    {
            }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);
            $inputData = $params[0];
            $keyType = $params[1] ?? TableMap::TYPE_PHPNAME;

            return $this->importFrom($format, $inputData, $keyType);
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = $params[0] ?? true;
            $keyType = $params[1] ?? TableMap::TYPE_PHPNAME;

            return $this->exportTo($format, $includeLazyLoadColumns, $keyType);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
