Blog symfony
 Faical Nachiti
  fonctionalite:
        crud sur les Biens
        authentification


-Connecter vers :  http://localhost:8000/admin
-vous pouvez utiliser le compte suivant pour se connecter: username : demo , password : demo

-cree le fichier '.env' dans la racine du project avec la ligne suivant pour configurer la BDD :
    DATABASE_URL=mysql://root:@127.0.0.1:3306/masuperagence
    
    executer la cmd  php bin/console doctrine:fixtures:load --append pour charger les données
    
-Pour faire logout : faut cliquer sur : Se déconnecter 
  et apres vous redireger vers la list des biens et leur Details
  
  

