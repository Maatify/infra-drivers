# Usage Examples for maatify/infra-drivers

These examples demonstrate the **correct wiring** of Config DTOs, Builders, and Native Drivers.

## ⚠️ Important Warnings

- These examples are **NOT production-ready**.
- **DO NOT** use environment loading (`.env`, `getenv()`) inside your driver wiring code.
- **DO NOT** wrap these in Service Containers or DI logic within the builder context.
- **DO NOT** add fallback logic, retries, or error suppression here.
- These files are for **reference only**.

## Examples

| File | Purpose | Required Dependency |
|---|---|---|
| `mysql-pdo.php` | Connect using native PDO | `ext-pdo` |
| `mysql-dbal.php` | Connect using Doctrine DBAL | `doctrine/dbal` |
| `redis-ext.php` | Connect using native Redis extension | `ext-redis` |
| `redis-predis.php` | Connect using Predis library | `predis/predis` |
| `mongo.php` | Connect using MongoDB library | `mongodb/mongodb` |

## Usage

You can run these examples independently if the dependencies are installed:

```bash
php examples/mysql-pdo.php
php examples/mysql-dbal.php
php examples/redis-ext.php
php examples/redis-predis.php
php examples/mongo.php
```

Ensure your local environment has the necessary services (MySQL, Redis, MongoDB) running to avoid connection errors, although the examples will throw exceptions if connections fail (which is expected behavior).
