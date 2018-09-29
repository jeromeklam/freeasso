<?php
namespace FreeAsso\Model;

/**
 * Modèle Utilisateur
 *
 * @author jeromeklam
 */
class MemberModel
{

    /**
     * Identifiant
     * @var int
     */
    protected $id = 0;

    /**
     * Prénom
     * @var string
     */
    protected $firstname = null;

    /**
     * Nom
     * @var string
     */
    protected $lastname = null;

    /**
     * Email
     * @var string
     */
    protected $email = null;

    /**
     * Retourne un nouvel objet MemberModel
     *
     * @param array $p_record
     *
     * @return \FreeAsso\Model\MemberModel
     */
    public static function getFromRecord(array $p_record = [])
    {
        $new = new static();
        return $new;
    }

    /**
     * Retourne l'email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Affecte l'email
     *
     * @param string $email
     *
     * @return \FreeAsso\Model\MemberModel
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Retourne le nom
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Affecte le nom
     *
     * @param string $lastname
     *
     * @return \FreeAsso\Model\MemberModel
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
        return $this;
    }

    /**
     * Retourne le prénom
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Affecte le prénom
     *
     * @param string $firstname
     *
     * @return \FreeAsso\Model\MemberModel
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * Retourne l'identifiant
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Affecte l'identifiant
     *
     * @param int $id
     *
     * @return \FreeAsso\Model\MemberModel
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Retourne le nom complet
     *
     * @return string
     */
    public function getFullname()
    {
        return trim($this->getFirstname() . ' ' . $this->getLastname());
    }
}
