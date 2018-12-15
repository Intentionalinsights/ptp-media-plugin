<?php
/**
 * ptp-media-plugin/functions/outputErrors.php
 */

namespace PTP\Media;

function outputErrors($key, $errors) {
    if (!isset($errors[$key])) {
        return '';
    }

    return '<p class="bg-danger text-danger">' . escape($errors[$key]) . '</p>';
}
