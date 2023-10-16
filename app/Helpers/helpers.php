<?php

if (!function_exists('quotes')) {

    /** Оборачивает строку в одинарные кавычки.
     * @param $data
     * @return string
     */
    function quotes($data): string
    {
        return "'" . $data . "'";
    }
}