# SimpleCTF
A simple platform based on php to host you CTF.

# Setup
1. Move the files in htdoc to the root of your server (which supports php).
2. Change the variables in file named env_var.php according to need.
3. Import the database.sql file onto your sql server.
4. Create a user with `USER_ID` = 0 for the admin user.
5. Each challenge should consist of a `index.php` (for challenge description) and `hints.php` (for challenge hints) in a folder named as the challenge name. This folder should be placed in the `$challenge_base_path` folder.
6. To activate a challenge login as the admin user and go to `admin.php`. Here create the challenge.
7. Later use the `admin.php` for other admin related tasks.

# Contributors
- [Pranav-Bhaskar](https://github.com/Pranav-Bhaskar/)

# Note
There are a lot of bugs and vulnerabilities in this project. Creation of issues and pull requests would be appriciated. While making a pull request make sure to add your name to the list of countributors in the readme.
