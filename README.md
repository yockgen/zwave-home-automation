# zwave-home-automation web application 
## Mandatory Hardware   
1 x Raspberry PI   
1 x Razberry https://z-wave.me/products/razberry/    

## Running Web UI Application
http://xxx.xxx.xxx.xxxx/main.php  

## z-wave devices configured for this app
2 x IP Cameras    
2 x Zwave wall mounted switch    
1 x Zwave dimmer     
1 x Zwave socket     

## Web Client
HTML   
CSS   
Jquery 1.4.3

## Web Server
PHP   
Apache     


## How to access web interface of Razberry to configure/add/remove zwave devices    
http://xxx.xxx.xxx.xxx:8083/   <-replace xxx.xxx.xxx.xxx with PI IP address  


## web api to control zwave device (e.g. off/on switch, control dimmer etc.) 
http://xxx.xxx.xxx.xxx:8083/ZWaveAPI/Run/devices[5].instances[0].commandClasses[37].Set(255) <-replace xxx.xxx.xxx.xxx with PI IP address

## How to save image from IP cameras
wget --output-document /home/pi/movidius/temp/test04.jpg 'http://xxx.xxx.xxx.xxx:8090/snapshot.cgi?user=xxxx&pwd=xxxxx&resolution=32'
 <-replace xxx.xxx.xxx.xxx with PI IP address   
