
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
    `key` VARCHAR(255) NOT NULL,
    `default` VARCHAR(255) NOT NULL,
    `value` VARCHAR(255) NOT NULL,
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

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
