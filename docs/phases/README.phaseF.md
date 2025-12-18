# Phase F — Documentation Hardening
[![Infra Drivers Repository](https://img.shields.io/badge/Infra--Drivers-Repository-blue?style=for-the-badge)](../../README.md)
[![Maatify Ecosystem](https://img.shields.io/badge/Maatify-Ecosystem-9C27B0?style=for-the-badge)](https://github.com/Maatify)

This phase focuses on **documentation hardening** only.
No source code, tests, or examples are introduced in this phase.

---

## 📌 Phase Intent

Phase F exists to **lock understanding**, not to change behavior.
Its goal is to prevent misuse of the library by clearly documenting:

* What this library **is**
* What this library **is NOT**
* Where its responsibility **starts and ends**

---

## ✅ Scope of This Phase

### Included

* Boundary clarification
* Explicit misuse prevention
* Documentation alignment with locked architecture
* Reinforcement of non-goals

### Explicitly Excluded

* ❌ Source code changes
* ❌ Tests
* ❌ Examples
* ❌ API changes

---

## 📄 README.phaseF.md

### What This Library Is

`maatify/infra-drivers` is a **pure infrastructure construction layer**.

It builds **real, native infrastructure drivers** (PDO, Redis, MongoDB, …)
from **explicit, readonly configuration DTOs**.

It performs **no runtime logic** beyond deterministic construction.

---

### What This Library Is NOT

This library does **not**:

* Read environment variables
* Use dotenv or env loaders
* Contain a DI container or service locator
* Wrap adapters or reference `AdapterInterface`
* Perform runtime driver detection or switching
* Implement retries, pooling, or fallback logic
* Manage connection lifecycle
* Make logging or monitoring decisions

If you need any of the above, you are in the **wrong layer**.

---

### Correct Layering Model

```text
Application
  ↓
maatify/bootstrap        (env → config wiring)
  ↓
Config DTOs
  ↓
maatify/infra-drivers   (build native drivers only)
  ↓
Native drivers
  ↓
maatify/data-adapters   (wrappers only)
```

---

### Common Misuse Patterns (Forbidden)

The following are **explicit design violations**:

* Creating drivers directly inside adapters
* Passing environment variables into builders
* Adding retry or fallback logic to builders
* Catching and suppressing driver exceptions
* Treating builders as factories or registries

Any of the above breaks architectural guarantees.

---

### Error Responsibility Model

* **DTOs**

    * Validate configuration
    * Throw `InvalidDriverConfigException`

* **Builders**

    * Construct drivers
    * Throw `DriverBuildException` or `MissingExtensionException`

This separation is intentional and locked.

---

## 📦 phase-output.json (Phase F Entry)

```json
{
  "phase": "phaseF",
  "title": "Documentation Hardening",
  "status": "completed",
  "changes": {
    "added": {
      "classes": [],
      "methods": []
    },
    "edited": {
      "classes": [],
      "methods": []
    },
    "deleted": {
      "classes": [],
      "methods": []
    }
  },
  "notes": [
    "Clarified library boundaries and responsibilities",
    "Documented explicit non-goals and misuse patterns",
    "No code, API, or behavior changes introduced"
  ]
}
```

---

## ✅ Phase Status

* README.phaseF.md: **READY**
* phase-output.json: **READY**
* api-map.json: **UNCHANGED**

---

**Decision:** Phase F completed — documentation boundaries locked.
