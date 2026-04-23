# initialisation du projet 
- creation des différentes migrations pour la creation automatique des différentes tables
- creation des modèle stand, produit, user, et commande
# 🎯 Gestion des Produits avec Authentification, Policy et Gate dans Laravel

Ce projet Laravel implémente un **CRUD complet pour les produits**, sécurisé de façon à ce que **seuls les utilisateurs avec le rôle `entrepreneur_approuve`** puissent ajouter, modifier ou supprimer des produits. Les administrateurs (`admin`) ont un accès complet via une **règle globale (Gate)**.

---

## ⚙️ Fonctionnalités principales

- 🔐 Authentification via le modèle `User`
- ✅ Gestion des rôles (`admin`, `entrepreneur_en_attente`, `entrepreneur_approuve`)
- 📦 CRUD complet pour le modèle `Produit`
- 🎯 Accès restreint par **Policy** (`ProduitPolicy`)
- 🔐 Autorisation globale via **Gate::before** pour les admins
- 🔄 Relations entre `User`, `Stand`, et `Produit`

---

## 🗃️ Base de données

### Tables utilisées :
- `users` : contient les rôles et les identifiants
- `stands` : chaque utilisateur a un ou plusieurs stands
- `produits` : liés à un stand (donc indirectement à un utilisateur)
- `commandes` : (à venir ou optionnelle)

---

## 🛠️ Étapes d’implémentation

### 1. Migration de la table `users`

Ajout du champ `role` :
```php
$table->enum('role', ['admin', 'entrepreneur_en_attente', 'entrepreneur_approuve'])->default('entrepreneur_en_attente');


[![committers.top badge](https://user-badge.committers.top/benin/Bellox1.svg)](https://user-badge.committers.top/benin/Bellox1)
