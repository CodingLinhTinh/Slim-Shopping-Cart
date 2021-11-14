<?php
namespace Cart\Middleware;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class ValidationErrorsMiddleware
{
    protected $view;

    public function __construct(Twig $view)
    {
        $this->view = $view;
    }


    public function __invoke($request, $response, $next)
    {
        if (isset($_SESSION['errors'])) {
            $this->view->getEnvironment()->addGlobal('errors', $_SESSION['errors']);
            unset($_SESSION['errors']);
        }

        $response = $next($request, $response);

        return $response;
    }
}