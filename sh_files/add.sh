
#!/bin/bash
command1='useradd -c username -u uid -g 100 -d /home/username -s /bin/bash username'
command1=${command1//"username"/$1}
command1=${command1//"uid"/$3}
command1=${command1//"password"/$2}
command1=$command1
command2='echo -e "password\npassword" | passwd username'
command2=${command2//"username"/$1}
command2=${command2//"password"/$2}
command2=$command2
ssh root@192.168.7.176 "$command1"
ssh root@192.168.7.176 "$command2"
