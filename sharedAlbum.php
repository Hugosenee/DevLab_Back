<?php

class sharedAlbum
{
    public function __construct(
        public int $albumId,
        public int $ownerId,
        public int $sharedId,
    )
    {
    }
}