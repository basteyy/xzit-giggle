<?php
use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1699550200.
 * Generated on 2023-11-09 17:16:40 by sebas */
class PropelMigration_1699550200{
    /**
     * @var string
     */
    public $comment = '';

    /**
     * @param \Propel\Generator\Manager\MigrationManager $manager
     *
     * @return null|false|void
     */
    public function preUp(MigrationManager $manager)
    {
        // add the pre-migration code here
    }

    /**
     * @param \Propel\Generator\Manager\MigrationManager $manager
     *
     * @return null|false|void
     */
    public function postUp(MigrationManager $manager)
    {
        // add the post-migration code here
    }

    /**
     * @param \Propel\Generator\Manager\MigrationManager $manager
     *
     * @return null|false|void
     */
    public function preDown(MigrationManager $manager)
    {
        // add the pre-migration code here
    }

    /**
     * @param \Propel\Generator\Manager\MigrationManager $manager
     *
     * @return null|false|void
     */
    public function postDown(MigrationManager $manager)
    {
        // add the post-migration code here
    }

    /**
     * Get the SQL statements for the Up migration
     *
     * @return array list of the SQL strings to execute for the Up migration
     *               the keys being the datasources
     */
    public function getUpSQL(): array
    {
        $connection_default = <<< 'EOT'

# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `xg_dialogs`

  CHANGE `hash` `hash` VARCHAR(16) DEFAULT LEFT(MD5(CURRENT_TIMESTAMP), 16) NOT NULL;

ALTER TABLE `xg_users`

  CHANGE `processed` `processed` TINYINT(1) DEFAULT 0,

  ADD `home_folder` VARCHAR(256) AFTER `processed_at`,

  ADD `log_folder` VARCHAR(256) AFTER `home_folder`,

  ADD `web_folder` VARCHAR(256) AFTER `log_folder`,

  ADD `bash` VARCHAR(256) AFTER `web_folder`,

  ADD `php_fpm_pool` VARCHAR(256) AFTER `bash`,

  ADD `php_fpm_socket` VARCHAR(256) AFTER `php_fpm_pool`,

  ADD `php_fpm_port` INTEGER AFTER `php_fpm_socket`;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
EOT;

        return [
            'default' => $connection_default,
        ];
    }

    /**
     * Get the SQL statements for the Down migration
     *
     * @return array list of the SQL strings to execute for the Down migration
     *               the keys being the datasources
     */
    public function getDownSQL(): array
    {
        $connection_default = <<< 'EOT'

# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `xg_dialogs`

  CHANGE `hash` `hash` VARCHAR(16) DEFAULT 'left(md5(rand()),16)' NOT NULL;

ALTER TABLE `xg_users`

  CHANGE `processed` `processed` TINYINT(1) DEFAULT 0 NOT NULL,

  DROP `home_folder`,

  DROP `log_folder`,

  DROP `web_folder`,

  DROP `bash`,

  DROP `php_fpm_pool`,

  DROP `php_fpm_socket`,

  DROP `php_fpm_port`;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
EOT;

        return [
            'default' => $connection_default,
        ];
    }

}
