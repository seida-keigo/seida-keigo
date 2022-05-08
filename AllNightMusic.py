# テレビ東京のAll Night Musicで放送された曲の一覧のHTMLファイルを作成します。
# 作成されたHTMLファイルから、YouTubeで検索して視聴できます。

from selenium import webdriver
edge=webdriver.Edge(executable_path="msedgedriver.exe")
edge.get("https:www.ttmnet.co.jp/blog-allnightmusic")
html="<!DOCTYPE html>\n<html>\n\t<head>\n\t\t<meta charset=\"utf-8\">\n\t\t<style>\n\t\t\ta{text-decoration:unset}\n\t\t</style>\n\t</head>\n\t<body>"
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
		tracks="<br>\n\t\t\t".join(tracks)
		html+="\n\t\t<p>\n\t\t\t"+tracks+"\n\t\t</p>"
edge.quit()
open("All Night Music.html","w",encoding="utf-8").write(html+"\n\t</body>\n</html>")