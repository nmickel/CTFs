# Blue THM
--------------------------------
>Nathaniel Mickel | Sept 9, 2021
--------------------------------
```bash
export IP=10.10.54.73
```
# Nmap 7.91 scan initiated Thu Sep  9 07:00:58 2021 as: nmap -v -sV -sC -oN nmap/initial 10.10.47.17
Increasing send delay for 10.10.47.17 from 0 to 5 due to 57 out of 189 dropped probes since last increase.
Nmap scan report for 10.10.47.17
Host is up (0.16s latency).
Not shown: 991 closed ports
PORT      STATE SERVICE            VERSION
135/tcp   open  msrpc              Microsoft Windows RPC
139/tcp   open  netbios-ssn        Microsoft Windows netbios-ssn
445/tcp   open  microsoft-ds       Windows 7 Professional 7601 Service Pack 1 microsoft-ds (workgroup: WORKGROUP)
3389/tcp  open  ssl/ms-wbt-server?
| rdp-ntlm-info: 
|   Target_Name: JON-PC
|   NetBIOS_Domain_Name: JON-PC
|   NetBIOS_Computer_Name: JON-PC
|   DNS_Domain_Name: Jon-PC
|   DNS_Computer_Name: Jon-PC
|   Product_Version: 6.1.7601
|_  System_Time: 2021-09-09T12:03:02+00:00
| ssl-cert: Subject: commonName=Jon-PC
| Issuer: commonName=Jon-PC
| Public Key type: rsa
| Public Key bits: 2048
| Signature Algorithm: sha1WithRSAEncryption
| Not valid before: 2021-09-08T11:55:18
| Not valid after:  2022-03-10T11:55:18
| MD5:   b1fc b5ce 77f5 8a94 104c 429f 690a 4c94
|_SHA-1: 628b 405e 575b 5dd0 c7e5 208d c824 f714 1c9d 4ed7
|_ssl-date: 2021-09-09T12:03:08+00:00; +1s from scanner time.
49152/tcp open  msrpc              Microsoft Windows RPC
49153/tcp open  msrpc              Microsoft Windows RPC
49154/tcp open  msrpc              Microsoft Windows RPC
49158/tcp open  msrpc              Microsoft Windows RPC
49159/tcp open  msrpc              Microsoft Windows RPC
Service Info: Host: JON-PC; OS: Windows; CPE: cpe:/o:microsoft:windows

Host script results:
|_clock-skew: mean: 1h00m00s, deviation: 2h14m10s, median: 0s
| nbstat: NetBIOS name: JON-PC, NetBIOS user: <unknown>, NetBIOS MAC: 02:5b:90:1b:78:51 (unknown)
| Names:
|   JON-PC<00>           Flags: <unique><active>
|   WORKGROUP<00>        Flags: <group><active>
|   JON-PC<20>           Flags: <unique><active>
|   WORKGROUP<1e>        Flags: <group><active>
|   WORKGROUP<1d>        Flags: <unique><active>
|_  \x01\x02__MSBROWSE__\x02<01>  Flags: <group><active>
| smb-os-discovery: 
|   OS: Windows 7 Professional 7601 Service Pack 1 (Windows 7 Professional 6.1)
|   OS CPE: cpe:/o:microsoft:windows_7::sp1:professional
|   Computer name: Jon-PC
|   NetBIOS computer name: JON-PC\x00
|   Workgroup: WORKGROUP\x00
|_  System time: 2021-09-09T07:03:02-05:00
| smb-security-mode: 
|   account_used: guest
|   authentication_level: user
|   challenge_response: supported
|_  message_signing: disabled (dangerous, but default)
| smb2-security-mode: 
|   2.02: 
|_    Message signing enabled but not required
| smb2-time: 
|   date: 2021-09-09T12:03:02
|_  start_date: 2021-09-09T11:55:17

# John creds
John's password: alqfna22

# Flags
Flag 1: flag{access_the_machine}
Flag 2: flag{sam_database_elevated_access}
Flag 3: flag{admin_documents_can_be_valuable}