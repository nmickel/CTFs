# Internal THM

>Nathaniel Mickel | 15, Sept , 2021

```bash
export IP=10.10.93.160
```

# Initial NMAP
```
Nmap 7.91 scan initiated Wed Sep 15 14:58:32 2021 as: nmap -sC -sV -oN nmap/initial 10.10.93.160
Nmap scan report for 10.10.93.160
Host is up (0.14s latency).
Not shown: 998 closed ports
PORT   STATE SERVICE VERSION
22/tcp open  ssh     OpenSSH 7.6p1 Ubuntu 4ubuntu0.3 (Ubuntu Linux; protocol 2.0)
| ssh-hostkey: 
|   2048 6e:fa:ef:be:f6:5f:98:b9:59:7b:f7:8e:b9:c5:62:1e (RSA)
|   256 ed:64:ed:33:e5:c9:30:58:ba:23:04:0d:14:eb:30:e9 (ECDSA)
|_  256 b0:7f:7f:7b:52:62:62:2a:60:d4:3d:36:fa:89:ee:ff (ED25519)
80/tcp open  http    Apache httpd 2.4.29 ((Ubuntu))
|_http-server-header: Apache/2.4.29 (Ubuntu)
|_http-title: Apache2 Ubuntu Default Page: It works
Service Info: OS: Linux; CPE: cpe:/o:linux:linux_kernel
```
# Agressive NMAP
```
Nmap 7.91 scan initiated Wed Sep 15 15:00:41 2021 as: nmap -A -p- -oN nmap/aggressive -v 10.10.93.160
Increasing send delay for 10.10.93.160 from 0 to 5 due to 88 out of 291 dropped probes since last increase.
Nmap scan report for 10.10.93.160
Host is up (0.14s latency).
Not shown: 65533 closed ports
PORT   STATE SERVICE VERSION
22/tcp open  ssh     OpenSSH 7.6p1 Ubuntu 4ubuntu0.3 (Ubuntu Linux; protocol 2.0)
| ssh-hostkey: 
|   2048 6e:fa:ef:be:f6:5f:98:b9:59:7b:f7:8e:b9:c5:62:1e (RSA)
|   256 ed:64:ed:33:e5:c9:30:58:ba:23:04:0d:14:eb:30:e9 (ECDSA)
|_  256 b0:7f:7f:7b:52:62:62:2a:60:d4:3d:36:fa:89:ee:ff (ED25519)
80/tcp open  http    Apache httpd 2.4.29 ((Ubuntu))
| http-methods: 
|_  Supported Methods: GET POST OPTIONS HEAD
|_http-server-header: Apache/2.4.29 (Ubuntu)
|_http-title: Apache2 Ubuntu Default Page: It works
Service Info: OS: Linux; CPE: cpe:/o:linux:linux_kernel
```
# Gobuster Scan
```
/blog                 (Status: 301) [Size: 311] [--> http://10.10.93.160/blog/]
/wordpress            (Status: 301) [Size: 316] [--> http://10.10.93.160/wordpress/]
/javascript           (Status: 301) [Size: 317] [--> http://10.10.93.160/javascript/]
/phpmyadmin           (Status: 301) [Size: 317] [--> http://10.10.93.160/phpmyadmin/]
/server-status        (Status: 403) [Size: 277]
```
# WordPress Scan
```_______________________________________________________________
         __          _______   _____
         \ \        / /  __ \ / ____|
          \ \  /\  / /| |__) | (___   ___  __ _ _ __ ®
           \ \/  \/ / |  ___/ \___ \ / __|/ _` | '_ \
            \  /\  /  | |     ____) | (__| (_| | | | |
             \/  \/   |_|    |_____/ \___|\__,_|_| |_|

         WordPress Security Scanner by the WPScan Team
                         Version 3.8.18
       Sponsored by Automattic - https://automattic.com/
       @_WPScan_, @ethicalhack3r, @erwan_lr, @firefart
