<?php


namespace App\Service;

use Symfony\Component\Filesystem\Filesystem;
use App\Entity\Value;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploadValue
{
    private $uploadDirValues;

    public function __construct($uploadDirValues)
    {
        $this->uploadDirValues = $uploadDirValues;
    }

    /**
     * $fileName = $this->uploader->upload($file);
     */
    public function upload(UploadedFile $image, Value $value)
    {
        // genere le nom de l'image
        $fileName = $value->getName().'.'.$image->guessExtension();
        // Deplace l'image
        $image->move($this->uploadDirValues, $fileName);

        return $fileName;
    }

    public function remove($fileName)
    {
        $fs = new Filesystem();
        // Supprimer le fichier
        $file = $this->uploadDirValues.'/'.$fileName;

        if ($fs->exists($file)){
            $fs->remove($file);
        }
    }
}