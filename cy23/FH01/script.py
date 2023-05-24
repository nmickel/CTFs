def xor_decrypt(data, key):
    decrypted_data = bytearray()
    key_length = len(key)
    for i in range(len(data)):
        decrypted_data.append(data[i] ^ ord(key[i % key_length]))
    return decrypted_data

# Provide the path to the encrypted GIF file
encrypted_file_path = "flag.gif"

# Provide the path to save the decrypted GIF file
decrypted_file_path = "/home/nmickel/CTFs/cy23/FH01/test.txt"
# Encryption key
key = "1"

# Read the encrypted GIF file
with open(encrypted_file_path, "rb") as file:
    encrypted_data = bytearray(file.read())

# Decrypt the GIF file
decrypted_data = xor_decrypt(encrypted_data, key)

# Save the decrypted GIF file
with open(decrypted_file_path, "wb") as file:
    file.write(decrypted_data)

print("Decryption completed. Decrypted GIF saved at:", decrypted_file_path)