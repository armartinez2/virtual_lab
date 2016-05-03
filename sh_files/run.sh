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
