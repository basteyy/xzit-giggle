<?php
$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->initDatabaseMapFromDumps(array (
  'default' => 
  array (
    'tablesByName' => 
    array (
      'xg_config' => '\\basteyy\\XzitGiggle\\Models\\Map\\ConfigTableMap',
      'xg_domains' => '\\basteyy\\XzitGiggle\\Models\\Map\\DomainTableMap',
      'xg_ip' => '\\basteyy\\XzitGiggle\\Models\\Map\\IpAddressTableMap',
      'xg_ip_pool' => '\\basteyy\\XzitGiggle\\Models\\Map\\IpPoolTableMap',
      'xg_ip_pool_users' => '\\basteyy\\XzitGiggle\\Models\\Map\\IpPoolUsersTableMap',
      'xg_user_roles' => '\\basteyy\\XzitGiggle\\Models\\Map\\UserRoleTableMap',
      'xg_users' => '\\basteyy\\XzitGiggle\\Models\\Map\\UserTableMap',
    ),
    'tablesByPhpName' => 
    array (
      '\\Config' => '\\basteyy\\XzitGiggle\\Models\\Map\\ConfigTableMap',
      '\\Domain' => '\\basteyy\\XzitGiggle\\Models\\Map\\DomainTableMap',
      '\\IpAddress' => '\\basteyy\\XzitGiggle\\Models\\Map\\IpAddressTableMap',
      '\\IpPool' => '\\basteyy\\XzitGiggle\\Models\\Map\\IpPoolTableMap',
      '\\IpPoolUsers' => '\\basteyy\\XzitGiggle\\Models\\Map\\IpPoolUsersTableMap',
      '\\User' => '\\basteyy\\XzitGiggle\\Models\\Map\\UserTableMap',
      '\\UserRole' => '\\basteyy\\XzitGiggle\\Models\\Map\\UserRoleTableMap',
    ),
  ),
));
