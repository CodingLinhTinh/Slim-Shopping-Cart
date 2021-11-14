<?php
namespace Cart\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class BraintreeController
{
    public function token(Response $response)
    {
        return $response->withJson([
            'token' => \Braintree_ClientToken::generate()
        ]);
    }
}