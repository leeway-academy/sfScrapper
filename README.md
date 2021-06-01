# sfScrapper
A simple web scrapper created using Symfony components.
This project is a proof of concept for the comparisson of Symfony and Laravel frameworks.
It will crawl the first page of [this site](http://www.guiadelaindustria.com.py/search?query=metalurgica&ciudad=asuncion&empresa_tiene%5B%5D=email&empresa_tiene%5B%5D=url) and output a list of emails found.

# Installation

In order to install the application you need to have [composer](https://getcomposer.org/) installed.
Once that's ready simply run ```composer install``` inside the project directory.

# Running

In order to run the application you'll need a php interpreter (7.4.3 or above is recommended).

You can run the the command using ```php get_emails.php``` to get the list of emails on screen.

If you want a more detailed view of what's going on you can use ```-v```, like this: ```php get_emails.php -v```.

Finally if you want to store the results in a text file you can use ```php get_emails.php > output.txt```
