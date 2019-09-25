spawn telnet 192.168.200.199
expect "login:"
send "filipe\r"
expect "password:"
send "123\r"
expect -r ">"
send "shutdown -s -f -t 01\r"
expect eof
