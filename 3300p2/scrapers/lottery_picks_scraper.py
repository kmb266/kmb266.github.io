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
print "Year,P1,P1Team,P2,P2Team,P3,P3Team,P4,P4Team,P5,P5Team,P6,P6Team,P7,P7Team"
pick_count = 0
for row in lottery_rows:
	#cells are all the tds; thus, you can think of a table as a 2d array with rows and cells within the rows
	#beautiful soup turns each of these into an array by virtue of the findChildren command
	cells = row.findChildren('td')
	#some rows don't actually have anything in them; ignore those
	if len(cells) >=3:
		#print cells[1].findChildren('b')[0].string
		year = cells[1].findChildren('b')
		if len(year) > 0:
			pick_count = 0
			print year[0].string,",",
		elif cells[0].string != " Pick ":
			if pick_count < 6:
				text = cells[1].string
				team = cells[2].string
				try:
					print text[:text.index(",")],",",
				except ValueError:
					print text,",",
				try:
					print team[:team.index("(")],",",
				except ValueError:
					print team,",",
				pick_count+=1
			elif pick_count == 6:
				text = cells[1].string
				team = cells[2].string
				try:
					print text[:text.index(",")],",",
				except ValueError:
					print text,",",
				try:
					print team[:team.index("(")]
				except ValueError:
					print team
				pick_count+=1


