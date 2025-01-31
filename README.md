# Audit Logger

A Laravel package for real-time audit trails with replay functionality. Easily log model changes (create, update, delete), store attribute diffs, and optionally revert models to previous states.

## Features

- **Real-time auditing** of any Eloquent model
- **JSON-based diffs** for old vs. new values
- **Replayer service** to restore or "time travel" a model to a previous state
- **Configurable** via a published config file
- **Sensitive field redaction** (e.g., passwords, credit cards)

## Installation

Require this package via Composer:

```bash
composer require infinety/audit-logger
