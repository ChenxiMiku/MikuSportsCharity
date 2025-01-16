# Miku Sports Charity Platform

Miku Sports Charity Platform is a platform for raising donations and recruiting volunteers for sports-related charities. 

## Features

- **Donation**: Users can donate to the charity through the platform.
- **Volunteer Recruitment**: Users can sign up to be volunteers for the charity.
- **Event Management**: Admins can create, update, and delete events.

## Environment

- PHP 8.2.13
- MySQL 8.2.0

## Notice: We only provide the document use WampServer to run the project, if you want to use other server, please refer to the official documentation.

## Installation

1. git clone the repository to your WampServer's `www` directory:

    ```bash
    git clone https://github.com/ChenxiMiku/MikuSportsCharity.git
    ```

2. Import the database:

    - Create a new database called `mikusportscharity` in phpMyAdmin.
    - Import the `database.sql` file into the new database.

3. Project configuration:
   
    - Open the `app\config\config.php` file.
    - Update the project configuration according to your environment.

4. Config your ,htaccess file:

    - Open the `public\.htaccess` file.
    - Update the `RewriteBase` according to your project path. Be sure to include the `/public` directory in the path.

## Usage

1. Start the server:

    - Open WampServer and start the server.

2. Access the project:

    - Accroding to your configuration in the `.htaccess` file, access the project through the browser.
    - For example, if the `RewriteBase` is `/MikuSportsCharity/public`, you can access the project through `http://localhost/MikuSportsCharity/public`.

## Contributing

This project is created by Chenxi Miku, AkiyaKiko and two other team members. It is a project for the course "Dyanamic Web Development" in the University of Tasmania. 
If you have any suggestions or find any bugs, please feel free to open an issue or submit a pull request.

## License

It is not allowed to use this project for commercial purposes. All rights reserved by the project team.