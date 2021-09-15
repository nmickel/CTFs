import hashlib

def hash(string):
    return hashlib.sha256(string).hexdigest()

time = b"12345678901"
name = b"test"
import os, binascii
import re
while True:
    answer = binascii.hexlify(os.urandom(20))
    thing = hash(name + answer + time)
    if len(re.findall('^(.{5}0e[\d]{18})', thing)) > 0:
        print(re.findall('^.....0e\d{18}', thing))
        print(name + b" " + answer + b" " + time)
        print(thing)
        exit()