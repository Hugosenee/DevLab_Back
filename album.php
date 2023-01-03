<?php

class album
{
    public function __construct(
        public string $name,
        public int $is_private,
        public int $user_id,
    )
    {
    }
}