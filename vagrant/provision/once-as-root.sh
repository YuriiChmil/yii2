#!/usr/bin/env bash

#== Import script args ==

timezone=$(echo "$1")

#== Bash helpers ==

function info {
  echo " "
  echo "--> $1"
  echo " "
}

#== Provision script ==

info "Provision-script user: `whoami`"

export DEBIAN_FRONTEND=noninteractive

info "Configure timezone"
timedatectl set-timezone ${timezone} --no-ask-password

info "Prepare root password for MySQL"
debconf-set-selections <<< "mysql-community-server mysql-community-server/root-pass password \"''\""
debconf-set-selections <<< "mysql-community-server mysql-community-server/re-root-pass password \"''\""
echo "Done!"

info "Update OS software"
apt-get update
apt-get upgrade -y

info "Install additional software"
apt-get install -y php7.0-curl php7.0-cli php7.0-intl php7.0-mysqlnd php7.0-gd php7.0-fpm php7.0-mbstring php7.0-xml unzip nginx mysql-server-5.7 php.xdebug php7.0-bcmath

info "Configure MySQL"
sed -i "s/.*bind-address.*/bind-address = 0.0.0.0/" /etc/mysql/mysql.conf.d/mysqld.cnf
mysql -uroot <<< "CREATE USER 'root'@'%' IDENTIFIED BY ''"
mysql -uroot <<< "GRANT ALL PRIVILEGES ON *.* TO 'root'@'%'"
mysql -uroot <<< "DROP USER 'root'@'localhost'"
mysql -uroot <<< "FLUSH PRIVILEGES"
echo "Done!"

info "Configure PHP-FPM"
sed -i 's/user = www-data/user = vagrant/g' /etc/php/7.0/fpm/pool.d/www.conf
sed -i 's/group = www-data/group = vagrant/g' /etc/php/7.0/fpm/pool.d/www.conf
sed -i 's/owner = www-data/owner = vagrant/g' /etc/php/7.0/fpm/pool.d/www.conf
cat << EOF > /etc/php/7.0/mods-available/xdebug.ini
zend_extension=xdebug.so
xdebug.remote_enable=1
xdebug.remote_connect_back=1
xdebug.remote_port=9000
xdebug.remote_autostart=1
EOF
echo "Done!"
info "install java"
add-apt-repository ppa:openjdk-r/ppa -y
apt-get update
apt-get install -y openjdk-8-jdk
echo "Done!"

info "install Elastisearch"
wget https://download.elastic.co/elasticsearch/elasticsearch/elasticsearch-2.3.3.deb
dpkg -i elasticsearch-2.3.3.deb
update-rc.d elasticsearch defaults
echo "Done!"
info "Install RabbitMq"
apt-get install -y rabbitmq-server
service rabbitmq-server start
rabbitmq-plugins enable rabbitmq_management
echo "Done!"

info "Install elasticsearch HQ plugin"
/usr/share/elasticsearch/bin/plugin install royrusso/elasticsearch-HQ
echo "network.bind_host: 0" >> /etc/elasticsearch/elasticsearch.yml
echo "network.host: 0.0.0.0" >> /etc/elasticsearch/elasticsearch.yml
service elasticsearch restart
echo "Done!"

info "Configure NGINX"
sed -i 's/user www-data/user vagrant/g' /etc/nginx/nginx.conf
echo "Done!"

info "Enabling site configuration"
ln -s /app/vagrant/nginx/app.conf /etc/nginx/sites-enabled/app.conf
echo "Done!"

info "Initailize databases for MySQL"
mysql -uroot <<< "CREATE DATABASE yii2advanced"
mysql -uroot <<< "CREATE DATABASE yii2advanced_test"
echo "Done!"

info "Install composer"
curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer