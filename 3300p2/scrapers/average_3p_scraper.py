from urllib2 import urlopen
from bs4 import BeautifulSoup

#header row for eventual printing stuff
print "Year,avg_3PA,avg_3P%"
for i in range(2016,1977,-1):
	#here I'm using each i to springboard me onto a page (the league page for that year)
	year_url ='http://www.basketball-reference.com/leagues/NBA_'+str(i)+'.html'
	#soupifying
	year_soup = BeautifulSoup(urlopen(year_url), "html.parser")
	#get the table we care about
	year_table = year_soup.find('table', attrs={'id': 'team'})
	#get the rows from it
	year_rows = year_table.findChildren(["tr"])
	#print out Year,avg_3PA,avg_3P%
	average_cells = year_rows[len(year_rows)-1].findChildren('td')
	#the comma after each print keeps it from printing a new line
	print str(i),",",
	print average_cells[8].string,",",
	print average_cells[9].string


