# GreatDeadlockBugfix

Fixes the critical **session/cache file lock deadlock** in Shopware 6.7.

## The Problem

Shopware 6.7 has a deadlock issue with file-based sessions:

```
Error: "error-page-..." is locked, waiting for it to be released
```

## The Fix

This plugin disables Symfony's `LockRegistry` which causes the deadlock:

```php
LockRegistry::setFiles([]);
```

## Installation

```bash
bin/console plugin:refresh
bin/console plugin:install --activate GreatDeadlockBugfix
bin/console cache:clear
```

## Links

- [GitHub Issue #12823](https://github.com/shopware/shopware/issues/12823)
