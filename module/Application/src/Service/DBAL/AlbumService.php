<?php
namespace Application\Service\DBAL;

class AlbumService
{
    const TABLE = 'album';

    protected $cols = [
        'id'        => 'id',
        'album'     => 'album',
        'title'     => 'title'
    ];

    public function getTableName()
    {
        return self::TABLE;
    }

    public function getCols()
    {
        return $this->cols;
    }

    public function showAlbumHeader()
    {

    }

    public function showAlbum(array $album = NULL)
    {
        return [
            'id'    => $album['id'],
            'album' => $album['album'],
            'title' => $album['title']
        ];
    }

    /**
     * Checks to see if any array params are not set
     * Data is assumed to be in the form of an array with the following fields:
     * id, album, title
     *
     * @param array $data
     * @return array
     */
    public function checkData(array $data)
    {
        $newData = [];
        foreach ($this->cols as $column) {
            if(isset($data[$column])) {
                $newData[$column] = $data[$column];
            } else {
                $newData[$column] = '';
            }
        }
        return $newData;
    }
}