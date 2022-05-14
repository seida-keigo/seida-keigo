from selenium import webdriver
edge=webdriver.Edge("msedgedriver.exe")
edge.get("https:www.ttmnet.co.jp/blog-allnightmusic")
html="<meta charset=\"utf-8\">\n<style>\n	a{text-decoration:unset}\n</style>"
import re
import time
for url in[a.get_attribute("name")for a in reversed(edge.find_elements_by_css_selector(".nooptg>a"))]:
	time.sleep(.25)
	edge.get(url)
	for tracks in reversed(edge.find_elements_by_css_selector(".text")):
		tracks=tracks.text
		tracks=re.split("\n+",tracks)
		tracks=[re.sub("\d+\.|M-\d+：|」$","",track)for track in tracks]
		tracks=[track.replace("〜","~")for track in tracks]
		tracks=[track.translate(str.maketrans({chr(n+65281):chr(n+33)for n in range(94)}))for track in tracks]
		tracks=[[track.replace("+","%2B"),track]for track in tracks]
		tracks=[[re.sub("[ 　]*[/／][ 　]*「?|[ 　]*「|[ 　]+♪","+",track[0]),re.sub("[ 　]*[/／][ 　]*「?|[ 　]*「|[ 　]+♪"," - ",track[1])]for track in tracks]
		tracks=[[re.sub("[ 　]+","+",track[0]),re.sub("[ 　]+"," ",track[1])]for track in tracks]
		tracks=["<a href=\"http:youtube.com/results?search_query="+track[0]+"\" target=\"_blank\">"+track[1]+"</a>"for track in tracks]
		tracks="<br>\n	".join(tracks)
		html+="\n<p>\n	"+tracks+"\n</p>"
edge.quit()
open("All Night Music.html","w",encoding="utf-8").write(html)