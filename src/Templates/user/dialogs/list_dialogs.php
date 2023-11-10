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

use basteyy\XzitGiggle\Models\User;

$this->layout('layouts::default', [
    'title' => __('Your Dialogs')
]);

/** @var User $user */
$user = $this->getUser();

?>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12 col-md-4">
                <?php
                if (count($user->getActiveDialogs()) === 0 ) {
                    echo $this->fetch('user/dialogs/partials/list_own_dialogs_empty');
                } else {
                    echo $this->fetch('user/dialogs/partials/list_own_dialogs', [
                        'dialogs' => $user->getActiveDialogs(),
                        'dialog' => $dialog ?? null,
                    ]);
                }
                ?>
            </div>
            <div class="col-12 col-md-8 order-first order-md-last">
                <?php
                if (isset($dialog)) {

                    echo $this->fetch('user/dialogs/partials/dialog_messages', [
                        'dialog' => $dialog
                    ]);

                    echo $this->fetch('user/dialogs/partials/dialog_message_form', [
                        'dialog' => $dialog,
                        'message' => $message ?? new \basteyy\XzitGiggle\Models\DialogMessage()
                    ]);

                } else {
                    echo __('Select a dialog to view the messages.');
                }
                ?>
            </div>
        </div>
    </div>
</div>