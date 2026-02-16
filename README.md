# ⚠️  SECURITY RESEARCH PACKAGE - DO NOT USE ⚠️

## CRITICAL WARNING

This package is created **solely for testing dependency confusion vulnerabilities** in private package repositories.

**DO NOT USE THIS PACKAGE IN PRODUCTION SYSTEMS!**

## Purpose

This package is part of internal Paysera security testing (Ticket: **EH-73**) to demonstrate how dependency confusion attacks work and to verify the security of Composer repository configurations.

## What is Dependency Confusion?

Dependency confusion is a supply chain attack where an attacker publishes a malicious package with the same name as a private internal package. If the package manager is misconfigured, it may install the public malicious package instead of the legitimate private one.

## This Package Demonstrates

1. **Package Name Collision:** Same name as private package `paysera-test/lib-security-confusion-poc`
2. **Higher Version:** v1.0.1 (higher than private v1.0.0)
3. **Malicious Indicators:** Safe indicators to prove the attack worked
4. **Attack Simulation:** Shows what a real attacker could do

## Package Details

- **Name:** `paysera-test/lib-security-confusion-poc`
- **Version:** `1.0.1` (PUBLIC MALICIOUS)
- **Source Indicator:** `PUBLIC_PACKAGIST_MALICIOUS`
- **Repository:** `packagist.org`
- **Danger Level:** DEMONSTRATION ONLY (safe payload)

## Safe Payload

This package includes a **safe testing payload** that:
- ✅ Creates indicator file at `/tmp/DEPENDENCY_CONFUSION_DETECTED.txt`
- ✅ Logs to error_log
- ✅ Provides methods to verify package source
- ❌ Does NOT contain actual malicious code
- ❌ Does NOT exfiltrate data
- ❌ Does NOT create backdoors

## Usage (Testing Only)

```php
<?php
use PayseraTest\Bundle\SecurityTestBundle\SecurityTest;

$test = new SecurityTest();
echo $test->getSource();    // Outputs: PUBLIC_PACKAGIST_MALICIOUS
echo $test->getVersion();   // Outputs: 1.0.1
echo $test->getSecurityStatus(); // Shows vulnerability warning
```

## Indicators of Compromise

If this package is installed:

1. **File Created:** `/tmp/DEPENDENCY_CONFUSION_DETECTED.txt`
2. **Source Check:** `$test->getSource()` returns `PUBLIC_PACKAGIST_MALICIOUS`
3. **Version Mismatch:** v1.0.1 instead of expected v1.0.0
4. **Authenticity Check:** `$test->isAuthentic()` returns `false`

## Real Attack Scenario

In a real dependency confusion attack, this package could:

❌ Execute arbitrary code during `composer install`
❌ Steal environment variables and secrets
❌ Create backdoors in the application
❌ Exfiltrate source code or data
❌ Compromise the entire supply chain

## How to Protect Against This Attack

1. **Correct Repository Order** in `composer.json`:
   ```json
   {
     "repositories": [
       {
         "type": "composer",
         "url": "https://private-repo-repman.paysera.net"
       },
       {
         "type": "composer",
         "url": "https://repo-repman.paysera.net"
       },
       {
         "packagist": false
       }
     ]
   }
   ```

2. **Private Repository MUST be listed FIRST**

3. **Verify Package Sources** in `composer.lock`

4. **Monitor for Unexpected Packages**

## Publication Instructions (For Testing)

### 1. Create GitHub Repository

```bash
# Create public repository on GitHub
# Repository name: lib-security-confusion-poc-public
```

### 2. Initialize and Push

```bash
cd /Users/oleksiibaranov/paysera/security-research/EH-73-dependency-confusion-poc/test-packages/public-package

git init
git add .
git commit -m "Security research package for EH-73 - DO NOT USE"
git remote add origin git@github.com:YOUR_USERNAME/lib-security-confusion-poc-public.git
git branch -M main
git push -u origin main
```

### 3. Publish to Packagist.org

1. Go to https://packagist.org
2. Login or create account
3. Submit repository URL
4. Wait for indexing (~5-10 minutes)

### 4. Verify Publication

```bash
curl https://packagist.org/packages/paysera-test/lib-security-confusion-poc.json
```

## Cleanup Instructions

**IMPORTANT:** After testing is complete:

1. Mark package as **Abandoned** on packagist.org
2. Delete GitHub repository
3. Update package description with "DEPRECATED - Testing Complete"
4. Ensure no systems are still using this package

## Responsible Disclosure

This is an **authorized security test** by Paysera internal security team.

- **Ticket:** EH-73
- **Purpose:** Internal security testing
- **Scope:** Controlled environment only
- **Contact:** security@paysera.com

## Legal Notice

This package is provided for **authorized security testing purposes only**. Unauthorized use, distribution, or modification may violate security policies and applicable laws.

**USE AT YOUR OWN RISK**

## Contact

For questions or concerns about this security research:
**Email:** security@paysera.com
**Ticket:** EH-73
