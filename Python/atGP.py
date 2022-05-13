type=input("1:事務等 2:IT 3:製造等 ")
if type in["1","2","3"]:
	from selenium import webdriver
	edge=webdriver.Edge("msedgedriver.exe")
	list=[]
	i=1
	while True:
		edge.get(
			"http:atgp.jp/search/top/search_result?"+(
				"job_categories=b01001610000002000,b01001610000004000&job_types=b01001620000034000,b01001620000036000,b01001620000037000,b01001620000043000"
					if type=="1"else
				"job_categories=b01001610000005000&job_types=b01001620000035000"
					if type=="2"else
				"job_types=b01001620000027000,b01001620000029000,b01001620000031000,b01001620000033000,b01001620000041000"
			)+"&recruit_type=0&page="+str(i)
		)
		for url in edge.find_elements_by_css_selector(".c-button--blue:not(.u-mr--10)"):
			list.append(url.get_attribute("href").replace("https://www.","").lower())
		if str(i)==edge.find_elements_by_css_selector(".c-pagenavi-c__number:last-of-type")[0].text:
			break
		i+=1
	edge.quit()
	open("atGP URL 事務等.txt"if type=="1"else"atGP URL IT.txt"if type=="2"else"atGP URL 製造等.txt","w").write("\n".join(sorted(list)))