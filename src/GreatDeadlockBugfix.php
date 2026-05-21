<?php declare(strict_types=1);

namespace Great\DeadlockBugfix;

use Shopware\Core\Framework\Plugin;
use Symfony\Component\Cache\LockRegistry;

/**
 * GreatDeadlockBugfix
 * 
 * Fixes the ABBA deadlock in Shopware 6.7 between:
 * - PHP session file locks (flock on /tmp/sess_*)
 * - Symfony Cache LockRegistry (flock on vendor/symfony/cache/Adapter/*.php)
 * 
 * Error message: "error-page-..." is locked, waiting for it to be released
 * 
 * @see https://github.com/shopware/shopware/issues/12823
 */
class GreatDeadlockBugfix extends Plugin
{
    /**
     * Boot the plugin - disable LockRegistry as early as possible
     */
    public function boot(): void
    {
        parent::boot();
        
        // Disable Symfony's Cache LockRegistry to prevent deadlocks
        if (class_exists(LockRegistry::class)) {
            LockRegistry::setFiles([]);
        }
    }
}
