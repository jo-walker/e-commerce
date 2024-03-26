# Database Migrations

This directory contains database migration files for the e-commerce application.

## What are Database Migrations?

Database migrations are a way to manage changes to the database schema over time. They allow you to version control your database schema and apply changes in a structured manner.

## How to Use Migrations

1. Make sure you have a database connection configured in your application.
2. Run the migration command to apply the migrations:
    ```
    $ php artisan migrate
    ```
    This command will execute any pending migrations and update the database schema accordingly.
3. If you need to rollback a migration, you can use the following command:
    ```
    $ php artisan migrate:rollback
    ```
    This will revert the last batch of migrations.

## Creating New Migrations

To create a new migration, you can use the following command: