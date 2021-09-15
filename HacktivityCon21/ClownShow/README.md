# Clown Show

>Nathaniel Mickel | 14 Sept, 2021

```bash
export IP=http://challenge.ctf.games:31600
```

# /src.php

```
we find the src.php file which allows to see how the informatin is processed

we run python dehash.py

curl http://challenge.ctf.games:31600/index.php -d 'name=test&answer=6b067ebdb712e42e64e6dcaeb6513afd0f801bfc&time=12345678901'
```
# flag
flag{w00t_W0ot_juggl1n6_1s_2_3z}