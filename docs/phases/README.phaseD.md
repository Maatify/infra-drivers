## Phase D — Error Boundary & Exception Model
[![Infra Drivers Repository](https://img.shields.io/badge/Infra--Drivers-Repository-blue?style=for-the-badge)](../../README.md)
[![Maatify Ecosystem](https://img.shields.io/badge/Maatify-Ecosystem-9C27B0?style=for-the-badge)](https://github.com/Maatify)

---

## Phase Status

**COMPLETED** ✅

This phase defines and enforces the **infrastructure error boundary model** for
`maatify/infra-drivers`.

All failures during driver construction are now:
- **Explicit**
- **Deterministic**
- **Typed**
- **Non-silent**

---

## Purpose of Phase D

The goal of Phase D is to ensure that **all infrastructure failures** are:

1. Clearly classified
2. Thrown early
3. Never swallowed
4. Never guessed
5. Never mixed with application or adapter concerns

This phase completes the **failure semantics** of the library.

---

## Core Principles (Locked)

- No silent failures
- No error guessing
- No retry or fallback logic
- No logging decisions
- No environment interpretation
- No adapter awareness

> Infrastructure errors must either be **native** or **explicitly wrapped** —
> never reinterpreted.

---

## Exception Model Overview

The library exposes a **minimal and explicit exception hierarchy**.

### 1. DriverBuildException

**Purpose:**  
Represents a failure while **constructing a native infrastructure driver**.

**Characteristics:**
- Wraps the original native exception
- Preserves the original error via `previous`
- Adds semantic meaning: *“driver build failed”*

**Usage Pattern:**
- Thrown only by driver builders
- Created via `DriverBuildException::fromThrowable()`
- Never thrown without a previous exception

---

### 2. InvalidDriverConfigException

**Purpose:**  
Represents an **invalid or inconsistent configuration**.

**Characteristics:**
- Extends `InvalidArgumentException`
- Indicates programmer or configuration error
- Deterministic and non-recoverable at runtime

**Typical Causes:**
- Missing required configuration values
- Invalid combinations of options
- Unsupported configuration states

---

### 3. MissingExtensionException

**Purpose:**  
Indicates that a **required PHP extension or optional dependency** is not available.

**Characteristics:**
- Thrown before any driver interaction
- Deterministic
- Uses a named constructor for clarity

**Typical Causes:**
- Missing `pdo`, `redis`, or `mongodb` extensions
- Missing optional libraries such as `predis/predis` or `doctrine/dbal`

---

## Builder Error Boundary Rules

All driver builders now follow the same strict rules:

1. Validate required extensions or classes **before** construction
2. Allow native drivers to throw their own exceptions
3. Catch only the **native driver exception type**
4. Wrap failures using `DriverBuildException::fromThrowable()`
5. Never invent error messages without a native cause

---

## Explicitly Forbidden Patterns

The following are **design violations** in `infra-drivers`:

- Throwing exceptions based on return values
- Creating exceptions without a previous throwable
- Swallowing native exceptions
- Logging inside builders
- Retrying failed connections
- Inferring or guessing failure causes

Any of the above is considered a **boundary violation**.

---

## Architectural Impact

After Phase D:

- Driver builders have a **single, consistent failure contract**
- Consumers can rely on **typed exceptions**
- Tests can assert deterministic failure paths
- Static analysis can reason about all failure cases
- No ambiguity exists between configuration errors and runtime failures

---

## Phase D Deliverables

- Typed infrastructure exception model
- Deterministic error boundaries for all builders
- Updated `phase-output.json`
- Updated `api-map.json`
- This documentation file

---

## Final Statement

> Phase D guarantees that **infra-drivers either build real drivers or fail loudly
> and predictably** — nothing in between.

---

**Next Phase:**  
Phase E — Testing Guarantees & Determinism Policy
