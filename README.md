# RescueFood

![Project Screenshot](screenshot.png)

RescueFood is a web application designed to facilitate the recovery and redistribution of surplus food from restaurants and retailers to charitable organizations. This project uses a robust stack for both frontend and backend functionality, providing a streamlined interface for managing food recovery and donation events.

## Table of Contents

- [Technologies Used](#technologies-used)
- [Installation](#installation)
- [Contributors](#contributors)
- [Project Features](#project-features)
- [Contact](#contact)

## Technologies Used

- **Backend:** Laravel (PHP Framework)
- **Database:** MySQL
- **Frontend:** Blade templates integrated with Laravel

## Installation

1. **Navigate to the Project Directory and Install Dependencies:**

    ```bash
    cd Food-Rescue-Project
    composer install
    npm install
    ```

2. **Setup Environment Variables:**

    Create a `.env` file by copying the example provided:

    ```bash
    cp .env.example .env
    ```

3. **Generate Application Key:**

    ```bash
    php artisan key:generate
    ```

4. **Run Database Migrations:**

    ```bash
    php artisan migrate
    ```

5. **Start the Development Server:**

    ```bash
    php artisan serve
    ```

## Contributors

The following individuals contributed to the development of RescueFood:

- Mohamed Wassim Ennar
- Nidhal Ennar
- Said Atoui
- Ahmed Gamgami
- Chaima Idoudi

## Project Features

- **Food Recovery Management:** Schedule and manage food recovery events.
- **Organization Coordination:** Facilitate communication and coordination between food providers and charities.
- **Data Security:** Protect sensitive data related to donations and user information.

## Contact

For further details or contributions, please feel free to contact the contributors through the GitHub repository.
