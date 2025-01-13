<?php

declare(strict_types=1);

namespace TalkBoards\Infrastructure\SymfonyHttpKernel;

use Symfony\Component\HttpFoundation\Response;

enum HttpStatusCode: int
{
    case OK = Response::HTTP_OK;
    case BAD_REQUEST = Response::HTTP_BAD_REQUEST;
    case UNAUTHORIZED = Response::HTTP_UNAUTHORIZED;
    case SERVER_ERROR = Response::HTTP_INTERNAL_SERVER_ERROR;
}
