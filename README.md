# Backdrop CMS Project Starter

I use this starter template to get my Backdrop CMS projects spun up the way I like
them as quickly as possible.

* `.example.env`
  * template w/ vars for deploys and pulls
* `lando.yml`
  * `drush` set up
  * `deploy` set up
  * `pull` set up
  * `web` root

After cloning down this repo:

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

Install Backdrop:

```
lando drush si --db-url=mysql://backdrop:backdrop@database/backdrop
```

Subtheme basis:

```
lando drush sb
```

Copy `settings.local.php` into the `web` root:

```
cp settings.local.php web/
```

At this point you have an opinionated Backdrop set up.

