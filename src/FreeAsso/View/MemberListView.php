<?php
namespace FreeAsso\View;

/**
 * Vue permettant d'afficher une liste de membres
 *
 * @author jeromeklam
 */
class MemberListView
{

    /**
     * Retourne le corps du tableau
     *
     * @param array $p_members
     *
     * @return string
     */
    protected function getBody(array $p_members)
    {
        $body = '';
        if (is_array($p_members) && count($p_members) > 0) {
            foreach ($p_members as $idx => $oneMember) {
                $body = $body . '<tr>';
                $body = $body . '    <td>' . $oneMember->getId() . '</td>';
                $body = $body . '    <td>' . $oneMember->getFullname() . '</td>';
                $body = $body . '    <td>' . $oneMember->getEmail() . '</td>';
                $body = $body . '</tr>';
            }
        }
        return $body;
    }

    /**
     * Retourne la vue
     *
     * @param array $p_datas
     *
     * @return string
     */
    public function render(array $p_datas)
    {
        /**
         * On commence par transformer les lignes
         */
        $tbody = $this->getBody($p_datas['members']);
        /**
         * Le corps de la vue
         */
        $view = '';
        $view = $view . '<h1>Liste des membres :</h1><br />';
        $view = $view . '<nav>';
        $view = $view . '    <ul>';
        $view = $view . '        <li><a href="/index.php?service=member&action=add">Ajouter un membre</a></li>';
        $view = $view . '    </ul>';
        $view = $view . '</nav>';
        $view = $view . '<table class="table table-stripped table-hover">';
        $view = $view . '    <thead>';
        $view = $view . '        <tr><th>Id.</th><th>Nom prénom</th><th>Email</th></tr>';
        $view = $view . '    </thead>';
        $view = $view . '    <tbody>';
        if ($tbody == '') {
            $view = $view . '<tr><td colspan="3" class="text-center">Aucun membre<td></tr>';
        } else {
            $view = $view . $tbody;
        }
        $view = $view . '    </tbody>';
        $view = $view . '</table>';
        return $view;
    }
}
