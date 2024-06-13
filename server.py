import os;
import sys;


class Web3Provider:
    
    name = 'ahmed'
    data = [1,'ahmed']
    dec = {
        "ID": 12
    }
    def __init__(self):
        self.name = self.name,' omer'

    def set_name(self, ID):
        return self.name
        


web3 = Web3Provider()
print(web3.set_name(10011))
print(web3.dec['ID'])