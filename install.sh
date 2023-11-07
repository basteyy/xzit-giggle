# Define dev mode
dev=true

# Repository
repo="https://github.com/basteyy/xzit-giggle.git"

if [ "$dev" = false ]; then

  # Check if OS with lsb_release is installed
  if ! [ -x "$(command -v lsb_release)" ]; then
    echo "Error: lsb_release is not installed." >&2
    exit 1
  fi

  # Check if ubuntu
  if [ "$(lsb_release -si)" != "Ubuntu" ]; then
    echo "Error: This script is only for Ubuntu." >&2
    exit 1
  fi

  # check is user is root
  if [ "$EUID" -ne 0 ]; then
    echo "Error: Please run as root." >&2
    exit 1
  fi

  # check if nginx is installed
  if ! [ -x "$(command -v nginx)" ]; then
    echo "Error: nginx is not installed." >&2
    exit 1
  fi

  # check if php 8.3-fpm is installed
  if ! [ -x "$(command -v php8.3-fpm)" ]; then
    echo "Error: php8.3-fpm is not installed." >&2
    exit 1
  fi

fi

# Check if git is installed
if ! [ -x "$(command -v git)" ]; then
  echo "Error: git is not installed." >&2
  exit 1
fi

# ask for primary ip address
echo "[INFO] Please enter the IP, which is connected to your server. Its required for building the config file."
# shellcheck disable=SC2162
read -p "Enter primary ip address: " primary_ip

# check primary ip address
if ! [[ $primary_ip =~ ^[0-9]+\.[0-9]+\.[0-9]+\.[0-9]+$ ]]; then
  echo "Error: $primary_ip is not a valid ip address." >&2
  exit 1
fi

# Ask for a server_name for giggle
echo "[INFO] Please enter a FQDN for giggle. Something like giggle.example.org. Its required for building the config file."
read -p "Enter server_name: " server_name

# check if server name is a valid fqdn
if ! [[ $server_name =~ ^[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,6}$ ]]; then
  echo "Error: $server_name is not a valid FQDN." >&2
  exit 1
fi

# create /var/www/virtual directory in case its not exist
mkdir -p /var/www/virtual

# clone repo to /var/www/virtual/xg directory
git clone $repo /var/www/virtual/xg

# change directory to /var/www/virtual/xg
# shellcheck disable=SC2164
cd /var/www/virtual/xg

# composer install
composer install

# replace {IP} with primary ip address in /var/www/virtual/xg/.builds/nginx/xg.conf
sed -i "s/{IP}/$primary_ip/g" .builds/nginx/xg.conf

# replace {SERVER_NAME} with server_name in /var/www/virtual/xg/.builds/nginx/xg.conf
sed -i "s/{SERVER_NAME}/$server_name/g" .builds/nginx/xg.conf

# copy /var/www/virtual/xg/.builds/nginx/xg.conf to /etc/nginx/sites-available/xg.conf
cp .builds/nginx/xg.conf /etc/nginx/sites-available/xg.conf

# create symlink from /etc/nginx/sites-available/xg.conf to /etc/nginx/sites-enabled/xg.conf
ln -s /etc/nginx/sites-available/xg.conf /etc/nginx/sites-enabled/xg.conf

# copy php pool
cp .builds/php/xg.conf /etc/php/8.3/fpm/pool.d/xg.conf

# restart nginx and php8.3-fpm
systemctl restart nginx php8.3-fpm
