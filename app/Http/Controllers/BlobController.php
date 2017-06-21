<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use WindowsAzure\Common\ServicesBuilder;
use MicrosoftAzure\Storage\Blob\Models\CreateContainerOptions;
use MicrosoftAzure\Storage\Blob\Models\PublicAccessType;

class BlobController extends Controller{

	private static function ConnectionString(){

		$accountKey="pt+yYoOVY5zTnIL6HXa0yE+hey3CEPK+idwro1QpFh1fYL7IzrCwEyd7+VchQYrwGQjd7nKDTyyk5rYUPrsfcQ==";
        $accountName="fastandfruit";

        $connectionString = "DefaultEndpointsProtocol=http;AccountName=".$accountName.";AccountKey=".$accountKey;

        return $connectionString;
	}

    public function createContainer(Request $request, $container){

        
        $blobRestProxy = ServicesBuilder::getInstance()->createBlobService($this->ConnectionString());

        // Create container options object.
        $createContainerOptions = new CreateContainerOptions();
        
        $createContainerOptions->setPublicAccess(PublicAccessType::CONTAINER_AND_BLOBS);
        
        try {
            // Create container.
            $blobRestProxy->createContainer($container, $createContainerOptions);
        }
        catch(ServiceException $e){
            // Handle exception based on error codes and messages.
            // Error codes and messages are here:
            // http://msdn.microsoft.com/library/azure/dd179439.aspx
            $code = $e->getCode();
            $error_message = $e->getMessage();
            echo $code.": ".$error_message."<br />";
        }
        
        return "Container created";
    }

    	public static function createBlob($name_file, $mycontainer, $blob_name){
	        
	        // Create blob REST proxy.
	        $blobRestProxy = ServicesBuilder::getInstance()->createBlobService(BlobController::ConnectionString());
	        
	        //$file = $name_file;
	        
	        if(is_readable($name_file)){
	            $content = fopen($name_file, "r");
	        }

	        else{
	            return "File not found";
	        }
  
	        try {
	            //Upload blob
	            $blobRestProxy->createBlockBlob($mycontainer, $blob_name, $content);
	        }
	        catch(ServiceException $e){
	            // Handle exception based on error codes and messages.
	            // Error codes and messages are here:
	            // http://msdn.microsoft.com/library/azure/dd179439.aspx
	            $code = $e->getCode();
	            $error_message = $e->getMessage();
	            echo $code.": ".$error_message."<br />";
	        }
	        
	        return "file uploaded";
    }

     public static function downloadBlob($mycontainer, $myblob) {
        
        try {
            // Get blob.
            $blobRestProxy = ServicesBuilder::getInstance()->createBlobService(BlobController::ConnectionString());
            $blob = $blobRestProxy->getBlob($mycontainer, $myblob);
             
            $source = stream_get_contents($blob->getContentStream());
            
            return $source;

            //echo '<img src="data:image/jpeg;base64,' . base64_encode( $source ) . '" />';
            
        }
        catch(ServiceException $e){
            // Handle exception based on error codes and messages.
            // Error codes and messages are here:
            // http://msdn.microsoft.com/library/azure/dd179439.aspx
            $code = $e->getCode();
            $error_message = $e->getMessage();
            echo $code.": ".$error_message."<br />";
        }
    }
}
