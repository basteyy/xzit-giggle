<?php
/**
 * Xzit Giggle
 *
 * This file `list_own_dialogs.php` is part of the `xzit-giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 08.11.2023
 */
declare(strict_types=1);
use basteyy\XzitGiggle\Models\Dialog;
use basteyy\XzitGiggle\Models\DialogUser;
use Propel\Runtime\Collection\Collection;

/** @var DialogUser $dialog */
/** @var Collection<Dialog> $dialogs */

?><div class="list-group">
    <?php

    $current_id = isset($dialog) ? $dialog->getId() : null;

        foreach($dialogs as $dialog) {
            ?>

            <a href="/@<?= $this->getUser()->getUsername() ?>/dialogs/?open=<?= $dialog->getHash() ?>"
               class="list-group-item list-group-item-action p-2 p-md-4<?= $current_id && $current_id == $dialog->getId() ? ' active':''?>"
               aria-current="<?= $current_id && $current_id == $dialog->getId() ? 'true':''?>">

                <span class="fw-bold"><?= $dialog->getSubject() ?></span>

                <?php
                if ($dialog->isPrivate()) {

                    $username = $dialog->getDialogUsers()->getFirst()->getUser()->getUsername() === $this->getUser()->getUsername() ?
                        $dialog->getDialogUsers()->getLast()->getUser()->getUsername() :
                        $dialog->getDialogUsers()->getFirst()->getUser()->getUsername();

                    echo '<span class="float-end badge bg-primary rounded-pill">Private with ' . $username ?? 'Unknown' . '</span>';
                }

                if ($dialog->isPrivate()) {
                }
                ?>
            </a>

            <?php
        }

    ?>

</div>