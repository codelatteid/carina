<p align="center"><img src="https://assets.codelatte.net/20200405033953-carina-n.png" width="100%"></p>

<center>
    
![PHP Composer](https://github.com/c0delatte/carina/workflows/PHP%20Composer/badge.svg)
![PHP Version](https://img.shields.io/badge/php-%5E%207.1.3-red)
![Github Stars](https://img.shields.io/github/stars/c0delatte/carina.svg)
![Contributors Welcome](https://img.shields.io/badge/contributions-welcome-brightgreen.svg?style=flat)
![Open Source](https://badges.frapsoft.com/os/v2/open-source.svg?v=103)
</center>

## About Carina

**Carina** is a web application used to store webshell, Virtual Private Server (VPS) and cPanel data. **Carina** is made so that we don't need to store webshell, VPS or cPanel data in "strange places".

## Install Carina
1. ```$ git clone https://github.com/c0delatte/carina && cd carina```
2. Run ```composer update```.
3. Edit ```.env.example``` with your database configuration.
4. Rename ```.env.example``` to ```.env```.
5. Run ```php artisan key:generate``` to generate application key.
5. Run ```php artisan migrate``` for generate required tables.
6. Run ```php artisan serve```.

## Contact

If you discover something stupid within Carina, please send an e-mail to us via [abay@codelatte.org](mailto:abay@codelatte.org).
