<?php

namespace AppBundle\Entity;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploadedFileUsers
{
     /**
     * @var UploadedFile
     */
    private $data;

    /**
     * @return UploadedFile
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param UploadedFile $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }
}

