spawn ssh -t filipe@10.0.0.106 'shutdown -h now'
expect "password:"
send "123\r"
expect -r "$"
expect eof
