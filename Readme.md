# Magento Sample Dtata Installer

Used to import Magento template sample data .sql file to the selected database.

### Template implementation

* Create template fullpackage.zip
* add installer.php file to theroot
* add dump.sql file to the root
* replace default Magento index.php file with the one in this repo

Index.php file has the following condition added: 

`if(!file_exists(__DIR__ . '/app/etc/env.php')){
     $installerPath = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]installer.php";
     header("Location: $installerPath");
 } else`