<?php

namespace Slim\Middlewares;

use Slim\Kernel\Context;

class GeneralCORS implements CORSPolicy
{
    public function __construct(
        private Context $context
    )
    {
    }

    public function getAllowOrigin(): string
    {
        return $this->context->getConfig()->get("CORS_DOMAIN");
    }

    public function getAllowMethods(): array
    {
        return [
            CORS::METHOD_GET,
            CORS::METHOD_POST,
            CORS::METHOD_PUT,
            CORS::METHOD_DELETE,
            CORS::METHOD_PATCH
        ];
    }

    public function getAllowHeaders(): array
    {
        return ["Content-Type", "X-Requested-With"];
    }

    public function getAllowCredentials(): bool
    {
        return true;
    }

    public static function policy(Context $context): ?static
    {
        if (!$context->getConfig()->get("CORS")) return null;
        return new static($context);
    }
}
