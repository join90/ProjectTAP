<?php

namespace App\Providers;

use Storage;
use League\Flysystem\Filesystem;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\Azure\AzureAdapter;
use WindowsAzure\Common\ServicesBuilder;

class AzureStorageServiceProvider extends ServiceProvider

{

    public function boot()

    {

        Storage::extend('azure', function($app, $config) {

            $endpoint = sprintf(

                'DefaultEndpointsProtocol=https;AccountName=%s;AccountKey=%s',

                $config['name'],

                $config['key']

            );

            $blobRestProxy = ServicesBuilder::getInstance()->createBlobService($endpoint);

            return new Filesystem(new AzureAdapter($blobRestProxy, $config['container']));

        });

    }

    /**

     * Register bindings in the container.

     *

     * @return void

     */

    public function register()

    {

        //

    }

}
