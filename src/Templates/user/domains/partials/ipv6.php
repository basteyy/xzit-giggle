<?php
/**
 * Xzit Giggle
 *
 * This file `ipv6.php` is part of the `xzit-giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 07.11.2023
 */
declare(strict_types=1);

$addresses = [];
// All generic IP
$addresses = \basteyy\XzitGiggle\Models\IpAddressQuery::create()
    ->filterByCanAssign(true)
    ->filterByExclusive(false)
    ->filterByIpv6(true)
    ->find();

if (count($addresses) === 0 ) {
    echo '<div class="alert alert-info mt-3" role="alert">';
    echo __('No IPv6 Address available');
    echo '</div>';
} else {

    ?>
    <div class="my-3">
        <label for="ipv6" class="form-label"><?= __('Choose the IPv6 Address') ?></label>
        <select id="ipv6" name="ipv6" class="form-select">
            <?php foreach ($addresses as $address) : ?>
                <option value="<?= $address->getId() ?>"><?= $address->getAddress() ?></option>
            <?php endforeach; ?>
        </select>
    </div>
<?php

}