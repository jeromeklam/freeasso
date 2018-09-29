<?php
namespace FreeAsso\Manager;

/**
 * Manager des utilisateurs
 *
 * @author jeromeklam
 */
class MemberManager
{

    /**
     * Constantes
     * @var string
     */
    const MEMBER_FILENAME = __DIR__ . '/../../../data/members.csv';

    /**
     * Retourne la liste des membres
     *
     * @return array
     */
    public function getAll()
    {
        $list  = [];
        $lines = @file(self::MEMBER_FILENAME);    // @ permet de ne pas afficher directement les erreurs
        if ($lines) {
            foreach ($lines as $idx => $oneLine) {
                $datas     = explode(';', $oneLine);
                /**
                 * On transforma la ligne en modèle
                 * @var \FreeAsso\Model\MemberModel $oneMember
                 */
                $oneMember = new \FreeAsso\Model\MemberModel();
                $oneMember
                    ->setId($datas[0])
                    ->setFirstname($datas[1])
                    ->setLastname($datas[2])
                    ->setEmail($datas[3])
                ;
                /**
                 * On ajoute le membre à la liste
                 */
                $list[] = $oneMember;
            }
        }
        return $list;
    }

    /**
     * Lecture d'un membre selon son identifiant
     *
     * @param int $p_id
     *
     * @return \FreeAsso\Model\MemberModel | false
     */
    public function getById(int $p_id)
    {
        $obj = new \FreeAsso\Model\MemberModel();
        return $obj;
    }

    /**
     * Retourne un membre selon son email
     *
     * @param string $p_email
     *
     * @return \FreeAsso\Model\MemberModel | false
     */
    public function getByEmail(string $p_email)
    {
        $obj = new \FreeAsso\Model\MemberModel();
        return $obj;
    }

    /**
     * Ajout d'un membre
     *
     * @param \FreeAsso\Model\MemberModel $p_user
     *
     * @return boolean
     */
    public function create(\FreeAsso\Model\MemberModel $p_member)
    {
        $id      = 0;
        $lines   = @file(self::MEMBER_FILENAME);
        if (is_array($lines)) {
            foreach ($lines as $idx => $oneLine) {
                $parts = explode(';', $oneLine);
                if (intval($parts[0]) > $id) {
                    $id = intval($parts[0]);
                }
            }
        }
        $p_member->setId($id+1);
        $lines[] =
            $p_member->getId() . ';' .
            $p_member->getFirstname() . ';' .
            $p_member->getLastname() . ';' .
            $p_member->getEmail()
        ;
        file_put_contents(self::MEMBER_FILENAME, implode("\n", $lines));
        return true;
    }

    /**
     * Mise à jour d'un membre
     *
     * @param \FreeAsso\Model\MemberModel $p_user
     *
     * @return boolean
     */
    public function update(\FreeAsso\Model\MemberModel $p_member)
    {
        return true;
    }

    /**
     * Suppression d'un membre
     *
     * @param \FreeAsso\Model\MemberModel $p_member
     *
     * @return boolean
     */
    public function delete(\FreeAsso\Model\MemberModel $p_member)
    {
        return true;
    }

    /**
     * Supprime tous les membres
     *
     * @return boolean
     */
    public function flush()
    {
        file_put_contents(self::USER_FILENAME, '');
        return true;
    }
}
