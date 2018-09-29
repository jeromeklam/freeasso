<?php
/**
 * Ce fichier est censé inclure les dépendances.
 * C'est à dire tous les fichiers php de l'application
 * On verra ensuite pour utiliser du PSR0 / PSR4 avec le loader de "getcomposer.org"
 */
require_once __DIR__ . '/../src/bootstrap.php';

/**
 * Le service à gérer, pour l'instant forcément member, on pourra l'ajouter à l'url après.
 * @var string $service
 */
$service = 'member';
/**
 * Le paramètre action de l'url m'indique l'action à effectuer.
 * Par défaut : home
 * @var string $action
 */
$action = 'home';
if (array_key_exists('action', $_GET)) {
    $action = $_GET['action'];
}

/**
 * On va essayer d'instancier le controller, c'est toujours <service>Controller
 * Et on appellera la fonction <action> de ce controlleur
 * @var object $controllerClass
 */
$ctrl            = ucfirst(strtolower($service));   // Première lettre en majuscule : camelCase.
$controller      = null;
$controllerClass = '\\FreeAsso\\Controller\\' . $ctrl . 'Controller';   // Le nom complet de la classe
if (class_exists($controllerClass)) {
    $controller = new $controllerClass();   // Si existe instance de la classe
}
if ($controller !== null) {
    /**
     * On vérifie que l'action est une méthode de la classe
     * Si oui on va l'exécuter.
     * Cette fonction est censé retourner le code html à afficher...
     */
    $action = strtolower($action);  // La fonction toujours en minuscules
    if (method_exists($controller, $action)) {
        /**
         * Création de la liste des paramètres, chaque indice du tableau est un paramètre
         * Le premier les attributs de la requête : GET + POST
         * @var array $params
         */
        $params   = [];
        $params[] = array_merge($_GET, $_POST);
        /**
         * La fonction si dessous permet d'appaller une méthode de classe en passant des paramètres
         * doc : http://php.net/manual/fr/function.call-user-func-array.php
         */
        $result = call_user_func_array([$controller, $action], $params);
    } else {
        // @todo
        $result = sprintf('<h1 class="error">La méthode %s n&apos;existe pas !</h1>', $action);
    }
} else {
    // @todo
    $result = sprintf('<h1 class="error">Le controlleur %s n&apos;existe pas !</h1>', $ctrl);
}
/**
 * Reste plus qu'à afficher
 */
?>
<!DOCTYPE html>
<html>
    <head>
    <title>Free Association Management</title>
    </head>
    <body>
<?php echo $result; ?>
    </body>
</html>