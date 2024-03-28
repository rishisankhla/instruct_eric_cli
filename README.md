# PHP Command Line (CLI) Program for Querying Europe Research Centre Data

This project is built considering a merge request for a production system, maintaining production code standards like error handling, unit testing, class modularity, etc. Libraries such as PHPUnit and Symfony were utilized.

## Project Directory Structure:

```
instruct_eric_cli/
|-- src/
|   |-- Command/
|   |   |-- QueryServiceCommand.php
|   |-- Model/
|   |   |-- Service.php
|   |-- Service/
|       |-- ServiceCatalogue.php
|-- tests/
|   |-- Command/
|   |   |-- QueryServiceCommandTest.php
|   |-- Model/
|   |   |-- ServiceTest.php
|   |-- Service/
|       |-- ServiceCatalogueTest.php
|-- composer.json
|-- services.csv
|-- cli_app.php
```

## Development Environment

I've been using the VS Code terminal on Windows for running and building this PHP CLI program.

### Prerequisites

- **PHP**: Ensure PHP is installed on your system. You can download it from [https://www.php.net/downloads.php](https://www.php.net/downloads.php) or use a package manager like Chocolatey:

  ```bash
  choco install php
  ```

  Verify installation with:

  ```bash
  php -v
  ```

- **Composer**: Composer is a dependency manager for PHP. Download it from [http://getcomposer.org/download/](http://getcomposer.org/download/) or use Chocolatey:

  ```bash
  choco install composer
  ```

  Verify installation with:

  ```bash
  composer --version
  ```

## Installation

Run the following command to install all required dependencies specified in `composer.json`:

```bash
composer install
```

## Usage Examples

### Query 1:

Query 1 allows us to display all the services provided by a specific country. In the example below, we query services available in Germany by using the country code 'DE'.

```bash
php cli_app.php service:query DE
```

**Output:**

BMELAB1, Black Mesa, Interdimensional Travel, de
BMELAB2, Black Mesa Second Site, Interdimensional Travel, DE
Total services in DE: 2

### Query 2:

```bash
php cli_app.php service:query
```

**Output:**

Please provide a country code or use --summary option to display summary.

### Query 3:

Query 3 generates a summary, displaying the total number of services available in each country.

```bash
php cli_app.php service:query --summary
```

**Output:**

Total services in FR: 2
Total services in DE: 2
Total services in GB: 2
Total services in CZ: 1
Total services in IT: 1
Total services in PT: 1
## Running Tests

### To run all tests:

```bash
./vendor/bin/phpunit tests/
```

**Output:**

PHPUnit 11.0.9 by Sebastian Bergmann and contributors.

Runtime:       PHP 8.3.4

......                                                              6 / 6 (100%)

Time: 00:00.060, Memory: 8.00 MB

OK (6 tests, 20 assertions)

### Running Individual Test Cases:

```bash
./vendor/bin/phpunit tests/Model/ServiceTest.php 
./vendor/bin/phpunit tests/Service/ServiceCatalogueTest.php 
./vendor/bin/phpunit tests/Command/QueryServiceCommandTest.php
```
