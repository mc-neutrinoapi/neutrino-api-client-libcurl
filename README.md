# NeutrinoAPI SDK

Neutrino API client for PHP using Client URL Library (cURL)

| Feature          |                                       |
|------------------|---------------------------------------|
| Language         | PHP                                   |
| Platform Version | >= 7                                  |
| Description      | PHP (with cURL) client library option |
| HTTP Library     | Client URL Library (cURL)             |
| HTTP/2           | Yes                                   |
| TLS Version      | 1.3                                   |

## Getting started

First you will need a user ID and API key pair: [SignUp](https://www.neutrinoapi.com/signup/)

## To Initialize 
```php
use NeutrinoAPI\NeutrinoAPIClient;

$neutrinoAPI = new NeutrinoAPI('<your-user-id>', '<your-api-key>');
```

## Running Examples

```sh
$ php neutrino-api-client-libcurl/src/examples/BadWordFilter.php
```
You can find examples of all APIs in _src/examples/_

## For Support 
[Contact us](https://www.neutrinoapi.com/contact-us/)
