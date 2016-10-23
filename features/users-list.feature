Feature: Get Users
  In order to show a list of users, we have to request it using the API key

  Scenario: Get a list of users via the API
    Given I have a valid API key
    When I get "users"
    Then I should get a successful response
    	And at least 1 "user"