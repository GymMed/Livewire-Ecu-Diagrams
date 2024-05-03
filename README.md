<h1 align="center">
    ECUs filtering system with charts
</h1>
<br/>
<div align="center">
  <!-- <img src="https://img.shields.io/badge/⚙%20Routers%20count-%2048%20Best%20Practices-blue.svg" alt="48 items"/>  -->
  <img id="last-update-badge" src="https://img.shields.io/badge/%F0%9F%93%85%20Last%20update%20-%20May%203%2C%202024-green.svg" alt="Last update: May 3, 2024" /> 
  <img src="https://img.shields.io/badge/ %E2%9C%94%20Updated%20For%20Version%20-%20Laravel%2011.5.0-brightgreen.svg" alt="Updated for laravel 11.5.0"/>
</div>

<div align="center">
  <img src="./preview/gifs/gif.gif" alt="Ecu diagrams page"/>
    <a href="./preview">More Project Views</a>
</div>

## Welcome!

### Prerequisites

-   [Laravel (v11.5.0 or later)](https://laravel.com/docs/11.x/upgrade#updating-dependencies)
-   [MySQL (v5.7 or later)](https://laravel.com/docs/11.x/database#introduction)
-   NPM or Yarn installed

# 1. How to launch this project

**[✔] 1.1 Add `.env` file**

-   Create a new file named `.env` in the project root directory.

-   To do it propertly copy this code and paste it to your newly created .env file(provided .env example document).

**[✔] 1.2 Install dependencies**

-   Run `composer install` in the root directory to install the required packages.
-   Run `npm install` in the root directory to install the required packages.

**[✔] 1.3 Migrate and seed database**

-   Run `php artisan migrate:fresh --seed` in the root directory to create tables and seed them with data from excel.

**[✔] 1.4 Launch the project**

-   Use `php artisan serve` to start backend on localhost.
-   Use `npm run dev` to watch style changes.
