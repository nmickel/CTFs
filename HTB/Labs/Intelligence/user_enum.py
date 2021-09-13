#!/usr/bin/python3

from pwn import *

io = process('/bin/sh')
io.sendline('ls -al pdf/')
lst = io.recvrepeat(1).decode().strip().split('\n')
files = []
for i in range(3,len(lst)):
	tmp = lst[i].split(' ')
	files.append(tmp[9])
#print (files)
f = open('users.txt','w')
for i in files:
	io.sendline(f'exiftool pdf/{i}')
	tmp = (io.recvrepeat(1).decode().strip().split(': '))
	f.write(tmp[-1] + '\n')
	print (tmp[-1])

f.close()