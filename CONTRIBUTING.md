# Contributing to maatify/infra-drivers

Thank you for considering contributing.

This project follows **strict architectural and governance rules**.
Contributions that violate these rules will not be accepted.

---

## Contribution Rules

Before submitting a contribution, ensure that:

- The change aligns with the locked design principles
- No environment access is introduced
- No adapters or DI containers are referenced
- No runtime magic or auto-detection is added
- Code is deterministic and strictly typed

---

## Pull Requests

- Fork the repository
- Create a feature or fix branch
- Keep changes minimal and focused
- Ensure all tests pass
- Ensure static analysis passes at maximum level

---

## What is NOT acceptable

- Feature creep outside the roadmap
- Implicit behavior or hidden defaults
- Introducing dependencies without approval
- Expanding scope beyond infrastructure construction

Architecture stability takes precedence over convenience.
