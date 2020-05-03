# Python code to find the URL from an input string 
# Using the regular expression 
import re 
import numpy as np

def Find(string): 
	url = re.findall('http[s]?://(?:[a-zA-Z]|[0-9]|[$-_@.&+]|[!*\(\),]|(?:%[0-9a-fA-F][0-9a-fA-F]))+', string)
	return url 
	
source = open("testFile.html", "r")
destSrc = open("newTestFile.html", "w")
arrayUrls = [];
for line in source:
	urls = Find(line)
	
	if urls:
		for url in urls:
			link = url[url.rfind("http"):url.rfind("jpg")+3]
			if link == "ht": 
				link = url[url.rfind("http"):url.rfind("png")+3]
				if link == "ht":
					continue
			assetName = link[link.rfind("/")+1:]
			replaceStr= "{{{{asset('img/{}')}}}}".format(assetName)
			print(replaceStr)
			line = line.replace(url,replaceStr)
	
	destSrc.write(line)
		
#print(len(arrayUrls))
#print(arrayUrls)

for imageUrl in arrayUrls:
	assetName = imageUrl[imageUrl.rfind("/")+1:]
	replaceStr= "{{asset('img/{}')}}".format(assetName)
	for line in source:
		print("hello")