# Phase H — Usage Examples & Integration Patterns
[![Infra Drivers Repository](https://img.shields.io/badge/Infra--Drivers-Repository-blue?style=for-the-badge)](../../README.md)
[![Maatify Ecosystem](https://img.shields.io/badge/Maatify-Ecosystem-9C27B0?style=for-the-badge)](https://github.com/Maatify)

## Status

**PLANNED → READY FOR IMPLEMENTATION**

---

## 🎯 Phase Objective

Phase H exists to provide **clear, minimal, and correct usage examples** for `maatify/infra-drivers`.

These examples demonstrate **how to wire the library correctly** without violating architectural boundaries.

They are required for **release readiness**.

---

## 🧠 Design Principles for Examples

All examples MUST:

* Use **explicit Config DTOs**
* Use the appropriate **DriverBuilder**
* Produce a **real native driver**
* Avoid all environment loading
* Avoid DI containers
* Avoid factories, registries, or abstractions
* Avoid retries, pooling, or lifecycle management

Examples are **wiring references**, not production bootstrap code.

---

## 📁 Directory Structure

```
examples/
├── README.md
├── mysql-pdo.php
├── mysql-dbal.php
├── redis-ext.php
├── redis-predis.php
└── mongo.php
```

---

## 📄 examples/README.md (Blueprint)

### Purpose

This directory contains **minimal usage examples** for `maatify/infra-drivers`.

Each file demonstrates:

* One configuration DTO
* One builder
* One resulting native driver

Examples are intentionally explicit and verbose.

### Important Notes

* These examples are **not production-ready bootstraps**
* No environment variables are read
* No DI container is used
* Dependency installation is the responsibility of the consumer

---

## 📄 Example Blueprints

### 1️⃣ mysql-pdo.php

**Shows:**

* `MySQLConfigDTO`
* `MySQLDriverBuilder`
* Native `PDO` instance

**Required dependency:**

* `ext-pdo`

---

### 2️⃣ mysql-dbal.php

**Shows:**

* `MySQLConfigDTO`
* `MySQLDBALDriverBuilder`
* Doctrine DBAL `Connection`

**Required dependency:**

* `doctrine/dbal`

---

### 3️⃣ redis-ext.php

**Shows:**

* `RedisConfigDTO`
* `RedisDriverBuilder`
* Native `Redis` instance

**Required dependency:**

* `ext-redis`

---

### 4️⃣ redis-predis.php

**Shows:**

* `RedisConfigDTO`
* `PredisDriverBuilder`
* Predis `Client`

**Required dependency:**

* `predis/predis`

---

### 5️⃣ mongo.php

**Shows:**

* `MongoConfigDTO`
* `MongoDriverBuilder`
* MongoDB `Client`

**Required dependency:**

* `mongodb/mongodb`

---

## 🚫 Explicitly Forbidden in Examples

* Reading `.env` files
* Using global configuration
* Using service containers
* Catching and suppressing exceptions
* Adding fallback or retry logic

---

## 📦 Phase Outputs

Phase H produces:

* `examples/README.md`
* 5 executable example files

No other artifacts are modified.

---

## 🔒 Phase Constraints

* No API changes
* No source changes
* No tests
* No documentation outside `examples/`

---

## ✅ Completion Criteria

Phase H is complete when:

* All example files exist
* Each example runs independently (given dependencies installed)
* Examples respect all architectural constraints

---

## 🧠 Final Note

> Examples define **how a library should be used**, not how it could be abused.

Phase H ensures `maatify/infra-drivers` is usable, predictable, and safe to release.
