<?php

namespace App\Helpers;

use Carbon\Carbon;

/**
 *
 */
class StringHelper
{
    /**
     * @param string|null $value
     * @return array|string|string[]|null
     */
    public static function removeSpecialCharacters(string $value = null): array|string|null
    {
        if (empty($value)) {
            return null;
        }

        $specialChars = ['.', '-', '/', '(', ')', ' ', ',', '@'];
        return str_replace($specialChars, '', $value);
    }

    /**
     * @param string $value
     * @return string|null
     */
    public static function convertBrDateToDbDate(string $value): ?string
    {
        if (empty($value)) {
            return null;
        }

        return Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }

    /**
     * @param ?string $value
     * @return string|null
     */
    public static function convertDbDateToBrDate(?string $value): ?string
    {
        if (empty($value)) {
            return null;
        }

        return Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y');
    }

    /**
     * @param string|null $phone
     * @return array|string|null
     */
    public static function maskPhoneNumber(?string $phone): array|string|null
    {
        if (empty($phone)) {
            return null;
        }

        $number = preg_replace('/\D/', '', $phone);
        $length = strlen($number);

        return match ($length) {
            10 => preg_replace('/(\d{2})(\d{4})(\d{4})/', '($1) $2-$3', $number),
            11 => preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $number),
            8 => preg_replace('/(\d{4})(\d{4})/', '$1-$2', $number),
            9 => preg_replace('/(\d{5})(\d{4})/', '$1-$2', $number),
            default => $number,
        };
    }

    /**
     * @param string $email
     * @return bool
     */
    public static function validateEmail(string $email): bool
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        return true;
    }

    /**
     * @param ?string $text
     * @return array|string
     */
    public static function removeAccents(?string $text): array|string
    {
        if (empty($text)) {
            return '';
        }

        $withAccents = ['à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ü', 'ú', 'ÿ', 'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'O', 'Ù', 'Ü', 'Ú'];
        $withoutAccents = ['a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'y', 'A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U'];

        return str_replace($withAccents, $withoutAccents, $text);
    }
}
