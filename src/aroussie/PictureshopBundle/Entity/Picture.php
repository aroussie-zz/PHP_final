<?php

namespace aroussie\PictureshopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\OptionsResolver;

/**
 * Picture
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="aroussie\PictureshopBundle\Entity\PictureRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Picture
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name_picture", type="string", length=255)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateUpdated", type="datetime")
     */
    private $date;


    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255)
     */
    private $path;

    /**
     * @Assert\File( maxSize = "6M",
     *              mimeTypes = {"image/jpeg","image/png"},
     *              mimeTypesMessage = "Please upload a valid Image")
     *
     */
    protected $file;

    private $temp;

    /**
     * @var string
     *
     * @ORM\Column(name="extension", type="string", length=255)
     */
    private $extension;

    /**
     * Picture constructor.
     * @param \DateTime $date
     */
    public function __construct()
    {
        $this->date = new \DateTime();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Picture
     */
    public function setName($name)
    {
        //I clean the name before persist
        $name = $this->test_data($name);
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Picture
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date->format('Y-m-d H:i:s');
    }

    /**
     * @return mixed
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * @param mixed $extension
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;
    }




    /**
     * Set path
     *
     * @param string $path
     *
     * @return Picture
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    public function getAbsolutePath()
    {
        return null === $this->path
            ? null
            : $this->getUploadRootDir().'/'.$this->path;
    }

    public function getWebPath()
    {
        return null === $this->path
            ? null
            : $this->getUploadDir().'/'.$this->path;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {

        return 'uploads/pictures';
    }


    public function getFile()
    {
        return $this->file;
    }


    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
        //Check if we have an old image path
        if(isset($this->path)){
            //Store the old name to delete after the update
            $this->temp=$this->path;
            $this->path=null;
        }else{
            $this->path = 'initial';
        }
    }

    /**
     * Clean the data
     * @param $data
     * @return string
     */
    function test_data($data){ //Do basic verifications on a data and send it back "cleaned"
        $data=trim($data); // Strip white spaces at the beginning and the end of the data
        $data=Htmlspecialchars($data);
        return $data;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload(){
        if(null !== $this->getFile()){
            //We generate a unique name
            $filename = sha1(uniqid(mt_rand(), true));
            $this->path = $filename.'.'.$this->getFile()->guessExtension();
            //We get the extension of the picture (jpeg or png)
            $this-> extension = $this->getFile()->guessExtension();

        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        // the file property can be empty if the field is not required
        if (null === $this->getFile()) {
            return;
        }


        // The function move takes the target directory and then the target filename to move to
        $this->getFile()->move(
            $this->getUploadRootDir(),
            $this->path
        );

        //check if we have an old image
        if(isset($this->temp)){
            //Delete the old image
            unlink($this->getUploadRootDir().'/'.$this->temp);
            //clear the temp image path
            $this->temp = null;
        }

        // clean up the file property as you won't need it anymore
        $this->file = null;
    }



    /**
     * @ORM\PostRemove()
     */
    public function removeUpload(){
        $file = $this->getAbsolutePath();
        if($file){
            unlink($file);
        }
    }

}

