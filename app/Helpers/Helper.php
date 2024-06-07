<?php

namespace App\Helpers;

use DateTime;

class Helper
{
    public static function removeMask(string $document): string
    {


        return preg_replace('/\D/is', '', $document);
    }

    public static function removeMoneyMask(string $money)
    {

        // Verifica se o valor está no padrão brasileiro
        if (strpos($money, ',') !== false) {
            // Remove pontos de milhares, substitui vírgula por ponto decimal
            $money = str_replace('.', '', $money);
            $money = str_replace(',', '.', $money);
        }

        // Retorna o valor convertido
        return $money;
    }

    public static function formatDocument(string $document): string
    {
        // Remove non-numeric characters
        $cleanedDocument = preg_replace("/[^0-9]/", "", $document);

        // Check if it's a CPF or CNPJ
        if (strlen($cleanedDocument) === 11) {
            // Format CPF
            return self::formatCPF($cleanedDocument);
        } elseif (strlen($cleanedDocument) === 14) {
            // Format CNPJ
            return self::formatCNPJ($cleanedDocument);
        } else {
            // Invalid document type
            return "Invalid document type";
        }
    }

    public static function formatCPF(string $cpf): string
    {
        // Add dots and hyphen to format CPF
        $formattedCPF = substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 6, 3) . '-' . substr($cpf, 9, 2);

        return $formattedCPF;
    }

    public static function formatCNPJ(string $cnpj): string
    {
        // Add dots, slashes, and hyphen to format CNPJ
        $formattedCNPJ = substr($cnpj, 0, 2) . '.' . substr($cnpj, 2, 3) . '.' . substr($cnpj, 5, 3) . '/' . substr($cnpj, 8, 4) . '-' . substr($cnpj, 12, 2);

        return $formattedCNPJ;
    }

    public static function formatPhoneNumber($phoneNumber): string
    {
        // Remove non-numeric characters
        $cleanedPhoneNumber = preg_replace("/[^0-9]/", "", $phoneNumber);

        // Check if it has a valid length
        $length = strlen($cleanedPhoneNumber);

        if ($length === 10) {
            // Format as (XX) XXXX-XXXX for landline
            $formattedPhoneNumber = "(" . substr($cleanedPhoneNumber, 0, 2) . ") " . substr($cleanedPhoneNumber, 2, 4) . "-" . substr($cleanedPhoneNumber, 6);
            return $formattedPhoneNumber;
        } elseif ($length === 11) {
            // Format as (XX) XXXXX-XXXX for mobile
            $formattedPhoneNumber = "(" . substr($cleanedPhoneNumber, 0, 2) . ") " . substr($cleanedPhoneNumber, 2, 5) . "-" . substr($cleanedPhoneNumber, 7);
            return $formattedPhoneNumber;
        } else {
            // Invalid phone number length
            return $phoneNumber;
        }
    }

    public static function  formatBrazilianNumber($number)
    {
        // Round the number to two decimal places
        $number = number_format($number, 2, '.', '');

        // Split the number into integer and decimal parts
        $parts = explode('.', $number);

        // Format the integer part with period as thousands separator
        $formatted_integer_part = number_format($parts[0], 0, '', '.');

        // Join the formatted integer part with the decimal part
        $formatted_number = $formatted_integer_part . ',' . $parts[1];

        return $formatted_number;
    }



    public static function numberFormat(float $value): string
    {
        return number_format($value, 2, ".", "");
    }

    public static function convertToBrazilianDateHour($date)
    {
        // Create a DateTime object with the provided date
        $dateObj = DateTime::createFromFormat('Y-m-d H:i:s', $date);

        // Check if there was an error during conversion
        if (!$dateObj) {
            return "Error converting the date";
        }

        // Format the date into Brazilian standard
        $brazilianDate = $dateObj->format('d/m/Y H:i:s');

        return $brazilianDate;
    }

    public static function convertToBrazilianDate($date)
    {

        if (empty($date)) {
            return $date;
        }
        // Create a DateTime object with the provided date
        $dateObj = DateTime::createFromFormat('Y-m-d', $date);

        // Check if there was an error during conversion
        if (!$dateObj) {
            return "Error converting the date";
        }

        // Format the date into Brazilian standard
        $brazilianDate = $dateObj->format('d/m/Y');

        return $brazilianDate;
    }

    public static function convertToAmericanDate($brazilianDate)
    {
        // First, check if the date is in the expected format (DD/MM/YYYY)
        if (preg_match('/^(\d{2})\/(\d{2})\/(\d{4})$/', $brazilianDate, $matches)) {
            // Extract the date components
            $day = $matches[1];
            $month = $matches[2];
            $year = $matches[3];

            // Format the date in the American format (YYYY-MM-DD)
            $americanDate = "$year-$month-$day";

            return $americanDate;
        } else {
            // If the date is not in the expected format, return false
            return null;
        }
    }


    public static function validateEmail($email)
    {

        if (empty($email)) {
            return false;
        }

        // Check if the email is in a valid format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        // Extract the domain from the email
        list($username, $domain) = explode('@', $email);

        // Check if the domain has valid MX (Mail Exchange) records
        if (!checkdnsrr($domain, 'MX')) {
            return false;
        }

        return true;
    }
}
