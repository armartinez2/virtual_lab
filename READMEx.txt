ADMIN

To the right is a list of all of your users that are located on this
machine in order for users to access Xen Orchestra they must first
be users on the gateway. If necessary you can delete any of these users
if they have been misusing the xen server or if they are no longer
using xen.


STUDENT

If you choose to download a xen interface on this page simply pick
the operating system that you would like to run it on, or if you are not running
a computer where you can download anything, then you can go directly
to xen through the web interface xen orchestra

XEN SERVER

To install XenServer, we downloaded the .iso file and booted it up the old 
fashoned way, through disk drive. The install process is pretty simple and 
you may think about setting up a static ip address. Other than that, it pretty
much installs itself. We also had to use a disk drive to install the new virtual
machines to the XenServer. XenCenter is a great admin tool that only works on 
Windows, It makes vm installation easier and can give you a good intro on how
the virtual machines are handled. You can also install OpenXenManager to Unix
systems.

XenServer is running as the operating system on the localhost 192.168.7.176 
it controls all of the virtual machines that you get to use in XenCenter, 
OpenXenManager, or XenOrchestra. To do this for free, we would have to make 
a controller and interpreter of the virtual machines being played on the 
XenServer host, replacing XenOrchestra. This will not be easy. We have 
learned some commands that we can send through bash to clone existing VM's,
and possibly create new users and pools of users.

We want to urge you to go into your own production of the handler of the VM's 
in the XenServer. We thought at first that XenCenter was the only way to gain
access to the server. After some research we found that there is an open-source
version called OpenXenManager, and an online interface called XenOrchestra.
XenCenter and OpenXenManager do not have enough features for the amount of 
security we need. That leaves us with XenOrchestra, it was $500/month and 
wasn't intuitive like we wanted, so we think there's something we missed.
We are suggesting you make your own interpretor of the vm's so you can create 
users, pools, vms, and assign them all on new user creation.

GATEWAY

The gateway is a ubuntu server that we believe should handle users from the web
page and send the mirrored image of the Virtual Machine from XenServer. Here's
the github for XenOrchestra https://github.com/vatesfr/xo. We also found a few
other Xen managers with web framework very late in our research and didn't get
a chance to look into them. But they do exist.

If you think you need to go the XenOrchestra way, You will have to use a bash
command passed through ssh to create a new user and assign it to it's vm's in
XenOrchestra, and create the vm's in XenServer.

XenOrchestra is actually a virtual machine running on XenServer, we don't know
if it could run on a seperate machine, so look into that. It seems to slow it 
down, so If you can run it on a seperate machine, you probably should.


