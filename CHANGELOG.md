# Changelog

All notable changes to this project will be documented in this file.

This project follows:
- [Keep a Changelog](https://keepachangelog.com/en/1.1.0/)
- [Semantic Versioning](https://semver.org/)

---

## [Unreleased]

### Added
- Project governance and architectural boundaries.
- Locked design principles for infrastructure driver construction.
- Initial repository structure and tooling configuration.

---

## [1.0.0] — Initial Release (Planned)

### Added
- `composer.json` with PHP ≥ 8.2 requirement.
- Strict PSR-4 autoloading for `Maatify\InfraDrivers`.
- Development tooling:
    - PHPUnit 11
    - PHPStan (level max)
    - PHP CS Fixer
- Governance and policy files:
    - `README.md`
    - `SECURITY.md`
    - `CONTRIBUTING.md`
    - `CODE_OF_CONDUCT.md`
- Architectural artifacts:
    - `api-map.json` (initialized, empty)
    - `phase-output.json` (Phase A record)

### Notes
- This release contains **no source code** by design.
- All architecture and scope decisions are **LOCKED**.
- Public APIs will be introduced in subsequent phases.

---

## Versioning Policy

- Public API additions → **minor version**
- Public API changes/removals → **major version**
- Internal or tooling changes → **patch version**
