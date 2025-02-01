<?php

declare(strict_types=1);

namespace TalkBoards\Presentation\Api\V1\HelloWorld;

use Symfony\Component\Validator\Constraints as Assert;

final readonly class Request
{
    /**
     * @param non-empty-string $param
     */
    public function __construct(
        #[Assert\NotBlank]
        public string $param,
    ) {}
}
