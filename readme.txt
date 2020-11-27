/*** How to import images for already created products ***/
   Magento follows some complicated directory structure to store images for their products. Let's use 
   out-of-the-box feature provided by Magento for this purpose.
      Approach-1: Import images from own server where Magento2 is itself hosted:
         1. Go to Magento admin > SYSTEM > Data Transfer > Import
	 2. Select "Entity Type" as "Products", then there would appear a link "Download Sample File"; click on 
	    it to download sample csv file.
	 3. Put all images to directory pub/media/import like as looks in following print-screen:
	       csv_files_and_import_images_demo_printscreens/images-inside-pub-media-import-directory.jpg 
	    or create some directory under pub/media/import like pub/media/import/my_images and put 
	    all your images there which you want to import for your already created products.
	 4. Instead of using the downloaded sample file, use following csv file and prepare your own: 
	       csv_files_and_import_images_demo_printscreens/catalog_product.csv 
	       or 
	       csv_files_and_import_images_demo_printscreens/images_with_hierarchical_directory_structure.csv 
	    to import images against sku.
	    Remember: Always use notepad/notepad++ to open/read/modify CSV file so that it could maintain/keep 
	              it's original format and behave as per expectation after modification & save the same. 
	              Sometime, we would need to save as the CSV file with Encoding UTF-8 (after modification) 
		      if Magento2 doesn't recognize this file as CSV file. Please look following print-screen:
	                 csv_files_and_import_images_demo_printscreens/save-as-csv-file-with-encoding-UTF-8.png
	    5. Now your csv file and images both are available.
	          csv_files_and_import_images_demo_printscreens/product-images-before-import.jpg 
	       Go to Magento admin > SYSTEM > Data Transfer > Import
	          a. Select "Entity Type" as "Products".
	          b. Select "Import Behavior" as "Add/Update"
	          c. Keep next selection same as "Stop on Error"
	          d. Keep "Allowed Errors Count" same as 10
	          e. Keep "Field separator" same as ","
	          f. Set "Multiple value separator" as ";" as we have used semicolon to separate two images under 
	             "additional_images" column in csv import file 
		        csv_files_and_import_images_demo_printscreens/catalog_product.csv 
			or 
			csv_files_and_import_images_demo_printscreens/images_with_hierarchical_directory_structure.csv
	          g. Keep "Fields enclosure" same i.e. un-selected checkbox.
	          h. Import file 
		        csv_files_and_import_images_demo_printscreens/catalog_product.csv 
			or 
	                csv_files_and_import_images_demo_printscreens/images_with_hierarchical_directory_structure.csv 
	             using the field "Select File to Import"
	          i. Set "Images File Directory" as "pub/media/import" i.e. the relative path from your project's 
		     root directory where you have kept your images to import. Now the page would look like as below:
		        csv_files_and_import_images_demo_printscreens/import-images-from-local-server.jpg
	          j. Click on button "Check Data" in header.
	          k. If all ok, "Import" button would appear in footer as following, click on that. 
		        csv_files_and_import_images_demo_printscreens/csv-file-data-verified.jpg 
	          l. Then you will get success message as following:
		        csv_files_and_import_images_demo_printscreens/csv-file-import-successful.jpg 
	             It's done: 
		        csv_files_and_import_images_demo_printscreens/product-images-after-import.jpg
	          m. Look on images: 
		        csv_files_and_import_images_demo_printscreens/product-images-before-import.jpg 
			& 
	                csv_files_and_import_images_demo_printscreens/product-images-after-import.jpg => The new 
			image which has been assigned as base/small/thumbnail/swatch, comes at position-1, then 
			the older-images and then the new added additional images.
	
      Approach-2: Import images from external server:
         Do everything same as in Approach-1 except the followings:
	    1. Use 
	          csv_files_and_import_images_demo_printscreens/catalog_product_2.csv 
               as import-file where image-file names prefixed with external server domain-name.
	    2. Keep "Images File Directory" field blank in import-product-webform as we have already mentioned 
	       each-image full path with it's domain-name in 
	          csv_files_and_import_images_demo_printscreens/catalog_product_2.csv 
	       Look print-screen: 
	          csv_files_and_import_images_demo_printscreens/import-images-from-external-server.jpg
         Note: Actually, what does Magento do in this approach-2 ? 
	       Magento downloads all images from external-server to it's pub/media/import directory and then follows 
	       Approach-1. You can check your pub/media/import directory after import process completion.
