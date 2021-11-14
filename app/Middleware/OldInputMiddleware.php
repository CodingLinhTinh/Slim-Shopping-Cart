<?php
namespace Cart\Middleware;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class OldInputMiddleware
{
    protected $view;

    public function __construct(Twig $view)
    {
        $this->view = $view;
    }


    public function __invoke($request, $response, $next)
    {
        if (isset($_SESSION['old'])) {
            $this->view->getEnvironment()->addGlobal('old', $_SESSION['old']);
        }

        $_SESSION['old'] = $request->getParams();

        $response = $next($request, $response);

        return $response;
    }
}