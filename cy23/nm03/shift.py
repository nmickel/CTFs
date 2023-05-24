# Initializing string
test_str = 'xhRmogZz9Nc2VuRUlhZG5lbkMtc3gyODA=OT'
 
# Printing original string
print("The original string is : " + test_str)
 
# Initializing right rot
r_rot = 7
 
# Initializing left rot
l_rot = 3
 
# Right and Left Shift characters in String
# Using String multiplication + string slicing
res = (test_str * 3)[len(test_str) + l_rot - r_rot:
                     2 * len(test_str) + l_rot - r_rot]
 
# Printing result
print("The string after rotation is : " + str(res))