# Requis pour le fonctionnnement du projet 
Symfony V.4.4
PHP 7.3.21 contraint par OVH
MySQL 5.7



# Installation du projet
php bin/console doctrine:database:create
php bin/console doctrine:schema:create
php bin/console doctrine:fixtures:load


# Répertoire des controlleur des api
src/Controller/Api/UsersController.php pour les api de l'entité User

- Listing : /api/users/ (GET)
- Recupération par id : /api/users/{id} (GET)  
- Affichage : /api/users/create/ (PUT)
- Mise à jour : /api/users/update/ (PATCH)
- Delete : /api/users/delete/{id} (DELETE)

Au niveau de l'accès à la ressources, la restriction se fait au niveau de l'entité via les paramètres suivants :

@Serializer\Expose pour exposer un champ de l'api
````
/**
 * @ORM\Column(type="string", length=100, nullable=true)
 * @Serializer\Expose
 */
private $lastname;
````

@Serializer\Exclude pour exclure un champs de l'api
````
/**
 * Encrypted password. Must be persisted.
 *
 * @var string
 * @Serializer\Exclude
 */
protected $roles;
````

*Information importante : * Pour la gestion des utilisateurs, nous utilisons FOSUserBundle et certains champs sensibles sont masqués. Nous le définissons dans un schéma à part dans :
src/serializer/FOSUB/Model.User.yml
````
FOS\UserBundle\Model\User:
    exclusion_policy: NONE
    properties:
        emailCanonical:
            exclude: "true"
        password:
          exclude: "true"
        usernameCanonical:
            exclude: "true"
        salt:
          exclude: "true"
````

# Doc pour FOSRestBundle
https://symfony.com/doc/master/bundles/FOSRestBundle/versioning.html

# Petite doc sur l'auto decouverte de notre api, à faire plus tard
https://openclassrooms.com/fr/courses/4087036-construisez-une-api-rest-avec-symfony/4343816-rendez-votre-api-auto-decouvrable-dernier-niveau-du-modele-de-maturite-de-richardson



 







