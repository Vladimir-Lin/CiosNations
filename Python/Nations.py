import sys
import mysql.connector

# if len(sys.argv) < 2 :
#  sys.exit(0) ;

# filename = sys.argv[1] ;
# file = open(filename,"r+") ;
# lines = file.readlines() ;
# file.close() ;

# elements = [] ;
# three = {} ;
# codes = {} ;

# for a in lines:
#  l = a.split('\t')
#  three [ l[0] ] = l [ 1 ]
#  codes [ l[0] ] = int ( l [ 2 ] )
#  elements.append(l[0])

#x = sorted(elements) ;
  
# for e in x:
#  print ( e , three [ e ] , codes [ e ] )

#db = mysql.connector.connect(
#  host="192.168.0.97",
#  user="foxman",
#  passwd="la0marina",
#  database="erp"
#)

#mc = db.cursor()

#id   = 250 ;
#base = 7400000000000000250 ;
#type = 0 ;
#used = 0 ;

#while id <= 5000:
#  ss = "insert into `erp`.`countries` (`id`,`uuid`,`type`,`used`) values (" + \
#       str(id) + "," + \
#       str(base) + "," + \
#       str(type) + "," + \
#       str(used) + ") ;" ;
#  id = id + 1
#  base = base + 1
#  print(ss)
#  mc.execute(ss)

#tables = ["c0001","c0002","c0003","c0004","c0005","c0006","c0007","c0008","c0009","c0010","s0001","s0002","s0003","s0004","s0005","p0001","p0002","p0003","p0004","p0005","u0001","u0002","u0003","u0004","u0005","u0006","u0007","u0008","u0009","u0010","u0011","u0012","u0013","u0014","u0015","u0016","u0017","u0018","u0019","u0020" ]

#for t in tables:
#  tn = "`uuids`.`" + t + "`" ;
#  ss = "select count(*) from " + tn + ";" ;
#  mc.execute(ss)
#  for e in mc:
#    print(e[0])


# mc.execute("SHOW TABLES")

# for x in mc:
#   print(x)
