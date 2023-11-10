<?php
$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->initDatabaseMapFromDumps(array (
  'default' => 
  array (
    'tablesByName' => 
    array (
      'xg_action_log' => '\\basteyy\\XzitGiggle\\Models\\Map\\ActionLogTableMap',
      'xg_config' => '\\basteyy\\XzitGiggle\\Models\\Map\\ConfigTableMap',
      'xg_dialog_messages' => '\\basteyy\\XzitGiggle\\Models\\Map\\DialogMessageTableMap',
      'xg_dialog_users' => '\\basteyy\\XzitGiggle\\Models\\Map\\DialogUserTableMap',
      'xg_dialogs' => '\\basteyy\\XzitGiggle\\Models\\Map\\DialogTableMap',
      'xg_domains' => '\\basteyy\\XzitGiggle\\Models\\Map\\DomainTableMap',
      'xg_ip' => '\\basteyy\\XzitGiggle\\Models\\Map\\IpAddressTableMap',
      'xg_ip_pool' => '\\basteyy\\XzitGiggle\\Models\\Map\\IpPoolTableMap',
      'xg_ip_pool_users' => '\\basteyy\\XzitGiggle\\Models\\Map\\IpPoolUsersTableMap',
      'xg_user_roles' => '\\basteyy\\XzitGiggle\\Models\\Map\\UserRoleTableMap',
      'xg_users' => '\\basteyy\\XzitGiggle\\Models\\Map\\UserTableMap',
    ),
    'tablesByPhpName' => 
    array (
      '\\ActionLog' => '\\basteyy\\XzitGiggle\\Models\\Map\\ActionLogTableMap',
      '\\Config' => '\\basteyy\\XzitGiggle\\Models\\Map\\ConfigTableMap',
      '\\Dialog' => '\\basteyy\\XzitGiggle\\Models\\Map\\DialogTableMap',
      '\\DialogMessage' => '\\basteyy\\XzitGiggle\\Models\\Map\\DialogMessageTableMap',
      '\\DialogUser' => '\\basteyy\\XzitGiggle\\Models\\Map\\DialogUserTableMap',
      '\\Domain' => '\\basteyy\\XzitGiggle\\Models\\Map\\DomainTableMap',
      '\\IpAddress' => '\\basteyy\\XzitGiggle\\Models\\Map\\IpAddressTableMap',
      '\\IpPool' => '\\basteyy\\XzitGiggle\\Models\\Map\\IpPoolTableMap',
      '\\IpPoolUsers' => '\\basteyy\\XzitGiggle\\Models\\Map\\IpPoolUsersTableMap',
      '\\User' => '\\basteyy\\XzitGiggle\\Models\\Map\\UserTableMap',
      '\\UserRole' => '\\basteyy\\XzitGiggle\\Models\\Map\\UserRoleTableMap',
    ),
  ),
));
