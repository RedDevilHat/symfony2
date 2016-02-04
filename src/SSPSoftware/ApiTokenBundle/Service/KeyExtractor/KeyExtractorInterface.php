<?php
/**
 * Created by PhpStorm.
 * User: KustovVA
 * Date: 03.02.2016
 * Time: 14:35
 */

namespace SSPSoftware\ApiTokenBundle\Service\KeyExtractor;


use Symfony\Component\HttpFoundation\Request;

/**
 * Interface KeyExtractorInterface
 * @package SSPSoftware\ApiTokenBundle\Service\KeyExtractor
 */
interface KeyExtractorInterface
{
    /**
     * Tells if the given requests carries an API key.
     *
     * @param Request $request
     *
     * @return bool
     */
    public function hasKey(Request $request);

    /**
     * Extract the API key from the given request
     *
     * @param Request $request
     *
     * @return string
     */
    public function extractKey(Request $request);
}