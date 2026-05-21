# GreatDeadlockBugfix

Behebt den kritischen **Session/Cache File-Lock Deadlock** in Shopware 6.7.

## Das Problem

Shopware 6.7 hat ein Deadlock-Problem mit dateibasierten Sessions:

```
Fehler: "error-page-..." is locked, waiting for it to be released
```

## Die Lösung

Dieses Plugin deaktiviert Symfonys `LockRegistry`, die den Deadlock verursacht:

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
