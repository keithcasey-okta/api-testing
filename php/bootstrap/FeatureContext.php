<?php

use Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends BehatContext
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @Given /^I have a valid API key$/
     */
    public function iHaveAValidApiKey()
    {
        throw new PendingException();
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