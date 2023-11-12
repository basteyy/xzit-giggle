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
use basteyy\XzitGiggle\Models\ActionLog as ChildActionLog;
use basteyy\XzitGiggle\Models\ActionLogQuery as ChildActionLogQuery;
use basteyy\XzitGiggle\Models\Dialog as ChildDialog;
use basteyy\XzitGiggle\Models\DialogMessage as ChildDialogMessage;
use basteyy\XzitGiggle\Models\DialogMessageQuery as ChildDialogMessageQuery;
use basteyy\XzitGiggle\Models\DialogQuery as ChildDialogQuery;
use basteyy\XzitGiggle\Models\DialogUser as ChildDialogUser;
use basteyy\XzitGiggle\Models\DialogUserQuery as ChildDialogUserQuery;
use basteyy\XzitGiggle\Models\Domain as ChildDomain;
use basteyy\XzitGiggle\Models\DomainQuery as ChildDomainQuery;
use basteyy\XzitGiggle\Models\IpPoolUsers as ChildIpPoolUsers;
use basteyy\XzitGiggle\Models\IpPoolUsersQuery as ChildIpPoolUsersQuery;
use basteyy\XzitGiggle\Models\User as ChildUser;
use basteyy\XzitGiggle\Models\UserQuery as ChildUserQuery;
use basteyy\XzitGiggle\Models\UserRole as ChildUserRole;
use basteyy\XzitGiggle\Models\UserRoleQuery as ChildUserRoleQuery;
use basteyy\XzitGiggle\Models\Map\ActionLogTableMap;
use basteyy\XzitGiggle\Models\Map\DialogMessageTableMap;
use basteyy\XzitGiggle\Models\Map\DialogTableMap;
use basteyy\XzitGiggle\Models\Map\DialogUserTableMap;
use basteyy\XzitGiggle\Models\Map\DomainTableMap;
use basteyy\XzitGiggle\Models\Map\IpPoolUsersTableMap;
use basteyy\XzitGiggle\Models\Map\UserTableMap;

/**
 * Base class that represents a row from the 'xg_users' table.
 *
 *
 *
 * @package    propel.generator...Base
 */
