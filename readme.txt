/*** How to import images for already created products ***/
   Magento follows some complicated directory structure to store images for their products. Let's use 
   out-of-the-box feature provided by Magento for this purpose.
      Approach-1: Import images from local server:
         1. Go to Magento admin > SYSTEM > Data Transfer > Import
	 2. Select "Entity Type" as "Products", then there would appear a link "Download Sample File"; click on 
	    it to download sample csv file.
	 3. Add all images to directory pub/media/import [my_files/images-inside-pub-media-import-directory.jpg] 
	    (or create another directory whatever you want and put images there) which you want to import for 
	    your products.
	 4. Use the downloaded sample file and prepare your own file (remember: always use notepad/notepad++ to 
	    open/read/modify csv file so that it could maintain/keep it's original format and behave as per 
	    expectation after modification & save the same) like my_files/catalog_product.csv or 
	    my_files/images_with_hierarchical_directory_structure.csv to import images against sku.
	 5. Now your csv file and images both are available [my_files/product-images-before-import.jpg]; 
	    Go to Magento admin > SYSTEM > Data Transfer > Import
	       a. Select "Entity Type" as "Products".
	       b. Select "Import Behavior" as "Add/Update"
	       c. Keep next selection same as "Stop on Error"
	       d. Keep "Allowed Errors Count" same as 10
	       e. Keep "Field separator" same as ","
	       f. Set "Multiple value separator" as ";" as we have used semi-colon to separate two images under 
	          "additional_images" column in csv import file my_files/catalog_product.csv or 
		  my_files/images_with_hierarchical_directory_structure.csv
	       g. Keep "Fields enclosure" same as un-selected checkbox.
	       h. Import file my_files/catalog_product.csv or my_files/images_with_hierarchical_directory_structure.csv 
	          using the field "Select File to Import"
	       i. Set "Images File Directory" as "pub/media/import" i.e. the relative path from your project's root 
	          directory where you have kept your images to import
	       j. The page would be shown as my_files/import-images-from-local-server.jpg
	       k. Click on button "Check Data" in header
	       l. If all ok, "Import" button would appear in footer, click on that [my_files/csv-file-data-verified.jpg]. 
	       m. Got success message [my_files/csv-file-import-successful.jpg]. It's done 
	          [my_files/product-images-after-import.jpg].
	       n. Look on images: my_files/product-images-before-import.jpg & 
	          my_files/product-images-after-import.jpg => The new image which has been assigned as 
		  base/small/thumbnail/swatch, comes at position-1, then the older-images and then the new added 
		  additional images.
	
      Approach-2: Import images from external server:
         Do everything same as in Approach-1 except the followings:
	    1. Use my_files/catalog_product_2.csv as import-file where image-file names prefixed with external server 
	       domain-name.
	    2. Keep "Images File Directory" field blank in import-product-webform as we have already mentioned 
	       each-image full path with it's domain-name in my_files/catalog_product_2.csv, look print-screen 
	       my_files/import-images-from-external-server.jpg
         Note: Actually Magento what does in this approach - Magento downloads all images from external-server to 
	       it's pub/media/import directory and then follows Approach-1. You can check your pub/media/import 
	       directory after import process completion.
