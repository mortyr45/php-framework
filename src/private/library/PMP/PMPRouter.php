<?php namespace PMP;

/**
 * The router for the PMP framework. Builds on AltoRouter.
 */
class PMPRouter
{
    #region Static properties and methods
    /** @var AltoRouter $altoRouter The AltoRouter instance to be used. */
    public static \AltoRouter $altoRouter;

    /** @var array $match The result of the matching function ['target', 'name', 'params'] */
    public static array $match = [];

    /**
     * Push route to buffer
     *
     * This function will create a new PMPRouter object and push it to the AltoRouter.
     *
     * @param mixed $verbs The http methods, which should be mapped with this route. Should be a single string of verbs in the following form: 'GET|POST|PUT', or an array of the verbs.
     * @param string $path The path that should be mapped to this route.
     * @param mixed $controller The controller function that should be mapped to this route. (NOTE: Any callable can be this parameter) (['class' => 'function'] notation is accepted as well)
     * @param string $name The optional name for reverse mapping of the route.
     * @return self
     **/
    public static function Map($verbs, string $path, $controller, string $name = null): self
    {
        $controllerToPush;
        if (\is_array($controller)) {
            $arrayKey = key($controller);
            $controllerToPush = "{$arrayKey}::{$controller[$arrayKey]}";
        }
        else $controllerToPush = $controller;

        $verbsToPush = \is_array($verbs) ? \implode('|', $verbs) : $verbs;

        $pmpRoute = new PMPRouter($controllerToPush);
        self::$altoRouter->map($verbsToPush, $path, $pmpRoute, $name);
        return $pmpRoute;
    }

    /**
     * Create a route group
     *
     * This function will assign all the middlewares provided, to all the routes it gets.
     *
     * @param array $middlewares The middlewares which should be added to all of the routes.
     * @param array $routes The array of routes to be grouped together.
     * @return array
     **/
    public static function RouteGroup(array $middlewares, array $pmpRoutes): array
    {
        foreach ($pmpRoutes as $route)
            if (\is_array($route)) self::RouteGroup($middlewares, $route);
            else $route->PushMiddlewares($middlewares, true);
        return $pmpRoutes;
    }

    /**
     * Match the request route
     *
     * This function will call the underlying AltoRouter's match function to determine if there is any match. Returns a bool indicating match success.
     *
     * @return bool
     **/
    public static function Match(): bool
    {
        $matchResult = self::$altoRouter->match();
        self::$match = \is_array($matchResult) ? $matchResult : [];
        return \is_array(self::$match);
    }

    /**
     * Create a redirecting route
     *
     * @param string $path The URI which should be redirecting.
     * @param string $target The target URL or URI to be redirected to.
     * @return self
     **/
    public static function Redirect(string $path, string $target): self
    {
        $fn = fn() => header("Location: $target");
        $pmpRoute = new PMPRouter($fn);
        self::$altoRouter->map('GET', $path, $pmpRoute);
        return $pmpRoute;
    }

    /**
     * Generates a route uri based on the given named route and the parameters.
     *
     * @param string $routeName The name of the route.
     * @param array $params The parameters that can be enclosed in the uri.
     * @return string
     **/
    public static function GenerateRoute(string $routeName, array $params = []): string
    {
        return self::$altoRouter->generate($routeName, $params);
    }
    #endregion

    #region Verb mapping shortcuts
    /**
     * Shorthand function for GET verbs.
     *
     * @param string $path The path that should be mapped to this route.
     * @param mixed $controller The controller function that should be mapped to this route. (NOTE: Any callable can be this parameter) (['class' => 'function'] notation is accepted as well)
     * @param string $name The optional name for reverse mapping of the route.
     * @return self
     **/
    public static function GET(string $path, $controller, string $name = null): self
    {
        return self::Map('GET', $path, $controller, $name);
    }

    /**
     * Shorthand function for POST verbs.
     *
     * @param string $path The path that should be mapped to this route.
     * @param mixed $controller The controller function that should be mapped to this route. (NOTE: Any callable can be this parameter) (['class' => 'function'] notation is accepted as well)
     * @param string $name The optional name for reverse mapping of the route.
     * @return self
     **/
    public static function POST(string $path, $controller, string $name = null): self
    {
        return self::Map('POST', $path, $controller, $name);
    }

    /**
     * Shorthand function for PUT verbs.
     *
     * @param string $path The path that should be mapped to this route.
     * @param mixed $controller The controller function that should be mapped to this route. (NOTE: Any callable can be this parameter) (['class' => 'function'] notation is accepted as well)
     * @param string $name The optional name for reverse mapping of the route.
     * @return self
     **/
    public static function PUT(string $path, $controller, string $name = null): self
    {
        return self::Map('PUT', $path, $controller, $name);
    }

    /**
     * Shorthand function for DELETE verbs.
     *
     * @param string $path The path that should be mapped to this route.
     * @param mixed $controller The controller function that should be mapped to this route. (NOTE: Any callable can be this parameter) (['class' => 'function'] notation is accepted as well)
     * @param string $name The optional name for reverse mapping of the route.
     * @return self
     **/
    public static function DELETE(string $path, $controller, string $name = null): self
    {
        return self::Map('DELETE', $path, $controller, $name);
    }

    /**
     * Shorthand function for OPTIONS verbs.
     *
     * @param string $path The path that should be mapped to this route.
     * @param mixed $controller The controller function that should be mapped to this route. (NOTE: Any callable can be this parameter) (['class' => 'function'] notation is accepted as well)
     * @param string $name The optional name for reverse mapping of the route.
     * @return self
     **/
    public static function OPTIONS(string $path, $controller, string $name = null): self
    {
        return self::Map('OPTIONS', $path, $controller, $name);
    }
    #endregion

    #region Instance properties and functions
    /** @var mixed $controller The controller function to be executed after successfull match and middleware. */
    public $controller;

    /** @var array $middlewares The array of middlewares to be processed before controller call. */
    private array $middlewares = [];

    /**
     * @param mixed $controller The controller function that should be mapped to this route. (NOTE: Any callable can be this parameter)
     */
    public function __construct($controller) {
        $this->controller = $controller;
    }

    /**
     * Push middlewares
     *
     * Pushes additional middlewares to the route.
     *
     * @param array $middlewares The middlewares that should be pushed to the route's middleware list.
     * @param bool $prepend Sets if the middlewares should be prepended before the already existing ones.
     * @return self
     **/
    public function PushMiddlewares(array $middlewares, bool $prepend = false): self
    {
        if ($prepend) $this->middlewares = \array_merge($middlewares, $this->middlewares);
        else $this->middlewares = \array_merge($this->middlewares, $middlewares);
        return $this;
    }

    /**
     * Route the app
     *
     * This function will start the processing of the middlewares, then invoke the controller function associated with this route.
     *
     * @param array $params The parameters to be passed to the controller function.
     * @return void
     **/
    public function Route(array $params = []): void
    {
        foreach ($this->middlewares as $key) {
            \call_user_func_array("{$key}::Process", []);
        }
        \call_user_func_array($this->controller, $params);
    }
    #endregion
}