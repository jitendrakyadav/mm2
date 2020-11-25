Install Magento 2.2.6 without sample data:
   1. "git clone" of this repository
   2. Go to master branch at your local
   3. Delete .git directory to remove other branches files/folders as you want to create a new/fresh Magento 
      project (Later you might use command "git init" to use your project as fresh/new git repository) otherwise 
      continue with current .git directory.
   4. Go to your project/repository root directory
   5. As here no vendor directory present, use command "composer install" to install/download all packages of 
      Magento & other-vendors as well.
   6. In between, control asks you about https://repo.magento.com/ credentials i.e. username/password so use here 
      Public-Key/Private-Key instead of username/password. To get your Public Key & Private Key, please follow 
      below steps:
         a. Go to https://developer.magento.com/ and register yourself there.
	 b. After logined into your account, click on your username in header > My Account > Developer Portal 
	    > My Products > My Access Keys > Magento 2 > Public Key & Private Key would be displayed here, if not, 
	    click on button "Create A New Access Key".
   7. Install Magento by using following command:
         php bin/magento setup:install --backend-frontname=admin --db-host=localhost --db-name=magento_7121tt --db-user=root --base-url=http://mg226tt.local.com --admin-user=admin --admin-password=admin@123 --admin-email=goto.jitendra@gmail.com --admin-firstname=Jitendra --admin-lastname=Yadav --language=en_US --timezone=Asia/Kolkata --currency=INR --use-rewrites=1
      Note: 
         1. By firing command "php bin/magento setup:install", you can know all suggested options by Magento, 
	    needed to install. Use "--db-password" option as well only if you have some password for your database. 
	    I haven't used this options here as I have no/blank/null password against my db username "root".
	 2. This command line installation does not use Apache i.e. webserver(as I have installed magento in my 
	    window-machine using the above command after stopping Apache) so memory-consumption would be 
	    lesser(as instead of Apache, PHP & MySQL only PHP & MySQL are involved) and installation would 
	    complete earlier. This means, CLI installation uses only PHP and MySQL.
         3. It's done. After installation, it might be possible:
	       A. your web-pages are un-accessible 
	       B. web-page's css not working properly then use commands(only b & c; a in special situations like 
	          you are unable to update/write any project's file or unable to set permissions/modes for your 
		  project's folders/files with your username):
   		     a. sudo chown -R your-user-name:your-group-name project-directory-name
   	             b. chmod -R 777 var pub generated
   	             c. php bin/magento setup:static-content:deploy -f
