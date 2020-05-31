# Backdrop CMS Project Starter

I use this starter template to get my Backdrop CMS projects spun up the way I like
them as quickly as possible.

## Dependencies

You'll need [lando](https://github.com/lando/lando) to make use of this repo.

## Inventory

* `.example.env`
  * template w/ vars for deploys and pulls
* `lando.yml`
  * `drush` set up
  * `deploy` set up
  * `pull` set up
  * `web` root

## Use the Backdrop Starter State

After cloning down this repo:

Move the example env file and fill out the vars to work with your stagint/production
server(s)
```
mv .example.env .env
```

Open and edit `.lando.yml` and replace all appearances of `NEW_PROJECT` with your project name.

For example in `vim` this would replace `NEW_PROJECT` with `gff`.

```
:%s/NEW_PROJECT/gff/g
```


Start up the project:

```
lando start
```

Get Backdrop:

```
lando drush dlb backdrop --path=web
```

Edit `web/settings.php` to point to the `$config_directories` to the config outside backdrop root.

```php
$config_directories['active'] = '../config/active';
$config_directories['staging'] = '../config/staging';
```

Copy `settings.local.php` into the `web` root:

```
cp settings.local.php web/
```

Install Backdrop:

```
lando drush si --db-url=mysql://backdrop:backdrop@database/backdrop
```

Subtheme basis:

```
lando drush sb
```

At this point you have an opinionated Backdrop set up.

