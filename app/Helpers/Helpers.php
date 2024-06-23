<?php

/**
 * Generate serial number for a property with the format TZUDSM-YYYYMMDDHHMMSS where YYYYMMDDHHMMSS is the current timestamp.
 *
 * @return string
 */
if (!function_exists('generateSerialNumber')) {
    function generateSerialNumber() {
        // Get the current timestamp in the format YYYYMMDDHHMMSS
        $timestamp = date('YmdHis');

        // Generate the serial number
        $serialNumber = 'TZUDSM-' . $timestamp;

        return $serialNumber;
    }
}

