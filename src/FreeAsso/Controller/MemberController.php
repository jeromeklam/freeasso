<?php
namespace FreeAsso\Controller;

/**
 * Controlleur des membres
 *
 * @author jeromeklam
 */
class MemberController
{

    /**
     * Affichage de la liste des membres
     *
     * @param array $p_request
     *
     * @return string
     */
    public function home(array $p_request)
    {
        /**
         * On va utiliser le manager pour nous retourner une liste de MemberModel
         */
        $memberManager = new \FreeAsso\Manager\MemberManager();
        $memberList    = $memberManager->getAll();
        /**
         * On a une liste il faut transformer ça en html
         * On va utiliser une vue pour cela, on considère que la vue dispose d'une méthode render
         * Cette méthode prend en paramètre une liste de données sous la forme clef=>valeur
         */
        $memberListView = new \FreeAsso\View\MemberListView();
        $result         = $memberListView->render(
            [
                'members' => $memberList
            ]
        );
        /**
         * Fini, on retourne le tout
         */
        return $result;
    }

    /**
     * Affichage du formulaire d'ajout d'un membre
     *
     * @param array $p_request
     *
     * @return string
     */
    public function add(array $p_request)
    {
        /**
         * On créé un membre vide que l'on va passer au formulaire
         * @var \FreeAsso\Model\MemberModel $newMember
         */
        $newMember = new \FreeAsso\Model\MemberModel();
        /**
         * Même principe que la liste, on instancie la vue et on passe le membre vide
         */
        $memberFormView = new \FreeAsso\View\MemberFormView();
        $result         = $memberFormView->render(
            [
                'member' => $newMember
            ]
        );
        /**
         * Fini, on retourne le tout
         */
        return $result;
    }

    /**
     * Sauvegarde du résultat ou annulation
     *
     * @param array $p_request
     *
     * @return string
     */
    public function save(array $p_request)
    {
        if (array_key_exists('cancel', $p_request)) {
            /**
             * On a annulé, pour faire simple on va afficher un bouton de retour
             * Sans vue pour l'instant.
             */
            $result = '<h1 class="text-warning">Action annulée</h1><br />';
            $result = $result . '<a href="/index.php?service=member&action=home">Retour</a>';
        } else {
            /**
             * On va remplir le modèle avec les champs du formulaire
             * @var \FreeAsso\Model\MemberModel $member
             */
            $member = new \FreeAsso\Model\MemberModel();
            $member
                ->setId($p_request['id'])
                ->setFirstname($p_request['firstname'])
                ->setLastname($p_request['lastname'])
                ->setEmail($p_request['email'])
            ;
            /**
             * On instancie le manager pour le CRUD
             * On verra plus tard pour gérer les erreurs, doublons, ...
             */
            $memberManager = new \FreeAsso\Manager\MemberManager();
            if ($member->getId() > 0) {
                $memberManager->update($member);
            } else {
                $memberManager->create($member);
            }
            $result = '<h1 class="text-success">Membre enregistré</h1><br />';
            $result = $result . '<a href="/index.php?service=member&action=home">Retour</a>';
        }
        return $result;
    }
}
