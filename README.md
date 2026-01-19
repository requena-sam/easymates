# Easy Mates

<h1 align="center">Easy Mates</h1>

<p align="center">
  <strong>Plateforme communautaire pour les fans de Gentle Mates</strong>
  <br>
  Projet de fin d’études – Web Development
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-Framework-red">
  <img src="https://img.shields.io/badge/Livewire-Reactive-blue">
  <img src="https://img.shields.io/badge/TailwindCSS-UI-38bdf8">
  <img src="https://img.shields.io/badge/Status-Projet%20académique-lightgrey">
</p>

---

## 🎮 Présentation

**Easy Mates** est une **application web communautaire** dédiée aux fans de la structure esport **Gentle Mates**.

Le projet a été réalisé dans le cadre d’un **projet de fin d’études** en bachelier infographie – orientation **web
développement**.

L’application vise à **centraliser les usages**, **simplifier l’accès à l’information** et **renforcer la communauté**
autour de Gentle Mates.

---

## 🎯 Objectifs

- Centraliser les informations liées à Gentle Mates
- Faciliter l’organisation des événements physiques
- Valoriser les créations de la communauté
- Encourager l’échange et l’entraide entre fans
- Proposer une expérience utilisateur simple et moderne

---

## 🧩 Fonctionnalités

### 🖼️ Hub de créations

- Publication de créations visuelles
- Likes & commentaires
- Système de tags
- Modération des contenus

### 📅 Événements

- Liste des événements à venir
- Pages événement détaillées
- Organisation communautaire :
    - Co-hébergement
    - Covoiturage

### 👥 Joueurs

- Liste des joueurs par jeu
- Accès aux réseaux sociaux
- Mise en avant des joueurs en live sur Twitch
- Données mises à jour automatiquement via l’API Twitch

### 🧑‍💻 Dashboard utilisateur

- Vue personnalisée
- Prochains événements
- Créations publiées
- Annonces personnelles
- Joueurs favoris en live

### 🔐 Rôles & permissions

- Utilisateur
- Modérateur
- Administrateur

### 🔔 Notifications

- Interactions sur les créations
- Joueurs favoris en live
- Actions importantes liées au compte

---

## 🛠️ Stack technique

### Front-end

- Blade
- Livewire
- Alpine.js
- Tailwind CSS

### Back-end

- Laravel
- Spatie (roles & permissions)
- Laravel Notifications

### Services & outils

- API Twitch
- Intervention Image
- UUID (gestion des images)
- MySQL
- Faker (factories)

---

## 🧱 Architecture

- Architecture orientée composants (Livewire)
- Services globaux (images, Twitch, notifications)
- Relations Eloquent claires :
    - User
    - Creation
    - Comment
    - Like
    - Event
    - CoHosting
    - Carpool
    - Player

---

## 🎨 UX / UI

- Design sobre et moderne
- Inspiré de l’identité visuelle de Gentle Mates
- Interfaces orientées cartes
- Utilisation de modales pour conserver le contexte
- Responsive desktop & mobile
- Lisibilité et accessibilité prioritaires

---

## 🧪 Tests utilisateurs

- Tests manuels réalisés auprès de fans
- Scénarios réels :
    - Participation à un événement
    - Découverte d’un joueur
    - Publication d’une création
- Ajustements UX suite aux retours

---

## 🚀 Améliorations futures

- Version mobile dédiée
- Messagerie interne
- Statistiques avancées
- Ouverture à d’autres structures esport

---

## 👤 Auteur

**Sam Requena**  
Étudiant en infographie – Web développement  
Projet de fin d’études – 2025/2026

---

## ⚠️ Disclaimer

Ce projet est un **projet académique** réalisé à des fins pédagogiques.  
Easy Mates n’est **pas affilié officiellement** à Gentle Mates.
