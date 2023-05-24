EOF = False
file_count = 0

f = open("pcap01.txt", "rb")

while not EOF:
	out_filename = "file" + str(file_count)
	out_file = open(out_filename, "wb")
	client_target_file = f.read(50)

	if len(client_target_file) == 0:
		break

	server_file_size = f.read(4)

	client_echo_file_size = f.read(8)

	read_byte_count = 5

	file_data = ""

	while True:
		chunk_header = f.read(16)
		file_data = f.read(2048)
		out_file.write(file_data)
		read_byte_count += 2048
		client_chunk_echo = f.read(8)

		if client_echo_file_size == client_chunk_echo:
			file_count += 1
			break

	out_file.close()
	
f.close()