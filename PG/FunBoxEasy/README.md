# FunEasyBox PG

>Nathaniel Mickel | 23, Sept 2021

## NMAP Scan
### Initial
```
Nmap 7.91 scan initiated Thu Sep 23 09:41:08 2021 as: nmap -sC -sV -oN nmap/initial 192.168.140.111
Nmap scan report for 192.168.140.111
Host is up (0.058s latency).
Not shown: 998 closed ports
PORT   STATE SERVICE VERSION
22/tcp open  ssh     OpenSSH 8.2p1 Ubuntu 4ubuntu0.1 (Ubuntu Linux; protocol 2.0)
| ssh-hostkey: 
|   3072 b2:d8:51:6e:c5:84:05:19:08:eb:c8:58:27:13:13:2f (RSA)
|   256 b0:de:97:03:a7:2f:f4:e2:ab:4a:9c:d9:43:9b:8a:48 (ECDSA)
|_  256 9d:0f:9a:26:38:4f:01:80:a7:a6:80:9d:d1:d4:cf:ec (ED25519)
80/tcp open  http    Apache httpd 2.4.41 ((Ubuntu))
| http-robots.txt: 1 disallowed entry 
|_gym
|_http-server-header: Apache/2.4.41 (Ubuntu)
|_http-title: Apache2 Ubuntu Default Page: It works
Service Info: OS: Linux; CPE: cpe:/o:linux:linux_kernel
```
### Aggressive
```
Nmap 7.91 scan initiated Thu Sep 23 09:45:17 2021 as: nmap -p- -A -oN nmap/agressive 192.168.140.111
Nmap scan report for 192.168.140.111
Host is up (0.059s latency).
Not shown: 65532 closed ports
PORT      STATE SERVICE VERSION
22/tcp    open  ssh     OpenSSH 8.2p1 Ubuntu 4ubuntu0.1 (Ubuntu Linux; protocol 2.0)
| ssh-hostkey: 
|   3072 b2:d8:51:6e:c5:84:05:19:08:eb:c8:58:27:13:13:2f (RSA)
|   256 b0:de:97:03:a7:2f:f4:e2:ab:4a:9c:d9:43:9b:8a:48 (ECDSA)
|_  256 9d:0f:9a:26:38:4f:01:80:a7:a6:80:9d:d1:d4:cf:ec (ED25519)
80/tcp    open  http    Apache httpd 2.4.41 ((Ubuntu))
| http-robots.txt: 1 disallowed entry 
|_gym
|_http-server-header: Apache/2.4.41 (Ubuntu)
|_http-title: Apache2 Ubuntu Default Page: It works
33060/tcp open  mysqlx?
| fingerprint-strings: 
|   DNSStatusRequestTCP, LDAPSearchReq, NotesRPC, SSLSessionReq, TLSSessionReq, X11Probe, afp: 
|     Invalid message"
|_    HY000
1 service unrecognized despite returning data. If you know the service/version, please submit the following fingerprint at https://nmap.org/cgi-bin/submit.cgi?new-service :
SF-Port33060-TCP:V=7.91%I=7%D=9/23%Time=614C9324%P=x86_64-pc-linux-gnu%r(N
SF:ULL,9,"\x05\0\0\0\x0b\x08\x05\x1a\0")%r(GenericLines,9,"\x05\0\0\0\x0b\
SF:x08\x05\x1a\0")%r(GetRequest,9,"\x05\0\0\0\x0b\x08\x05\x1a\0")%r(HTTPOp
SF:tions,9,"\x05\0\0\0\x0b\x08\x05\x1a\0")%r(RTSPRequest,9,"\x05\0\0\0\x0b
SF:\x08\x05\x1a\0")%r(RPCCheck,9,"\x05\0\0\0\x0b\x08\x05\x1a\0")%r(DNSVers
SF:ionBindReqTCP,9,"\x05\0\0\0\x0b\x08\x05\x1a\0")%r(DNSStatusRequestTCP,2
SF:B,"\x05\0\0\0\x0b\x08\x05\x1a\0\x1e\0\0\0\x01\x08\x01\x10\x88'\x1a\x0fI
SF:nvalid\x20message\"\x05HY000")%r(Help,9,"\x05\0\0\0\x0b\x08\x05\x1a\0")
SF:%r(SSLSessionReq,2B,"\x05\0\0\0\x0b\x08\x05\x1a\0\x1e\0\0\0\x01\x08\x01
SF:\x10\x88'\x1a\x0fInvalid\x20message\"\x05HY000")%r(TerminalServerCookie
SF:,9,"\x05\0\0\0\x0b\x08\x05\x1a\0")%r(TLSSessionReq,2B,"\x05\0\0\0\x0b\x
SF:08\x05\x1a\0\x1e\0\0\0\x01\x08\x01\x10\x88'\x1a\x0fInvalid\x20message\"
SF:\x05HY000")%r(Kerberos,9,"\x05\0\0\0\x0b\x08\x05\x1a\0")%r(SMBProgNeg,9
SF:,"\x05\0\0\0\x0b\x08\x05\x1a\0")%r(X11Probe,2B,"\x05\0\0\0\x0b\x08\x05\
SF:x1a\0\x1e\0\0\0\x01\x08\x01\x10\x88'\x1a\x0fInvalid\x20message\"\x05HY0
SF:00")%r(FourOhFourRequest,9,"\x05\0\0\0\x0b\x08\x05\x1a\0")%r(LPDString,
SF:9,"\x05\0\0\0\x0b\x08\x05\x1a\0")%r(LDAPSearchReq,2B,"\x05\0\0\0\x0b\x0
SF:8\x05\x1a\0\x1e\0\0\0\x01\x08\x01\x10\x88'\x1a\x0fInvalid\x20message\"\
SF:x05HY000")%r(LDAPBindReq,9,"\x05\0\0\0\x0b\x08\x05\x1a\0")%r(SIPOptions
SF:,9,"\x05\0\0\0\x0b\x08\x05\x1a\0")%r(LANDesk-RC,9,"\x05\0\0\0\x0b\x08\x
SF:05\x1a\0")%r(TerminalServer,9,"\x05\0\0\0\x0b\x08\x05\x1a\0")%r(NCP,9,"
SF:\x05\0\0\0\x0b\x08\x05\x1a\0")%r(NotesRPC,2B,"\x05\0\0\0\x0b\x08\x05\x1
SF:a\0\x1e\0\0\0\x01\x08\x01\x10\x88'\x1a\x0fInvalid\x20message\"\x05HY000
SF:")%r(JavaRMI,9,"\x05\0\0\0\x0b\x08\x05\x1a\0")%r(WMSRequest,9,"\x05\0\0
SF:\0\x0b\x08\x05\x1a\0")%r(oracle-tns,9,"\x05\0\0\0\x0b\x08\x05\x1a\0")%r
SF:(ms-sql-s,9,"\x05\0\0\0\x0b\x08\x05\x1a\0")%r(afp,2B,"\x05\0\0\0\x0b\x0
SF:8\x05\x1a\0\x1e\0\0\0\x01\x08\x01\x10\x88'\x1a\x0fInvalid\x20message\"\
SF:x05HY000")%r(giop,9,"\x05\0\0\0\x0b\x08\x05\x1a\0");
Service Info: OS: Linux; CPE: cpe:/o:linux:linux_kernel
```
## gobuster
```
/.htaccess            (Status: 403) [Size: 280]
/.hta                 (Status: 403) [Size: 280]
/.htpasswd            (Status: 403) [Size: 280]
/admin                (Status: 301) [Size: 318] [--> http://192.168.140.111/admin/]
/index.html           (Status: 200) [Size: 10918]
/index.php            (Status: 200) [Size: 3468]
/robots.txt           (Status: 200) [Size: 14]
/secret               (Status: 301) [Size: 319] [--> http://192.168.140.111/secret/]
/server-status        (Status: 403) [Size: 280]
/store                (Status: 301) [Size: 318] [--> http://192.168.140.111/store/]
```
## feroxbuster
```
301        9l       28w      318c http://192.168.140.111/admin
301        9l       28w      318c http://192.168.140.111/store
301        9l       28w      325c http://192.168.140.111/admin/assets
301        9l       28w      333c http://192.168.140.111/admin/assets/plugins
301        9l       28w      329c http://192.168.140.111/admin/assets/img
301        9l       28w      328c http://192.168.140.111/store/functions
301        9l       28w      334c http://192.168.140.111/admin/assets/img/icon
301        9l       28w      319c http://192.168.140.111/secret
301        9l       28w      325c http://192.168.140.111/store/models
301        9l       28w      331c http://192.168.140.111/admin/assets/fonts
301        9l       28w      331c http://192.168.140.111/store/models/admin
301        9l       28w      330c http://192.168.140.111/store/controllers
301        9l       28w      334c http://192.168.140.111/store/models/customer
301        9l       28w      327c http://192.168.140.111/store/database
301        9l       28w      327c http://192.168.140.111/store/template
301        9l       28w      328c http://192.168.140.111/admin/assets/js
301        9l       28w      329c http://192.168.140.111/admin/assets/css
301        9l       28w      336c http://192.168.140.111/admin/assets/css/themes
301        9l       28w      333c http://192.168.140.111/store/models/reviews
301        9l       28w      342c http://192.168.140.111/admin/assets/plugins/ckeditor
301        9l       28w      332c http://192.168.140.111/store/models/orders
301        9l       28w      342c http://192.168.140.111/admin/assets/plugins/fancybox
301        9l       28w      336c http://192.168.140.111/admin/assets/img/others
301        9l       28w      333c http://192.168.140.111/admin/assets/js/json
301        9l       28w      331c http://192.168.140.111/store/models/goods
301        9l       28w      333c http://192.168.140.111/admin/assets/css/rtl
301        9l       28w      336c http://192.168.140.111/store/models/interfaces
301        9l       28w      331c http://192.168.140.111/store/models/serve
301        9l       28w      338c http://192.168.140.111/admin/assets/plugins/pace
```