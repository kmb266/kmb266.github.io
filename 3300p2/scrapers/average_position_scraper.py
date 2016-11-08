from urllib2 import urlopen
from bs4 import BeautifulSoup

#header row for eventual printing stuff
print "Year,GP,Min,P2M,P2A,P2Pct,P3M,P3A,P3Pct,FTM,FTA,FTPct,ROff,RDef,RTot,Ast,TO,Stl,Blk,PF,PPG"
for i in range(2016,1977,-1):
	#here I'm using each i to springboard me onto a page (the league page for that year)
	year_url ='https://sports.yahoo.com/nba/stats/byposition?pos=SF%2CPF%2CF%2CFC&sort=25&qualified=0&conference=NBA&year=season_'+str(i)
	#soupifying
	year_soup = BeautifulSoup(urlopen(year_url), "html.parser")
	#get the table we care about
	year_tables = year_soup.findChildren('table')
	#can't find the goddamn correct table
	correct_table = year_tables[5]
	#get the rows from it
	year_rows = correct_table.findChildren('tr')
	#add up all stats for everyone
	GP,Min,P2M,P2A,P2Pct,P3M,P3A,P3Pct,FTM,FTA,FTPct,ROff,RDef,RTot,Ast,TO,Stl,Blk,PF,PPG = (0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0)
	for i in range(2,len(year_rows)):
		player_cells = year_rows[i].findChildren('td')
		GP += player_cells[2]
		Min += player_cells[3]
		P2M += player_cells[4]
		P2A += player_cells[5]
		P2Pct += player_cells[6]
		P3M += player_cells[7]
		P3A += player_cells[8]
		P3Pct += player_cells[9]
		FTM += player_cells[10]
		FTA += player_cells[11]
		FTPct += player_cells[12]
		ROff += player_cells[13]
		RDef += player_cells[14]
		RTot += player_cells[15]
		Ast += player_cells[16]
		TO += player_cells[17]
		Stl += player_cells[18]
		Blk += player_cells[19]
		PF += player_cells[20]
		PPG += player_cells[21]
	#the comma after each print keeps it from printing a new line
	print str(i),",",
	total_players = len(year_rows)-2
	print str(GP/total_players),",",
	print Min/total_players,",",
	print P2M/total_players,",",
	print P2A/total_players,",",
	print P2Pct/total_players,",",
	print P3M/total_players,",",
	print P3A/total_players,",",
	print P3Pct/total_players,",",
	print FTM/total_players,",",
	print FTA/total_players,",",
	print FTPct/total_players,",",
	print ROff/total_players,",",
	print RDef/total_players,",",
	print RTot/total_players,",",
	print Ast/total_players,",",
	print TO/total_players,",",
	print Stl/total_players,",",
	print Blk/total_players,",",
	print PF/total_players,",",
	print PPG/total_players,",",
	


for i in range(2016,1977,-1):
	#here I'm using each i to springboard me onto a page (the league page for that year)
	year_url ='https://sports.yahoo.com/nba/stats/byposition?pos=PG%2CSG%2CG%2CGF&sort=25&qualified=0&conference=NBA&year=season_'+str(i)
	#soupifying
	year_soup = BeautifulSoup(urlopen(year_url), "html.parser")
	#get the table we care about
	year_tables = year_soup.findChildren('table')
	correct_table = year_tables[5]
	#get the rows from it
	year_rows = correct_table.findChildren('tr')
	#add up all stats for everyone
	GP,Min,P2M,P2A,P2Pct,P3M,P3A,P3Pct,FTM,FTA,FTPct,ROff,RDef,RTot,Ast,TO,Stl,Blk,PF,PPG = 0
	for i in range(2,len(year_rows)):
		player_cells = year_rows[i].findChildren('td')
		GP += player_cells[2]
		Min += player_cells[3]
		P2M += player_cells[4]
		P2A += player_cells[5]
		P2Pct += player_cells[6]
		P3M += player_cells[7]
		P3A += player_cells[8]
		P3Pct += player_cells[9]
		FTM += player_cells[10]
		FTA += player_cells[11]
		FTPct += player_cells[12]
		ROff += player_cells[13]
		RDef += player_cells[14]
		RTot += player_cells[15]
		Ast += player_cells[16]
		TO += player_cells[17]
		Stl += player_cells[18]
		Blk += player_cells[19]
		PF += player_cells[20]
		PPG += player_cells[21]
	#the comma after each print keeps it from printing a new line
	print str(i),",",
	total_players = len(year_rows)-2
	print str(GP/total_players),",",
	print Min/total_players,",",
	print P2M/total_players,",",
	print P2A/total_players,",",
	print P2Pct/total_players,",",
	print P3M/total_players,",",
	print P3A/total_players,",",
	print P3Pct/total_players,",",
	print FTM/total_players,",",
	print FTA/total_players,",",
	print FTPct/total_players,",",
	print ROff/total_players,",",
	print RDef/total_players,",",
	print RTot/total_players,",",
	print Ast/total_players,",",
	print TO/total_players,",",
	print Stl/total_players,",",
	print Blk/total_players,",",
	print PF/total_players,",",
	print PPG/total_players,",",



