# Adelaide IV 2019

Website for Adelaide IV 2019 built using Laravel 5.6.

## About this project

For a long time now, each IV festival has put out its own website and registration system.
That’s all well and good until you realise that a lot of the work gets reinvented year
after year (usually, Sydney used Brisbane’s sytem) and it doesn’t have to be this way.

This site uses PHP and PostgreSQL or MariaDB (which is quite similar to MySQL).

These choices and being open source hopefully make it easier to adopt and adapt for future festivals.

### Why PHP?
* It is available on any good web host (and just about every of crummy web host too)
* It is easy to learn
* There are a lot of resources available for it.
* It’s cheap.

Although PHP doesn’t have the best reputation, the above points are worth a lot. The site
is constructed with the Laravel framework and PHP 7.

## Installing

To install a new copy of the site:
1. Clone the repository.
2. Use Composer to populate the vendor directory.
3. Check permissions: storage and bootstrap/cache and their contents web writable.
4. Create a .env file with appropriate configuration and application key.
5. It’s worth checking the config folder for more options.
6. Migrate the database.
7. Direct the web server root to the public folder.

## Adelaide IV’s environment

* I develop using PostgreSQL but our production site uses MySQL.
* Emails are handled with the Mailgun driver, but you could choose another that Laravel supports.
* Credit and debit card payments are handled with Stripe.
* We use NearlyFreeSpeech.NET to host. They are rock solid hosts (and I mean neutron star rock solid)
and very good at what they do.