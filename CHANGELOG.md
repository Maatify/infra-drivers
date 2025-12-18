# Changelog

All notable changes to this project will be documented in this file.

This project follows:
- [Keep a Changelog](https://keepachangelog.com/en/1.1.0/)
- [Semantic Versioning](https://semver.org/)

---

## [1.0.0] — Initial Stable Release

### Added

#### Core Infrastructure
- Infrastructure driver builders for:
  - MySQL (PDO)
  - MySQL (Doctrine DBAL)
  - Redis (ext-redis)
  - Redis (Predis)
  - MongoDB
- Explicit, typed, readonly configuration DTOs for all drivers.
- Deterministic validation with typed infrastructure exceptions.
- Strict separation between:
  - Configuration
  - Driver construction
  - Adapters and application logic

#### Dependency & Policy
- Zero implicit or hidden dependencies.
- Strict opt-in dependency model using Composer `suggest`.
- Explicit dependency matrix per driver builder.
- Deterministic failure behavior for missing extensions or libraries.

#### Documentation
- Complete user-facing `README.md` with:
  - Clear scope and non-goals
  - Architectural positioning
  - Quick Start example
  - Usage examples linkage
- Standalone executable usage examples for all supported drivers:
  - MySQL (PDO, DBAL)
  - Redis (ext-redis, Predis)
  - MongoDB
- Governance and policy documentation:
  - `SECURITY.md`
  - `CONTRIBUTING.md`
  - `CODE_OF_CONDUCT.md`

#### Tooling & Quality
- PHP ≥ 8.4 support.
- Strict PSR-4 autoloading for `Maatify\InfraDrivers`.
- Development tooling:
  - PHPUnit 11
  - PHPStan (level max)
  - PHP CS Fixer
- CI pipeline with static analysis and test execution.

### Notes
- This release establishes the **stable public foundation** of the library.
- Architecture, scope, and dependency policy are **LOCKED**.
- No environment loading, DI containers, runtime detection, or fallback logic exist by design.
- Future releases will focus on:
  - Coverage hardening
  - Minor enhancements
  - Strictly backward-compatible improvements.

---

## Versioning Policy

- Public API additions → **minor version**
- Public API changes/removals → **major version**
- Internal improvements, tooling, or documentation → **patch version**
