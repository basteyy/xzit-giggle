<?php
use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1699469986.
 * Generated on 2023-11-08 18:59:46 by sebas */
class PropelMigration_1699469986{
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

DROP TABLE IF EXISTS `xg_messages`;

CREATE TABLE `xg_dialogs`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `created_user_id` INTEGER NOT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `active` TINYINT(1) DEFAULT 0 NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `xg_dialogs_fi_b54cde` (`created_user_id`),
    CONSTRAINT `xg_dialogs_fk_b54cde`
        FOREIGN KEY (`created_user_id`)
        REFERENCES `xg_users` (`id`)
) ENGINE=InnoDB;

CREATE TABLE `xg_dialog_users`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `user_id` INTEGER NOT NULL,
    `dialog_id` INTEGER NOT NULL,
    `joined` TINYINT(1) DEFAULT 0 NOT NULL,
    `joined_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    `invited_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    `invited_user_id` INTEGER,
    PRIMARY KEY (`id`),
    INDEX `xg_dialog_users_fi_3f87ee` (`user_id`),
    INDEX `xg_dialog_users_fi_d1f623` (`invited_user_id`),
    INDEX `xg_dialog_users_fi_2ff1b7` (`dialog_id`),
    CONSTRAINT `xg_dialog_users_fk_3f87ee`
        FOREIGN KEY (`user_id`)
        REFERENCES `xg_users` (`id`),
    CONSTRAINT `xg_dialog_users_fk_d1f623`
        FOREIGN KEY (`invited_user_id`)
        REFERENCES `xg_users` (`id`),
    CONSTRAINT `xg_dialog_users_fk_2ff1b7`
        FOREIGN KEY (`dialog_id`)
        REFERENCES `xg_dialogs` (`id`)
) ENGINE=InnoDB;

CREATE TABLE `xg_dialog_messages`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `user_id` INTEGER NOT NULL,
    `dialog_id` INTEGER NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `xg_dialog_messages_fi_3f87ee` (`user_id`),
    INDEX `xg_dialog_messages_fi_2ff1b7` (`dialog_id`),
    CONSTRAINT `xg_dialog_messages_fk_3f87ee`
        FOREIGN KEY (`user_id`)
        REFERENCES `xg_users` (`id`),
    CONSTRAINT `xg_dialog_messages_fk_2ff1b7`
        FOREIGN KEY (`dialog_id`)
        REFERENCES `xg_dialogs` (`id`)
) ENGINE=InnoDB;

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

DROP TABLE IF EXISTS `xg_dialogs`;

DROP TABLE IF EXISTS `xg_dialog_users`;

DROP TABLE IF EXISTS `xg_dialog_messages`;

CREATE TABLE `xg_messages`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `sender_id` INTEGER NOT NULL,
    `recipient_id` INTEGER NOT NULL,
    `message` TEXT NOT NULL,
    `sent_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `read_at` TIMESTAMP NULL,
    `read` TINYINT(1) DEFAULT 0 NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `xg_messages_fi_28e373` (`sender_id`),
    INDEX `xg_messages_fi_303517` (`recipient_id`),
    CONSTRAINT `xg_messages_fk_28e373`
        FOREIGN KEY (`sender_id`)
        REFERENCES `xg_users` (`id`),
    CONSTRAINT `xg_messages_fk_303517`
        FOREIGN KEY (`recipient_id`)
        REFERENCES `xg_users` (`id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
EOT;

        return [
            'default' => $connection_default,
        ];
    }

}
