<?php
namespace Application\Service;

use Application\Entity\Album;

class AlbumService
{
    public function showAlbumHeader()
    {

    }

    public function showAlbum(Album $album)
    {
        return [
            'id'        => $album->__get('id'),
            'artist'    => $album->__get('artist'),
            'title'     => $album->__get('title')
        ];
    }
}