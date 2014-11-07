__author__ = 'derua_000'

with open("outputCanton.txt","w+") as fOut:
    with open("inputCanton.txt", "r+") as f:
         old = f.read()
         print(old)
         canton = old.split('),(')
         print(canton[len(canton)-1])

         for s in canton:
             tmp = s.split(',')
             putIn = "array('id'=>'" + tmp[0] + "','name'=>" + tmp[1] + ",'id_canton'=>'" + tmp[3] + "','zipcode'=>'" + tmp[2] + "'),\n"
             print(putIn)
             fOut.write(putIn)

#array('id'=>'1','name'=>'Geneve','id_canton'=>'2','zipcode'=>'2132'),