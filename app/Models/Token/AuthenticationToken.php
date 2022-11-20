<?php

namespace App\Models\Token;

class AuthenticationToken
{
    private readonly string $value;

    private readonly string $type;

    private readonly int $ttl;

    public function __construct(string $value, string $type, int $ttl)
    {
        $this->value = $value;
        $this->type = $type;
        $this->ttl = $ttl;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getTTL(): int
    {
        return $this->ttl;
    }
}
