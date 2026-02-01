<?php

$CONFIG['maintenance_window_start'] = 1;
$CONFIG['trusted_domains'] = array (
    0 => getenv('TS_HOSTNAME') . '.' . getenv('TS_TAILNET'),
);

