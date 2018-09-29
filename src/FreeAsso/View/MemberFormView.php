<?php
namespace FreeAsso\View;

/**
 * Vue permettant d'afficher un membre
 *
 * @author jeromeklam
 */
class MemberFormView
{

    /**
     * Retourne la vue
     *
     * @param array $p_datas
     *
     * @return string
     */
    public function render(array $p_datas)
    {
        $view   = '';
        /**
         * Il faudrait tester que le membre existe et correspond au type, ...
         * @var \FreeAsso\Model\MemberModel $member
         */
        $member = $p_datas['member'];
        if ($member->getId() > 0) {
            $view = $view . '<h1>Modification d&apos;un membre :</h1><br />';
        } else {
            $view = $view . '<h1>Ajout d&apos;un membre :</h1><br />';
        }
        $view = $view . '<form method="POST" action="index.php?service=member&action=save" class="form form-horizontal">';
        $view = $view . '    <div class="form-header">';
        $view = $view . '        <div class="form-group">';
        $view = $view . '            <input type="hidden" name="id" value="' . $member->getId() . '">';
        $view = $view . '        </div>';
        $view = $view . '    </div>';
        $view = $view . '    <div class="form-bodyr">';
        $view = $view . '        <div class="form-group">';
        $view = $view . '            <label for="firstname">Prénom :</label>';
        $view = $view . '            <input type="text" id="firstname" name="firstname" value="' . $member->getFirstname() . '">';
        $view = $view . '        </div>';
        $view = $view . '        <div class="form-group">';
        $view = $view . '            <label for="lastname">Nom :</label>';
        $view = $view . '            <input type="text" id="lastname" name="lastname" value="' . $member->getLastname() . '">';
        $view = $view . '        </div>';
        $view = $view . '        <div class="form-group">';
        $view = $view . '            <label for="email">Email :</label>';
        $view = $view . '            <input type="text" id="email" name="email" value="' . $member->getEmail() . '">';
        $view = $view . '        </div>';
        $view = $view . '    </div>';
        $view = $view . '    <div class="form-footer">';
        $view = $view . '        <button class="btn btn-success" type="submit" name="submit">Valider</button>';
        $view = $view . '        <button class="btn btn-warning" type="submit" name="cancel">Annuler</button>';
        $view = $view . '    </div>';
        $view = $view . '</form>';
        return $view;
    }
}