/* ---------------------------------------------------------------------------------------------------------------------- */
How I made ready this mg226 repository:
   1. Download Magento 2.2.6 (zip with no sample-data) from "https://magento.com/tech-resources/download".
   2. Create a blank-directory mg226 and unzip downloaded zip file into this directory mg226.
   3. Modify .gitignore file: 
         a. add one more line (as from https://github.com/magento/magento2/blob/2.2.6/.gitignore : It's Magento 
	    with Tag: 2.2.6 github release):
    	       /app/etc/config.php
	 b. remove one line:
	       /.gitattributes
   4. Create .gitattributes file (Dealing with line endings):
         a. Every time you press return(i.e Enter button) on your keyboard you're actually inserting an invisible 
	    character called a line ending. Historically, different operating systems have handled line endings differently.
	 b. For Linux & Mac: this invisible character is LF(Line Feed), for Windows: this invisible character is 
	    a combination of two characters i.e. CR(Carriage Return) & LF(Line Feed) means CRLF.
	 c. When you view changes in a file, Git handles line endings in its own way. Since you're collaborating 
	    on projects with Git and GitHub, Git might produce unexpected results if, for example, you're working 
	    on a Windows machine, and your collaborator has made a change in Linux.
	 d. Global settings for line endings:
	       The "git config core.autocrlf" command is used to change how Git handles line endings. It takes a 
	       single argument.
	       On Linux, you simply pass "input" to the configuration. 
	       For example: "git config --global core.autocrlf input"
	       
	       On Windows, you pass "true" to the configuration.
	       For example: "git config --global core.autocrlf true"
	       
	       That means if a file from git repository reaches in windows environment, all LF are converted to 
	       CRLF in that file, that's why "git status" would show it as modified file without any change, even 
	       of a single line.
	 e. Per-repository settings:
	       Optionally, you can configure the way Git manages line endings on a per-repository basis by 
	       configuring a special .gitattributes file. This file is committed into the repository and overrides 
	       an individual's core.autocrlf setting, ensuring consistent behavior for all users, regardless of 
	       their Git settings. The advantage of a .gitattributes file is that your line configurations are 
	       associated with your repository. You don't need to worry about whether or not collaborators have 
	       the same line ending settings that you do.
	 f. For more detaile, look here: https://help.github.com/articles/dealing-with-line-endings/ or 
	    articles_dealing-with-line-endings.png in root-directory.
   5. Remove all files/folders from/inside vendor directory except .htaccess
      or
      Backup vendor/.htaccess, remove whole vendor directory, create again vendor directory and move here your 
      backed-up .htaccess file
   6. create/add file readme.txt with content as here.
   7. ceate a repository on github with name "mg226".
   8. When you are in your local project's root directory, fire command "git init".
   9. Fire command "git remote add origin https://github.com/<your-user-name>/mg226.git"
   10.Fire command "git add .".
   11.Fire command 'git commit -m "First commit"'
   12.Fire command "git push origin master"
   13.It's done.
/* ---------------------------------------------------------------------------------------------------------------------- */
Install Magento 2.2.6 with sample data: 
   Installation process for Magento 2.2.6 with sample data is almost same as for without sample data.
   Even exactly same name & number of files & folders in root directory.
   Then what difference between the 2 zip downloaded, as zip-with-sample-data is 150MB heavier then 
   zip-without-sample data:
      a. composer.json (and of course composer.lock) file content is different in with-sample-data and 
         without-sample-data versions of Magento download. As in with-sample-data, composer.json has various 
	 sample-data module/plugin/package as their dependency.
      b. In with-sample-data, pub/media directory contains media files, might be sample-product images, etc.
      c. After installation, with-sample-data DB would be obviously heavier than the without-sample-data DB as 
         it contains many sample records in it's various tables.

   1. Download Magento 2.2.6 (zip with sample-data) from "https://magento.com/tech-resources/download".
   2. Create a blank-directory mgwd226 and unzip downloaded zip file into this directory mgwd226; might be using 
      command:
         unzip ~/Downloads/Magento-CE-2.2.6_sample_data-2018-09-07-02-28-42.zip -d mgwd226/
   3. Skip this step-3 as this is only for your information/knowledge:
         Here we see vendor directory is available with all dependencies as mentioned in composer.json, so need 
	 not of use "composer install" command. If still we run/fire command "composer install", we instantly got 
	 message: No need of update/install, autoload file created.
         Let backup of vendor/.htaccess file and delete the whole vendor directory.
         Again create a blank vendor directory and put here backed-up file .htaccess.
         If we run command "composer install" now, composer downloads/installs all 
	 dependencies(i.e. libraries/packages) inside vendor directory as mentioned in composer.lock(or composer.json; 
	 remember "composer install" command always look for composer.lockfile first, if not available then look 
	 into composer.json).
   4. Run exactly the same command as above(only changed currency from "INR" to "USD"), used to install 
      Magento 2.2.6 without sample data i.e.:
         php bin/magento setup:install --backend-frontname=admin --db-host=localhost --db-name=magento_7121tt --db-user=root --base-url=http://mg226tt.local.com --admin-user=admin --admin-password=admin@123 --admin-email=goto.jitendra@gmail.com --admin-firstname=Jitendra --admin-lastname=Yadav --language=en_US --timezone=Asia/Kolkata --currency=USD --use-rewrites=1
   5. In 15-20 minutes, we get successful installation message. It's done.
