# Requis pour le fonctionnement du projet 
- Symfony V.4.4
- PHP 7.3.21 (contraint par OVH)
- MySQL 5.7



# Installation du projet
````
composer update (Installer les sources)
php bin/console doctrine:database:create
php bin/console doctrine:schema:create
php bin/console doctrine:fixtures:load
````


# Répertoire des controlleurs des api
````
src/Controller/Api/Users/UsersController.php pour les api de l'entité User
src/Controller/Api/Ads/AdsController.php pour les api de l'entité Ads 
````
Il en sera de même pour toutes les autres entités ou webServices

# Connexion JWT Token avec LexikJWTAuthenticationBundle
Cf doc : https://github.com/lexik/LexikJWTAuthenticationBundle

URL : /api/login_check
Avec saisi dans l'onglet "Body" et dans la section "Raw" de Postman les valeurs suivantes :
````
{
  "username": "email@domain.com",
  "password": "password"
}
````


# Restriction des controlleurs des api avec JWT Token
On distingue deux types d'api : 
- Celles dites ouvertes sans restrictions : Ex. la liste des utilisateurs, la liste des annonces, qui ne demanderont pas forcément un accès particulier. 
- Et celles dites privées avec Jeton d'accès (JWT), comme par exemple la création d'utilisateurs ou encore la mise à jour d'une ressources particulière.

Les ressources libres seront distinguées par "free-api"
Et celles sécurisés par "api" tout court.

## Exemples:
````
- Listing : /free-api/users/ (GET)
- Recupération par id : /free-api/users/{id} (GET)
- Mise à jour : /api/users/update/ (PATCH)
- Delete : /api/users/{id} (DELETE)
````

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


# Petite doc sur l'auto decouverte de notre api, à faire plus tard
https://openclassrooms.com/fr/courses/4087036-construisez-une-api-rest-avec-symfony/4343816-rendez-votre-api-auto-decouvrable-dernier-niveau-du-modele-de-maturite-de-richardson


## MANDRILL CONNEXION

URL : https://mandrillapp.com/settings/

user: camillekanza@gmail.com

password: Azerty77*
 







