<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Project description

As you know, an online store has several products, each product is part of a category, and each category in turn can require a product to have several specific attributes.
For example, we have the following category: Smartphones. The category at its turn requires the products with certain attributes:
- Smartphones: brand, model, screen resolution, battery type, screen type, etc.
Besides these categories, another important aspect to manage are the Products. Each product contains:
- Product code
- Product name
- The category it belongs to
- The values ​​for each attribute specific to the category to which it belongs
- Price in EUR (without VAT)

## Technologies
- PHP version 8.2 
- Composer
- Laravel 11
- MySQL (MariaDB)

## How to initialize the project
1. using GIT you will the the following command git clone https://github.com/cristinagroh/dynamic_attributes.git
2. create your .env file using the example from the project folder and the database
3. run php artisan migrate
4. run php artisan serve
5. for bringing the exchange rate you will run the following command: php artisan app:get-bnr-exchange-rate-command {CURRENCIES} // for example EUR,RON
