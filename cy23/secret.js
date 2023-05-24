# SANS BootUp CTF (Beginner)
# Overkill version

import socket
import re

host = "1-ne01.bootupctf.com"
port = 7904
flag_found = False

# Setup connection
s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
s.connect((host, port))

while flag_found == False:
    question = s.recv(1024).decode("utf-8")

    # Remove the = sign
    calc = re.findall(r"^.*(?=\s\=)", question)
    
    # Calculate result
    result = str(int(eval(calc[0]))) + "\n"

    # Send result
    s.send(result.encode("UTF-8"))

    # Check response
    response = s.recv(1024).decode("UTF-8")
    if "flag" in response.lower():
        flag_found = True
        print(response)