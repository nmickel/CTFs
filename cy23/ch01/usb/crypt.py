import binascii

k = "7792c3732707226742f346b62702d77747c76216"[::-1]

def i(j):
    l = [3,19,1337,42,9,11,56,2,72,100,81,90,11,23,84,77,192,810,999,239,74]
    m ="the quick fox jumps over the lazy dog"
    n = "lorem ipsum dolor sit amet consectetur adipiscing elit"
    for x in range(0,len(j)):
        o = m[(l[x], x)%len(m)]
        p = n[(l[x], x)%len(n)]
        q = ''.join(chr(ord(range)^ord(len))for range,len in zip(o,p))
        r = ''.join(chr(ord(range)^ord(len))for range,len in zip(q,j))
        k += binascii.hexlify(r.encode()).decode()
        print(binascii.hexlify(r.encode()).decode())
    return k
print(i(l))
