# DDD and Clean Architecture example on Symfony

## Description

This project is an example of how to implement Domain-Driven Design and Clean Architecture in a Symfony application.
*Project made for educational purposes*.

Project separated into 3 modules:

- **module/Client**: Module responsible for managing clients.
- **module/Notification**: Module responsible for managing notifications.
- **module/Product**: Module responsible for managing products.

## Installation

1. **Set up environment variables:**
    ```sh
   make env
    ```

2. **Build and start Docker containers:**
    ```sh
    make build
    ```

3. **Install dependencies:**
    ```sh
    make install
    ```

4. **Run database migrations:**
    ```sh
    make db-migrate
    ```

## Usage

### You can find request examples in the `requests.http` file.
