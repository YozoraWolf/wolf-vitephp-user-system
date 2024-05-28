




[EN](README.md) | [JP](README_JP.md)

# PHP User Signup/Login System (WIP)

This is a simple user signup/login system implemented in PHP and MySQL. It is mostly a practice project to me.

## Considerations

- Make sure you have MySQL server installed. Backend will try to connect to it when starting.
- Confirm you have `composer` installed.
- Make a simple .env file with your own DB vars as follows:

```
DB_HOST=localhost
DB_NAME=usersys
DB_TABLE=users
DB_USER=root
DB_PASS=dbpwdhere # (if any)
```

## Features

- User registration with email and password
- User login with email and password
- Password hashing for secure storage
- MySQL database integration

## Installation

1. Clone the repository: `git clone https://github.com/YozoraWolf/wolf-vitephp-user-system`
2. Run `composer install`
3. Run `npm run dev`

## Usage

1. Open your web browser and navigate to `http://localhost:3005/pages/`
2. Register a new user account
3. Login with your credentials

## License

This project is licensed under the [MIT License](LICENSE).