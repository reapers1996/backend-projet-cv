# Backend pour le projet CV

Backend PHP léger destiné à être utilisé dans un projet pédagogique.

## Pré-requis

PHP 7+
Extension PHP : pdo\_sqlite

## Mise en place

- Cloner ce dépôt.
- Faire en sorte que votre serveur web pointe dessus et qu’il puisse exécuter des pages PHP.
- Consulter la page l’URL racine du site pour vérifier qu’elle fonctionne. Elle doit afficher "API CV".
- Consulter la page "/index.php?action=init" pour initialiser la base de données.


# Documentation API

## Initialisation de la base de données

### GET /?action=init

Cet appel est à effectuer à partir d’un navigateur Internet. Si aucune erreur n’est affichée, la base de données à été créée, et Initialisée correctement.

> Cette action doit être exécutée une fois pour pouvoir utiliser l’API.

## Endpoints pour les Profils



### GET /?action=profile

- Description: Récupère les informations du profil utilisateur.
- Réponse (exemple):
```json
{ "FirstName": "Jean", "LastName": "Dupont", "Address": "123 Rue de Paris", "Email": "jean.dupont@email.com", "Phone": "0123456789", "DateOfBirth": "1990-01-01", "CVTitle": "Ingénieur Logiciel" }
```


### POST /?action=set-profile

- Description: Met à jour ou crée le profil utilisateur.
- Données requises (exemple):
```json
{ "FirstName": "Jean", "LastName": "Dupont", "Address": "123 Rue de Paris", "Email": "jean.dupont@email.com", "Phone": "0123456789", "DateOfBirth": "1990-01-01", "CVTitle": "Ingénieur Logiciel" }
```
- Réponse (exemple):
```json
{ "success": true }
```


## Endpoints pour les Expériences



### GET /?action=experience&id=[id](id)

- Description: Récupère une expérience spécifique par son ID.
- Paramètres: id - Identifiant de l'expérience.
- Réponse (exemple):
```json
{ "ID": 1, "Title": "Développeur Front-End", "StartDate": "2019-05-01", "EndDate": "2021-04-30", "Description": "Développement d'interfaces utilisateur riches pour une application web d'e-commerce." }
```


### GET /?action=experiences

- Description: Récupère toutes les expériences.
- Réponse (exemple):
```json
[{ "ID": 1, "Title": "Développeur Front-End", "StartDate": "2019-05-01", "EndDate": "2021-04-30", "Description": "Développement d'interfaces utilisateur riches pour une application web d'e-commerce." }]
```


### POST /?action=insert-experience

- Description: Ajoute une nouvelle expérience.
- Données requises (exemple):
```json
{ "Title": "Développeur Web", "StartDate": "2022-01-01", "EndDate": null, "Description": "Conception et développement de sites web en utilisant HTML, CSS, et JavaScript." }
```
- Réponse (exemple):
```json
{ "success": true, "id": 2 }
```


### POST /?action=update-experience&id=[id](id)

- Description: Met à jour une expérience existante.
- Paramètres: id - Identifiant de l'expérience.
- Données requises (exemple):
```json
{ "Title": "Développeur Web Senior", "StartDate": "2022-01-01", "EndDate": null, "Description": "Gestion de projets web et développement avancé en JavaScript." }
```
- Réponse (exemple):
```json
{ "success": true }
```


### POST /?action=delete-experience&id=[id](id)

- Description: Supprime une expérience spécifique.
- Paramètres: id - Identifiant de l'expérience.
- Réponse (exemple):
```json
{ "success": true }
```


## Endpoints pour les Diplômes Académiques



### GET /?action=academicDegree&id=[id](id)

- Description: Récupère un diplôme académique spécifique par son ID.
- Paramètres: id - Identifiant du diplôme.
- Réponse (exemple):
```json
{ "ID": 1, "Title": "Master en Informatique", "Institution": "Université de Technologie", "StartDate": "2018-09-01", "EndDate": "2020-06-30", "Description": "Spécialisation en intelligence artificielle et apprentissage automatique." }
```


### GET /?action=academicDegrees

