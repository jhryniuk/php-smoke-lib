Feature: Check status of GET request

  Scenario: Check GET request
    Given I have uri "http://www.wp.pl"
    When I check with method "GET" status code "200" and content "Wirtualna Polska"
    Then I should receive status "OK!"

  Scenario: Check GET request without checking content
    Given I have uri "http://www.wp.pl"
    When I check with method "GET status code "200" without checking content
    Then I should receive status "OK!"
