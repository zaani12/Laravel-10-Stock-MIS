@echo off
REM Install PHP and MySQL
powershell -command "Invoke-WebRequest -Uri 'https://path-to-your-installer/php-installer.exe' -OutFile php-installer.exe"
powershell -command "Invoke-WebRequest -Uri 'https://path-to-your-installer/mysql-installer.exe' -OutFile mysql-installer.exe"
php-installer.exe /silent
mysql-installer.exe /silent

REM Install Composer
powershell -command "Invoke-WebRequest -Uri 'https://getcomposer.org/installer' -OutFile composer-setup.php"
php composer-setup.php --install-dir={app}
php {app}\composer.phar install
