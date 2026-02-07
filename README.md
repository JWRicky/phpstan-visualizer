# PhpStan Visualizer

A beautiful, Xcode-style visualizer for PHPStan reports in Laravel.  
Developed by **JWRicky**.

---

## Prerequisites

This package requires **PHPStan** (or **Larastan**) to be installed and configured in your Laravel project.

If you haven't installed it yet, please run:

```bash
composer require --dev larastan/larastan
```

## Features

*   **Xcode-style UI**: Clean and intuitive error reporting inspired by modern IDEs.
*   **Deep Linking**: Open files directly in VSCode or other supported editors directly from your browser.
*   **Easy Integration**: Specifically designed for seamless use within Laravel projects.

Appearance Customization
<table width="100%">
  <tr>
    <td width="50%" align="center">
      <img src="https://github.com/user-attachments/assets/cff3aa9f-b100-4ee0-a363-162a28bb3b81" alt="display" style="max-width:100%;">
      <br><strong>Black</strong>
    </td>
    <td width="50%" align="center">
      <img src="https://github.com/user-attachments/assets/0112ed52-bfda-4ef2-97a2-393231f53dd5" alt="display" style="max-width:100%;">
      <br><strong>White</strong>
    </td>
  </tr>
</table>


## Installation

You can install the package via Composer:

```bash
composer require jwricky/phpstan-visualizer:^1.0
```

> **Note:** If you haven't registered this on Packagist yet, ensure you have the repository URL in your project's `composer.json`.

## Setup

After installation, complete the following steps to enable the visualizer:

### 1. Register Service Provider
If you are using Laravel 11+ or have auto-discovery disabled, add the provider to `config/app.php` (for Laravel 10) or `bootstrap/providers.php` (for Laravel 11):

```php
JWRicky\PhpStanVisualizer\PhpStanVisualizerServiceProvider::class,
```

### 2. Publish Configuration
Publish the configuration file to customize the editor links or file paths:

```bash
php artisan vendor:publish --tag=phpstan-visualizer-config
```

### 3. Generate PHPStan Report
This package visualizes a `report.json` file. Ensure you generate it using the JSON format:

```bash
phpstan analyse --error-format=json > storage/app/phpstan/report.json
```

**Tip:** Add this to your `composer.json scripts for convenience:

```json
"scripts": {
    "phpstan:json": "phpstan analyse --error-format=json > storage/app/phpstan/report.json || true"
}
```

### 4. Access the Dashboard
Once the report is generated, visit the following URL in your browser:

`http://your-app.test/phpstan`

---

## License

The MIT License (MIT). Please see the License File for more information.

Maintained by **JWRicky**.

You are free to use, copy, modify, and distribute this software for personal or commercial purposes.
