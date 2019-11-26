# WIP: PHP Library Development Toolkit
This toolkit gathers some tools and scripts to save time while developping high quality php libraries by:

+ avoiding the need of local dev environment by using docker
+ making dependencies management and tests runnable in several PHP versions
+ downgrading your PHP7+ code to PHP5.6 automatically 
+ generating api reference in markdown
+ TODO automatically configure some CI tools
+ TODO adding git hooks
+ TODO automatic coding style check

### Overview
Run your tests
```
./phpunit
./php 7.1 phpunit
./php * phpunit # todo
./php 7.1 composer update
./php 5.6 phpunit # automatically generate PHP 5.6 code and apply tests on it
```


## Add this toolkit to your library
+ As development toolkit is a third party set of tools, it has to be installed as  a git submodule. This avoids adding out of scope constraints on composer dependencies.
```
git submodule add https://github.com/jclaveau/php-library-development-toolkit
```

+ Make the tools available in your library directory
```
./php-library-development-toolkit/install
```
*NB: You can install your submodule where you want in your project*

+ Patch composer.json and create the autoloader (TODO move it to the install script)

+ Add a link to the Usage section bellow in the README of your library like in this [example](lib_README_example.md)

## Usage

If your shell tells you the file is missing (because the directory of the submodule is empty) you must download the tools first
```
git submodule update --init --recursive
```

### Working with multiple versions of PHP
Using the ./php instead of the php command installed on your system provides an optionnal first argument to choose the version you want. It then run it in a docker container providing all the php extensions required for the wanted php version.
```
./php 5.6 my_file.php
./php 7.1 my_file.php
```
#### Dependencies
Dependencies will change depending on the PHP version you use so the ./composer wrapper will set a specific ./vendor directory and a composer.lock for each.
```
./php 5.6 composer update
./php 7.1 composer update
```

 


