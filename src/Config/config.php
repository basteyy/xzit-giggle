<?php
/**
 * Xzit Giggle
 *
 * This file `config.php` is part of the `Xzit Giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 05.11.2023
 */
declare(strict_types=1);

/**
 * The following settings are stored in the database. The values from here are the default values.
 * @see \basteyy\XzitGiggle\Helper\Config for more information
 */

return [
    /** Emails related settings */
    'emails',                                                   // Activate the sending e-mails
    'emails_activated'              => false,                   // Activate the sending e-mails
    'emails_from_address'           => 'root@localhost',        // The e-mail address from which the e-mails are sent
    'emails_from_name'              => 'Giggle',                // The name from which the e-mails are sent
    'emails_driver'                 => '',                      // The driver to use for sending e-mails
    'emails_smtp_host'              => '',                      // The SMTP host to use for sending e-mails
    'emails_smtp_port'              => 0,                       // The SMTP port to use for sending e-mails
    'emails_smtp_username'          => '',                      // The SMTP username to use for sending e-mails
    'emails_smtp_password'          => '',                      // The SMTP password to use for sending e-mails

    /** User related settings */
    'allow_user_login'              => false,                   // Allow users to login
    'allow_user_change_email'       => false,                   // Allow users to change their e-mail address

    /** Domain related settings */
    'allow_users_domain_adding'     => false,                   // Allow users to add domains
    'allow_users_domain_editing'    => false,                   // Allow users to edit domains
    'allow_users_domain_deleting'   => false,                   // Allow users to delete domains

    /** Database related settings */
    'allow_users_database_adding'   => false,                   // Allow users to add databases
    'allow_users_database_editing'  => false,                   // Allow users to edit databases
    'allow_users_database_deleting' => false,                   // Allow users to delete databases
];