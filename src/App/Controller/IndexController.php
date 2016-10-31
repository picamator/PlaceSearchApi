<?php
declare(strict_types = 1);

namespace Picamator\PlaceSearchApi\App\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Index controller
 */
class IndexController
{
    /**
     * Index
     *
     * @param Request       $request
     * @param Application   $app
     *
     * @return JsonResponse
     */
    public function index(Request $request, Application $app)
    {
        $message = <<<'EOD'
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Place Search API</title>
        <link rel="icon" type="image/x-icon" href="favicon.ico">
    </head>
<body>        
<article>
    <header>
        <h2>Welcome to Place Search Api!</h2>
    </header>

    <section>
        <p>
            Place Search Api is an application over <a href="https://developers.google.com/places/web-service/search">Google Place API</a>
        </p>
    </section>
    <footer>
        <p>
            Please visit GitHub <a href="https://github.com/picamator/PlaceSearchApi">https://github.com/picamator/PlaceSearchApi</a>
        </p>
    </footer>
</article>
</body>
</html>

EOD;


        return new Response($message);
    }
}
