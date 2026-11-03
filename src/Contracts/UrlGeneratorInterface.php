<?php

declare(strict_types=1);

namespace Tavaan\Engine\Http\Routing\Contracts;

/**
 * قرارداد UrlGenerator.
 *
 * @see \Tavaan\Engine\Http\Routing\UrlGenerator
 * @api 1.0
 */
interface UrlGeneratorInterface
{
    /**
     * متد route.
     *
     * @return mixed
     */
    public function route(/* ... */): mixed;

    /**
     * متد action.
     *
     * @return mixed
     */
    public function action(/* ... */): mixed;

    /**
     * متد url.
     *
     * @return mixed
     */
    public function url(/* ... */): mixed;

    /**
     * متد asset.
     *
     * @return mixed
     */
    public function asset(/* ... */): mixed;

    /**
     * متد current.
     *
     * @return mixed
     */
    public function current(/* ... */): mixed;

    /**
     * متد previous.
     *
     * @return mixed
     */
    public function previous(/* ... */): mixed;

    /**
     * متد full.
     *
     * @return mixed
     */
    public function full(/* ... */): mixed;

    /**
     * متد signed.
     *
     * @return mixed
     */
    public function signed(/* ... */): mixed;

    /**
     * متد temporarySignedRoute.
     *
     * @return mixed
     */
    public function temporarySignedRoute(/* ... */): mixed;

    /**
     * متد isValidSignature.
     *
     * @return mixed
     */
    public function isValidSignature(/* ... */): mixed;

    /**
     * متد to.
     *
     * @return mixed
     */
    public function to(/* ... */): mixed;
}