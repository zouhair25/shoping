<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Cocur\Slugify\Slugify;
/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 * @Vich\Uploadable
 */
class Article
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $name;

   

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbre_vendu;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

  

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Fabricant", inversedBy="articles_fabricant")
     * @ORM\JoinColumn(nullable=true)
     */
    private $fabricant;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Pointure", inversedBy="articles_pointure")
     * @ORM\JoinColumn(nullable=true)
     */
    private $pointure;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Menu", inversedBy="articles_menu")
     * @ORM\JoinColumn(nullable=false)
     */
    private $menu;

   /**
     * @Vich\UploadableField(mapping="articles_images", fileNameProperty="image1")
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=60,nullable=true)
     * 
     */
    private $image1;

    /**
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $image2;

    /**
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $image3;

    /**
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $image4;

    /**
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $image5;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Taille", inversedBy="articles")
     */
    private $taille;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Promotion", inversedBy="articles")
     */
    private $promotion;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categorie", inversedBy="articles")
     * @ORM\JoinColumn(nullable=true)
     */
    private $categorie;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Couleur", inversedBy="articles")
     */
    private $color;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

   

 

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSlug(): string
    {
        $slug = new Slugify();
        $slug = $slug -> slugify($this->name);
       return $slug;
    }




    public function getNbreVendu(): ?int
    {
        return $this->nbre_vendu;
    }

    public function setNbreVendu(?int $nbre_vendu): self
    {
        $this->nbre_vendu = $nbre_vendu;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

   

 

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getFabricant(): ?Fabricant
    {
        return $this->fabricant;
    }

    public function setFabricant(?Fabricant $fabricant): self
    {
        $this->fabricant = $fabricant;

        return $this;
    }

    public function getPointure(): ?Pointure
    {
        return $this->pointure;
    }

    public function setPointure(?Pointure $pointure): self
    {
        $this->pointure = $pointure;

        return $this;
    }

    public function getMenu(): ?Menu
    {
        return $this->menu;
    }

    public function setMenu(?Menu $menu): self
    {
        $this->menu = $menu;

        return $this;
    }

    public function getImage1(): ?string
    {
        return $this->image1;
    }

    public function setImage1(string $image1): self
    {
        $this->image1 = $image1;

        return $this;
    }

    public function getImage2(): ?string
    {
        return $this->image2;
    }

    public function setImage2(?string $image2): self
    {
        $this->image2 = $image2;

        return $this;
    }

    public function getImage3(): ?string
    {
        return $this->image3;
    }

    public function setImage3(?string $image3): self
    {
        $this->image3 = $image3;

        return $this;
    }

    public function getImage4(): ?string
    {
        return $this->image4;
    }

    public function setImage4(?string $image4): self
    {
        $this->image4 = $image4;

        return $this;
    }

    public function getImage5(): ?string
    {
        return $this->image5;
    }

    public function setImage5(?string $image5): self
    {
        $this->image5 = $image5;

        return $this;
    }

    public function getTaille(): ?Taille
    {
        return $this->taille;
    }

    public function setTaille(?Taille $taille): self
    {
        $this->taille = $taille;

        return $this;
    }

    public function getPromotion(): ?Promotion
    {
        return $this->promotion;
    }

    public function setPromotion(?Promotion $promotion): self
    {
        $this->promotion = $promotion;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getColor(): ?Couleur
    {
        return $this->color;
    }

    public function setColor(?Couleur $color): self
    {
        $this->color = $color;

        return $this;
    }

   
    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|UploadedFile $imageFile
     */
    public function setImageFile(?File $imageFile = null)
    {
        $this->imageFile = $imageFile;

        if ($this->imageFile instanceof UploadedFile) {
            $this->updatedAt = new \DateTime('now');
        }
        return $this;
    }


    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }


  

   


}
