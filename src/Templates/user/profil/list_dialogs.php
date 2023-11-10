<?php
/**
 * Xzit Giggle
 *
 * This file `list_dialogs.php` is part of the `xzit-giggle` project.
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
<h1>Your dialogs</h1>
<p class="lead lh-lg">
    This is your private dialog with <?= $this->getUser()->getUsername() ?>.
</p>

<?php

$dialogs = \basteyy\XzitGiggle\Models\MessageQuery::create()
    ->filterBySenderId([
        \basteyy\XzitGiggle\Models\Map\MessageTableMap::COL_SENDER_ID => $this->getUser()->getId(),
        \basteyy\XzitGiggle\Models\Map\MessageTableMap::COL_RECIPIENT_ID => $this->getUser()->getId()
    ], \Propel\Runtime\ActiveQuery\Criteria::LOGICAL_OR)
    ->find();

foreach ($dialogs as $dialog) {

    if ($dialog->getSenderId() === $this->getUser()->getId()) {
        $user = $dialog->getRecipient();
    } else {
        $user = $dialog->getSender();
    }

    ?>
<div class="card">
    <a href=""><?= $user->getUsername()?></a>
</div>
<?php
}

?>
