# Phase G — Dependency Matrix & Composer Policy

## Status

**ACTIVE → FINALIZING**

---

## 🎯 Phase Purpose

Phase G exists to **lock and formalize the dependency policy** of `maatify/infra-drivers`.

The goal is to guarantee that:

* The package has **zero hidden or implicit dependencies**
* All infrastructure requirements are **explicit, discoverable, and intentional**
* Consumers can install the package **without being forced** to install unused drivers

This phase introduces **no code changes**.

---

## 🧱 Dependency Philosophy

`maatify/infra-drivers` follows a **strict opt-in dependency model**.

### Core Rules

1. The package must be installable with **PHP only**
2. No driver dependency is required by default
3. Each driver builder declares its requirements **explicitly**
4. Missing dependencies fail **loudly and deterministically** at runtime

There is **no auto-detection**, **no fallback**, and **no silent behavior**.

---

## 📦 Composer Policy

### require

The `require` section contains **only**:

* PHP version constraint

No extensions or external libraries are required at install time.

---

### suggest

All optional infrastructure dependencies are declared via `suggest`.

This allows Composer to:

* Inform the user of required dependencies
* Avoid forcing unused drivers
* Keep the installation surface minimal

---

## 🔗 Dependency Matrix

| Builder Class            | Required Dependency | Type             |
| ------------------------ | ------------------- | ---------------- |
| `MySQLDriverBuilder`     | `ext-pdo`           | PHP extension    |
| `MySQLDBALDriverBuilder` | `doctrine/dbal`     | Composer package |
| `RedisDriverBuilder`     | `ext-redis`         | PHP extension    |
| `PredisDriverBuilder`    | `predis/predis`     | Composer package |
| `MongoDriverBuilder`     | `mongodb/mongodb`   | Composer package |

Each builder validates its dependency explicitly and throws a typed exception if missing.

---

## ❌ Forbidden Patterns

The following patterns are **explicitly forbidden**:

* Requiring driver dependencies in `require`
* Runtime detection or switching between drivers
* Silent fallback to alternative drivers
* Conditional behavior based on installed packages
* Hidden dependency loading via `class_exists`

Any of the above breaks determinism and is considered a design violation.

---

## 🧨 Failure Model

When a required dependency is missing:

* The builder **does not attempt recovery**
* A `MissingExtensionException` or `DriverBuildException` is thrown
* The failure is immediate and explicit

This behavior is intentional and locked.

---

## 🔒 Phase Guarantees

After Phase G:

* Dependency surface is **fully documented**
* Composer policy is **locked**
* No implicit infrastructure requirements exist
* Consumers can reason about dependencies **without reading source code**

---

## 🚫 Out of Scope

Phase G does **not** include:

* Source code changes
* Tests or examples
* API modifications
* Integration logic

---

## 🧠 Final Note

> Infrastructure dependencies must be a **deliberate decision**, never a surprise.

Phase G ensures that `maatify/infra-drivers` remains predictable, minimal, and enterprise-safe.
