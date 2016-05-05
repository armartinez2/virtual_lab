#this section will download every tool necessary to install 
#xen manager onto your system then it installs xen manager
#onto the desktop of the user. to run you must first chmod +x
#to the run.sh file when it is downloaded and then you must
#launch run.sh
#!/bin/bash
sudo apt-get -f install
sudo iptables -I INPUT -p tcp -s 192.168.7.175 --dport 9999 -j ACCEPT
sudo apt-get install git
sudo apt-get install python2.7
sudo apt-get install python-pip
sudo mkdir ~/Desktop/pygtk
cd ~/pygtk
sudo git init
sudo git clone https://github.com/GNOME/pygtk.git
cd ~
sudo pip install configobj
cd ~/Desktop
git init
git clone https://github.com/OpenXenManager/openxenmanager.git
sudo apt-get install gtkvncviewer
sudo mv ~/Desktop/pygtk/* ~/Desktop/openxenmanager
sudo rm -rf ~/Desktop/pygtk
cd ~/Desktop/openxenmanager
sudo ./openxenmanager
