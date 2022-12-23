<?php

class movie
{
    public function __construct(
        public int $id,
        public string $title,
        public string $desc,
        public string $img_url
    )
    {
    }
}