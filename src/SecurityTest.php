<?php
declare(strict_types=1);

namespace PayseraTest\Bundle\SecurityTestBundle;

/**
 * PUBLIC MALICIOUS VERSION - Security Testing Class
 *
 * ⚠️  WARNING: This is a TEST package for security research (EH-73)
 * ⚠️  If you see this class loaded in production, you have a CRITICAL security issue!
 *
 * This package demonstrates a dependency confusion attack where a public package
 * with the same name as a private package is installed instead of the legitimate one.
 *
 * @package PayseraTest\Bundle\SecurityTestBundle
 * @purpose Security Testing (EH-73) - Dependency Confusion Attack PoC
 */
class SecurityTest
{
    private string $indicatorFile = '/tmp/DEPENDENCY_CONFUSION_DETECTED.txt';

    public function __construct()
    {
        // Safe indicator of compromise - write to temporary file
        // In a real attack, this could execute malicious code
        $this->createCompromiseIndicator();
    }

    /**
     * Returns the source of the package
     *
     * Returns: PUBLIC_PACKAGIST_MALICIOUS
     * This indicates a dependency confusion attack succeeded!
     */
    public function getSource(): string
    {
        return 'PUBLIC_PACKAGIST_MALICIOUS';
    }

    /**
     * Returns the version of the package
     */
    public function getVersion(): string
    {
        return '1.0.1';
    }

    /**
     * Returns package metadata
     */
    public function getMetadata(): array
    {
        return [
            'source' => $this->getSource(),
            'version' => $this->getVersion(),
            'type' => 'PUBLIC_MALICIOUS',
            'repository' => 'packagist.org',
            'ticket' => 'EH-73',
            'secure' => false,
            'warning' => 'DEPENDENCY CONFUSION ATTACK DETECTED!',
        ];
    }

    /**
     * Verify package authenticity
     */
    public function isAuthentic(): bool
    {
        return false; // This is NOT the authentic private package
    }

    /**
     * Get security status message
     */
    public function getSecurityStatus(): string
    {
        return '⚠️  CRITICAL VULNERABILITY: Malicious public package loaded instead of private!';
    }

    /**
     * Create safe compromise indicator
     * In real attack, this could be malicious payload
     */
    private function createCompromiseIndicator(): void
    {
        $timestamp = date('Y-m-d H:i:s');
        $message = "[{$timestamp}] DEPENDENCY CONFUSION ATTACK DETECTED\n";
        $message .= "Package: paysera-test/lib-security-confusion-poc\n";
        $message .= "Source: PUBLIC_PACKAGIST_MALICIOUS\n";
        $message .= "Version: 1.0.1\n";
        $message .= "Ticket: EH-73\n";
        $message .= "Severity: CRITICAL\n";
        $message .= "Action: This indicates incorrect composer.json repository ordering\n";
        $message .= "---\n";

        // Safe file write to indicate compromise
        file_put_contents(
            $this->indicatorFile,
            $message,
            FILE_APPEND | LOCK_EX
        );

        // Log to error_log as well
        error_log("SECURITY: Dependency Confusion Attack Detected - EH-73");
    }

    /**
     * Simulate what a real attacker could do
     * (This is SAFE for testing purposes)
     */
    public function demonstrateAttackCapabilities(): array
    {
        return [
            'file_write' => 'SUCCESS - Created indicator file at ' . $this->indicatorFile,
            'environment_access' => 'POSSIBLE - Could access $_ENV, $_SERVER',
            'code_execution' => 'POSSIBLE - Could execute arbitrary PHP code',
            'data_exfiltration' => 'POSSIBLE - Could send data to external servers',
            'backdoor' => 'POSSIBLE - Could create persistent backdoors',
            'supply_chain' => 'POSSIBLE - Could compromise entire supply chain',
        ];
    }
}
