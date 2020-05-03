urls = ['https://bongngo.tv/sat-thu-vo-cung-cuc-7944.html', "https://image.bongngo.tv/upload/poster-sat-thu-vo-cung-cuc-2020.jpg')", 'https://bongngo.tv/ke-san-moi-day-bien-7920.html', "https://image.bongngo.tv/upload/poster-ke-san-moi-day-bien-2020.jpg')", 'https://bongngo.tv/bloodshot-7899.html', "https://image.bongngo.tv/upload/poster-bloodshot-2020.jpg')", 'https://bongngo.tv/nu-hoang-bang-gia-2-7599.html', "https://image.bongngo.tv/upload/poster-nu-hoang-bang-gia-2-2019.jpg')", 'https://bongngo.tv/tin-hac-m-2-7668.html', "https://image.bongngo.tv/upload/poster-tien-hac-am-2-2019.jpg')", 'https://bongngo.tv/ga-he-7498.html', "https://image.bongngo.tv/upload/poster-ga-he-2-2019.jpg')"]

for url in urls:
			link = url[url.rfind("http"):url.rfind("jpg")+3]
			if link == "ht": 
				link = url[url.rfind("http"):url.rfind("png")+3]
				if link == "ht":
					continue
			#print(link)
			assetName = link[link.rfind("/")+1:]
			replaceStr= "{{{{asset('img/{}')}}}}".format(assetName)
			print(replaceStr)