<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Smoke\Smoke\Smoke;
use GuzzleHttp\Client;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, SnippetAcceptingContext
{
    private $smoke;
    private $uri;
    private $method;
    private $statusCode;
    private $content;


    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $this->smoke = new Smoke(new Client());
    }

    /**
     * @Given I have uri :uri
     */
    public function iHaveUrl($uri)
    {
        $this->uri = $uri;
    }

    /**
     * @When I check with method :method status code :statusCode and content :content
     * @When I check with method :method status code :statusCode without checking content
     */
    public function iCheckWithMethodAndContent($method, $statusCode, $content = '')
    {
        $this->method = $method;
        $this->statusCode = (int)$statusCode;
        $this->content = $content;
    }

    /**
     * @Then I should receive status :status
     */
    public function iShouldReceive($status)
    {
        $result = $this->smoke->checkAddress($this->method, $this->uri, $this->statusCode, [], $this->content);
        expect($result['status'])->toBe($status);
    }
}
