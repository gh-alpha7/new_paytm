
from numpy import pi, cos, sqrt
def num_tilings(m, n):
    prod = 1
    for k in range(1, m+1):
    	for l in range(1, n+1):
        	prod *= 2*cos(pi*k/(m+1)) + 2j*cos(pi*l/(n+1))
    return sqrt(abs(prod))
print(num_tilings(9,9))