- Description: Récupère tous les diplômes académiques.
- Réponse (exemple):
```json
[{ "ID": 1, "Title": "Master en Informatique", "Institution": "Université de Technologie", "StartDate": "2018-09-01", "EndDate": "2020-06-30", "Description": "Spécialisation en intelligence artificielle et apprentissage automatique." }]
```


### POST /?action=insert-academicDegree

- Description: Ajoute un nouveau diplôme académique.
- Données requises (exemple):
```json
{ "Title": "Doctorat en Physique Quantique", "Institution": "Institut des Sciences Avancées", "StartDate": "2021-09-01", "EndDate": null, "Description": "Recherche approfondie sur les particules subatomiques." }
```
- Réponse (exemple):
```json
{ "success": true, "id": 2 }
```


### POST /?action=update-academicDegree&id=[id](id)

- Description: Met à jour un diplôme académique existant.
- Paramètres: id - Identifiant du diplôme.
- Données requises (exemple):
```json
{ "Title": "Doctorat en Physique Quantique", "Institution": "Institut des Sciences Avancées", "StartDate": "2021-09-01", "EndDate": "2025-09-01", "Description": "Nouvelles découvertes dans le domaine de la mécanique quantique." }
```
- Réponse (exemple):
```json
{ "success": true }
```


### POST /?action=delete-academicDegree&id=[id](id)

- Description: Supprime un diplôme académique spécifique.
- Paramètres: id - Identifiant du diplôme.
- Réponse (exemple):
```json
{ "success": true }
```


## Endpoints pour les Hobbies



### GET /?action=hobby&id=[id](id)

- Description: Récupère un hobby spécifique par son ID.
- Paramètres: id - Identifiant du hobby.
- Réponse (exemple):
```json
{ "ID": 1, "HobbyName": "Photographie", "Description": "Photographie de paysages naturels et urbains." }
```


### GET /?action=hobbies

- Description: Récupère tous les hobbies.
- Réponse (exemple):
```json
[{ "ID": 1, "HobbyName": "Photographie", "Description": "Photographie de paysages naturels et urbains." }]
```


### POST /?action=insert-hobby

- Description: Ajoute un nouveau hobby.
- Données requises (exemple):
```json
{ "HobbyName": "Jardinage", "Description": "Cultivation de légumes et de fleurs biologiques." }
```
- Réponse (exemple):
```json
{ "success": true, "id": 2 }
```


### POST /?action=update-hobby&id=[id](id)

- Description: Met à jour un hobby existant.
- Paramètres: id - Identifiant du hobby.
- Données requises (exemple):
```json
{ "HobbyName": "Photographie avancée", "Description": "Techniques avancées de photographie, y compris la photographie nocturne et sous-marine." }
```
- Réponse (exemple):
```json
{ "success": true }
```


### POST /?action=delete-hobby&id=[id](id)

- Description: Supprime un hobby spécifique.
- Paramètres: id - Identifiant du hobby.
- Réponse (exemple):
```json
{ "success": true }
```


## Endpoints pour les Compétences



### GET /?action=skill&id=[id](id)

- Description: Récupère une compétence spécifique par son ID.
- Paramètres: id - Identifiant de la compétence.
- Réponse (exemple):
```json
{ "ID": 1, "SkillName": "Programmation", "SkillLevel": 5 }
```


### GET /?action=skills

- Description: Récupère toutes les compétences.
- Réponse (exemple):
```json
[{ "ID": 1, "SkillName": "Programmation", "SkillLevel": 5 }]
```


### POST /?action=insert-skill

- Description: Ajoute une nouvelle compétence.
- Données requises (exemple):
```json
{ "SkillName": "Développement Web", "SkillLevel": 4 }
```
- Réponse (exemple):
```json
{ "success": true, "id": 3 }
```


### POST /?action=update-skill&id=[id](id)

- Description: Met à jour une compétence existante.
- Paramètres: id - Identifiant de la compétence.
- Données requises (exemple):
```json
{ "SkillName": "Programmation avancée", "SkillLevel": 5 }
```
- Réponse (exemple):
```json
{ "success": true }
```


### POST /?action=delete-skill&id=[id](id)

- Description: Supprime une compétence spécifique.
- Paramètres: id - Identifiant de la compétence.
- Réponse (exemple):
```json
{ "success": true }
```
