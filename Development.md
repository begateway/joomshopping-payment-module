# Install Joomla

Use `docker-compose` to run the Joomla CMS. Set the `joomla` argument value in `docker-compose.yml` to select the Joomla version. Refer to https://hub.docker.com/_/joomla for version tags.

Run

```
docker-compose build
docker-compose up
```

to up Joompla's containers.

Open http://0.0.0.0 in a browser to install Joomla. Use environment variables from the `db` container for database parameters.

## Enable debug mode

Open http://0.0.0.0/administrator/index.php?option=com_config and select the System tab. Enable the Debug System option to see your code errors.

# Install Joomshopping

Download a Joomshopping package from https://www.webdesigner-profi.de/joomla-webdesign/joomla-shop/downloads

Open http://0.0.0.0/administrator/index.php in a browser to login as an administrator.  Visit the link http://0.0.0.0/administrator/index.php?option=com_installer&view=install to install the Joomshopping extension.

Use the Upload Package file tab to upload previously downloaded Joomshopping's package and install the Joomshopping extension.

## Add menu link

Open http://0.0.0.0/administrator/index.php?option=com_menus&view=items&menutype= in a browser and create a menu item selecting the component Joomshopping -> Products list

## Populate shop data

1. Create a test category visiting the link http://0.0.0.0/administrator/index.php?option=com_jshopping&controller=categories&catid=0
2. Create a test product visting the link http://0.0.0.0/administrator/index.php?option=com_jshopping&controller=products&category_id=0

# Install payment plugin

Open http://0.0.0.0/administrator/index.php?option=com_jshopping&controller=update to install the payment plugin. Go to Install from Folder, type the path /plg_begateway and click Install & Update.

Login to the running `joomla` container by

```
docker-compose exec joomla bash
```

Execute the shell command to create a symlink to mounted plugin volume

```
rm -rf /var/www/html/components/com_jshopping/payments/pm_begateway
ln -fs /plg_begateway/components/com_jshopping/payments/pm_begateway /var/www/html/components/com_jshopping/payments/
```

# Configure payment plugin

Open the link http://0.0.0.0/administrator/index.php?option=com_jshopping&controller=payments in a browser.

Edit and enable the payment method with the `begateway` code.

# Translation

Install a language pack using the menu System -> Languages. 

If the JoomShopping menu items in the admin panel hasn't been translated after that, then copy the language ini-file manually e.g.

```
cp administrator/components/com_jshopping/language/ru-RU.com_jshopping.sys.ini administrator/language/ru-RU/
```
