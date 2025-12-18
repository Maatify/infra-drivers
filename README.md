![Maatify.dev](https://www.maatify.dev/assets/img/img/maatify_logo_white.svg)

---

[![Version](https://img.shields.io/packagist/v/maatify/infra-drivers?label=Version&color=4C1)](https://packagist.org/packages/maatify/infra-drivers)
[![PHP](https://img.shields.io/packagist/php-v/maatify/infra-drivers?label=PHP&color=777BB3)](https://packagist.org/packages/maatify/infra-drivers)
![PHP Version](https://img.shields.io/badge/php-%3E%3D8.4-blue)

[![Build](https://github.com/Maatify/infra-drivers/actions/workflows/ci.yml/badge.svg?label=Build&color=brightgreen)](https://github.com/Maatify/infra-drivers/actions/workflows/ci.yml)

![Monthly Downloads](https://img.shields.io/packagist/dm/maatify/infra-drivers?label=Monthly%20Downloads&color=00A8E8)
![Total Downloads](https://img.shields.io/packagist/dt/maatify/infra-drivers?label=Total%20Downloads&color=2AA9E0)

![Stars](https://img.shields.io/github/stars/Maatify/infra-drivers?label=Stars&color=FFD43B)
[![License](https://img.shields.io/github/license/Maatify/infra-drivers?label=License&color=blueviolet)](LICENSE)
![Status](https://img.shields.io/badge/Status-Stable-success)

![PHPStan](https://img.shields.io/badge/PHPStan-Level%20Max-4E8CAE)
![Coverage](https://img.shields.io/endpoint?url=https://raw.githubusercontent.com/Maatify/infra-drivers/badges/coverage.json)

[![Changelog](https://img.shields.io/badge/Changelog-View-blue)](CHANGELOG.md)
[![Security](https://img.shields.io/badge/Security-Policy-important)](SECURITY.md)

---

# maatify/infra-drivers

Pure infrastructure driver builders for PHP.

`maatify/infra-drivers` is a low-level infrastructure library responsible for
**constructing real native drivers** (PDO, Redis, MongoDB, etc.)
from **explicit, typed, readonly configuration objects**.

This package exists to strictly separate **driver construction**
from application bootstrap logic, adapters, and domain concerns.

---

## What this library is

- Builds **real infrastructure drivers**
- Accepts **explicit configuration DTOs**
- Performs **deterministic validation**
- Throws **typed infrastructure exceptions**
- Has **zero environment awareness**

---

## What this library is NOT

This package does **not**:

- Read environment variables
- Use dotenv or env loaders
- Provide DI containers or service locators
- Wrap adapters or expose unified APIs
- Perform runtime detection or switching
- Implement retries, pooling, or lifecycle management
- Make logging or monitoring decisions

Any such behavior is considered a **design violation**.

---

## Architectural position

```text
Application
   ↓
maatify/bootstrap        (env → config wiring)
   ↓
Configuration DTOs
   ↓
maatify/infra-drivers   (driver construction only)
   ↓
Native drivers
   ↓
maatify/data-adapters   (wrappers only)
```

---

## Design status

* Architecture: **LOCKED**
* Scope: **LOCKED**
* Versioning: **Semantic Versioning (SemVer)**

Public API changes require a major version bump.

---

## Quick Start

`maatify/infra-drivers` is a **low-level infrastructure wiring library**.

It builds **real native drivers** from **explicit configuration DTOs**
without reading environment variables or relying on DI containers.

### Example: MySQL using PDO

```php
use Maatify\InfraDrivers\Config\MySQL\MySQLConfigDTO;
use Maatify\InfraDrivers\Builder\MySQL\MySQLDriverBuilder;

$config = new MySQLConfigDTO(
    dsn: 'mysql:host=localhost;dbname=test_db;charset=utf8mb4',
    username: 'user',
    password: 'password'
);

$builder = new MySQLDriverBuilder();

/** @var PDO $pdo */
$pdo = $builder->build($config);
```

This example demonstrates **pure wiring only**:

- No environment loading
- No service container
- No abstraction layer

---

## Usage Examples

This repository includes **standalone executable examples** demonstrating
correct usage for all supported drivers.

Available examples:

- MySQL (PDO)
- MySQL (Doctrine DBAL)
- Redis (ext-redis)
- Redis (Predis)
- MongoDB

📁 See the full list in [`examples/`](./examples/README.md)

⚠️ These examples are for **reference only** and are not production bootstraps.

---

## One-line identity

> Build real infrastructure drivers from explicit configuration objects — nothing more, nothing less.


---
## 🪪 License

**[MIT License](LICENSE)**
© [Maatify.dev](https://www.maatify.dev) — Free to use, modify, and distribute with attribution.

---

## 👤 Author

Engineered by **Mohamed Abdulalim** ([@megyptm](https://github.com/megyptm))
Backend Lead & Technical Architect — [https://www.maatify.dev](https://www.maatify.dev)

---

## 🤝 Contributors

Special thanks to the Maatify.dev engineering team and all open-source contributors.

Contributions are welcome.
Please read the [Contributing Guide](CONTRIBUTING.md) before opening a PR.

---

<p align="center">
  <sub>Built with ❤️ by <a href="https://www.maatify.dev">Maatify.dev</a> — Infrastructure-first PHP libraries</sub>
</p>