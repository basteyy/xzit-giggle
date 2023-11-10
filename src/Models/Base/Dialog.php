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
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;
use basteyy\XzitGiggle\Models\Dialog as ChildDialog;
use basteyy\XzitGiggle\Models\DialogMessage as ChildDialogMessage;
use basteyy\XzitGiggle\Models\DialogMessageQuery as ChildDialogMessageQuery;
use basteyy\XzitGiggle\Models\DialogQuery as ChildDialogQuery;
use basteyy\XzitGiggle\Models\DialogUser as ChildDialogUser;
use basteyy\XzitGiggle\Models\DialogUserQuery as ChildDialogUserQuery;
use basteyy\XzitGiggle\Models\User as ChildUser;
use basteyy\XzitGiggle\Models\UserQuery as ChildUserQuery;
use basteyy\XzitGiggle\Models\Map\DialogMessageTableMap;
use basteyy\XzitGiggle\Models\Map\DialogTableMap;
use basteyy\XzitGiggle\Models\Map\DialogUserTableMap;

/**
 * Base class that represents a row from the 'xg_dialogs' table.
 *
 *
 *
 * @package    propel.generator...Base
 */
abstract class Dialog implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\basteyy\\XzitGiggle\\Models\\Map\\DialogTableMap';


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
     * The value for the hash field.
     *
     * Note: this column has a database default value of: (expression) LEFT(MD5(CURRENT_TIMESTAMP), 16)
     * @var        string
     */
    protected $hash;

    /**
     * The value for the subject field.
     *
     * Note: this column has a database default value of: 'Chat'
     * @var        string|null
     */
    protected $subject;

    /**
     * The value for the created_user_id field.
     *
     * @var        int
     */
    protected $created_user_id;

    /**
     * The value for the created_at field.
     *
     * Note: this column has a database default value of: (expression) CURRENT_TIMESTAMP
     * @var        DateTime
     */
    protected $created_at;

    /**
     * The value for the active field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $active;

    /**
     * The value for the is_private field.
     *
     * Note: this column has a database default value of: true
     * @var        boolean
     */
    protected $is_private;

    /**
     * The value for the last_message field.
     *
     * @var        DateTime|null
     */
    protected $last_message;

    /**
     * @var        ChildUser
     */
    protected $aCreatedByUser;

    /**
     * @var        ObjectCollection|ChildDialogUser[] Collection to store aggregation of ChildDialogUser objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildDialogUser> Collection to store aggregation of ChildDialogUser objects.
     */
    protected $collDialogUsers;
    protected $collDialogUsersPartial;

    /**
     * @var        ObjectCollection|ChildDialogMessage[] Collection to store aggregation of ChildDialogMessage objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildDialogMessage> Collection to store aggregation of ChildDialogMessage objects.
     */
    protected $collDialogUserss;
    protected $collDialogUserssPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildDialogUser[]
     * @phpstan-var ObjectCollection&\Traversable<ChildDialogUser>
     */
    protected $dialogUsersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildDialogMessage[]
     * @phpstan-var ObjectCollection&\Traversable<ChildDialogMessage>
     */
    protected $dialogUserssScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->subject = 'Chat';
        $this->active = false;
        $this->is_private = true;
    }

    /**
     * Initializes internal state of basteyy\XzitGiggle\Models\Base\Dialog object.
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
     * Compares this with another <code>Dialog</code> instance.  If
     * <code>obj</code> is an instance of <code>Dialog</code>, delegates to
     * <code>equals(Dialog)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [hash] column value.
     *
     * @return string
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * Get the [subject] column value.
     *
     * @return string|null
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Get the [created_user_id] column value.
     *
     * @return int
     */
    public function getCreatedUserId()
    {
        return $this->created_user_id;
    }

    /**
     * Get the [optionally formatted] temporal [created_at] column value.
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
    public function getCreatedAt($format = null)
    {
        if ($format === null) {
            return $this->created_at;
        } else {
            return $this->created_at instanceof \DateTimeInterface ? $this->created_at->format($format) : null;
        }
    }

    /**
     * Get the [active] column value.
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Get the [active] column value.
     *
     * @return boolean
     */
    public function isActive()
    {
        return $this->getActive();
    }

    /**
     * Get the [is_private] column value.
     *
     * @return boolean
     */
    public function getIsPrivate()
    {
        return $this->is_private;
    }

    /**
     * Get the [is_private] column value.
     *
     * @return boolean
     */
    public function isPrivate()
    {
        return $this->getIsPrivate();
    }

    /**
     * Get the [optionally formatted] temporal [last_message] column value.
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
    public function getLastMessage($format = null)
    {
        if ($format === null) {
            return $this->last_message;
        } else {
            return $this->last_message instanceof \DateTimeInterface ? $this->last_message->format($format) : null;
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
            $this->modifiedColumns[DialogTableMap::COL_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [hash] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setHash($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->hash !== $v) {
            $this->hash = $v;
            $this->modifiedColumns[DialogTableMap::COL_HASH] = true;
        }

        return $this;
    }

    /**
     * Set the value of [subject] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSubject($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->subject !== $v) {
            $this->subject = $v;
            $this->modifiedColumns[DialogTableMap::COL_SUBJECT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [created_user_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCreatedUserId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->created_user_id !== $v) {
            $this->created_user_id = $v;
            $this->modifiedColumns[DialogTableMap::COL_CREATED_USER_ID] = true;
        }

        if ($this->aCreatedByUser !== null && $this->aCreatedByUser->getId() !== $v) {
            $this->aCreatedByUser = null;
        }

        return $this;
    }

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            if ($this->created_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->created_at->format("Y-m-d H:i:s.u")) {
                $this->created_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[DialogTableMap::COL_CREATED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Sets the value of the [active] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param bool|integer|string $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setActive($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->active !== $v) {
            $this->active = $v;
            $this->modifiedColumns[DialogTableMap::COL_ACTIVE] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [is_private] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param bool|integer|string $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setIsPrivate($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->is_private !== $v) {
            $this->is_private = $v;
            $this->modifiedColumns[DialogTableMap::COL_IS_PRIVATE] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [last_message] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setLastMessage($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->last_message !== null || $dt !== null) {
            if ($this->last_message === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->last_message->format("Y-m-d H:i:s.u")) {
                $this->last_message = $dt === null ? null : clone $dt;
                $this->modifiedColumns[DialogTableMap::COL_LAST_MESSAGE] = true;
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
            if ($this->subject !== 'Chat') {
                return false;
            }

            if ($this->active !== false) {
                return false;
            }

            if ($this->is_private !== true) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : DialogTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : DialogTableMap::translateFieldName('Hash', TableMap::TYPE_PHPNAME, $indexType)];
            $this->hash = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : DialogTableMap::translateFieldName('Subject', TableMap::TYPE_PHPNAME, $indexType)];
            $this->subject = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : DialogTableMap::translateFieldName('CreatedUserId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_user_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : DialogTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : DialogTableMap::translateFieldName('Active', TableMap::TYPE_PHPNAME, $indexType)];
            $this->active = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : DialogTableMap::translateFieldName('IsPrivate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_private = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : DialogTableMap::translateFieldName('LastMessage', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->last_message = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 8; // 8 = DialogTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\basteyy\\XzitGiggle\\Models\\Dialog'), 0, $e);
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
        if ($this->aCreatedByUser !== null && $this->created_user_id !== $this->aCreatedByUser->getId()) {
            $this->aCreatedByUser = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(DialogTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildDialogQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCreatedByUser = null;
            $this->collDialogUsers = null;

            $this->collDialogUserss = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see Dialog::setDeleted()
     * @see Dialog::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(DialogTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildDialogQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(DialogTableMap::DATABASE_NAME);
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
                DialogTableMap::addInstanceToPool($this);
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

            if ($this->aCreatedByUser !== null) {
                if ($this->aCreatedByUser->isModified() || $this->aCreatedByUser->isNew()) {
                    $affectedRows += $this->aCreatedByUser->save($con);
                }
                $this->setCreatedByUser($this->aCreatedByUser);
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

            if ($this->dialogUsersScheduledForDeletion !== null) {
                if (!$this->dialogUsersScheduledForDeletion->isEmpty()) {
                    \basteyy\XzitGiggle\Models\DialogUserQuery::create()
                        ->filterByPrimaryKeys($this->dialogUsersScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->dialogUsersScheduledForDeletion = null;
                }
            }

            if ($this->collDialogUsers !== null) {
                foreach ($this->collDialogUsers as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->dialogUserssScheduledForDeletion !== null) {
                if (!$this->dialogUserssScheduledForDeletion->isEmpty()) {
                    \basteyy\XzitGiggle\Models\DialogMessageQuery::create()
                        ->filterByPrimaryKeys($this->dialogUserssScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->dialogUserssScheduledForDeletion = null;
                }
            }

            if ($this->collDialogUserss !== null) {
                foreach ($this->collDialogUserss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
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

        $this->modifiedColumns[DialogTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . DialogTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(DialogTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(DialogTableMap::COL_HASH)) {
            $modifiedColumns[':p' . $index++]  = '`hash`';
        }
        if ($this->isColumnModified(DialogTableMap::COL_SUBJECT)) {
            $modifiedColumns[':p' . $index++]  = '`subject`';
        }
        if ($this->isColumnModified(DialogTableMap::COL_CREATED_USER_ID)) {
            $modifiedColumns[':p' . $index++]  = '`created_user_id`';
        }
        if ($this->isColumnModified(DialogTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`created_at`';
        }
        if ($this->isColumnModified(DialogTableMap::COL_ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = '`active`';
        }
        if ($this->isColumnModified(DialogTableMap::COL_IS_PRIVATE)) {
            $modifiedColumns[':p' . $index++]  = '`is_private`';
        }
        if ($this->isColumnModified(DialogTableMap::COL_LAST_MESSAGE)) {
            $modifiedColumns[':p' . $index++]  = '`last_message`';
        }

        $sql = sprintf(
            'INSERT INTO `xg_dialogs` (%s) VALUES (%s)',
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
                    case '`hash`':
                        $stmt->bindValue($identifier, $this->hash, PDO::PARAM_STR);

                        break;
                    case '`subject`':
                        $stmt->bindValue($identifier, $this->subject, PDO::PARAM_STR);

                        break;
                    case '`created_user_id`':
                        $stmt->bindValue($identifier, $this->created_user_id, PDO::PARAM_INT);

                        break;
                    case '`created_at`':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case '`active`':
                        $stmt->bindValue($identifier, (int) $this->active, PDO::PARAM_INT);

                        break;
                    case '`is_private`':
                        $stmt->bindValue($identifier, (int) $this->is_private, PDO::PARAM_INT);

                        break;
                    case '`last_message`':
                        $stmt->bindValue($identifier, $this->last_message ? $this->last_message->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

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
        $pos = DialogTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getHash();

            case 2:
                return $this->getSubject();

            case 3:
                return $this->getCreatedUserId();

            case 4:
                return $this->getCreatedAt();

            case 5:
                return $this->getActive();

            case 6:
                return $this->getIsPrivate();

            case 7:
                return $this->getLastMessage();

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
        if (isset($alreadyDumpedObjects['Dialog'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['Dialog'][$this->hashCode()] = true;
        $keys = DialogTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getId(),
            $keys[1] => $this->getHash(),
            $keys[2] => $this->getSubject(),
            $keys[3] => $this->getCreatedUserId(),
            $keys[4] => $this->getCreatedAt(),
            $keys[5] => $this->getActive(),
            $keys[6] => $this->getIsPrivate(),
            $keys[7] => $this->getLastMessage(),
        ];
        if ($result[$keys[4]] instanceof \DateTimeInterface) {
            $result[$keys[4]] = $result[$keys[4]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[7]] instanceof \DateTimeInterface) {
            $result[$keys[7]] = $result[$keys[7]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aCreatedByUser) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'user';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'xg_users';
                        break;
                    default:
                        $key = 'CreatedByUser';
                }

                $result[$key] = $this->aCreatedByUser->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collDialogUsers) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'dialogUsers';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'xg_dialog_userss';
                        break;
                    default:
                        $key = 'DialogUsers';
                }

                $result[$key] = $this->collDialogUsers->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collDialogUserss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'dialogMessages';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'xg_dialog_messagess';
                        break;
                    default:
                        $key = 'DialogUserss';
                }

                $result[$key] = $this->collDialogUserss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = DialogTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setHash($value);
                break;
            case 2:
                $this->setSubject($value);
                break;
            case 3:
                $this->setCreatedUserId($value);
                break;
            case 4:
                $this->setCreatedAt($value);
                break;
            case 5:
                $this->setActive($value);
                break;
            case 6:
                $this->setIsPrivate($value);
                break;
            case 7:
                $this->setLastMessage($value);
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
        $keys = DialogTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setHash($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setSubject($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setCreatedUserId($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setCreatedAt($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setActive($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setIsPrivate($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setLastMessage($arr[$keys[7]]);
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
        $criteria = new Criteria(DialogTableMap::DATABASE_NAME);

        if ($this->isColumnModified(DialogTableMap::COL_ID)) {
            $criteria->add(DialogTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(DialogTableMap::COL_HASH)) {
            $criteria->add(DialogTableMap::COL_HASH, $this->hash);
        }
        if ($this->isColumnModified(DialogTableMap::COL_SUBJECT)) {
            $criteria->add(DialogTableMap::COL_SUBJECT, $this->subject);
        }
        if ($this->isColumnModified(DialogTableMap::COL_CREATED_USER_ID)) {
            $criteria->add(DialogTableMap::COL_CREATED_USER_ID, $this->created_user_id);
        }
        if ($this->isColumnModified(DialogTableMap::COL_CREATED_AT)) {
            $criteria->add(DialogTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(DialogTableMap::COL_ACTIVE)) {
            $criteria->add(DialogTableMap::COL_ACTIVE, $this->active);
        }
        if ($this->isColumnModified(DialogTableMap::COL_IS_PRIVATE)) {
            $criteria->add(DialogTableMap::COL_IS_PRIVATE, $this->is_private);
        }
        if ($this->isColumnModified(DialogTableMap::COL_LAST_MESSAGE)) {
            $criteria->add(DialogTableMap::COL_LAST_MESSAGE, $this->last_message);
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
        $criteria = ChildDialogQuery::create();
        $criteria->add(DialogTableMap::COL_ID, $this->id);

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
     * @param object $copyObj An object of \basteyy\XzitGiggle\Models\Dialog (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setHash($this->getHash());
        $copyObj->setSubject($this->getSubject());
        $copyObj->setCreatedUserId($this->getCreatedUserId());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setActive($this->getActive());
        $copyObj->setIsPrivate($this->getIsPrivate());
        $copyObj->setLastMessage($this->getLastMessage());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getDialogUsers() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addDialogUser($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getDialogUserss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addDialogUsers($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

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
     * @return \basteyy\XzitGiggle\Models\Dialog Clone of current object.
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
    public function setCreatedByUser(ChildUser $v = null)
    {
        if ($v === null) {
            $this->setCreatedUserId(NULL);
        } else {
            $this->setCreatedUserId($v->getId());
        }

        $this->aCreatedByUser = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildUser object, it will not be re-added.
        if ($v !== null) {
            $v->addStartedDialogs($this);
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
    public function getCreatedByUser(?ConnectionInterface $con = null)
    {
        if ($this->aCreatedByUser === null && ($this->created_user_id != 0)) {
            $this->aCreatedByUser = ChildUserQuery::create()->findPk($this->created_user_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCreatedByUser->addStartedDialogss($this);
             */
        }

        return $this->aCreatedByUser;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName): void
    {
        if ('DialogUser' === $relationName) {
            $this->initDialogUsers();
            return;
        }
        if ('DialogUsers' === $relationName) {
            $this->initDialogUserss();
            return;
        }
    }

    /**
     * Clears out the collDialogUsers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addDialogUsers()
     */
    public function clearDialogUsers()
    {
        $this->collDialogUsers = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collDialogUsers collection loaded partially.
     *
     * @return void
     */
    public function resetPartialDialogUsers($v = true): void
    {
        $this->collDialogUsersPartial = $v;
    }

    /**
     * Initializes the collDialogUsers collection.
     *
     * By default this just sets the collDialogUsers collection to an empty array (like clearcollDialogUsers());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initDialogUsers(bool $overrideExisting = true): void
    {
        if (null !== $this->collDialogUsers && !$overrideExisting) {
            return;
        }

        $collectionClassName = DialogUserTableMap::getTableMap()->getCollectionClassName();

        $this->collDialogUsers = new $collectionClassName;
        $this->collDialogUsers->setModel('\basteyy\XzitGiggle\Models\DialogUser');
    }

    /**
     * Gets an array of ChildDialogUser objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildDialog is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildDialogUser[] List of ChildDialogUser objects
     * @phpstan-return ObjectCollection&\Traversable<ChildDialogUser> List of ChildDialogUser objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getDialogUsers(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collDialogUsersPartial && !$this->isNew();
        if (null === $this->collDialogUsers || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collDialogUsers) {
                    $this->initDialogUsers();
                } else {
                    $collectionClassName = DialogUserTableMap::getTableMap()->getCollectionClassName();

                    $collDialogUsers = new $collectionClassName;
                    $collDialogUsers->setModel('\basteyy\XzitGiggle\Models\DialogUser');

                    return $collDialogUsers;
                }
            } else {
                $collDialogUsers = ChildDialogUserQuery::create(null, $criteria)
                    ->filterByDialog($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collDialogUsersPartial && count($collDialogUsers)) {
                        $this->initDialogUsers(false);

                        foreach ($collDialogUsers as $obj) {
                            if (false == $this->collDialogUsers->contains($obj)) {
                                $this->collDialogUsers->append($obj);
                            }
                        }

                        $this->collDialogUsersPartial = true;
                    }

                    return $collDialogUsers;
                }

                if ($partial && $this->collDialogUsers) {
                    foreach ($this->collDialogUsers as $obj) {
                        if ($obj->isNew()) {
                            $collDialogUsers[] = $obj;
                        }
                    }
                }

                $this->collDialogUsers = $collDialogUsers;
                $this->collDialogUsersPartial = false;
            }
        }

        return $this->collDialogUsers;
    }

    /**
     * Sets a collection of ChildDialogUser objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $dialogUsers A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setDialogUsers(Collection $dialogUsers, ?ConnectionInterface $con = null)
    {
        /** @var ChildDialogUser[] $dialogUsersToDelete */
        $dialogUsersToDelete = $this->getDialogUsers(new Criteria(), $con)->diff($dialogUsers);


        $this->dialogUsersScheduledForDeletion = $dialogUsersToDelete;

        foreach ($dialogUsersToDelete as $dialogUserRemoved) {
            $dialogUserRemoved->setDialog(null);
        }

        $this->collDialogUsers = null;
        foreach ($dialogUsers as $dialogUser) {
            $this->addDialogUser($dialogUser);
        }

        $this->collDialogUsers = $dialogUsers;
        $this->collDialogUsersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related DialogUser objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related DialogUser objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countDialogUsers(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collDialogUsersPartial && !$this->isNew();
        if (null === $this->collDialogUsers || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collDialogUsers) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getDialogUsers());
            }

            $query = ChildDialogUserQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByDialog($this)
                ->count($con);
        }

        return count($this->collDialogUsers);
    }

    /**
     * Method called to associate a ChildDialogUser object to this object
     * through the ChildDialogUser foreign key attribute.
     *
     * @param ChildDialogUser $l ChildDialogUser
     * @return $this The current object (for fluent API support)
     */
    public function addDialogUser(ChildDialogUser $l)
    {
        if ($this->collDialogUsers === null) {
            $this->initDialogUsers();
            $this->collDialogUsersPartial = true;
        }

        if (!$this->collDialogUsers->contains($l)) {
            $this->doAddDialogUser($l);

            if ($this->dialogUsersScheduledForDeletion and $this->dialogUsersScheduledForDeletion->contains($l)) {
                $this->dialogUsersScheduledForDeletion->remove($this->dialogUsersScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildDialogUser $dialogUser The ChildDialogUser object to add.
     */
    protected function doAddDialogUser(ChildDialogUser $dialogUser): void
    {
        $this->collDialogUsers[]= $dialogUser;
        $dialogUser->setDialog($this);
    }

    /**
     * @param ChildDialogUser $dialogUser The ChildDialogUser object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeDialogUser(ChildDialogUser $dialogUser)
    {
        if ($this->getDialogUsers()->contains($dialogUser)) {
            $pos = $this->collDialogUsers->search($dialogUser);
            $this->collDialogUsers->remove($pos);
            if (null === $this->dialogUsersScheduledForDeletion) {
                $this->dialogUsersScheduledForDeletion = clone $this->collDialogUsers;
                $this->dialogUsersScheduledForDeletion->clear();
            }
            $this->dialogUsersScheduledForDeletion[]= clone $dialogUser;
            $dialogUser->setDialog(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Dialog is new, it will return
     * an empty collection; or if this Dialog has previously
     * been saved, it will retrieve related DialogUsers from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Dialog.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildDialogUser[] List of ChildDialogUser objects
     * @phpstan-return ObjectCollection&\Traversable<ChildDialogUser}> List of ChildDialogUser objects
     */
    public function getDialogUsersJoinUser(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildDialogUserQuery::create(null, $criteria);
        $query->joinWith('User', $joinBehavior);

        return $this->getDialogUsers($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Dialog is new, it will return
     * an empty collection; or if this Dialog has previously
     * been saved, it will retrieve related DialogUsers from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Dialog.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildDialogUser[] List of ChildDialogUser objects
     * @phpstan-return ObjectCollection&\Traversable<ChildDialogUser}> List of ChildDialogUser objects
     */
    public function getDialogUsersJoinInviterUser(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildDialogUserQuery::create(null, $criteria);
        $query->joinWith('InviterUser', $joinBehavior);

        return $this->getDialogUsers($query, $con);
    }

    /**
     * Clears out the collDialogUserss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addDialogUserss()
     */
    public function clearDialogUserss()
    {
        $this->collDialogUserss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collDialogUserss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialDialogUserss($v = true): void
    {
        $this->collDialogUserssPartial = $v;
    }

    /**
     * Initializes the collDialogUserss collection.
     *
     * By default this just sets the collDialogUserss collection to an empty array (like clearcollDialogUserss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initDialogUserss(bool $overrideExisting = true): void
    {
        if (null !== $this->collDialogUserss && !$overrideExisting) {
            return;
        }

        $collectionClassName = DialogMessageTableMap::getTableMap()->getCollectionClassName();

        $this->collDialogUserss = new $collectionClassName;
        $this->collDialogUserss->setModel('\basteyy\XzitGiggle\Models\DialogMessage');
    }

    /**
     * Gets an array of ChildDialogMessage objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildDialog is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildDialogMessage[] List of ChildDialogMessage objects
     * @phpstan-return ObjectCollection&\Traversable<ChildDialogMessage> List of ChildDialogMessage objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getDialogUserss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collDialogUserssPartial && !$this->isNew();
        if (null === $this->collDialogUserss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collDialogUserss) {
                    $this->initDialogUserss();
                } else {
                    $collectionClassName = DialogMessageTableMap::getTableMap()->getCollectionClassName();

                    $collDialogUserss = new $collectionClassName;
                    $collDialogUserss->setModel('\basteyy\XzitGiggle\Models\DialogMessage');

                    return $collDialogUserss;
                }
            } else {
                $collDialogUserss = ChildDialogMessageQuery::create(null, $criteria)
                    ->filterByDialog($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collDialogUserssPartial && count($collDialogUserss)) {
                        $this->initDialogUserss(false);

                        foreach ($collDialogUserss as $obj) {
                            if (false == $this->collDialogUserss->contains($obj)) {
                                $this->collDialogUserss->append($obj);
                            }
                        }

                        $this->collDialogUserssPartial = true;
                    }

                    return $collDialogUserss;
                }

                if ($partial && $this->collDialogUserss) {
                    foreach ($this->collDialogUserss as $obj) {
                        if ($obj->isNew()) {
                            $collDialogUserss[] = $obj;
                        }
                    }
                }

                $this->collDialogUserss = $collDialogUserss;
                $this->collDialogUserssPartial = false;
            }
        }

        return $this->collDialogUserss;
    }

    /**
     * Sets a collection of ChildDialogMessage objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $dialogUserss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setDialogUserss(Collection $dialogUserss, ?ConnectionInterface $con = null)
    {
        /** @var ChildDialogMessage[] $dialogUserssToDelete */
        $dialogUserssToDelete = $this->getDialogUserss(new Criteria(), $con)->diff($dialogUserss);


        $this->dialogUserssScheduledForDeletion = $dialogUserssToDelete;

        foreach ($dialogUserssToDelete as $dialogUsersRemoved) {
            $dialogUsersRemoved->setDialog(null);
        }

        $this->collDialogUserss = null;
        foreach ($dialogUserss as $dialogUsers) {
            $this->addDialogUsers($dialogUsers);
        }

        $this->collDialogUserss = $dialogUserss;
        $this->collDialogUserssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related DialogMessage objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related DialogMessage objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countDialogUserss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collDialogUserssPartial && !$this->isNew();
        if (null === $this->collDialogUserss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collDialogUserss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getDialogUserss());
            }

            $query = ChildDialogMessageQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByDialog($this)
                ->count($con);
        }

        return count($this->collDialogUserss);
    }

    /**
     * Method called to associate a ChildDialogMessage object to this object
     * through the ChildDialogMessage foreign key attribute.
     *
     * @param ChildDialogMessage $l ChildDialogMessage
     * @return $this The current object (for fluent API support)
     */
    public function addDialogUsers(ChildDialogMessage $l)
    {
        if ($this->collDialogUserss === null) {
            $this->initDialogUserss();
            $this->collDialogUserssPartial = true;
        }

        if (!$this->collDialogUserss->contains($l)) {
            $this->doAddDialogUsers($l);

            if ($this->dialogUserssScheduledForDeletion and $this->dialogUserssScheduledForDeletion->contains($l)) {
                $this->dialogUserssScheduledForDeletion->remove($this->dialogUserssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildDialogMessage $dialogUsers The ChildDialogMessage object to add.
     */
    protected function doAddDialogUsers(ChildDialogMessage $dialogUsers): void
    {
        $this->collDialogUserss[]= $dialogUsers;
        $dialogUsers->setDialog($this);
    }

    /**
     * @param ChildDialogMessage $dialogUsers The ChildDialogMessage object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeDialogUsers(ChildDialogMessage $dialogUsers)
    {
        if ($this->getDialogUserss()->contains($dialogUsers)) {
            $pos = $this->collDialogUserss->search($dialogUsers);
            $this->collDialogUserss->remove($pos);
            if (null === $this->dialogUserssScheduledForDeletion) {
                $this->dialogUserssScheduledForDeletion = clone $this->collDialogUserss;
                $this->dialogUserssScheduledForDeletion->clear();
            }
            $this->dialogUserssScheduledForDeletion[]= clone $dialogUsers;
            $dialogUsers->setDialog(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Dialog is new, it will return
     * an empty collection; or if this Dialog has previously
     * been saved, it will retrieve related DialogUserss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Dialog.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildDialogMessage[] List of ChildDialogMessage objects
     * @phpstan-return ObjectCollection&\Traversable<ChildDialogMessage}> List of ChildDialogMessage objects
     */
    public function getDialogUserssJoinUser(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildDialogMessageQuery::create(null, $criteria);
        $query->joinWith('User', $joinBehavior);

        return $this->getDialogUserss($query, $con);
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
        if (null !== $this->aCreatedByUser) {
            $this->aCreatedByUser->removeStartedDialogs($this);
        }
        $this->id = null;
        $this->hash = null;
        $this->subject = null;
        $this->created_user_id = null;
        $this->created_at = null;
        $this->active = null;
        $this->is_private = null;
        $this->last_message = null;
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
            if ($this->collDialogUsers) {
                foreach ($this->collDialogUsers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collDialogUserss) {
                foreach ($this->collDialogUserss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collDialogUsers = null;
        $this->collDialogUserss = null;
        $this->aCreatedByUser = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(DialogTableMap::DEFAULT_STRING_FORMAT);
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
