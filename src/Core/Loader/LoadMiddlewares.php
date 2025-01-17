<?php

declare(strict_types=1);

namespace App\Loader;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Http\Kernel;

trait LoadMiddlewares
{
    /**
     * @void
     * @throws BindingResolutionException
     */
    public function loadMiddlewares(): void
    {
        $this->registerMiddleware($this->middlewares);
        $this->registerMiddlewareGroups($this->middlewareGroups);
        $this->registerMiddlewarePriority($this->middlewarePriority);
        $this->registerRouteMiddleware($this->routeMiddleware);
    }

    /**
     * Registering Route Group's
     *
     * @param array $middlewares
     * @throws BindingResolutionException
     */
    private function registerMiddleware(array $middlewares = []): void
    {
        $httpKernel = $this->app->make(Kernel::class);

        foreach ($middlewares as $middleware) {
            $httpKernel->prependMiddleware($middleware);
        }
    }

    /**
     * Registering Route Group
     *
     * @param array $middlewareGroups
     */
    private function registerMiddlewareGroups(array $middlewareGroups = []): void
    {
        foreach ($middlewareGroups as $key => $middleware) {
            if (\is_array($middleware)) {
                foreach ($middleware as $item) {
                    $this->app['router']->pushMiddlewareToGroup($key, $item);
                }
            } else {
                $this->app['router']->pushMiddlewareToGroup($key, $middleware);
            }
        }
    }

    /**
     * Registering Route Middlewares priority
     *
     * @param array $middlewarePriority
     */
    private function registerMiddlewarePriority(array $middlewarePriority = []): void
    {
        foreach ($middlewarePriority as $middleware) {
            if (!\in_array($middleware, $this->app['router']->middlewarePriority, true)) {
                $this->app['router']->middlewarePriority[] = $middleware;
            }
        }
    }

    /**
     * Registering Route Middlewares
     *
     * @param array $routeMiddleware
     */
    private function registerRouteMiddleware(array $routeMiddleware = []): void
    {
        foreach ($routeMiddleware as $key => $value) {
            $this->app['router']->aliasMiddleware($key, $value);
        }
    }
}
