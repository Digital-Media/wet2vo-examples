<?php

namespace LoginExample;

use Fhooe\Router\Router;

/**
 * RouteGuard is a simple, session-based mechanism to protect certain routes. It can either check if a session token is
 * present and if not, perform a redirect or test if a session token is explicitly not present.
 * @package LoginExample
 * @author Wolfgang Hochleitner <wolfgang.hochleitner@fh-hagenberg.at>
 * @version 2025
 */
class RouteGuard
{
    /**
     * Requires that a session token is present to access the route. If this is not the case,
     * a redirect is performed to the route provided in $exitRoute.
     * @param string $tokenName The name of the session token to check for.
     * @param Router $router The Router object to perform the redirect.
     * @param string $exitRoute The route to redirect if the session token is not present or invalid.
     * @return void Returns nothing.
     */
    public static function requireLoggedIn(string $tokenName, Router $router, string $exitRoute): void
    {
        if (!isset($_SESSION[$tokenName])) {
            $router->redirectTo($exitRoute);
        }
    }

    /**
     * Requires that a session token is not present to access the route. If this is not the case,
     * a redirect is performed to the route provided in $exitRoute.
     * @param string $tokenName The name of the session token to check for.
     * @param Router $router The Router object to perform the redirect.
     * @param string $exitRoute The route to redirect if the session token is present valid.
     * @return void Returns nothing.
     */
    public static function requireNotLoggedIn(string $tokenName, Router $router, string $exitRoute): void
    {
        if (isset($_SESSION[$tokenName])) {
            $router->redirectTo($exitRoute);
        }
    }
}