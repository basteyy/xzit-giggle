
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- xg_config
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `xg_config`;

CREATE TABLE `xg_config`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `key` VARCHAR(96) NOT NULL,
    `default` VARCHAR(255) NOT NULL,
    `value` VARCHAR(255) NOT NULL,
    `var_type` VARCHAR(64) DEFAULT 'string' NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `xg_config_u_b0eafe` (`key`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- xg_users
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `xg_users`;

CREATE TABLE `xg_users`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `email` VARCHAR(255) NOT NULL,
    `username` VARCHAR(255) NOT NULL,
    `user_role_id` INTEGER NOT NULL,
    `secret_key` VARCHAR(128),
    `password_hash` VARCHAR(256),
    `activated` TINYINT(1) DEFAULT 0 NOT NULL,
    `blocked` TINYINT(1) DEFAULT 0 NOT NULL,
    `is_delete_candidate` TINYINT(1) DEFAULT 0 NOT NULL,
    `last_login` TIMESTAMP NULL,
    `last_login_ip` VARCHAR(128),
    `processed` TINYINT(1) DEFAULT 0,
    `processed_at` TIMESTAMP NULL,
    `home_folder` VARCHAR(256),
    `log_folder` VARCHAR(256),
    `web_folder` VARCHAR(256),
    `bash` VARCHAR(256),
    `php_fpm_pool` VARCHAR(256),
    `php_fpm_socket` VARCHAR(256),
    `php_fpm_port` INTEGER,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `xg_users_u_184e0a` (`email`, `secret_key`),
    INDEX `xg_users_fi_a5abbb` (`user_role_id`),
    CONSTRAINT `xg_users_fk_a5abbb`
        FOREIGN KEY (`user_role_id`)
        REFERENCES `xg_user_roles` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- xg_user_roles
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `xg_user_roles`;

CREATE TABLE `xg_user_roles`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(64) NOT NULL,
    `identifier` VARCHAR(64) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- xg_ip
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `xg_ip`;

CREATE TABLE `xg_ip`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `address` VARCHAR(128) NOT NULL,
    `ipv4` INTEGER NOT NULL,
    `ipv6` VARCHAR(128) NOT NULL,
    `can_assign` TINYINT(1) DEFAULT 0 NOT NULL,
    `exclusive` TINYINT(1) DEFAULT 0 NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- xg_ip_pool
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `xg_ip_pool`;

CREATE TABLE `xg_ip_pool`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `ip_id` INTEGER NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `xg_ip_pool_fi_ab77c1` (`ip_id`),
    CONSTRAINT `xg_ip_pool_fk_ab77c1`
        FOREIGN KEY (`ip_id`)
        REFERENCES `xg_ip` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- xg_ip_pool_users
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `xg_ip_pool_users`;

CREATE TABLE `xg_ip_pool_users`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `user_id` INTEGER NOT NULL,
    `pool_id` INTEGER NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `xg_ip_pool_users_fi_3c25bc` (`pool_id`),
    INDEX `xg_ip_pool_users_fi_3f87ee` (`user_id`),
    CONSTRAINT `xg_ip_pool_users_fk_3c25bc`
        FOREIGN KEY (`pool_id`)
        REFERENCES `xg_ip_pool` (`id`),
    CONSTRAINT `xg_ip_pool_users_fk_3f87ee`
        FOREIGN KEY (`user_id`)
        REFERENCES `xg_users` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- xg_domains
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `xg_domains`;

CREATE TABLE `xg_domains`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `user_id` INTEGER NOT NULL,
    `tld` VARCHAR(255) NOT NULL,
    `domain` VARCHAR(255) NOT NULL,
    `registered` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `www_alias` TINYINT(1) DEFAULT 0 NOT NULL,
    `lets_encrypt` TINYINT(1) DEFAULT 0 NOT NULL,
    `ipv4` INTEGER NOT NULL,
    `ipv6` INTEGER,
    `mounting_point` VARCHAR(255) NOT NULL,
    `activated` TINYINT(1) DEFAULT 1 NOT NULL,
    `blocked` TINYINT(1) DEFAULT 0 NOT NULL,
    `processed` TINYINT(1) DEFAULT 0 NOT NULL,
    `processed_at` TIMESTAMP NULL,
    PRIMARY KEY (`id`),
    INDEX `xg_domains_fi_3f87ee` (`user_id`),
    CONSTRAINT `xg_domains_fk_3f87ee`
        FOREIGN KEY (`user_id`)
        REFERENCES `xg_users` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- xg_dialogs
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `xg_dialogs`;

CREATE TABLE `xg_dialogs`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `hash` VARCHAR(16) DEFAULT LEFT(MD5(CURRENT_TIMESTAMP), 16) NOT NULL,
    `subject` VARCHAR(255) DEFAULT 'Chat',
    `created_user_id` INTEGER NOT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `active` TINYINT(1) DEFAULT 0 NOT NULL,
    `is_private` TINYINT(1) DEFAULT 1 NOT NULL,
    `last_message` TIMESTAMP NULL,
    PRIMARY KEY (`id`),
    INDEX `xg_dialogs_fi_b54cde` (`created_user_id`),
    CONSTRAINT `xg_dialogs_fk_b54cde`
        FOREIGN KEY (`created_user_id`)
        REFERENCES `xg_users` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- xg_dialog_users
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `xg_dialog_users`;

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

-- ---------------------------------------------------------------------
-- xg_dialog_messages
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `xg_dialog_messages`;

CREATE TABLE `xg_dialog_messages`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `user_id` INTEGER NOT NULL,
    `dialog_id` INTEGER NOT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `message` VARCHAR(2048) NOT NULL,
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

-- ---------------------------------------------------------------------
-- xg_action_log
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `xg_action_log`;

CREATE TABLE `xg_action_log`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `user_id` INTEGER NOT NULL,
    `action` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    INDEX `xg_action_log_fi_3f87ee` (`user_id`),
    CONSTRAINT `xg_action_log_fk_3f87ee`
        FOREIGN KEY (`user_id`)
        REFERENCES `xg_users` (`id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
