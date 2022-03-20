<?php

//https://github.com/vimeo/psalm/issues/7799

/** @var array<string, int> */
$data = [];

/** @psalm-suppress UnusedForeachValue */
foreach ($data as $k => $v) {
    echo $k;
}
