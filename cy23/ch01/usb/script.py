import binascii

def reverse_xor(ciphertext, key):
    plaintext = ''
    for i in range(len(ciphertext)):
        plaintext += chr(ord(ciphertext[i]) ^ key)
    return plaintext

def reverse_function(encrypted_flag):
    k = encrypted_flag[::-1]
    l = [3, 19, 1337, 42, 9, 11, 56, 2, 72, 100, 81, 90, 11, 23, 84, 77, 192, 810, 999, 239, 74]
    m = "the quick fox jumps over the lazy dog"
    n = "lorem ipsum dolor sit amet consectetur adipiscing elit"

    decrypted_flag = ''
    for i in range(len(k)):
        index = (l[i % len(l)] + i) % len(m)
        o = m[index]
        p = n[index]
        q = reverse_xor(k[i], ord(o))
        r = reverse_xor(q, ord(p))
        decrypted_flag += r

    return decrypted_flag

encrypted_flag = "7792c3732707226742f346b62702d77747c76216"
decrypted_flag = reverse_function(encrypted_flag)

print(decrypted_flag)