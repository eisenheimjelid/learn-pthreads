# Enseñando y aprendiendo de hilos en PHP
Para fines académicos, este repositorio contiene información y código detallado de como hacer uso de hilos de procesamiento (threads) dentro de PHP.
De igual forma se describe como realizar la instalación de la libreria desde Linux (fuente: http://php.net/manual/es/pthreads.installation.php#114837), realizando la compilación de una versión de PHP en un Debian.
## Consideraciones y versiones
Las versiones utilizadas para el presente código son:
* PHP 5.5.35
* pthreads 2.0.10
* Composer 1.1.1
* Debian 8 Jessie GNU/Linux 3.16.0-4.amd64
Estas versiones fueron escogidas, dado que las versiones más actuales de pthreads funcionan solo con PHP7, y para temas académicos, no es necesario mostrar una versión más actual.
# Instalar pthreads
1. Instalar las dependencias de paquetes necesarios para realizar la compilación y configuración de los paquetes:
```shell
~# sudo apt-get install gcc make libzzip-dev libreadline-dev libxml2-dev \
libssl-dev libmcrypt-dev libcurl4-openssl-dev libbz2-dev autoconf libcurl4-openssl-dev pkg-config libssl-dev libssl-ocaml-dev
```
2. Descargar la versión de PHP correspondiente (en mi caso, la versión 5.5.35) y la descomprimimos en una ubicación en nuestro sistema:
```shell
~# cd /usr/local/src
~# wget http://www.php.net/distributions/php-5.5.35.tar.gz
~# tar zxvf php-5.5.35.tar.gz
```
3. Configuramos y compilamos el paquete descargado, en este paso puede tardarse varios minutos, dependiendo de la carga que tenga el sistema operativo en ese momento y de los recursos con los que cuente (CPU, RAM, etc.)
```shell
~# cd /usr/local/src/php-5.5.35
~# ./configure --prefix=/usr --with-config-file-path=/etc --enable-maintainer-zts --with-openssl --with-openssl-dir=/usr/local/bin --with-curl=/usr/local
~# make && make install
```
-- ( make -j3 && make -j3 install) -- De esta forma puede ser un poco más rápido
4. Copiamos el nuevo archivo de configuración de PHP (php.ini) a la ubicación correspondiente:
```shell
~# cp php.ini-development /etc/php.ini
```
5. Procedemos a instalar la libreria pthreads, habilitar la extensión en la configuración de PHP (php.ini) y revisamos que ya se pueda instanciar:
```shell
~# pecl install pthreads-2.0.10
~# echo "extension=pthreads.so" >> /etc/php.ini
~# php -m | grep pthreads
```
# Antes de empezar
Ahora que ya se tiene instalado y compilado correctamente nuestra versión de PHP con pthreads, realizamos la instalación de composer, para poder realizar el ejemplo expuesto aquí, plenamente:
```shell
~# cd /usr/local/src
~# wget https://getcomposer.org/installer
~# php installer --install-dir=/usr/local/bin --filename=composer
~# composer version
Composer version 1.1.1 2016-05-17 12:25:44
```
Ya con esto, podemos descargar este repositorio y actualizar las dependencias, de tal forma que se instalen el resto de librerias necesarias para hacer funcionar el ejemplo completo.
