# load a given picture from a web page and save it to a file
# (you have to be on the internet to do this)
# tested with Python24     vegaseat     19sep2006
import urllib2
import webbrowser
import os
# find yourself a picture on a web page you like
# (right click on the picture, look under properties and copy the address)
picture_page = "https://image.bongngo.tv/upload/slide-ke-vo-hinh.png"
hdr = {'User-Agent': 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.64 Safari/537.11',
       'Accept': 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
       'Accept-Charset': 'ISO-8859-1,utf-8;q=0.7,*;q=0.3',
       'Accept-Encoding': 'none',
       'Accept-Language': 'en-US,en;q=0.8',
       'Connection': 'keep-alive'}
#webbrowser.open(picture_page)  # test
# open the web page picture and read it into a variable
req = urllib2.Request(picture_page, headers=hdr)
page1 = urllib2.urlopen(req)
my_picture = page1.read()
# open file for binary write and save picture
# picture_page[-4:] extracts extension eg. .gif
# (most image file extensions have three letters, otherwise modify)
#filename = "my_image" + picture_page[-4:]
filename = picture_page[picture_page.rfind("/")+1:]
print filename  # test
fout = open(filename, "wb")
fout.write(my_picture)
fout.close()
# was it saved correctly?
# test it out ...
#webbrowser.open(filename)
# or ...
# on Windows this will display the image in the default viewer
#os.startfile(filename)