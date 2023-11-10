<?php
/**
 * Xzit Giggle
 *
 * This file `dialog.php` is part of the `xzit-giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 08.11.2023
 */
declare(strict_types=1);

use basteyy\XzitGiggle\Models\Message;
use basteyy\XzitGiggle\Models\User;
use Propel\Runtime\Collection\ObjectCollection;

$this->layout('layouts::default', [
    'title' => __('Dashboard')
]);

/** @var User $user */
/** @var ObjectCollection<Message> $dialog */
/** @var Message $message */


?>
<h1>Your dialog with <?= $user->getUsername() ?></h1>
<p class="lead lh-lg">
    This is your private dialog with <?= $user->getUsername() ?>.
</p>

<?php
/** @var Message $item */
foreach ($dialog as $item) {
    if ($item->getRecipientId() === $user->getId()) {
        // Message send by current user
        ?>
        <div class="row m-2 m-md-4 ">
            <div class="col-4"></div>
            <div class="col-8">
                <h2 class="h5"><a href="/@<?= $item->getSender()->getUsername() ?>">You</a> on <?= $item->getSentAt(DEFAULT_DATETIME_FORMAT) ?></h2>
                <div class="bg-light text-bg-light p-3 rounded-3">
                    <p class="">
                        <?= $item->getReadAt() ?
                            '<span title="'.__('Read on %s', $item->getReadAt(DEFAULT_DATETIME_FORMAT)).'" class="small badge text-success float-end rounded-circle"><span 
                        class="visually-hidden">'.__('Read').'</span> <bi 
                        class="bi bi-check-circle"></bi></span>' : '<span class="small badge text-bg-warning float-end">'.__
                            ('Unread').'</span>' ?>
                        <?= $item->getMessage() ?>
                    </p>
                </div>
            </div>
        </div>
        <?php
    } else {
        // Message recieved by current user


        ?>
        <div class="row m-2 m-md-4 ">
            <div class="col-8">
                <h2 class="h5">
                    <a href="/@<?= $item->getSender()->getUsername() ?>"><?= $item->getSender()->getUsername() ?></a> on <?= $item->getSentAt(DEFAULT_DATETIME_FORMAT)
                    ?>
                </h2>
                <div class="bg-primary  p-3 rounded-3">
                    <?= $item->isRead() ? '' : '<span class="small badge text-bg-warning float-end">New Message</span>' ?>
                    <p class="">
                        <?= $item->getMessage() ?>
                    </p>
                </div>
            </div>
            <div class="col-4"></div>
        </div>
        <?php

        if (!$item->isRead()) {
            $item->setRead(true);
            $item->setReadAt(new DateTime());
            $item->save();
        }

    }
}
?>
