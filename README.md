# Introduction
Symfony2 wrapper around  [HaPi](http://labs.mdbitz.com/harvest-api/) [Harvest](http://www.getharvest.com/) API client for app usage.

MattvickHarvestAppBundle is just a simple proxy bundle between HaPi HarvestAPI client and symfony2. It is only meant to be used as a clientless app. 

Code borrowed heavily from [InoriTwitterAppBundle](https://github.com/Inori/InoriTwitterAppBundle) a great Twitter bundle and inspired by [Harvest4Clients](https://github.com/jkenters/Harvest4Clients) a 

# Example usage
Example use-case for this bundle would be display Harvest data (from your project account) about clients, projects or tasks etc in your system.


# Installation

#### With composer:
Add this bundle and the HaPi package to your composer.json:

    // composer.json
    {
        // ...
        require: {
            // ...
            "mattvick/harvest-app-bundle": "master"
        }
        // ...
        "repositories": [
            // ...
            {
                "type": "package",
                "package": {
                    "name": "mdbitz/hapi",
                    "version": "1.1.1",
                    "dist": {
                        "url": "http://labs.mdbitz.com/wp-content/uploads/2010/10/HaPi-1.1.1.zip",
                        "type": "zip"
                    }
                }
            }
        ],
    }

Open up your `app/autoload.php` file and add the HaPi HarvestAPI Autoloader:

    //app/autoload.php
    // ...
    require_once __DIR__.'/../vendor/mdbitz/hapi/HarvestAPI.php';
    spl_autoload_register( array('HarvestAPI', 'autoload') );
    // ...

This tells Symfony2 where it can locate your `HarvestAPI` class. Since HaPi Harvest API does not
yet follow the PSR-0 Naming standards its autoloader has to be attached manually.


Add this bundle to your application's kernel:

    //app/AppKernel.php
    public function registerBundles()
    {
        return array(
            // ...
            new Mattvick\HarvestAppBundle\MattvickHarvestAppBundle(),
        );
    }

Configure the `harvest_app` service in your YAML configuration:

    #app/config/config.yml
    mattvick_harvest_app:
        file:       %kernel.root_dir%/../vendor/mdbitz/hapi/HarvestAPI.php
        user:      xxxxxx  # this is your email address
        password:  xxxxxx
        account:   xxxxxx  # this is you subdomain (see below)
        ssl:       true

**NB!** The `account:` is your harvest subdomain such as https://**example**.harvestapp.com/.

Now tell composer to download the bundle by running the command:

    $ php composer.phar update mattvick/harvest-app-bundle


# Using HarvestApp

If the setup is done correctly, then you can start using HarvestApp like this:

    // ...
    $api = $this->container->get('harvest_app')->getApi();

An example use in a controller is as follows:

    // ...
    $api = $this->get('harvest_app')->getApi();
    $result = $api->getClient( 123456 );
    if( $result->isSuccess() ) {
        $client = $result->data;
    }

See the [HaPi Harvest API documentation](http://labs.mdbitz.com/harvest-api/docs/) for more examples.

