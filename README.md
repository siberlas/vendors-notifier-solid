# Vendors Notifier — Pratique SOLID avec Symfony 6.4

![PHP](https://img.shields.io/badge/PHP-8.3-blue)
![Symfony](https://img.shields.io/badge/Symfony-6.4-black)
![PHPUnit](https://img.shields.io/badge/Tests-PHPUnit%2012-green)
![License](https://img.shields.io/badge/license-MIT-blue)

## Contexte

Projet personnel de mise en pratique des **principes SOLID** en PHP/Symfony.  
Il simule un système de notification de vendors lors de la création d'une commande,  
avec plusieurs canaux de notification (email, log) extensibles sans modification du code existant.

---

## Principes appliqués

| Principe | Application concrète |
|---|---|
| **S** — Single Responsibility | `OrderService`, `NotificationService`, canaux séparés |
| **O** — Open/Closed | Nouveau canal = nouvelle classe, rien à modifier |
| **L** — Liskov Substitution | `InMemoryOrderRepository` interchangeable |
| **I** — Interface Segregation | `OrderRepositoryInterface`, `NotificationChannelInterface` |
| **D** — Dependency Inversion | Injection d'interfaces, jamais de classes concrètes |

---

## Stack technique

- PHP 8.3
- Symfony 6.4
- PHPUnit 12
- PSR-12 (style de code)
- PSR-3 (LoggerInterface)
- PSR-4 (autoloading)

---

## Installation

```bash
git clone https://github.com/TON_USERNAME/vendors-notifier-solid.git
cd vendors-notifier-solid
composer install
```

---

## Lancer les tests

```bash
./vendor/bin/phpunit
```

Résultat attendu :

```
PHPUnit 12.x by Sebastian Bergmann
..                    2 / 2 (100%)
OK (2 tests, 4 assertions)
```

---

## Lancer la commande

```bash
# Créer une commande et notifier le vendor
php bin/console app:order:notify-vendor 1 Kinkeliba 12.50

# Mode simulation — aucune modification
php bin/console app:order:notify-vendor 1 Kinkeliba 12.50 --dry-run
```

---

## Structure du projet

```
src/
├── Command/
│   └── NotifyVendorCommand.php       # Point d'entrée CLI
├── DTO/
│   └── CreateOrderDTO.php            # Données entrantes — public readonly
├── Entity/
│   ├── Order.php                     # Objet de domaine — immuable
│   └── Vendor.php                    # Objet de domaine — immuable
├── Interface/
│   ├── NotificationChannelInterface.php  # Contrat canal notification
│   └── OrderRepositoryInterface.php      # Contrat repository
├── Notification/
│   ├── EmailNotificationChannel.php  # Canal email (simulation)
│   └── LogNotificationChannel.php    # Canal log PSR-3
├── Repository/
│   └── InMemoryOrderRepository.php   # Implémentation sans BDD
└── Service/
    ├── NotificationService.php       # Orchestre les canaux
    └── OrderService.php              # Logique métier commande

tests/
└── Service/
    └── OrderServiceTest.php          # Tests unitaires avec mocks
```

---

## Ajouter un canal de notification

Créer une classe qui implémente `NotificationChannelInterface` — rien d'autre à modifier :

```php
class WhatsAppNotificationChannel implements NotificationChannelInterface
{
    public function send(Order $order): void
    {
        // logique WhatsApp
    }
}
```

C'est le principe **Open/Closed** en action.

---

## Auteur

**Lassana Dansoko** — Développeur Full-Stack PHP/Symfony  
[LinkedIn](https://linkedin.com/in/lassana-dansoko-0089b08b) · [GitHub](https://github.com/siberlas)