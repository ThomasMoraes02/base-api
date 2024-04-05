<?php 

/**
 * Dump de valores
 *
 * @param mixed ...$data
 * @return void
 */
function dd(...$data)
{
    echo "<pre>";
    print_r($data);
}