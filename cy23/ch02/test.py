#import base64
#import pyot

# Encoded string
#encoded_string = "xhRmogZz9Nc2VuRUlhZG5lbkMtc3gyODA="

# Decode base64 string
#decoded_string = base64.b64decode(encoded_string).decode('utf-8')

# Output the decoded string
#print(decoded_string)

import pyot

# Initialize OT instance
ot = pyot.OT()

# Decode the string
decoded_string = ot.decode("xhRmogZz9Nc2VuRUlhZG5lbkMtc3gyODA=")

# Print the decoded string
print(decoded_string)
