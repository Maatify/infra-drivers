# Phase C — Driver Builders

## Status

**COMPLETED** ✅

---

## Purpose

Phase C introduces **explicit infrastructure driver builders**.

Each builder is responsible for constructing a **real native driver**
from a **readonly configuration DTO**, with **no environment access**
and **no adapter or application awareness**.

This phase defines the **only supported construction path**
for infrastructure drivers inside `maatify/infra-drivers`.

---

## Scope

The following driver builders were introduced:

### MySQL

| Builder | Driver | Dependency |
|------|-------|------------|
| `MySQLDriverBuilder` | PDO | PHP core |
| `MySQLDBALDriverBuilder` | Doctrine DBAL | Optional (`doctrine/dbal`) |

---

### Redis

| Builder | Driver | Dependency |
|------|-------|------------|
| `RedisDriverBuilder` | ext-redis | PHP extension |
| `PredisDriverBuilder` | Predis | Optional (`predis/predis`) |

---

### MongoDB

| Builder | Driver | Dependency |
|------|-------|------------|
| `MongoDriverBuilder` | `MongoDB\Client` | `mongodb` extension |

---

## Design Rules (Strict)

All builders in this phase **MUST**:

* Accept exactly **one configuration DTO**
* Construct **real native drivers**
* Perform **no environment access**
* Perform **no runtime detection or switching**
* Perform **no retry, fallback, pooling, or lifecycle management**
* Throw **typed infrastructure exceptions**
* Expose **explicit public APIs only**

Any deviation is considered a **design violation**.

---

## Optional Infrastructure Policy

Optional drivers (DBAL, Predis):

* Are implemented via **separate, explicit builders**
* Are **never auto-detected**
* Are **never fallback targets**
* Are **never implicitly required**
* Are declared later via Composer `suggest`

If the dependency is missing, the builder **fails immediately**
with a deterministic exception.

---

## Failure Model

All builders fail fast using:

* `DriverBuildException`

Native driver exceptions are preserved as `previous`
when meaningful.

No errors are swallowed.
No implicit recovery is attempted.

---

## Explicit Non-Goals

This phase does **NOT** introduce:

* Adapters or `AdapterInterface`
* Environment variable access
* Dependency injection containers
* Runtime driver selection
* Connection pooling or retries
* Health checks or logging
* Configuration inference or defaults

---

## Public API Contract

All public builders and methods are reflected in:

* `api-map.json`

This file is the **authoritative API contract**
and must remain backward-compatible within the v1.x series.

---

## Phase Artifacts

This phase produced the following artifacts:

* `src/Builder/**` — driver builders
* `src/Exception/DriverBuildException.php`
* `api-map.json` — updated public API contract
* `phase-output.json` — phase execution reflection
* `README.phaseC.md` — this document

---

## Architectural Position

```text
Config DTOs
   ↓
Driver Builders (this phase)
   ↓
Native Drivers
   ↓
Adapters (outside this package)
````

`maatify/infra-drivers` **stops at driver construction**.

---

## Completion Statement

Phase C is complete.

All supported infrastructure drivers now have
explicit, deterministic, and isolated construction paths.

No runtime magic exists.
No hidden behavior exists.
No dependency assumptions exist.

---

**Next Phase:**
➡️ Phase D — Error Boundary & Exception Model
