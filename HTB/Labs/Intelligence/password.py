#!/usr/bin/python3

from pdfminer.high_level import extract_text
import os
files = []
user = 'user'
for i in os.listdir('pdf'):
    files.append(i)
for i in files:
	text = extract_text('pdf/'+i)
	if user in text:
		print (i)
		print (text)
