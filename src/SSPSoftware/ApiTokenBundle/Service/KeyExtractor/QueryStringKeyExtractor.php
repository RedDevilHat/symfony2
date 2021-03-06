<?php
/**
 * Created by PhpStorm.
 * User: KustovVA
 * Date: 03.02.2016
 * Time: 14:42
 */

namespace SSPSoftware\ApiTokenBundle\Service\KeyExtractor;


use Symfony\Component\HttpFoundation\Request;

/**
 * Class QueryStringKeyExtractor
 * @package SSPSoftware\ApiTokenBundle\Service\KeyExtractor
 */
class QueryStringKeyExtractor implements KeyExtractorInterface
{
    /**
     * @var string
     */
    protected $parameterName;

    /**
     * @param string $parameterName The name of the URL parameter containing the API key.
     */
    public function __construct($parameterName)
    {
        $this->parameterName = $parameterName;
    }

    /**
     * Tells if the given requests carries an API key.
     *
     * @param Request $request
     *
     * @return bool
     */
    public function hasKey(Request $request)
    {
        return $request->query->has($this->parameterName);
    }

    /**
     * Extract the API key from the given request
     *
     * @param Request $request
     *
     * @return string
     * @throws \InvalidArgumentException
     */
    public function extractKey(Request $request)
    {
        return $request->query->get($this->parameterName);
    }
}