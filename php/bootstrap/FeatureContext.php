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
        $code = $this->response->getStatusCode();

        if (2 == (int) $code/100) {
            return true;
        }

        throw new Exception("Expected a 2xx success response but received $code response code");
    }

    /**
     * @Given /^at least (\d+) "([^"]*)"$/
     */
    public function atLeast($min_expected_objects, $expected_object_type)
    {
        $payload = $this->response->getBody();
        $data = json_decode($payload);
        $object_count = count($data);

        if ($object_count < $min_expected_objects) {
            throw new Exception("Expected $min_expected_objects $expected_object_type(s) but found $object_count instead");
        }

        switch ($expected_object_type) {
            case 'user':
                $user = $data[0];
                if (!property_exists($user, 'profile')) {
                    throw new Exception("We did not find the expected '$expected_object_type' object");
                }

                break;
            default:
                throw new Exception("We did not find the expected '$expected_object_type' object");
        }
    }
}