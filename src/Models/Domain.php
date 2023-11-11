<?php

namespace basteyy\XzitGiggle\Models;

use basteyy\XzitGiggle\Models\Base\Domain as BaseDomain;

/**
 * Skeleton subclass for representing a row from the 'xg_domains' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 */
class Domain extends BaseDomain
{

    public function getNginxConfigPath() : string {
        // base is /etc/nginx/sites-available/
        return '/etc/nginx/sites-available/' . $this->getDomain() . '.conf';
    }

    public function getSymbolicNginxEnabledPath() : string {
        // base is /etc/nginx/sites-enabled/
        return '/etc/nginx/sites-enabled/' . $this->getDomain() . '.conf';
    }

    public function getServerConfig()
    {


        $config = 'server {';

        // Server name
        $config .= PHP_EOL . PHP_TAB . "server_name " . $this->getDomain() . ';';

        // IP V4 Listen
        if ($this->getIpv4()) {
            $address = IpAddressQuery::create()->findOneById($this->getIpv4())->getAddress();
            $config .= PHP_EOL . PHP_TAB ."listen $address:80;";
        }

        // IPv6 listen
        if ($this->getIpv6()) {
            $address = IpAddressQuery::create()->findOneById($this->getIpv6())->getAddress();
            $config .= PHP_EOL . PHP_TAB ."listen [$address]:80;";
        }

        // Root
        $config .= PHP_EOL . PHP_EOL . PHP_TAB . "root " . $this->getUser()->getWebRoot() . $this->getMountingPoint() . ';';

        // Index
        $config .= PHP_EOL . PHP_TAB . "index index.html index.php;";

        // access_log /home/eiweleit/logs/code.eiweleit.de_access.log;
        $config .= PHP_EOL . PHP_TAB . "access_log " . $this->getUser()->getLogRoot() . $this->getDomain() . '_access.log;';
        $config .= PHP_EOL . PHP_TAB . "error_log " . $this->getUser()->getLogRoot() . $this->getDomain() . '_error.log;';

        $config .= PHP_EOL . PHP_EOL . PHP_TAB . 'location / {';
        $config .= PHP_EOL . PHP_TAB . PHP_TAB . 'absolute_redirect off;';
        $config .= PHP_EOL . PHP_TAB . PHP_TAB . 'try_files $uri $uri/ /index.php?$query_string;';
        $config .= PHP_EOL . PHP_TAB . '}';

        $config .= PHP_EOL . PHP_EOL . PHP_TAB . 'location ~ \.php$ {';
        $config .= PHP_EOL . PHP_TAB . PHP_TAB . 'include snippets/fastcgi-php.conf;';
        $config .= PHP_EOL . PHP_TAB . PHP_TAB . 'fastcgi_read_timeout 120s;';
        $config .= PHP_EOL . PHP_TAB . PHP_TAB . 'fastcgi_pass unix:'.$this->getUser()->getFpmSock() . ';';
        $config .= PHP_EOL . PHP_TAB . '}';

        $config .= PHP_EOL . PHP_EOL . PHP_TAB . 'location ~* \.(jpg|jpeg|gif|png|css|js|ico|svg|eot|ttf|woff|woff2|otf)$ {';
        $config .= PHP_EOL . PHP_TAB . PHP_TAB . 'access_log        off;';
        $config .= PHP_EOL . PHP_TAB . PHP_TAB . 'lognot_found      off;';
        $config .= PHP_EOL . PHP_TAB . PHP_TAB . 'expires          30d;';
        $config .= PHP_EOL . PHP_TAB . '}';


        $config .= PHP_EOL . '}';

        return $config;
    }
}
