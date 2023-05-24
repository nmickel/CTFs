import subprocess
import os
# read in users and strip the newlines

lines= 'hi'
i=0
# get list of commands for each user
while i!= 1:
    cmd = ['echo ' + lines+ ' | nc 3-nh01.bootupctf.net 8229']
    proc = subprocess.Popen(cmd, stdout=subprocess.PIPE, stderr=subprocess.PIPE, shell=True)
   
    lines = str(proc.communicate()[0]).replace('\\n','')
    lines = lines.replace('Rejected challenge.','')
    lines = lines.replace('Enter your challenge: Expected challenge: ','')
    lines = lines.replace('b', '')
    lines = lines.replace('\'','')
    print ("this-" +lines)
    
   # with open('num.txt') as f:
    #    lines = f.readline()
     #   f.close()
    #lines = lines[-9:]
    #print (lines)
