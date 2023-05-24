#!/usr/bin/env python
"""
    <Name>
        Extract.py
    <Description>
        Simple sample script that scrapes for JFIF headers on files to
        find JPEG images in corrupted files.
        Saved images will be created as 
            [filename]-n.jpeg
    <Usage>
        ./extract.py [filename] 
    <Author>
        Santiago Torres
    <Date>
        1447793239
"""
import sys



SOI = '\xFF\xD8'
APP0MARKER = '\xFF\xE0'
IDENTIFIER = 'JFIF\x00'
EOI = '\xFF\xD9'

def save_image(data, filename, number):

    with open("{}-{}.jpeg".format(filename, number), 'wb') as fp:
        fp.write(data)

if __name__ == "__main__":

    if len(sys.argv) < 2:
        print("usage: ./extract.py [filename]")
        sys.exit(0)

    filename = sys.argv[1]

    with open(filename) as fp:
        data = fp.read()

    # FIXME: let's do it the dumb way first
    soi = data.find(SOI)
    eoi = data.find(EOI)
    i = 0

    while(soi != -1 and eoi != -1):


        image = data[soi:eoi+len(EOI)]
        data = data[eoi+len(EOI):]

        save_image(image, filename, i)

        i += 1
        if i > 10:
            import pdb; pdb.set_trace()
            sys.exit(0)

        soi = data.find(SOI)
        eoi = data.find(EOI)