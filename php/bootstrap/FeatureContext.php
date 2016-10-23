<?php

use Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException,
    GuzzleHttp\Client as GuzzleClient;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends BehatContext
{
    protected $apikey = '';
    protected $domain = '';

    protected $client = null;
    protected $response = null;

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
        $this->domain = 'https://' . $parameters['domain'] . '/api/v1/';

        $this->client = new GuzzleClient(['base_uri' => $this->domain]);
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
    public function iGet($endpoint)
    {
        $this->response = 
            $this->client->request('GET', $endpoint, [
                'headers' => [
                    'Authorization' => 'SSWS ' . $this->apikey
                ]
            ]);
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