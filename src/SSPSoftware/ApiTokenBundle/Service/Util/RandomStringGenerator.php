<?php
/**
 * Created by PhpStorm.
 * User: KustovVA
 * Date: 03.02.2016
 * Time: 15:52
 */

namespace SSPSoftware\ApiTokenBundle\Service\Util;


class RandomStringGenerator
{
    /**
     * @param string $characterSet
     * @param int $apiKeyLength
     * @return string
     */
    public static function generate(
        $characterSet = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
        $apiKeyLength = 64
    ) {
        $characterSetLength = strlen($characterSet);
        $apikey = '';
        for ($i = 0; $i < $apiKeyLength; ++$i) {
            $apikey .= $characterSet[random_int(0, $characterSetLength - 1)];
        }

        return rtrim(base64_encode(sha1(uniqid($apikey, true).$apikey)), '=');
    }
}