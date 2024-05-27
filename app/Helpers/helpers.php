<?php

if (!function_exists('dot_name')) {
    function dot_name($name) {
        return str_replace('[', '.', str_replace(']', '', $name));
    }
}