_______________________________________________________________

[32m[+][0m URL: http://10.10.93.160/blog/ [10.10.93.160]
[32m[+][0m Started: Wed Sep 15 15:02:42 2021

Interesting Finding(s):

[32m[+][0m Headers
 | Interesting Entry: Server: Apache/2.4.29 (Ubuntu)
 | Found By: Headers (Passive Detection)
 | Confidence: 100%

[32m[+][0m XML-RPC seems to be enabled: http://10.10.93.160/blog/xmlrpc.php
 | Found By: Direct Access (Aggressive Detection)
 | Confidence: 100%
 | References:
 |  - http://codex.wordpress.org/XML-RPC_Pingback_API
 |  - https://www.rapid7.com/db/modules/auxiliary/scanner/http/wordpress_ghost_scanner/
 |  - https://www.rapid7.com/db/modules/auxiliary/dos/http/wordpress_xmlrpc_dos/
 |  - https://www.rapid7.com/db/modules/auxiliary/scanner/http/wordpress_xmlrpc_login/
 |  - https://www.rapid7.com/db/modules/auxiliary/scanner/http/wordpress_pingback_access/

[32m[+][0m WordPress readme found: http://10.10.93.160/blog/readme.html
 | Found By: Direct Access (Aggressive Detection)
 | Confidence: 100%

[32m[+][0m The external WP-Cron seems to be enabled: http://10.10.93.160/blog/wp-cron.php
 | Found By: Direct Access (Aggressive Detection)
 | Confidence: 60%
 | References:
 |  - https://www.iplocation.net/defend-wordpress-from-ddos
 |  - https://github.com/wpscanteam/wpscan/issues/1299

[32m[+][0m WordPress version 5.4.2 identified (Insecure, released on 2020-06-10).
 | Found By: Emoji Settings (Passive Detection)
 |  - http://10.10.93.160/blog/, Match: 'wp-includes\/js\/wp-emoji-release.min.js?ver=5.4.2'
 | Confirmed By: Meta Generator (Passive Detection)
 |  - http://10.10.93.160/blog/, Match: 'WordPress 5.4.2'

[34m[i][0m The main theme could not be detected.


[34m[i][0m No plugins Found.


[34m[i][0m No Config Backups Found.

[33m[!][0m No WPScan API Token given, as a result vulnerability data has not been output.
[33m[!][0m You can get a free API token with 25 daily requests by registering at https://wpscan.com/register

[32m[+][0m Finished: Wed Sep 15 15:02:53 2021
[32m[+][0m Requests Done: 165
[32m[+][0m Cached Requests: 4
[32m[+][0m Data Sent: 41.757 KB
[32m[+][0m Data Received: 190.275 KB
[32m[+][0m Memory used: 178.746 MB
[32m[+][0m Elapsed time: 00:00:10
```

# PHP Reverse 

# Flags 
User Flag = THM{int3rna1_fl4g_1}
Root Flag = THM{d0ck3r_d3str0y3r}

# Creds
```
aubreanna:bubb13guM!@#123
root:tr0ub13guM!@#123
```
# Explanation
```
First we started by enumerating the ports using nmap which found ports 22 and 80. Once this was done I started looking into the 
website and through a gobuster scan we found that it is running wordpress. I ran a WordPress scan and didnt find much. after bruteforcing the login page using WPScan. I uploaded a php reverse shell which gave me the www-data user then from there I enumerated the systeam and found a txt file called wp-save.txt that had login creds for aubreanna, from there we sshed into the system and found the user.txt file with the first we also found jenkins.txt file that told us there was a jenkins server running on 127.0.0.1:8080. There is a internal jenkins server running on port 8080 after bruteforcing the login page i gained access. After using a Groovy Reverse Shell we had access to the jenkins user. After looking around the system we found the notes.txt that 
gave us the root creds after login as root we got the root flag
```