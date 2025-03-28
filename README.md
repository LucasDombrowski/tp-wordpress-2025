# Bedrock with DDEV

This README provides instructions to set up and run a Bedrock-based WordPress project using DDEV.

## Prerequisites

Ensure you have the following installed:
- [DDEV](https://ddev.readthedocs.io/en/stable/#installation)
- Docker

## Getting Started

### 1. Clone the Repository
```bash
git clone <repository-url>
cd tp-wordpress-2025
```

### 2. Start DDEV
Start the DDEV environment:
```bash
ddev start
```

### 3. Install Dependencies
Install PHP dependencies using Composer:
```bash
ddev composer install
```

### 4. Set Up Environment
Copy the example `.env` file and update it as needed:
```bash
cp .env.example .env
```

### 5. Import Database (Optional)
If you have an existing database dump, import it:
```bash
ddev import-db --src=path/to/your-database.sql
```

### 6. Access the Site
Visit your site at [https://tp-wordpress-2025.ddev.site](https://tp-wordpress-2025.ddev.site).

## Additional Commands

- **Stop DDEV**: `ddev stop`
- **Restart DDEV**: `ddev restart`
- **Access DDEV SSH**: `ddev ssh`

## Troubleshooting

If you encounter issues, refer to the [DDEV documentation](https://ddev.readthedocs.io/en/stable/) or check the logs:
```bash
ddev logs
```

## License

This project is licensed under the [MIT License](LICENSE).
