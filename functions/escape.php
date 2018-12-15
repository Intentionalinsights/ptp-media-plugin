<?php
/**
 * ptp-media-plugin/functions/escape.php
 */

namespace PTP\Media;

function escape($content) {
    return htmlspecialchars($content, ENT_QUOTES);
}
