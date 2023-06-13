<?php

namespace App\Entity;

use App\Repository\UserRepository;
use DateTime;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`app_user`')]
#[ORM\Index(columns: ["last_login_ip", "last_login_at"], name: "idx_lastLoginIp_lastLoginAt")]
#[ORM\Index(columns: ["is_deleted", "deleted_at"], name: "idx_isDeleted_deletedAt")]
#[ORM\Index(columns: ["gender"], name: "idx_gender")]
#[ORM\Index(columns: ["email"], name:"idx_email")]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]

class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(name: 'email', length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column(name: 'password', type: Types::STRING)]
    private ?string $password = null;

    #[Assert\NotBlank]
    #[ORM\Column(name: 'name',type: Types::STRING, length: 44)]
    #[Assert\Length( min: 3, max: 44, minMessage: 'Minimum 3 karakter olmalı.', maxMessage: 'Maksimum karakter sayısına ulaştınız.')]
    private ?string $name;

    #[Assert\NotBlank]
    #[ORM\Column(name: 'surname',type: Types::STRING, length: 44)]
    #[Assert\Length( min: 2, max: 44, minMessage: 'Minimum 2 karakter olmalı.', maxMessage: 'Maksimum karakter sayısına ulaştınız.')]
    private ?string $surname;


//    #[ORM\Column(type: Types::STRING)]
//    #[
//        Assert\NotBlank(message: "form.errors.blank"),
//        Assert\Length(
//            min: 7,
//            max: 120,
//            minMessage: "form.errors.min.password",
//            maxMessage: "form.errors.max.password"
//        ),
//        Assert\Regex(
//            pattern: "/(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).{7,}/",
//            message: "form.errors.password.week"
//        )
//    ]
//    private ?string $password = null;

    #[ORM\Column(name: 'image',length: 1024, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(name: 'gender', type: Types::INTEGER, length: 64, nullable: true)]
    private ?string $gender = null;

    #[ORM\Column(name: 'last_login_ip',type: Types::STRING, length: 64, nullable: true)]
    private ?string $lastLoginIp = null;

    #[ORM\Column(name: 'last_login_at',type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?DateTime $lastLoginAt = null;

    #[ORM\Column(name: 'is_deleted', type: Types::BOOLEAN, length: 64, options: ["default" => false])]
    private ?bool $isDeleted = false;
    #[ORM\Column(name: 'deleted_at',  length: 64, nullable: true)]
    private ?\Datetime $deletedAt ;

    #[ORM\Column(name: 'created_at', type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTime $createdAt = null;

    #[ORM\Column(name: 'updated_at', type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTime $updatedAt = null;

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getSurname(): ?string
    {
        return $this->surname;
    }

    /**
     * @param string|null $surname
     */
    public function setSurname(?string $surname): void
    {
        $this->surname = $surname;
    }

    /**
     * @return string|null
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @param string|null $image
     */
    public function setImage(?string $image): void
    {
        $this->image = $image;
    }

    /**
     * @return string|null
     */
    public function getGender(): ?string
    {
        return $this->gender;
    }

    /**
     * @param string|null $gender
     */
    public function setGender(?string $gender): void
    {
        $this->gender = $gender;
    }

    /**
     * @return string|null
     */
    public function getLastLoginIp(): ?string
    {
        return $this->lastLoginIp;
    }

    /**
     * @param string|null $lastLoginIp
     */
    public function setLastLoginIp(?string $lastLoginIp): void
    {
        $this->lastLoginIp = $lastLoginIp;
    }

    /**
     * @return DateTime|null
     */
    public function getLastLoginAt(): ?DateTime
    {
        return $this->lastLoginAt;
    }

    /**
     * @param DateTime|null $lastLoginAt
     */
    public function setLastLoginAt(?DateTime $lastLoginAt): void
    {
        $this->lastLoginAt = $lastLoginAt;
    }

    /**
     * @return bool|null
     */
    public function getIsDeleted(): ?bool
    {
        return $this->isDeleted;
    }

    /**
     * @param bool|null $isDeleted
     */
    public function setIsDeleted(?bool $isDeleted): void
    {
        $this->isDeleted = $isDeleted;
    }

    /**
     * @return Datetime|null
     */
    public function getDeletedAt(): ?Datetime
    {
        return $this->deletedAt;
    }

    /**
     * @param Datetime|null $deletedAt
     */
    public function setDeletedAt(?Datetime $deletedAt): void
    {
        $this->deletedAt = $deletedAt;
    }

    /**
     * @return DateTime|null
     */
    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime|null $createdAt
     */
    public function setCreatedAt(?DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return DateTime|null
     */
    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTime|null $updatedAt
     */
    public function setUpdatedAt(?DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
}
