#!/bin/bash
# Post installation standard
#--------------------------------------------------------------------------------------
# Author : jeromeklam@free.fr
# Usage  : after_install.sh <répertoire>
#--------------------------------------------------------------------------------------






#--------------------------------------------------------------------------------------
#
#--------------------------------------------------------------------------------------
exitProgramm ()
{
    echo "######################################################"
    echo "Erreur : $1"
    echo "Message : $2"
    echo ""
    exit $1
}

#--------------------------------------------------------------------------------------
#
#--------------------------------------------------------------------------------------
info ()
{
    echo "# $1"
}

#--------------------------------------------------------------------------------------
# MAIN
#--------------------------------------------------------------------------------------
ici=`pwd`
info "Vérification des paramètres..."
case $# in
   1) ;;
   *) exitProgramm 3 "Le nombre de paramètre est incorrect !"
      ;;
esac

cd $1
php app/tech.php database::migrate 2>$1/log/install.log >$1/log/install.log
exit $?