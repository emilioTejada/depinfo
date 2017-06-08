<?php

namespace AppBundle\Entity;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploadedDataDto
{

    const CICLOS = "ciclo";
    const USERS = "usuarios";

    /**
     * @var UploadedFile
     */
    private $data;


    /**
     * @var string
     */
    private $dataType;


    /**
     * @return UploadedFile
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param UploadedFile $data
     * @return UploadedDataDto
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return string
     */
    public function getDataType()
    {
        return $this->dataType;
    }

    /**
     * @param string $dataType
     * @return UploadedDataDto
     */
    public function setDataType(string $dataType)
    {
        $this->dataType = $dataType;

        return $this;
    }
}

