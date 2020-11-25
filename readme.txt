/******** Some common queries and their solutions ********/

Query 1: WinSCP is not showing hidden files/folders like .htaccess file and .git directory ?
Solution: 
   WinSCP is a free and open-source SFTP (Secure File Transfer Protocol), FTP (File Transfer Protocol), WebDAV, 
   Amazon S3 and SCP (Secure Copy Protocol) client for Microsoft Windows. Its main function is secure file 
   transfer between a local and a remote computer. 
      1. To solve this issue, goto WinSCP header Options -> Preferences
      2. Click on "Panels" showing at left hand side.
      3. Now check the checkbox "Show hidden files (Ctrl+Alt+H)" visible at right hand side.

Query 2: How to install and configure Laravel ?
Solution: 
   Install & Configure Laravel:
      1. Firstly, check prerequisite from Laravel documentation URL:https://laravel.com/docs/5.7 under section 
         "Server Requirements". You might check the same from URL:https://packagist.org/packages/laravel/laravel 
	 where Laravel package resides on packagist.org.
      2. To install Laravel, execute following command:
            composer create-project laravel/laravel dashboard
	    /*
	     * This command would install Laravel in dashboard directory as well as downloads all 
	     * dependencies.
	     * dashboard => is the directory in which you want to install Laravel
	     * laravel/laravel => is the Laravel package name on packagist.org which you want to install
	     */
      3. Create a new copy of database configuration file as following:
	    cp config/database.php config/database.example.php
      4. Open .gitignore file in your project root directory and add following at last line:
            /config/database.php
      5. Create virtual host (by creating file in /etc/apache2/sites-available or 
	    /etc/nginx/sites-available) and make entry in /etc/hosts file as well for the same.
      6. Configure the project using Laravel documentation URL:https://laravel.com/docs/5.7 as above under 
	    section "Configuration".
      7. That's it. Another way, you can clone https://github.com/laravel/laravel, then using "composer 
	    install" download all dependencies and then create virtual-host, configure the project as above.

   Create repository for project:
      1. Go to inside your project root directory i.e. here directory "dashboard".
      2. execute command "git init". If you have installed Laravel by cloning github URL, then firstly checkout 
         to the branch i.e. the Laravel version on which you want to work then delete the .git folder.
      3. Now git has been initialized in your project; now set remote repository using:
	    git remote add origin <remote-repository-url>
      4. Use following commands to push your first commit to remote-repository:
	    git add .
	    git commit -m "First commit"
	    git push origin master
      5. Now, you might create new branch & start your work.
