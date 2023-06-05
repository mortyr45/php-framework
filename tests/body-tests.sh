http -j POST localhost/ asd=asd
http -j PUT localhost/ asd=asd
http -j DELETE localhost/ asd=asd
http -j PATCH localhost/ asd=asd
http -j LOCK localhost/ asd=asd

http -f GET localhost/ asd=asd
http -f POST localhost/ asd=asd
http -f PUT localhost/ asd=asd
http -f DELETE localhost/ asd=asd
http -f PATCH localhost/ asd=asd
http -f LOCK localhost/ asd=asd

http --form GET localhost/ asd=asd cv@'home.sh'
http --form POST localhost/ asd=asd cv@'home.sh'
http --form PUT localhost/ asd=asd cv@'home.sh'
http --form DELETE localhost/ asd=asd cv@'home.sh'
http --form PATCH localhost/ asd=asd cv@'home.sh'
http --form LOCK localhost/ asd=asd cv@'home.sh'