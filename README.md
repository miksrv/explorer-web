Automatic weather station
===============
This project is an implementation of a Web-based interface for automatic weather station, made of improvised programs included with the Arduino. This program is intended only for training, it can not be used for weather forecasting and later use as an official source of information on meteorological reports.

To use this web interface, you must have a web server such as Apache and PHP version with the support of not less than 5 and MySqL data base.

[DEMO PAGE](http://miksrv.ru/meteo)

----------------------

### Installation

Create a new database, for example through phpMyAdmin and import the file to database.sql. In directory '/php.inc/config/' rename files 'sample.arduino.php' to 'arduino.php' and 'sample.mysql.php' to 'mysql.php'

Configuring the connection to the database, change the file '/php.inc/config/mysql.php':

```php
    $config['hostname'] = 'localhost';
    $config['username'] = 'root';
    $config['password'] = '';
    $config['database'] = 'meteo';
    $config['prefix']   = '';
```

The next step is to edit '/php.inc/config/arduino.php':

```php
    $config['latitude']   = '34.11';
    $config['longitude']  = '36.23';
    $config['gmt_offset'] = '1';
    $config['secret']     = '';
```

Enter the geographical coordinates of the location of the weather station and the time relative to the equator, to accurately calculate the time of sunrise and sunset of the Sun and the Moon.

Set the secret key, which must be identical key by Arduino sketch. This is to ensure that no one else could replace data. Keep your secret key.

When you install the program are not in the root directory of a site, you should change the .htaccess file, replacing the string:

```Apache
RewriteBase /
```
On this:
```Apache
RewriteBase /CATALOG_NAME/
```

----------------------

### Usage

Your weather station on the Arduino to transmit a GET request to the address '/insert', containing a ready-made set of data. Example:

> http://example.com/insert?ID=SECRET_KEY&temp1=25.6&temp2=21.6&battery=5.9&humd=44.2&press=775.0&light=260&wind=1.73

GET request contains the following parameters:
- "**temp1**" (*float*) the value of the first temperature sensor
- "**temp2**" (*float*) the value of the second temperature sensor
- "**humd**" (*float*) appointment hygrometer (humidity sensor)
- "**press**" (*float*) the value of the barometer (mm Hg)
- "**wind**" (*float*) appointment of an anemometer (wind speed sensor)
- "**light**" (*integer*) appointment luxmeter (light sensor)
- "**battery**" (*float*) voltage weather station batteries

The functionality of this project will be expanded.

----------------------

### Author
* WebSite: http://miksrv.ru
* Facebook: http://facebook.com/miksrv.ru
* Instagram: http://instagram.com/greenexp.ru/

----------------------

### Components used

The following components and classes were used in the development of applications:

* [Weather Icons] [WeatherIcons] - Erik Flowers
* [Font Awesome] [FontAwesome] - created and maintained by Dave Gandy
* [Moon phase calculation class] [MoonPhase] by Samir Shah
* Calculates the moon rise/set by [Keith Burnett] [KeithBurnett] and [Matt Hackmann] [MattHackmann]

   [WeatherIcons]: <http://erikflowers.github.io/weather-icons>
   [FontAwesome]: <https://github.com/FortAwesome/Font-Awesome>
   [MoonPhase]: <http://rayofsolaris.net>
   [KeithBurnett]: <http://bodmas.org>
   [MattHackmann]: <http://dxprog.com>