abstract class User implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\basteyy\\XzitGiggle\\Models\\Map\\UserTableMap';


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
     * The value for the email field.
     *
     * @var        string
     */
    protected $email;

    /**
     * The value for the username field.
     *
     * @var        string
     */
    protected $username;

    /**
     * The value for the user_role_id field.
     *
     * @var        int
     */
    protected $user_role_id;

    /**
     * The value for the secret_key field.
     *
     * @var        string|null
     */
    protected $secret_key;

    /**
     * The value for the password_hash field.
     *
     * @var        string|null
     */
    protected $password_hash;

    /**
     * The value for the activated field.
     *
     * Note: this column has a database default value of: false
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
     * The value for the is_delete_candidate field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $is_delete_candidate;

    /**
     * The value for the last_login field.
     *
     * @var        DateTime|null
     */
    protected $last_login;

    /**
     * The value for the last_login_ip field.
     *
     * @var        string|null
     */
    protected $last_login_ip;

    /**
     * The value for the processed field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean|null
     */
    protected $processed;

    /**
     * The value for the processed_at field.
     *
     * @var        DateTime|null
     */
    protected $processed_at;

    /**
     * The value for the home_folder field.
     *
     * @var        string|null
     */
    protected $home_folder;

    /**
     * The value for the log_folder field.
     *
     * @var        string|null
     */
    protected $log_folder;

    /**
     * The value for the web_folder field.
     *
     * @var        string|null
     */
    protected $web_folder;

    /**
     * The value for the bash field.
     *
     * @var        string|null
     */
    protected $bash;

    /**
     * @var        ChildUserRole
     */
    protected $aUserRole;

    /**
     * @var        ObjectCollection|ChildIpPoolUsers[] Collection to store aggregation of ChildIpPoolUsers objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildIpPoolUsers> Collection to store aggregation of ChildIpPoolUsers objects.
     */
    protected $collIpPoolUserss;
    protected $collIpPoolUserssPartial;

    /**
     * @var        ObjectCollection|ChildDomain[] Collection to store aggregation of ChildDomain objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildDomain> Collection to store aggregation of ChildDomain objects.
     */
    protected $collDomainss;
    protected $collDomainssPartial;

    /**
     * @var        ObjectCollection|ChildDialog[] Collection to store aggregation of ChildDialog objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildDialog> Collection to store aggregation of ChildDialog objects.
     */
    protected $collStartedDialogss;
    protected $collStartedDialogssPartial;

    /**
     * @var        ObjectCollection|ChildDialogUser[] Collection to store aggregation of ChildDialogUser objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildDialogUser> Collection to store aggregation of ChildDialogUser objects.
     */
    protected $collDialogss;
    protected $collDialogssPartial;

    /**
     * @var        ObjectCollection|ChildDialogUser[] Collection to store aggregation of ChildDialogUser objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildDialogUser> Collection to store aggregation of ChildDialogUser objects.
     */
    protected $collDialogInvitess;
    protected $collDialogInvitessPartial;

    /**
     * @var        ObjectCollection|ChildDialogMessage[] Collection to store aggregation of ChildDialogMessage objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildDialogMessage> Collection to store aggregation of ChildDialogMessage objects.
     */
    protected $collDialogMessagess;
    protected $collDialogMessagessPartial;

    /**
     * @var        ObjectCollection|ChildActionLog[] Collection to store aggregation of ChildActionLog objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildActionLog> Collection to store aggregation of ChildActionLog objects.
     */
    protected $collActionLogss;
    protected $collActionLogssPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildIpPoolUsers[]
     * @phpstan-var ObjectCollection&\Traversable<ChildIpPoolUsers>
     */
    protected $ipPoolUserssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildDomain[]
     * @phpstan-var ObjectCollection&\Traversable<ChildDomain>
     */
    protected $domainssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildDialog[]
     * @phpstan-var ObjectCollection&\Traversable<ChildDialog>
     */
    protected $startedDialogssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildDialogUser[]
     * @phpstan-var ObjectCollection&\Traversable<ChildDialogUser>
     */
    protected $dialogssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildDialogUser[]
     * @phpstan-var ObjectCollection&\Traversable<ChildDialogUser>
     */
    protected $dialogInvitessScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildDialogMessage[]
     * @phpstan-var ObjectCollection&\Traversable<ChildDialogMessage>
     */
    protected $dialogMessagessScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildActionLog[]
     * @phpstan-var ObjectCollection&\Traversable<ChildActionLog>
     */
    protected $actionLogssScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->activated = false;
        $this->blocked = false;
        $this->is_delete_candidate = false;
        $this->processed = false;
    }

    /**
     * Initializes internal state of basteyy\XzitGiggle\Models\Base\User object.
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
     * Compares this with another <code>User</code> instance.  If
     * <code>obj</code> is an instance of <code>User</code>, delegates to
     * <code>equals(User)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [email] column value.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the [username] column value.
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Get the [user_role_id] column value.
     *
     * @return int
     */
    public function getUserRoleId()
    {
        return $this->user_role_id;
    }

    /**
     * Get the [secret_key] column value.
     *
     * @return string|null
     */
    public function getSecretKey()
    {
        return $this->secret_key;
    }

    /**
     * Get the [password_hash] column value.
     *
     * @return string|null
     */
    public function getPasswordHash()
    {
        return $this->password_hash;
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
     * Get the [is_delete_candidate] column value.
     *
     * @return boolean
     */
    public function getIsDeleteCandidate()
    {
        return $this->is_delete_candidate;
    }

    /**
     * Get the [is_delete_candidate] column value.
     *
     * @return boolean
     */
    public function isDeleteCandidate()
    {
        return $this->getIsDeleteCandidate();
    }

    /**
     * Get the [optionally formatted] temporal [last_login] column value.
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
    public function getLastLogin($format = null)
    {
        if ($format === null) {
            return $this->last_login;
        } else {
            return $this->last_login instanceof \DateTimeInterface ? $this->last_login->format($format) : null;
        }
    }

    /**
     * Get the [last_login_ip] column value.
     *
     * @return string|null
     */
    public function getLastLoginIp()
    {
        return $this->last_login_ip;
    }

    /**
     * Get the [processed] column value.
     *
     * @return boolean|null
     */
    public function getProcessed()
    {
        return $this->processed;
    }

    /**
     * Get the [processed] column value.
     *
     * @return boolean|null
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
     * Get the [home_folder] column value.
     *
     * @return string|null
     */
    public function getHomeFolder()
    {
        return $this->home_folder;
    }

    /**
     * Get the [log_folder] column value.
     *
     * @return string|null
     */
    public function getLogFolder()
    {
        return $this->log_folder;
    }

    /**
     * Get the [web_folder] column value.
     *
     * @return string|null
     */
    public function getWebFolder()
    {
        return $this->web_folder;
    }

    /**
     * Get the [bash] column value.
     *
     * @return string|null
     */
    public function getBash()
    {
        return $this->bash;
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
            $this->modifiedColumns[UserTableMap::COL_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [email] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email !== $v) {
            $this->email = $v;
            $this->modifiedColumns[UserTableMap::COL_EMAIL] = true;
        }

        return $this;
    }

    /**
     * Set the value of [username] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setUsername($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->username !== $v) {
            $this->username = $v;
            $this->modifiedColumns[UserTableMap::COL_USERNAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [user_role_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setUserRoleId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->user_role_id !== $v) {
            $this->user_role_id = $v;
            $this->modifiedColumns[UserTableMap::COL_USER_ROLE_ID] = true;
        }

        if ($this->aUserRole !== null && $this->aUserRole->getId() !== $v) {
            $this->aUserRole = null;
        }

        return $this;
    }

    /**
     * Set the value of [secret_key] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSecretKey($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->secret_key !== $v) {
            $this->secret_key = $v;
            $this->modifiedColumns[UserTableMap::COL_SECRET_KEY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [password_hash] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPasswordHash($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->password_hash !== $v) {
            $this->password_hash = $v;
            $this->modifiedColumns[UserTableMap::COL_PASSWORD_HASH] = true;
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
            $this->modifiedColumns[UserTableMap::COL_ACTIVATED] = true;
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
            $this->modifiedColumns[UserTableMap::COL_BLOCKED] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [is_delete_candidate] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param bool|integer|string $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setIsDeleteCandidate($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->is_delete_candidate !== $v) {
            $this->is_delete_candidate = $v;
            $this->modifiedColumns[UserTableMap::COL_IS_DELETE_CANDIDATE] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [last_login] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setLastLogin($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->last_login !== null || $dt !== null) {
            if ($this->last_login === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->last_login->format("Y-m-d H:i:s.u")) {
                $this->last_login = $dt === null ? null : clone $dt;
                $this->modifiedColumns[UserTableMap::COL_LAST_LOGIN] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [last_login_ip] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setLastLoginIp($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->last_login_ip !== $v) {
            $this->last_login_ip = $v;
            $this->modifiedColumns[UserTableMap::COL_LAST_LOGIN_IP] = true;
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
     * @param bool|integer|string|null $v The new value
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
            $this->modifiedColumns[UserTableMap::COL_PROCESSED] = true;
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
                $this->modifiedColumns[UserTableMap::COL_PROCESSED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [home_folder] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setHomeFolder($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->home_folder !== $v) {
            $this->home_folder = $v;
            $this->modifiedColumns[UserTableMap::COL_HOME_FOLDER] = true;
        }

        return $this;
    }

    /**
     * Set the value of [log_folder] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setLogFolder($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->log_folder !== $v) {
            $this->log_folder = $v;
            $this->modifiedColumns[UserTableMap::COL_LOG_FOLDER] = true;
        }

        return $this;
    }

    /**
     * Set the value of [web_folder] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setWebFolder($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->web_folder !== $v) {
            $this->web_folder = $v;
            $this->modifiedColumns[UserTableMap::COL_WEB_FOLDER] = true;
        }

        return $this;
    }

    /**
     * Set the value of [bash] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setBash($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->bash !== $v) {
            $this->bash = $v;
            $this->modifiedColumns[UserTableMap::COL_BASH] = true;
        }

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
            if ($this->activated !== false) {
                return false;
            }

            if ($this->blocked !== false) {
                return false;
            }

            if ($this->is_delete_candidate !== false) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : UserTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : UserTableMap::translateFieldName('Email', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : UserTableMap::translateFieldName('Username', TableMap::TYPE_PHPNAME, $indexType)];
            $this->username = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : UserTableMap::translateFieldName('UserRoleId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->user_role_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : UserTableMap::translateFieldName('SecretKey', TableMap::TYPE_PHPNAME, $indexType)];
            $this->secret_key = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : UserTableMap::translateFieldName('PasswordHash', TableMap::TYPE_PHPNAME, $indexType)];
            $this->password_hash = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : UserTableMap::translateFieldName('Activated', TableMap::TYPE_PHPNAME, $indexType)];
            $this->activated = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : UserTableMap::translateFieldName('Blocked', TableMap::TYPE_PHPNAME, $indexType)];
            $this->blocked = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : UserTableMap::translateFieldName('IsDeleteCandidate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_delete_candidate = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : UserTableMap::translateFieldName('LastLogin', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->last_login = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : UserTableMap::translateFieldName('LastLoginIp', TableMap::TYPE_PHPNAME, $indexType)];
            $this->last_login_ip = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : UserTableMap::translateFieldName('Processed', TableMap::TYPE_PHPNAME, $indexType)];
            $this->processed = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : UserTableMap::translateFieldName('ProcessedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->processed_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : UserTableMap::translateFieldName('HomeFolder', TableMap::TYPE_PHPNAME, $indexType)];
            $this->home_folder = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : UserTableMap::translateFieldName('LogFolder', TableMap::TYPE_PHPNAME, $indexType)];
            $this->log_folder = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : UserTableMap::translateFieldName('WebFolder', TableMap::TYPE_PHPNAME, $indexType)];
            $this->web_folder = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : UserTableMap::translateFieldName('Bash', TableMap::TYPE_PHPNAME, $indexType)];
            $this->bash = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 17; // 17 = UserTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\basteyy\\XzitGiggle\\Models\\User'), 0, $e);
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
        if ($this->aUserRole !== null && $this->user_role_id !== $this->aUserRole->getId()) {
            $this->aUserRole = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(UserTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildUserQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aUserRole = null;
            $this->collIpPoolUserss = null;

            $this->collDomainss = null;

            $this->collStartedDialogss = null;

            $this->collDialogss = null;

            $this->collDialogInvitess = null;

            $this->collDialogMessagess = null;

            $this->collActionLogss = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see User::setDeleted()
     * @see User::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildUserQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(UserTableMap::DATABASE_NAME);
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
                UserTableMap::addInstanceToPool($this);
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

            if ($this->aUserRole !== null) {
                if ($this->aUserRole->isModified() || $this->aUserRole->isNew()) {
                    $affectedRows += $this->aUserRole->save($con);
                }
                $this->setUserRole($this->aUserRole);
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

            if ($this->ipPoolUserssScheduledForDeletion !== null) {
                if (!$this->ipPoolUserssScheduledForDeletion->isEmpty()) {
                    \basteyy\XzitGiggle\Models\IpPoolUsersQuery::create()
                        ->filterByPrimaryKeys($this->ipPoolUserssScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->ipPoolUserssScheduledForDeletion = null;
                }
            }

            if ($this->collIpPoolUserss !== null) {
                foreach ($this->collIpPoolUserss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->domainssScheduledForDeletion !== null) {
                if (!$this->domainssScheduledForDeletion->isEmpty()) {
                    \basteyy\XzitGiggle\Models\DomainQuery::create()
                        ->filterByPrimaryKeys($this->domainssScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->domainssScheduledForDeletion = null;
                }
            }

            if ($this->collDomainss !== null) {
                foreach ($this->collDomainss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->startedDialogssScheduledForDeletion !== null) {
                if (!$this->startedDialogssScheduledForDeletion->isEmpty()) {
                    \basteyy\XzitGiggle\Models\DialogQuery::create()
                        ->filterByPrimaryKeys($this->startedDialogssScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->startedDialogssScheduledForDeletion = null;
                }
            }

            if ($this->collStartedDialogss !== null) {
                foreach ($this->collStartedDialogss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->dialogssScheduledForDeletion !== null) {
                if (!$this->dialogssScheduledForDeletion->isEmpty()) {
                    \basteyy\XzitGiggle\Models\DialogUserQuery::create()
                        ->filterByPrimaryKeys($this->dialogssScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->dialogssScheduledForDeletion = null;
                }
            }

            if ($this->collDialogss !== null) {
                foreach ($this->collDialogss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->dialogInvitessScheduledForDeletion !== null) {
                if (!$this->dialogInvitessScheduledForDeletion->isEmpty()) {
                    foreach ($this->dialogInvitessScheduledForDeletion as $dialogInvites) {
                        // need to save related object because we set the relation to null
                        $dialogInvites->save($con);
                    }
                    $this->dialogInvitessScheduledForDeletion = null;
                }
            }

            if ($this->collDialogInvitess !== null) {
                foreach ($this->collDialogInvitess as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->dialogMessagessScheduledForDeletion !== null) {
                if (!$this->dialogMessagessScheduledForDeletion->isEmpty()) {
                    \basteyy\XzitGiggle\Models\DialogMessageQuery::create()
                        ->filterByPrimaryKeys($this->dialogMessagessScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->dialogMessagessScheduledForDeletion = null;
                }
            }

            if ($this->collDialogMessagess !== null) {
                foreach ($this->collDialogMessagess as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->actionLogssScheduledForDeletion !== null) {
                if (!$this->actionLogssScheduledForDeletion->isEmpty()) {
                    \basteyy\XzitGiggle\Models\ActionLogQuery::create()
                        ->filterByPrimaryKeys($this->actionLogssScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->actionLogssScheduledForDeletion = null;
                }
            }

            if ($this->collActionLogss !== null) {
                foreach ($this->collActionLogss as $referrerFK) {
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

        $this->modifiedColumns[UserTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . UserTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(UserTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(UserTableMap::COL_EMAIL)) {
            $modifiedColumns[':p' . $index++]  = '`email`';
        }
        if ($this->isColumnModified(UserTableMap::COL_USERNAME)) {
            $modifiedColumns[':p' . $index++]  = '`username`';
        }
        if ($this->isColumnModified(UserTableMap::COL_USER_ROLE_ID)) {
            $modifiedColumns[':p' . $index++]  = '`user_role_id`';
        }
        if ($this->isColumnModified(UserTableMap::COL_SECRET_KEY)) {
            $modifiedColumns[':p' . $index++]  = '`secret_key`';
        }
        if ($this->isColumnModified(UserTableMap::COL_PASSWORD_HASH)) {
            $modifiedColumns[':p' . $index++]  = '`password_hash`';
        }
        if ($this->isColumnModified(UserTableMap::COL_ACTIVATED)) {
            $modifiedColumns[':p' . $index++]  = '`activated`';
        }
        if ($this->isColumnModified(UserTableMap::COL_BLOCKED)) {
            $modifiedColumns[':p' . $index++]  = '`blocked`';
        }
        if ($this->isColumnModified(UserTableMap::COL_IS_DELETE_CANDIDATE)) {
            $modifiedColumns[':p' . $index++]  = '`is_delete_candidate`';
        }
        if ($this->isColumnModified(UserTableMap::COL_LAST_LOGIN)) {
            $modifiedColumns[':p' . $index++]  = '`last_login`';
        }
        if ($this->isColumnModified(UserTableMap::COL_LAST_LOGIN_IP)) {
            $modifiedColumns[':p' . $index++]  = '`last_login_ip`';
        }
        if ($this->isColumnModified(UserTableMap::COL_PROCESSED)) {
            $modifiedColumns[':p' . $index++]  = '`processed`';
        }
        if ($this->isColumnModified(UserTableMap::COL_PROCESSED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`processed_at`';
        }
        if ($this->isColumnModified(UserTableMap::COL_HOME_FOLDER)) {
            $modifiedColumns[':p' . $index++]  = '`home_folder`';
        }
        if ($this->isColumnModified(UserTableMap::COL_LOG_FOLDER)) {
            $modifiedColumns[':p' . $index++]  = '`log_folder`';
        }
        if ($this->isColumnModified(UserTableMap::COL_WEB_FOLDER)) {
            $modifiedColumns[':p' . $index++]  = '`web_folder`';
        }
        if ($this->isColumnModified(UserTableMap::COL_BASH)) {
            $modifiedColumns[':p' . $index++]  = '`bash`';
        }

        $sql = sprintf(
            'INSERT INTO `xg_users` (%s) VALUES (%s)',
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
                    case '`email`':
                        $stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);

                        break;
                    case '`username`':
                        $stmt->bindValue($identifier, $this->username, PDO::PARAM_STR);

                        break;
                    case '`user_role_id`':
                        $stmt->bindValue($identifier, $this->user_role_id, PDO::PARAM_INT);

                        break;
                    case '`secret_key`':
                        $stmt->bindValue($identifier, $this->secret_key, PDO::PARAM_STR);

                        break;
                    case '`password_hash`':
                        $stmt->bindValue($identifier, $this->password_hash, PDO::PARAM_STR);

                        break;
                    case '`activated`':
                        $stmt->bindValue($identifier, (int) $this->activated, PDO::PARAM_INT);

                        break;
                    case '`blocked`':
                        $stmt->bindValue($identifier, (int) $this->blocked, PDO::PARAM_INT);

                        break;
                    case '`is_delete_candidate`':
                        $stmt->bindValue($identifier, (int) $this->is_delete_candidate, PDO::PARAM_INT);

                        break;
                    case '`last_login`':
                        $stmt->bindValue($identifier, $this->last_login ? $this->last_login->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case '`last_login_ip`':
                        $stmt->bindValue($identifier, $this->last_login_ip, PDO::PARAM_STR);

                        break;
                    case '`processed`':
                        $stmt->bindValue($identifier, (int) $this->processed, PDO::PARAM_INT);

                        break;
                    case '`processed_at`':
                        $stmt->bindValue($identifier, $this->processed_at ? $this->processed_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case '`home_folder`':
                        $stmt->bindValue($identifier, $this->home_folder, PDO::PARAM_STR);

                        break;
                    case '`log_folder`':
                        $stmt->bindValue($identifier, $this->log_folder, PDO::PARAM_STR);

                        break;
                    case '`web_folder`':
                        $stmt->bindValue($identifier, $this->web_folder, PDO::PARAM_STR);

                        break;
                    case '`bash`':
                        $stmt->bindValue($identifier, $this->bash, PDO::PARAM_STR);

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
        $pos = UserTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getEmail();

            case 2:
                return $this->getUsername();

            case 3:
                return $this->getUserRoleId();

            case 4:
                return $this->getSecretKey();

            case 5:
                return $this->getPasswordHash();

            case 6:
                return $this->getActivated();

            case 7:
                return $this->getBlocked();

            case 8:
                return $this->getIsDeleteCandidate();

            case 9:
                return $this->getLastLogin();

            case 10:
                return $this->getLastLoginIp();

            case 11:
                return $this->getProcessed();

            case 12:
                return $this->getProcessedAt();

            case 13:
                return $this->getHomeFolder();

            case 14:
                return $this->getLogFolder();

            case 15:
                return $this->getWebFolder();

            case 16:
                return $this->getBash();

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
        if (isset($alreadyDumpedObjects['User'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['User'][$this->hashCode()] = true;
        $keys = UserTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getId(),
            $keys[1] => $this->getEmail(),
            $keys[2] => $this->getUsername(),
            $keys[3] => $this->getUserRoleId(),
            $keys[4] => $this->getSecretKey(),
            $keys[5] => $this->getPasswordHash(),
            $keys[6] => $this->getActivated(),
            $keys[7] => $this->getBlocked(),
            $keys[8] => $this->getIsDeleteCandidate(),
            $keys[9] => $this->getLastLogin(),
            $keys[10] => $this->getLastLoginIp(),
            $keys[11] => $this->getProcessed(),
            $keys[12] => $this->getProcessedAt(),
            $keys[13] => $this->getHomeFolder(),
            $keys[14] => $this->getLogFolder(),
            $keys[15] => $this->getWebFolder(),
            $keys[16] => $this->getBash(),
        ];
        if ($result[$keys[9]] instanceof \DateTimeInterface) {
            $result[$keys[9]] = $result[$keys[9]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[12]] instanceof \DateTimeInterface) {
            $result[$keys[12]] = $result[$keys[12]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aUserRole) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'userRole';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'xg_user_roles';
                        break;
                    default:
                        $key = 'UserRole';
                }

                $result[$key] = $this->aUserRole->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collIpPoolUserss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'ipPoolUserss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'xg_ip_pool_userss';
                        break;
                    default:
                        $key = 'IpPoolUserss';
                }

                $result[$key] = $this->collIpPoolUserss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collDomainss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'domains';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'xg_domainss';
                        break;
                    default:
                        $key = 'Domainss';
                }

                $result[$key] = $this->collDomainss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collStartedDialogss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'dialogs';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'xg_dialogss';
                        break;
                    default:
                        $key = 'StartedDialogss';
                }

                $result[$key] = $this->collStartedDialogss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collDialogss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'dialogUsers';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'xg_dialog_userss';
                        break;
                    default:
                        $key = 'Dialogss';
                }

                $result[$key] = $this->collDialogss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collDialogInvitess) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'dialogUsers';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'xg_dialog_userss';
                        break;
                    default:
                        $key = 'DialogInvitess';
                }

                $result[$key] = $this->collDialogInvitess->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collDialogMessagess) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'dialogMessages';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'xg_dialog_messagess';
                        break;
                    default:
                        $key = 'DialogMessagess';
                }

                $result[$key] = $this->collDialogMessagess->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collActionLogss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'actionLogs';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'xg_action_logs';
                        break;
                    default:
                        $key = 'ActionLogss';
                }

                $result[$key] = $this->collActionLogss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = UserTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setEmail($value);
                break;
            case 2:
                $this->setUsername($value);
                break;
            case 3:
                $this->setUserRoleId($value);
                break;
            case 4:
                $this->setSecretKey($value);
                break;
            case 5:
                $this->setPasswordHash($value);
                break;
            case 6:
                $this->setActivated($value);
                break;
            case 7:
                $this->setBlocked($value);
                break;
            case 8:
                $this->setIsDeleteCandidate($value);
                break;
            case 9:
                $this->setLastLogin($value);
                break;
            case 10:
                $this->setLastLoginIp($value);
                break;
            case 11:
                $this->setProcessed($value);
                break;
            case 12:
                $this->setProcessedAt($value);
                break;
            case 13:
                $this->setHomeFolder($value);
                break;
            case 14:
                $this->setLogFolder($value);
                break;
            case 15:
                $this->setWebFolder($value);
                break;
            case 16:
                $this->setBash($value);
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
        $keys = UserTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setEmail($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setUsername($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setUserRoleId($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setSecretKey($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setPasswordHash($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setActivated($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setBlocked($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setIsDeleteCandidate($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setLastLogin($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setLastLoginIp($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setProcessed($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setProcessedAt($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setHomeFolder($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setLogFolder($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setWebFolder($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setBash($arr[$keys[16]]);
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
        $criteria = new Criteria(UserTableMap::DATABASE_NAME);

        if ($this->isColumnModified(UserTableMap::COL_ID)) {
            $criteria->add(UserTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(UserTableMap::COL_EMAIL)) {
            $criteria->add(UserTableMap::COL_EMAIL, $this->email);
        }
        if ($this->isColumnModified(UserTableMap::COL_USERNAME)) {
            $criteria->add(UserTableMap::COL_USERNAME, $this->username);
        }
        if ($this->isColumnModified(UserTableMap::COL_USER_ROLE_ID)) {
            $criteria->add(UserTableMap::COL_USER_ROLE_ID, $this->user_role_id);
        }
        if ($this->isColumnModified(UserTableMap::COL_SECRET_KEY)) {
            $criteria->add(UserTableMap::COL_SECRET_KEY, $this->secret_key);
        }
        if ($this->isColumnModified(UserTableMap::COL_PASSWORD_HASH)) {
            $criteria->add(UserTableMap::COL_PASSWORD_HASH, $this->password_hash);
        }
        if ($this->isColumnModified(UserTableMap::COL_ACTIVATED)) {
            $criteria->add(UserTableMap::COL_ACTIVATED, $this->activated);
        }
        if ($this->isColumnModified(UserTableMap::COL_BLOCKED)) {
            $criteria->add(UserTableMap::COL_BLOCKED, $this->blocked);
        }
        if ($this->isColumnModified(UserTableMap::COL_IS_DELETE_CANDIDATE)) {
            $criteria->add(UserTableMap::COL_IS_DELETE_CANDIDATE, $this->is_delete_candidate);
        }
        if ($this->isColumnModified(UserTableMap::COL_LAST_LOGIN)) {
            $criteria->add(UserTableMap::COL_LAST_LOGIN, $this->last_login);
        }
        if ($this->isColumnModified(UserTableMap::COL_LAST_LOGIN_IP)) {
            $criteria->add(UserTableMap::COL_LAST_LOGIN_IP, $this->last_login_ip);
        }
        if ($this->isColumnModified(UserTableMap::COL_PROCESSED)) {
            $criteria->add(UserTableMap::COL_PROCESSED, $this->processed);
        }
        if ($this->isColumnModified(UserTableMap::COL_PROCESSED_AT)) {
            $criteria->add(UserTableMap::COL_PROCESSED_AT, $this->processed_at);
        }
        if ($this->isColumnModified(UserTableMap::COL_HOME_FOLDER)) {
            $criteria->add(UserTableMap::COL_HOME_FOLDER, $this->home_folder);
        }
        if ($this->isColumnModified(UserTableMap::COL_LOG_FOLDER)) {
            $criteria->add(UserTableMap::COL_LOG_FOLDER, $this->log_folder);
        }
        if ($this->isColumnModified(UserTableMap::COL_WEB_FOLDER)) {
            $criteria->add(UserTableMap::COL_WEB_FOLDER, $this->web_folder);
        }
        if ($this->isColumnModified(UserTableMap::COL_BASH)) {
            $criteria->add(UserTableMap::COL_BASH, $this->bash);
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
        $criteria = ChildUserQuery::create();
        $criteria->add(UserTableMap::COL_ID, $this->id);

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
     * @param object $copyObj An object of \basteyy\XzitGiggle\Models\User (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setEmail($this->getEmail());
        $copyObj->setUsername($this->getUsername());
        $copyObj->setUserRoleId($this->getUserRoleId());
        $copyObj->setSecretKey($this->getSecretKey());
        $copyObj->setPasswordHash($this->getPasswordHash());
        $copyObj->setActivated($this->getActivated());
        $copyObj->setBlocked($this->getBlocked());
        $copyObj->setIsDeleteCandidate($this->getIsDeleteCandidate());
        $copyObj->setLastLogin($this->getLastLogin());
        $copyObj->setLastLoginIp($this->getLastLoginIp());
        $copyObj->setProcessed($this->getProcessed());
        $copyObj->setProcessedAt($this->getProcessedAt());
        $copyObj->setHomeFolder($this->getHomeFolder());
        $copyObj->setLogFolder($this->getLogFolder());
        $copyObj->setWebFolder($this->getWebFolder());
        $copyObj->setBash($this->getBash());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getIpPoolUserss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addIpPoolUsers($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getDomainss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addDomains($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getStartedDialogss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addStartedDialogs($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getDialogss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addDialogs($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getDialogInvitess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addDialogInvites($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getDialogMessagess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addDialogMessages($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getActionLogss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addActionLogs($relObj->copy($deepCopy));
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
     * @return \basteyy\XzitGiggle\Models\User Clone of current object.
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
     * Declares an association between this object and a ChildUserRole object.
     *
     * @param ChildUserRole $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setUserRole(ChildUserRole $v = null)
    {
        if ($v === null) {
            $this->setUserRoleId(NULL);
        } else {
            $this->setUserRoleId($v->getId());
        }

        $this->aUserRole = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildUserRole object, it will not be re-added.
        if ($v !== null) {
            $v->addUsers($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildUserRole object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildUserRole The associated ChildUserRole object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getUserRole(?ConnectionInterface $con = null)
    {
        if ($this->aUserRole === null && ($this->user_role_id != 0)) {
            $this->aUserRole = ChildUserRoleQuery::create()->findPk($this->user_role_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aUserRole->addUserss($this);
             */
        }

        return $this->aUserRole;
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
        if ('IpPoolUsers' === $relationName) {
            $this->initIpPoolUserss();
            return;
        }
        if ('Domains' === $relationName) {
            $this->initDomainss();
            return;
        }
        if ('StartedDialogs' === $relationName) {
            $this->initStartedDialogss();
            return;
        }
        if ('Dialogs' === $relationName) {
            $this->initDialogss();
            return;
        }
        if ('DialogInvites' === $relationName) {
            $this->initDialogInvitess();
            return;
        }
        if ('DialogMessages' === $relationName) {
            $this->initDialogMessagess();
            return;
        }
        if ('ActionLogs' === $relationName) {
            $this->initActionLogss();
            return;
        }
    }

    /**
     * Clears out the collIpPoolUserss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addIpPoolUserss()
     */
    public function clearIpPoolUserss()
    {
        $this->collIpPoolUserss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collIpPoolUserss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialIpPoolUserss($v = true): void
    {
        $this->collIpPoolUserssPartial = $v;
    }

    /**
     * Initializes the collIpPoolUserss collection.
     *
     * By default this just sets the collIpPoolUserss collection to an empty array (like clearcollIpPoolUserss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initIpPoolUserss(bool $overrideExisting = true): void
    {
        if (null !== $this->collIpPoolUserss && !$overrideExisting) {
            return;
        }

        $collectionClassName = IpPoolUsersTableMap::getTableMap()->getCollectionClassName();

        $this->collIpPoolUserss = new $collectionClassName;
        $this->collIpPoolUserss->setModel('\basteyy\XzitGiggle\Models\IpPoolUsers');
    }

    /**
     * Gets an array of ChildIpPoolUsers objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildIpPoolUsers[] List of ChildIpPoolUsers objects
     * @phpstan-return ObjectCollection&\Traversable<ChildIpPoolUsers> List of ChildIpPoolUsers objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getIpPoolUserss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collIpPoolUserssPartial && !$this->isNew();
        if (null === $this->collIpPoolUserss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collIpPoolUserss) {
                    $this->initIpPoolUserss();
                } else {
                    $collectionClassName = IpPoolUsersTableMap::getTableMap()->getCollectionClassName();

                    $collIpPoolUserss = new $collectionClassName;
                    $collIpPoolUserss->setModel('\basteyy\XzitGiggle\Models\IpPoolUsers');

                    return $collIpPoolUserss;
                }
            } else {
                $collIpPoolUserss = ChildIpPoolUsersQuery::create(null, $criteria)
                    ->filterByUsers($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collIpPoolUserssPartial && count($collIpPoolUserss)) {
                        $this->initIpPoolUserss(false);

                        foreach ($collIpPoolUserss as $obj) {
                            if (false == $this->collIpPoolUserss->contains($obj)) {
                                $this->collIpPoolUserss->append($obj);
                            }
                        }

                        $this->collIpPoolUserssPartial = true;
                    }

                    return $collIpPoolUserss;
                }

                if ($partial && $this->collIpPoolUserss) {
                    foreach ($this->collIpPoolUserss as $obj) {
                        if ($obj->isNew()) {
                            $collIpPoolUserss[] = $obj;
                        }
                    }
                }

                $this->collIpPoolUserss = $collIpPoolUserss;
                $this->collIpPoolUserssPartial = false;
            }
        }

        return $this->collIpPoolUserss;
    }

    /**
     * Sets a collection of ChildIpPoolUsers objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $ipPoolUserss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setIpPoolUserss(Collection $ipPoolUserss, ?ConnectionInterface $con = null)
    {
        /** @var ChildIpPoolUsers[] $ipPoolUserssToDelete */
        $ipPoolUserssToDelete = $this->getIpPoolUserss(new Criteria(), $con)->diff($ipPoolUserss);


        $this->ipPoolUserssScheduledForDeletion = $ipPoolUserssToDelete;

        foreach ($ipPoolUserssToDelete as $ipPoolUsersRemoved) {
            $ipPoolUsersRemoved->setUsers(null);
        }

        $this->collIpPoolUserss = null;
        foreach ($ipPoolUserss as $ipPoolUsers) {
            $this->addIpPoolUsers($ipPoolUsers);
        }

        $this->collIpPoolUserss = $ipPoolUserss;
        $this->collIpPoolUserssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related IpPoolUsers objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related IpPoolUsers objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countIpPoolUserss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collIpPoolUserssPartial && !$this->isNew();
        if (null === $this->collIpPoolUserss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collIpPoolUserss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getIpPoolUserss());
            }

            $query = ChildIpPoolUsersQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUsers($this)
                ->count($con);
        }

        return count($this->collIpPoolUserss);
    }

    /**
     * Method called to associate a ChildIpPoolUsers object to this object
     * through the ChildIpPoolUsers foreign key attribute.
     *
     * @param ChildIpPoolUsers $l ChildIpPoolUsers
     * @return $this The current object (for fluent API support)
     */
    public function addIpPoolUsers(ChildIpPoolUsers $l)
    {
        if ($this->collIpPoolUserss === null) {
            $this->initIpPoolUserss();
            $this->collIpPoolUserssPartial = true;
        }

        if (!$this->collIpPoolUserss->contains($l)) {
            $this->doAddIpPoolUsers($l);

            if ($this->ipPoolUserssScheduledForDeletion and $this->ipPoolUserssScheduledForDeletion->contains($l)) {
                $this->ipPoolUserssScheduledForDeletion->remove($this->ipPoolUserssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildIpPoolUsers $ipPoolUsers The ChildIpPoolUsers object to add.
     */
    protected function doAddIpPoolUsers(ChildIpPoolUsers $ipPoolUsers): void
    {
        $this->collIpPoolUserss[]= $ipPoolUsers;
        $ipPoolUsers->setUsers($this);
    }

    /**
     * @param ChildIpPoolUsers $ipPoolUsers The ChildIpPoolUsers object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeIpPoolUsers(ChildIpPoolUsers $ipPoolUsers)
    {
        if ($this->getIpPoolUserss()->contains($ipPoolUsers)) {
            $pos = $this->collIpPoolUserss->search($ipPoolUsers);
            $this->collIpPoolUserss->remove($pos);
            if (null === $this->ipPoolUserssScheduledForDeletion) {
                $this->ipPoolUserssScheduledForDeletion = clone $this->collIpPoolUserss;
                $this->ipPoolUserssScheduledForDeletion->clear();
            }
            $this->ipPoolUserssScheduledForDeletion[]= clone $ipPoolUsers;
            $ipPoolUsers->setUsers(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related IpPoolUserss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildIpPoolUsers[] List of ChildIpPoolUsers objects
     * @phpstan-return ObjectCollection&\Traversable<ChildIpPoolUsers}> List of ChildIpPoolUsers objects
     */
    public function getIpPoolUserssJoinIpPool(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildIpPoolUsersQuery::create(null, $criteria);
        $query->joinWith('IpPool', $joinBehavior);

        return $this->getIpPoolUserss($query, $con);
    }

    /**
     * Clears out the collDomainss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addDomainss()
     */
    public function clearDomainss()
    {
        $this->collDomainss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collDomainss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialDomainss($v = true): void
    {
        $this->collDomainssPartial = $v;
    }

    /**
     * Initializes the collDomainss collection.
     *
     * By default this just sets the collDomainss collection to an empty array (like clearcollDomainss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initDomainss(bool $overrideExisting = true): void
    {
        if (null !== $this->collDomainss && !$overrideExisting) {
            return;
        }

        $collectionClassName = DomainTableMap::getTableMap()->getCollectionClassName();

        $this->collDomainss = new $collectionClassName;
        $this->collDomainss->setModel('\basteyy\XzitGiggle\Models\Domain');
    }

    /**
     * Gets an array of ChildDomain objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildDomain[] List of ChildDomain objects
     * @phpstan-return ObjectCollection&\Traversable<ChildDomain> List of ChildDomain objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getDomainss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collDomainssPartial && !$this->isNew();
        if (null === $this->collDomainss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collDomainss) {
                    $this->initDomainss();
                } else {
                    $collectionClassName = DomainTableMap::getTableMap()->getCollectionClassName();

                    $collDomainss = new $collectionClassName;
                    $collDomainss->setModel('\basteyy\XzitGiggle\Models\Domain');

                    return $collDomainss;
                }
            } else {
                $collDomainss = ChildDomainQuery::create(null, $criteria)
                    ->filterByUser($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collDomainssPartial && count($collDomainss)) {
                        $this->initDomainss(false);

                        foreach ($collDomainss as $obj) {
                            if (false == $this->collDomainss->contains($obj)) {
                                $this->collDomainss->append($obj);
                            }
                        }

                        $this->collDomainssPartial = true;
                    }

                    return $collDomainss;
                }

                if ($partial && $this->collDomainss) {
                    foreach ($this->collDomainss as $obj) {
                        if ($obj->isNew()) {
                            $collDomainss[] = $obj;
                        }
                    }
                }

                $this->collDomainss = $collDomainss;
                $this->collDomainssPartial = false;
            }
        }

        return $this->collDomainss;
    }

    /**
     * Sets a collection of ChildDomain objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $domainss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setDomainss(Collection $domainss, ?ConnectionInterface $con = null)
    {
        /** @var ChildDomain[] $domainssToDelete */
        $domainssToDelete = $this->getDomainss(new Criteria(), $con)->diff($domainss);


        $this->domainssScheduledForDeletion = $domainssToDelete;

        foreach ($domainssToDelete as $domainsRemoved) {
            $domainsRemoved->setUser(null);
        }

        $this->collDomainss = null;
        foreach ($domainss as $domains) {
            $this->addDomains($domains);
        }

        $this->collDomainss = $domainss;
        $this->collDomainssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Domain objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Domain objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countDomainss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collDomainssPartial && !$this->isNew();
        if (null === $this->collDomainss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collDomainss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getDomainss());
            }

            $query = ChildDomainQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUser($this)
                ->count($con);
        }

        return count($this->collDomainss);
    }

    /**
     * Method called to associate a ChildDomain object to this object
     * through the ChildDomain foreign key attribute.
     *
     * @param ChildDomain $l ChildDomain
     * @return $this The current object (for fluent API support)
     */
    public function addDomains(ChildDomain $l)
    {
        if ($this->collDomainss === null) {
            $this->initDomainss();
            $this->collDomainssPartial = true;
        }

        if (!$this->collDomainss->contains($l)) {
            $this->doAddDomains($l);

            if ($this->domainssScheduledForDeletion and $this->domainssScheduledForDeletion->contains($l)) {
                $this->domainssScheduledForDeletion->remove($this->domainssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildDomain $domains The ChildDomain object to add.
     */
    protected function doAddDomains(ChildDomain $domains): void
    {
        $this->collDomainss[]= $domains;
        $domains->setUser($this);
    }

    /**
     * @param ChildDomain $domains The ChildDomain object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeDomains(ChildDomain $domains)
    {
        if ($this->getDomainss()->contains($domains)) {
            $pos = $this->collDomainss->search($domains);
            $this->collDomainss->remove($pos);
            if (null === $this->domainssScheduledForDeletion) {
                $this->domainssScheduledForDeletion = clone $this->collDomainss;
                $this->domainssScheduledForDeletion->clear();
            }
            $this->domainssScheduledForDeletion[]= clone $domains;
            $domains->setUser(null);
        }

        return $this;
    }

    /**
     * Clears out the collStartedDialogss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addStartedDialogss()
     */
    public function clearStartedDialogss()
    {
        $this->collStartedDialogss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collStartedDialogss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialStartedDialogss($v = true): void
    {
        $this->collStartedDialogssPartial = $v;
    }

    /**
     * Initializes the collStartedDialogss collection.
     *
     * By default this just sets the collStartedDialogss collection to an empty array (like clearcollStartedDialogss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initStartedDialogss(bool $overrideExisting = true): void
    {
        if (null !== $this->collStartedDialogss && !$overrideExisting) {
            return;
        }

        $collectionClassName = DialogTableMap::getTableMap()->getCollectionClassName();

        $this->collStartedDialogss = new $collectionClassName;
        $this->collStartedDialogss->setModel('\basteyy\XzitGiggle\Models\Dialog');
    }

    /**
     * Gets an array of ChildDialog objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildDialog[] List of ChildDialog objects
     * @phpstan-return ObjectCollection&\Traversable<ChildDialog> List of ChildDialog objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getStartedDialogss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collStartedDialogssPartial && !$this->isNew();
        if (null === $this->collStartedDialogss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collStartedDialogss) {
                    $this->initStartedDialogss();
                } else {
                    $collectionClassName = DialogTableMap::getTableMap()->getCollectionClassName();

                    $collStartedDialogss = new $collectionClassName;
                    $collStartedDialogss->setModel('\basteyy\XzitGiggle\Models\Dialog');

                    return $collStartedDialogss;
                }
            } else {
                $collStartedDialogss = ChildDialogQuery::create(null, $criteria)
                    ->filterByCreatedByUser($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collStartedDialogssPartial && count($collStartedDialogss)) {
                        $this->initStartedDialogss(false);

                        foreach ($collStartedDialogss as $obj) {
                            if (false == $this->collStartedDialogss->contains($obj)) {
                                $this->collStartedDialogss->append($obj);
                            }
                        }

                        $this->collStartedDialogssPartial = true;
                    }

                    return $collStartedDialogss;
                }

                if ($partial && $this->collStartedDialogss) {
                    foreach ($this->collStartedDialogss as $obj) {
                        if ($obj->isNew()) {
                            $collStartedDialogss[] = $obj;
                        }
                    }
                }

                $this->collStartedDialogss = $collStartedDialogss;
                $this->collStartedDialogssPartial = false;
            }
        }

        return $this->collStartedDialogss;
    }

    /**
     * Sets a collection of ChildDialog objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $startedDialogss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setStartedDialogss(Collection $startedDialogss, ?ConnectionInterface $con = null)
    {
        /** @var ChildDialog[] $startedDialogssToDelete */
        $startedDialogssToDelete = $this->getStartedDialogss(new Criteria(), $con)->diff($startedDialogss);


        $this->startedDialogssScheduledForDeletion = $startedDialogssToDelete;

        foreach ($startedDialogssToDelete as $startedDialogsRemoved) {
            $startedDialogsRemoved->setCreatedByUser(null);
        }

        $this->collStartedDialogss = null;
        foreach ($startedDialogss as $startedDialogs) {
            $this->addStartedDialogs($startedDialogs);
        }

        $this->collStartedDialogss = $startedDialogss;
        $this->collStartedDialogssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Dialog objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Dialog objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countStartedDialogss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collStartedDialogssPartial && !$this->isNew();
        if (null === $this->collStartedDialogss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collStartedDialogss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getStartedDialogss());
            }

            $query = ChildDialogQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCreatedByUser($this)
                ->count($con);
        }

        return count($this->collStartedDialogss);
    }

    /**
     * Method called to associate a ChildDialog object to this object
     * through the ChildDialog foreign key attribute.
     *
     * @param ChildDialog $l ChildDialog
     * @return $this The current object (for fluent API support)
     */
    public function addStartedDialogs(ChildDialog $l)
    {
        if ($this->collStartedDialogss === null) {
            $this->initStartedDialogss();
            $this->collStartedDialogssPartial = true;
        }

        if (!$this->collStartedDialogss->contains($l)) {
            $this->doAddStartedDialogs($l);

            if ($this->startedDialogssScheduledForDeletion and $this->startedDialogssScheduledForDeletion->contains($l)) {
                $this->startedDialogssScheduledForDeletion->remove($this->startedDialogssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildDialog $startedDialogs The ChildDialog object to add.
     */
    protected function doAddStartedDialogs(ChildDialog $startedDialogs): void
    {
        $this->collStartedDialogss[]= $startedDialogs;
        $startedDialogs->setCreatedByUser($this);
    }

    /**
     * @param ChildDialog $startedDialogs The ChildDialog object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeStartedDialogs(ChildDialog $startedDialogs)
    {
        if ($this->getStartedDialogss()->contains($startedDialogs)) {
            $pos = $this->collStartedDialogss->search($startedDialogs);
            $this->collStartedDialogss->remove($pos);
            if (null === $this->startedDialogssScheduledForDeletion) {
                $this->startedDialogssScheduledForDeletion = clone $this->collStartedDialogss;
                $this->startedDialogssScheduledForDeletion->clear();
            }
            $this->startedDialogssScheduledForDeletion[]= clone $startedDialogs;
            $startedDialogs->setCreatedByUser(null);
        }

        return $this;
    }

    /**
     * Clears out the collDialogss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addDialogss()
     */
    public function clearDialogss()
    {
        $this->collDialogss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collDialogss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialDialogss($v = true): void
    {
        $this->collDialogssPartial = $v;
    }

    /**
     * Initializes the collDialogss collection.
     *
     * By default this just sets the collDialogss collection to an empty array (like clearcollDialogss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initDialogss(bool $overrideExisting = true): void
    {
        if (null !== $this->collDialogss && !$overrideExisting) {
            return;
        }

        $collectionClassName = DialogUserTableMap::getTableMap()->getCollectionClassName();

        $this->collDialogss = new $collectionClassName;
        $this->collDialogss->setModel('\basteyy\XzitGiggle\Models\DialogUser');
    }

    /**
     * Gets an array of ChildDialogUser objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildDialogUser[] List of ChildDialogUser objects
     * @phpstan-return ObjectCollection&\Traversable<ChildDialogUser> List of ChildDialogUser objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getDialogss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collDialogssPartial && !$this->isNew();
        if (null === $this->collDialogss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collDialogss) {
                    $this->initDialogss();
                } else {
                    $collectionClassName = DialogUserTableMap::getTableMap()->getCollectionClassName();

                    $collDialogss = new $collectionClassName;
                    $collDialogss->setModel('\basteyy\XzitGiggle\Models\DialogUser');

                    return $collDialogss;
                }
            } else {
                $collDialogss = ChildDialogUserQuery::create(null, $criteria)
                    ->filterByUser($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collDialogssPartial && count($collDialogss)) {
                        $this->initDialogss(false);

                        foreach ($collDialogss as $obj) {
                            if (false == $this->collDialogss->contains($obj)) {
                                $this->collDialogss->append($obj);
                            }
                        }

                        $this->collDialogssPartial = true;
                    }

                    return $collDialogss;
                }

                if ($partial && $this->collDialogss) {
                    foreach ($this->collDialogss as $obj) {
                        if ($obj->isNew()) {
                            $collDialogss[] = $obj;
                        }
                    }
                }

                $this->collDialogss = $collDialogss;
                $this->collDialogssPartial = false;
            }
        }

        return $this->collDialogss;
    }

    /**
     * Sets a collection of ChildDialogUser objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $dialogss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setDialogss(Collection $dialogss, ?ConnectionInterface $con = null)
    {
        /** @var ChildDialogUser[] $dialogssToDelete */
        $dialogssToDelete = $this->getDialogss(new Criteria(), $con)->diff($dialogss);


        $this->dialogssScheduledForDeletion = $dialogssToDelete;

        foreach ($dialogssToDelete as $dialogsRemoved) {
            $dialogsRemoved->setUser(null);
        }

        $this->collDialogss = null;
        foreach ($dialogss as $dialogs) {
            $this->addDialogs($dialogs);
        }

        $this->collDialogss = $dialogss;
        $this->collDialogssPartial = false;

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
    public function countDialogss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collDialogssPartial && !$this->isNew();
        if (null === $this->collDialogss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collDialogss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getDialogss());
            }

            $query = ChildDialogUserQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUser($this)
                ->count($con);
        }

        return count($this->collDialogss);
    }

    /**
     * Method called to associate a ChildDialogUser object to this object
     * through the ChildDialogUser foreign key attribute.
     *
     * @param ChildDialogUser $l ChildDialogUser
     * @return $this The current object (for fluent API support)
     */
    public function addDialogs(ChildDialogUser $l)
    {
        if ($this->collDialogss === null) {
            $this->initDialogss();
            $this->collDialogssPartial = true;
        }

        if (!$this->collDialogss->contains($l)) {
            $this->doAddDialogs($l);

            if ($this->dialogssScheduledForDeletion and $this->dialogssScheduledForDeletion->contains($l)) {
                $this->dialogssScheduledForDeletion->remove($this->dialogssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildDialogUser $dialogs The ChildDialogUser object to add.
     */
    protected function doAddDialogs(ChildDialogUser $dialogs): void
    {
        $this->collDialogss[]= $dialogs;
        $dialogs->setUser($this);
    }

    /**
     * @param ChildDialogUser $dialogs The ChildDialogUser object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeDialogs(ChildDialogUser $dialogs)
    {
        if ($this->getDialogss()->contains($dialogs)) {
            $pos = $this->collDialogss->search($dialogs);
            $this->collDialogss->remove($pos);
            if (null === $this->dialogssScheduledForDeletion) {
                $this->dialogssScheduledForDeletion = clone $this->collDialogss;
                $this->dialogssScheduledForDeletion->clear();
            }
            $this->dialogssScheduledForDeletion[]= clone $dialogs;
            $dialogs->setUser(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related Dialogss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildDialogUser[] List of ChildDialogUser objects
     * @phpstan-return ObjectCollection&\Traversable<ChildDialogUser}> List of ChildDialogUser objects
     */
    public function getDialogssJoinDialog(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildDialogUserQuery::create(null, $criteria);
        $query->joinWith('Dialog', $joinBehavior);

        return $this->getDialogss($query, $con);
    }

    /**
     * Clears out the collDialogInvitess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addDialogInvitess()
     */
    public function clearDialogInvitess()
    {
        $this->collDialogInvitess = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collDialogInvitess collection loaded partially.
     *
     * @return void
     */
    public function resetPartialDialogInvitess($v = true): void
    {
        $this->collDialogInvitessPartial = $v;
    }

    /**
     * Initializes the collDialogInvitess collection.
     *
     * By default this just sets the collDialogInvitess collection to an empty array (like clearcollDialogInvitess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initDialogInvitess(bool $overrideExisting = true): void
    {
        if (null !== $this->collDialogInvitess && !$overrideExisting) {
            return;
        }

        $collectionClassName = DialogUserTableMap::getTableMap()->getCollectionClassName();

        $this->collDialogInvitess = new $collectionClassName;
        $this->collDialogInvitess->setModel('\basteyy\XzitGiggle\Models\DialogUser');
    }

    /**
     * Gets an array of ChildDialogUser objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildDialogUser[] List of ChildDialogUser objects
     * @phpstan-return ObjectCollection&\Traversable<ChildDialogUser> List of ChildDialogUser objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getDialogInvitess(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collDialogInvitessPartial && !$this->isNew();
        if (null === $this->collDialogInvitess || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collDialogInvitess) {
                    $this->initDialogInvitess();
                } else {
                    $collectionClassName = DialogUserTableMap::getTableMap()->getCollectionClassName();

                    $collDialogInvitess = new $collectionClassName;
                    $collDialogInvitess->setModel('\basteyy\XzitGiggle\Models\DialogUser');

                    return $collDialogInvitess;
                }
            } else {
                $collDialogInvitess = ChildDialogUserQuery::create(null, $criteria)
                    ->filterByInviterUser($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collDialogInvitessPartial && count($collDialogInvitess)) {
                        $this->initDialogInvitess(false);

                        foreach ($collDialogInvitess as $obj) {
                            if (false == $this->collDialogInvitess->contains($obj)) {
                                $this->collDialogInvitess->append($obj);
                            }
                        }

                        $this->collDialogInvitessPartial = true;
                    }

                    return $collDialogInvitess;
                }

                if ($partial && $this->collDialogInvitess) {
                    foreach ($this->collDialogInvitess as $obj) {
                        if ($obj->isNew()) {
                            $collDialogInvitess[] = $obj;
                        }
                    }
                }

                $this->collDialogInvitess = $collDialogInvitess;
                $this->collDialogInvitessPartial = false;
            }
        }

        return $this->collDialogInvitess;
    }

    /**
     * Sets a collection of ChildDialogUser objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $dialogInvitess A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setDialogInvitess(Collection $dialogInvitess, ?ConnectionInterface $con = null)
    {
        /** @var ChildDialogUser[] $dialogInvitessToDelete */
        $dialogInvitessToDelete = $this->getDialogInvitess(new Criteria(), $con)->diff($dialogInvitess);


        $this->dialogInvitessScheduledForDeletion = $dialogInvitessToDelete;

        foreach ($dialogInvitessToDelete as $dialogInvitesRemoved) {
            $dialogInvitesRemoved->setInviterUser(null);
        }

        $this->collDialogInvitess = null;
        foreach ($dialogInvitess as $dialogInvites) {
            $this->addDialogInvites($dialogInvites);
        }

        $this->collDialogInvitess = $dialogInvitess;
        $this->collDialogInvitessPartial = false;

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
    public function countDialogInvitess(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collDialogInvitessPartial && !$this->isNew();
        if (null === $this->collDialogInvitess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collDialogInvitess) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getDialogInvitess());
            }

            $query = ChildDialogUserQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByInviterUser($this)
                ->count($con);
        }

        return count($this->collDialogInvitess);
    }

    /**
     * Method called to associate a ChildDialogUser object to this object
     * through the ChildDialogUser foreign key attribute.
     *
     * @param ChildDialogUser $l ChildDialogUser
     * @return $this The current object (for fluent API support)
     */
    public function addDialogInvites(ChildDialogUser $l)
    {
        if ($this->collDialogInvitess === null) {
            $this->initDialogInvitess();
            $this->collDialogInvitessPartial = true;
        }

        if (!$this->collDialogInvitess->contains($l)) {
            $this->doAddDialogInvites($l);

            if ($this->dialogInvitessScheduledForDeletion and $this->dialogInvitessScheduledForDeletion->contains($l)) {
                $this->dialogInvitessScheduledForDeletion->remove($this->dialogInvitessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildDialogUser $dialogInvites The ChildDialogUser object to add.
     */
    protected function doAddDialogInvites(ChildDialogUser $dialogInvites): void
    {
        $this->collDialogInvitess[]= $dialogInvites;
        $dialogInvites->setInviterUser($this);
    }

    /**
     * @param ChildDialogUser $dialogInvites The ChildDialogUser object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeDialogInvites(ChildDialogUser $dialogInvites)
    {
        if ($this->getDialogInvitess()->contains($dialogInvites)) {
            $pos = $this->collDialogInvitess->search($dialogInvites);
            $this->collDialogInvitess->remove($pos);
            if (null === $this->dialogInvitessScheduledForDeletion) {
                $this->dialogInvitessScheduledForDeletion = clone $this->collDialogInvitess;
                $this->dialogInvitessScheduledForDeletion->clear();
            }
            $this->dialogInvitessScheduledForDeletion[]= $dialogInvites;
            $dialogInvites->setInviterUser(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related DialogInvitess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildDialogUser[] List of ChildDialogUser objects
     * @phpstan-return ObjectCollection&\Traversable<ChildDialogUser}> List of ChildDialogUser objects
     */
    public function getDialogInvitessJoinDialog(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildDialogUserQuery::create(null, $criteria);
        $query->joinWith('Dialog', $joinBehavior);

        return $this->getDialogInvitess($query, $con);
    }

    /**
     * Clears out the collDialogMessagess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addDialogMessagess()
     */
    public function clearDialogMessagess()
    {
        $this->collDialogMessagess = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collDialogMessagess collection loaded partially.
     *
     * @return void
     */
    public function resetPartialDialogMessagess($v = true): void
    {
        $this->collDialogMessagessPartial = $v;
    }

    /**
     * Initializes the collDialogMessagess collection.
     *
     * By default this just sets the collDialogMessagess collection to an empty array (like clearcollDialogMessagess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initDialogMessagess(bool $overrideExisting = true): void
    {
        if (null !== $this->collDialogMessagess && !$overrideExisting) {
            return;
        }

        $collectionClassName = DialogMessageTableMap::getTableMap()->getCollectionClassName();

        $this->collDialogMessagess = new $collectionClassName;
        $this->collDialogMessagess->setModel('\basteyy\XzitGiggle\Models\DialogMessage');
    }

    /**
     * Gets an array of ChildDialogMessage objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildDialogMessage[] List of ChildDialogMessage objects
     * @phpstan-return ObjectCollection&\Traversable<ChildDialogMessage> List of ChildDialogMessage objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getDialogMessagess(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collDialogMessagessPartial && !$this->isNew();
        if (null === $this->collDialogMessagess || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collDialogMessagess) {
                    $this->initDialogMessagess();
                } else {
                    $collectionClassName = DialogMessageTableMap::getTableMap()->getCollectionClassName();

                    $collDialogMessagess = new $collectionClassName;
                    $collDialogMessagess->setModel('\basteyy\XzitGiggle\Models\DialogMessage');

                    return $collDialogMessagess;
                }
            } else {
                $collDialogMessagess = ChildDialogMessageQuery::create(null, $criteria)
                    ->filterByUser($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collDialogMessagessPartial && count($collDialogMessagess)) {
                        $this->initDialogMessagess(false);

                        foreach ($collDialogMessagess as $obj) {
                            if (false == $this->collDialogMessagess->contains($obj)) {
                                $this->collDialogMessagess->append($obj);
                            }
                        }

                        $this->collDialogMessagessPartial = true;
                    }

                    return $collDialogMessagess;
                }

                if ($partial && $this->collDialogMessagess) {
                    foreach ($this->collDialogMessagess as $obj) {
                        if ($obj->isNew()) {
                            $collDialogMessagess[] = $obj;
                        }
                    }
                }

                $this->collDialogMessagess = $collDialogMessagess;
                $this->collDialogMessagessPartial = false;
            }
        }

        return $this->collDialogMessagess;
    }

    /**
     * Sets a collection of ChildDialogMessage objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $dialogMessagess A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setDialogMessagess(Collection $dialogMessagess, ?ConnectionInterface $con = null)
    {
        /** @var ChildDialogMessage[] $dialogMessagessToDelete */
        $dialogMessagessToDelete = $this->getDialogMessagess(new Criteria(), $con)->diff($dialogMessagess);


        $this->dialogMessagessScheduledForDeletion = $dialogMessagessToDelete;

        foreach ($dialogMessagessToDelete as $dialogMessagesRemoved) {
            $dialogMessagesRemoved->setUser(null);
        }

        $this->collDialogMessagess = null;
        foreach ($dialogMessagess as $dialogMessages) {
            $this->addDialogMessages($dialogMessages);
        }

        $this->collDialogMessagess = $dialogMessagess;
        $this->collDialogMessagessPartial = false;

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
    public function countDialogMessagess(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collDialogMessagessPartial && !$this->isNew();
        if (null === $this->collDialogMessagess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collDialogMessagess) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getDialogMessagess());
            }

            $query = ChildDialogMessageQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUser($this)
                ->count($con);
        }

        return count($this->collDialogMessagess);
    }

    /**
     * Method called to associate a ChildDialogMessage object to this object
     * through the ChildDialogMessage foreign key attribute.
     *
     * @param ChildDialogMessage $l ChildDialogMessage
     * @return $this The current object (for fluent API support)
     */
    public function addDialogMessages(ChildDialogMessage $l)
    {
        if ($this->collDialogMessagess === null) {
            $this->initDialogMessagess();
            $this->collDialogMessagessPartial = true;
        }

        if (!$this->collDialogMessagess->contains($l)) {
            $this->doAddDialogMessages($l);

            if ($this->dialogMessagessScheduledForDeletion and $this->dialogMessagessScheduledForDeletion->contains($l)) {
                $this->dialogMessagessScheduledForDeletion->remove($this->dialogMessagessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildDialogMessage $dialogMessages The ChildDialogMessage object to add.
     */
    protected function doAddDialogMessages(ChildDialogMessage $dialogMessages): void
    {
        $this->collDialogMessagess[]= $dialogMessages;
        $dialogMessages->setUser($this);
    }

    /**
     * @param ChildDialogMessage $dialogMessages The ChildDialogMessage object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeDialogMessages(ChildDialogMessage $dialogMessages)
    {
        if ($this->getDialogMessagess()->contains($dialogMessages)) {
            $pos = $this->collDialogMessagess->search($dialogMessages);
            $this->collDialogMessagess->remove($pos);
            if (null === $this->dialogMessagessScheduledForDeletion) {
                $this->dialogMessagessScheduledForDeletion = clone $this->collDialogMessagess;
                $this->dialogMessagessScheduledForDeletion->clear();
            }
            $this->dialogMessagessScheduledForDeletion[]= clone $dialogMessages;
            $dialogMessages->setUser(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related DialogMessagess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildDialogMessage[] List of ChildDialogMessage objects
     * @phpstan-return ObjectCollection&\Traversable<ChildDialogMessage}> List of ChildDialogMessage objects
     */
    public function getDialogMessagessJoinDialog(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildDialogMessageQuery::create(null, $criteria);
        $query->joinWith('Dialog', $joinBehavior);

        return $this->getDialogMessagess($query, $con);
    }

    /**
     * Clears out the collActionLogss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addActionLogss()
     */
    public function clearActionLogss()
    {
        $this->collActionLogss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collActionLogss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialActionLogss($v = true): void
    {
        $this->collActionLogssPartial = $v;
    }

    /**
     * Initializes the collActionLogss collection.
     *
     * By default this just sets the collActionLogss collection to an empty array (like clearcollActionLogss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initActionLogss(bool $overrideExisting = true): void
    {
        if (null !== $this->collActionLogss && !$overrideExisting) {
            return;
        }

        $collectionClassName = ActionLogTableMap::getTableMap()->getCollectionClassName();

        $this->collActionLogss = new $collectionClassName;
        $this->collActionLogss->setModel('\basteyy\XzitGiggle\Models\ActionLog');
    }

    /**
     * Gets an array of ChildActionLog objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildActionLog[] List of ChildActionLog objects
     * @phpstan-return ObjectCollection&\Traversable<ChildActionLog> List of ChildActionLog objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getActionLogss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collActionLogssPartial && !$this->isNew();
        if (null === $this->collActionLogss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collActionLogss) {
                    $this->initActionLogss();
                } else {
                    $collectionClassName = ActionLogTableMap::getTableMap()->getCollectionClassName();

                    $collActionLogss = new $collectionClassName;
                    $collActionLogss->setModel('\basteyy\XzitGiggle\Models\ActionLog');

                    return $collActionLogss;
                }
            } else {
                $collActionLogss = ChildActionLogQuery::create(null, $criteria)
                    ->filterByUser($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collActionLogssPartial && count($collActionLogss)) {
                        $this->initActionLogss(false);

                        foreach ($collActionLogss as $obj) {
                            if (false == $this->collActionLogss->contains($obj)) {
                                $this->collActionLogss->append($obj);
                            }
                        }

                        $this->collActionLogssPartial = true;
                    }

                    return $collActionLogss;
                }

                if ($partial && $this->collActionLogss) {
                    foreach ($this->collActionLogss as $obj) {
                        if ($obj->isNew()) {
                            $collActionLogss[] = $obj;
                        }
                    }
                }

                $this->collActionLogss = $collActionLogss;
                $this->collActionLogssPartial = false;
            }
        }

        return $this->collActionLogss;
    }

    /**
     * Sets a collection of ChildActionLog objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $actionLogss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setActionLogss(Collection $actionLogss, ?ConnectionInterface $con = null)
    {
        /** @var ChildActionLog[] $actionLogssToDelete */
        $actionLogssToDelete = $this->getActionLogss(new Criteria(), $con)->diff($actionLogss);


        $this->actionLogssScheduledForDeletion = $actionLogssToDelete;

        foreach ($actionLogssToDelete as $actionLogsRemoved) {
            $actionLogsRemoved->setUser(null);
        }

        $this->collActionLogss = null;
        foreach ($actionLogss as $actionLogs) {
            $this->addActionLogs($actionLogs);
        }

        $this->collActionLogss = $actionLogss;
        $this->collActionLogssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ActionLog objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related ActionLog objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countActionLogss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collActionLogssPartial && !$this->isNew();
        if (null === $this->collActionLogss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collActionLogss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getActionLogss());
            }

            $query = ChildActionLogQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUser($this)
                ->count($con);
        }

        return count($this->collActionLogss);
    }

    /**
     * Method called to associate a ChildActionLog object to this object
     * through the ChildActionLog foreign key attribute.
     *
     * @param ChildActionLog $l ChildActionLog
     * @return $this The current object (for fluent API support)
     */
    public function addActionLogs(ChildActionLog $l)
    {
        if ($this->collActionLogss === null) {
            $this->initActionLogss();
            $this->collActionLogssPartial = true;
        }

        if (!$this->collActionLogss->contains($l)) {
            $this->doAddActionLogs($l);

            if ($this->actionLogssScheduledForDeletion and $this->actionLogssScheduledForDeletion->contains($l)) {
                $this->actionLogssScheduledForDeletion->remove($this->actionLogssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildActionLog $actionLogs The ChildActionLog object to add.
     */
    protected function doAddActionLogs(ChildActionLog $actionLogs): void
    {
        $this->collActionLogss[]= $actionLogs;
        $actionLogs->setUser($this);
    }

    /**
     * @param ChildActionLog $actionLogs The ChildActionLog object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeActionLogs(ChildActionLog $actionLogs)
    {
        if ($this->getActionLogss()->contains($actionLogs)) {
            $pos = $this->collActionLogss->search($actionLogs);
            $this->collActionLogss->remove($pos);
            if (null === $this->actionLogssScheduledForDeletion) {
                $this->actionLogssScheduledForDeletion = clone $this->collActionLogss;
                $this->actionLogssScheduledForDeletion->clear();
            }
            $this->actionLogssScheduledForDeletion[]= clone $actionLogs;
            $actionLogs->setUser(null);
        }

        return $this;
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
        if (null !== $this->aUserRole) {
            $this->aUserRole->removeUsers($this);
        }
        $this->id = null;
        $this->email = null;
        $this->username = null;
        $this->user_role_id = null;
        $this->secret_key = null;
        $this->password_hash = null;
        $this->activated = null;
        $this->blocked = null;
        $this->is_delete_candidate = null;
        $this->last_login = null;
        $this->last_login_ip = null;
        $this->processed = null;
        $this->processed_at = null;
        $this->home_folder = null;
        $this->log_folder = null;
        $this->web_folder = null;
        $this->bash = null;
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
            if ($this->collIpPoolUserss) {
                foreach ($this->collIpPoolUserss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collDomainss) {
                foreach ($this->collDomainss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collStartedDialogss) {
                foreach ($this->collStartedDialogss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collDialogss) {
                foreach ($this->collDialogss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collDialogInvitess) {
                foreach ($this->collDialogInvitess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collDialogMessagess) {
                foreach ($this->collDialogMessagess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collActionLogss) {
                foreach ($this->collActionLogss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collIpPoolUserss = null;
        $this->collDomainss = null;
        $this->collStartedDialogss = null;
        $this->collDialogss = null;
        $this->collDialogInvitess = null;
        $this->collDialogMessagess = null;
        $this->collActionLogss = null;
        $this->aUserRole = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(UserTableMap::DEFAULT_STRING_FORMAT);
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
