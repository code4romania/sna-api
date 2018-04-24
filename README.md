# Strategia Națională Anticorupție: Data Visualization - API 

[![GitHub contributors](https://img.shields.io/github/contributors/code4romania/sna-api.svg?style=for-the-badge)]() [![GitHub last commit](https://img.shields.io/github/last-commit/code4romania/sna-api.svg?style=for-the-badge)]() [![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg?style=for-the-badge)](https://opensource.org/licenses/MIT)

This portal makes the implementation of the 2016-2020 National Anticorruption Strategy more transparent for everybody involved, from citizens to stakeholders. The information and data sets (corruption indicators, integrity warnings, ethics counselling) developed through this new strategy will be accessible to everyone in an easily parseable and explainable format. As the new anticorruption strategy emphasises education and prevention, citizen involvement in fighting corruption starts with this portal.

[Built with](#built-with) | [Repos and projects](#repos-and-projects) | [Deployment](#deployment) | [Contributing](#contributing) | [Feedback](#feedback) | [License](#license) | [About Code4Ro](#about-code4ro)

## Built With

### Programming languages

php

### Platforms

Laravel 5.4

### Package managers

Composer

### Database technology & provider

MySQL

## Repos and projects

https://github.com/code4romania/sna-api

related to https://github.com/code4romania/sna-client

## Deployment

### Installation process

   - install `composer` with your package manager or from https://getcomposer.org/download/
   - open a terminal and go to the project; once there, run:
       ```
       composer install
       ```
   - create an `.env` file with:
       ```
       cp .env.example .env
       ```
   - generate a jwt secret with:
       ```
       php artisan jwt:generate --show
       ```
   - put the secret in the `.env` file as variable `JWT_SECRET`
   - run database migrations:
       ```
       php artisan migrate
       ```
   - seed the database with the needed data:
       ```
       php artisan db:seed
       ```
   - configure the server to run the app

### Software dependencies

   Listed in the `composer.json` file of the project.

## Contributing

If you would like to contribute to one of our repositories, first identify the scale of what you would like to contribute. If it is small (grammar/spelling or a bug fix) feel free to start working on a fix. If you are submitting a feature or substantial code contribution, please discuss it with the team and ensure it follows the product roadmap. 

* Fork it (https://github.com/code4romania/sna-api/fork)
* Create your feature branch (git checkout -b feature/fooBar)
* Commit your changes (git commit -am 'Add some fooBar')
* Push to the branch (git push origin feature/fooBar)
* Create a new Pull Request

## Feedback

* Request a new feature on GitHub.
* Vote for popular feature requests.
* File a bug in GitHub Issues.
* Email us with other feedback contact@code4.ro

## License

This project is licensed under the MPL 2.0 License - see the [LICENSE](LICENSE) file for details

## About Code4Ro

Started in 2016, Code for Romania is a civic tech NGO, official member of the Code for All network. We have a community of over 500 volunteers (developers, ux/ui, communications, data scientists, graphic designers, devops, it security and more) who work pro-bono for developing digital solutions to solve social problems. #techforsocialgood. If you want to learn more details about our projects [visit our site](https://www.code4.ro/en/) or if you want to talk to one of our staff members, please e-mail us at contact@code4.ro.

Last, but not least, we rely on donations to ensure the infrastructure, logistics and management of our community that is widely spread accross 11 timezones, coding for social change to make Romania and the world a better place. If you want to support us, [you can do it here](https://code4.ro/en/donate/).
