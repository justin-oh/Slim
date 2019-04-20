<?php
/**
 * Slim Framework (https://slimframework.com)
 *
 * @license https://github.com/slimphp/Slim/blob/4.x/LICENSE.md (MIT License)
 */

declare(strict_types=1);

namespace Slim\Interfaces;

use InvalidArgumentException;
use Psr\Http\Message\UriInterface;
use RuntimeException;

interface RouteCollectorInterface
{
    /**
     * Get default route invocation strategy
     *
     * @return InvocationStrategyInterface
     */
    public function getDefaultInvocationStrategy(): InvocationStrategyInterface;

    /**
     * Set default route invocation strategy
     *
     * @param InvocationStrategyInterface $strategy
     * @return RouteCollectorInterface
     */
    public function setDefaultInvocationStrategy(InvocationStrategyInterface $strategy): RouteCollectorInterface;

    /**
     * Get path to FastRoute cache file
     *
     * @return null|string
     */
    public function getCacheFile(): ?string;

    /**
     * Set path to FastRoute cache file
     *
     * @param string $cacheFile
     * @return RouteCollectorInterface
     *
     * @throws InvalidArgumentException
     * @throws RuntimeException
     */
    public function setCacheFile(string $cacheFile): RouteCollectorInterface;

    /**
     * Get the base path used in pathFor()
     *
     * @return string
     */
    public function getBasePath(): string;

    /**
     * Set the base path used in pathFor()
     *
     * @param string $basePath
     * @return RouteCollectorInterface
     */
    public function setBasePath(string $basePath): RouteCollectorInterface;

    /**
     * Get route objects
     *
     * @return RouteInterface[]
     */
    public function getRoutes(): array;

    /**
     * Get named route object
     *
     * @param string $name        Route name
     *
     * @return RouteInterface
     *
     * @throws RuntimeException   If named route does not exist
     */
    public function getNamedRoute(string $name): RouteInterface;

    /**
     * Remove named route
     *
     * @param string $name        Route name
     * @return RouteCollectorInterface
     *
     * @throws RuntimeException   If named route does not exist
     */
    public function removeNamedRoute(string $name): RouteCollectorInterface;

    /**
     * @param string $identifier
     *
     * @return RouteInterface
     *
     * @throws RuntimeException   If route of identifier does not exist
     */
    public function lookupRoute(string $identifier): RouteInterface;

    /**
     * Add a route group to the array
     *
     * @param string   $pattern The group pattern
     * @param callable $callable A group callable
     *
     * @return RouteGroupInterface
     */
    public function pushGroup(string $pattern, $callable): RouteGroupInterface;

    /**
     * Removes the last route group from the array
     *
     * @return RouteGroupInterface|null
     */
    public function popGroup(): ?RouteGroupInterface;

    /**
     * Add route
     *
     * @param string[] $methods Array of HTTP methods
     * @param string   $pattern The route pattern
     * @param callable|string $handler The route callable
     *
     * @return RouteInterface
     */
    public function map(array $methods, string $pattern, $handler): RouteInterface;

    /**
     * Build the path for a named route excluding the base path
     *
     * @param string $name        Route name
     * @param array  $data        Named argument replacement data
     * @param array  $queryParams Optional query string parameters
     *
     * @return string
     *
     * @throws RuntimeException         If named route does not exist
     * @throws InvalidArgumentException If required data not provided
     */
    public function relativePathFor(string $name, array $data = [], array $queryParams = []): string;

    /**
     * Build the path for a named route including the base path
     *
     * This method is deprecated. Use urlFor() from now on.
     *
     * @param string $name        Route name
     * @param array  $data        Named argument replacement data
     * @param array  $queryParams Optional query string parameters
     *
     * @return string
     *
     * @throws RuntimeException         If named route does not exist
     * @throws InvalidArgumentException If required data not provided
     */
    public function pathFor(string $name, array $data = [], array $queryParams = []): string;

    /**
     * Build the path for a named route including the base path
     *
     * @param string $name        Route name
     * @param array  $data        Named argument replacement data
     * @param array  $queryParams Optional query string parameters
     *
     * @return string
     *
     * @throws RuntimeException         If named route does not exist
     * @throws InvalidArgumentException If required data not provided
     */
    public function urlFor(string $name, array $data = [], array $queryParams = []): string;

    /**
     * Get fully qualified URL for named route
     *
     * @param UriInterface  $uri
     * @param string        $routeName Route name
     * @param array         $data Named argument replacement data
     * @param array         $queryParams Optional query string parameters
     *
     * @return string
     */
    public function fullUrlFor(UriInterface $uri, string $routeName, array $data = [], array $queryParams = []): string;
}