<?php

use Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends BehatContext
{
    protected $apikey = '';
    protected $domain = '';

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct(array $parameters)
    {
        $this->apikey = $parameters['apikey'];
    }

    /**
     * @Given /^I have a valid API key$/
     */
    public function iHaveAValidApiKey()
    {
        if ('' == $this->apikey) {
            throw new Exception("You must provide an API key in behat.yml");
        }
    }

    /**
     * @When /^I get "([^"]*)"$/
     */
    public function iGet($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then /^I should get a successful response$/
     */
    public function iShouldGetASuccessfulResponse()
    {
        throw new PendingException();
    }

    /**
     * @Given /^at least (\d+) "([^"]*)"$/
     */
    public function atLeast($arg1, $arg2)
    {
        throw new PendingException();
    }
}