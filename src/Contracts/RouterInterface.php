<?php

declare(strict_types=1);

namespace Tavaan\Engine\Http\Routing\Contracts;

/**
 * قرارداد Router.
 *
 * @see \Tavaan\Engine\Http\Routing\Router
 * @api 1.0
 */
interface RouterInterface
{
    /**
     * متد get.
     *
     * @return mixed
     */
    public function get(/* ... */): mixed;

    /**
     * متد post.
     *
     * @return mixed
     */
    public function post(/* ... */): mixed;

    /**
     * متد put.
     *
     * @return mixed
     */
    public function put(/* ... */): mixed;

    /**
     * متد patch.
     *
     * @return mixed
     */
    public function patch(/* ... */): mixed;

    /**
     * متد delete.
     *
     * @return mixed
     */
    public function delete(/* ... */): mixed;

    /**
     * متد options.
     *
     * @return mixed
     */
    public function options(/* ... */): mixed;

    /**
     * متد head.
     *
     * @return mixed
     */
    public function head(/* ... */): mixed;

    /**
     * متد match.
     *
     * @return mixed
     */
    public function match(/* ... */): mixed;

    /**
     * متد any.
     *
     * @return mixed
     */
    public function any(/* ... */): mixed;

    /**
     * متد view.
     *
     * @return mixed
     */
    public function view(/* ... */): mixed;

    /**
     * متد redirect.
     *
     * @return mixed
     */
    public function redirect(/* ... */): mixed;

    /**
     * متد permanentRedirect.
     *
     * @return mixed
     */
    public function permanentRedirect(/* ... */): mixed;

    /**
     * متد resource.
     *
     * @return mixed
     */
    public function resource(/* ... */): mixed;

    /**
     * متد apiResource.
     *
     * @return mixed
     */
    public function apiResource(/* ... */): mixed;

    /**
     * متد group.
     *
     * @return mixed
     */
    public function group(/* ... */): mixed;

    /**
     * متد prefix.
     *
     * @return mixed
     */
    public function prefix(/* ... */): mixed;

    /**
     * متد middleware.
     *
     * @return mixed
     */
    public function middleware(/* ... */): mixed;

    /**
     * متد domain.
     *
     * @return mixed
     */
    public function domain(/* ... */): mixed;

    /**
     * متد fallback.
     *
     * @return mixed
     */
    public function fallback(/* ... */): mixed;

    /**
     * متد model.
     *
     * @return mixed
     */
    public function model(/* ... */): mixed;

    /**
     * متد bind.
     *
     * @return mixed
     */
    public function bind(/* ... */): mixed;

    /**
     * متد match.
     *
     * @return mixed
     */
    public function match(/* ... */): mixed;

    /**
     * متد current.
     *
     * @return mixed
     */
    public function current(/* ... */): mixed;

    /**
     * متد currentRouteName.
     *
     * @return mixed
     */
    public function currentRouteName(/* ... */): mixed;

    /**
     * متد has.
     *
     * @return mixed
     */
    public function has(/* ... */): mixed;
}