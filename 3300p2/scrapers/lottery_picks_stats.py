from urllib2 import urlopen
from bs4 import BeautifulSoup

#url of page you want to parse (in this case, list of all NBA champs)
lottery_url='http://www.nba.com/history/draft/all-time-lottery-draft-picks/index.html'
#turn it into "beautiful soup"
lottery_soup = BeautifulSoup(urlopen(lottery_url), "html.parser")
#find table within page, either by class or id or both
lottery_table = lottery_soup.find('table', attrs={'class': 'cnnTM'})
#http://stackoverflow.com/questions/2010481/how-do-you-get-all-the-rows-from-a-particular-table-using-beautifulsoup
#find all the rows (trs) in the table
lottery_rows = lottery_table.findChildren(["tr"])
#header row for eventual printing stuff
print "Year_Drafted,Player,Year1,Team1,wins1,Year2,Team2,wins2,Year3,Team3,wins3,Year4,Team4,wins4,Year5,Team5,wins5,Year6,Team6,wins6,Year7,Team7,wins7,Year8,Team8,wins8,Year9,Team9,wins9,Year10,Team10,wins10"
pick_count = 0
for row in lottery_rows:
	#cells are all the tds; thus, you can think of a table as a 2d array with rows and cells within the rows
	#beautiful soup turns each of these into an array by virtue of the findChildren command
	cells = row.findChildren('td')
	#some rows don't actually have anything in them; ignore those
	if len(cells) >=3:
		is_it_a_year = cells[1].findChildren('b')
		if len(is_it_a_year) > 0:
			pick_count = 0
			year = is_it_a_year[0].string
		elif (cells[0].string != " Pick ") and (int(year) < 1993):
			if pick_count <= 6:
				#prints year drafted
				print year,",",
				text = cells[1].string
				try:
					name = text[:text.index(",")][1:]
				except ValueError:
					name = text[1:]
				if year == "2011":
					name = name[:len(name)-1]
				if name == "Joel Embiid#":
					#motherfucker never played a goddamn nba game
					print "Joel Embiid"
				elif name == "Len Bias":
					#died before he played
					print "Len Bias"
				else:
					#prints player name
					if name == "Michael Conley":
						name = "Mike Conley"
					elif name == "Sheldon Williams":
						name = "Shelden Williams"
					elif name == "Carmello Anthony":
						name = "Carmelo Anthony"
					elif name == "Isaiah (J.R.) Rider":
						name = "Isaiah Rider"
					elif name == "Jimmy Jackson":
						name = "Jim Jackson"
					elif name == "Chris Jackson":
						name = "Mahmoud Abdul-Rauf"
					elif name == "Armon Gilliam":
						name = "Armen Gilliam"
					print name,",",
					first_name = name[:name.index(" ")].lower()
					last_name = name[name.index(" ")+1:].lower()
					if name == "Nene Hilario":
						name = "Nene"
					if last_name == "kidd-gilchrist":
						last_name = "kiddgilchrist"
					elif last_name == "van horn":
						last_name = "vanhorn"
					elif last_name == "o'neal":
						last_name = "oneal"
					if first_name == "o.j.":
						first_name = "oj"
					elif first_name == "j.r.":
						first_name = "jr"
					for i in range(1,10):
						if len(last_name) >= 5:
							player_url = "http://www.basketball-reference.com/players/"+last_name[0]+"/"+last_name[:5]+first_name[:2]+"0"+str(i)+".html"
						else:
							player_url = "http://www.basketball-reference.com/players/"+last_name[0]+"/"+last_name+first_name[:2]+"0"+str(i)+".html"
						if name == "Larry Johnson":
							player_url = "http://www.basketball-reference.com/players/j/johnsla02.html"
						player_soup = BeautifulSoup(urlopen(player_url), "html.parser")
						if player_soup.find('h1').string == name:
							totals_table = player_soup.find('table', attrs={ 'id' : 'totals' })
							TOT = False
							for season in totals_table.findChildren(["tr"])[1:]:
								season_cells = season.findChildren('td')
								if len(season_cells) >= 3:
									if season_cells[0].string == 'Career':
										print ""
										break
									#doesn't work when all-star...
									if len(season_cells[0].findChildren('a')) > 0:
										season_year = season_cells[0].find('a').string
										team = season_cells[2].string
										if team == 'TOT':
											TOT = True
										elif TOT:
											TOT = False
										else:
											print season_year,",",
											if team == "CHO" or team == "CHH":
												team = "CHA"
											elif team == "NOP" or team == "NOK":
												team = "NOH"
											elif team == "BRK":
												team = "NJN"
											elif team == "SEA":
												team = "OKC"
											elif team == "VAN":
												team = "MEM"
											elif team == "WSB":
												team = "WAS"
											print team,",",
											team_url = "http://www.basketball-reference.com/teams/"+team+"/"
											team_soup = BeautifulSoup(urlopen(team_url), "html.parser")
											season_table = team_soup.find('table', attrs={ 'id' : team })
											for each in season_table.findChildren('tr')[1:]:
												#print each
												if each.findChildren('td')[0].string == season_year:
													print each.findChildren('td')[3].string,",",
							break

				pick_count+=1


