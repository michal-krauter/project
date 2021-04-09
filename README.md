# project
SOAP systém pro registraci uživatelů pomocí webové služby do MySQL databáze.

řešeno pomocí webové služby SOAP s WSDL specifikací (serverová část i klient v PHP)
zdrojový kód – v přiložených souborech – sekce client, server a dump z MySQL tabulky users
řešení nasazeno na:
http://4rau13r-svr.8u.cz/index.php  (registrační formulář)
http://4rau13r-svr.8u.cz/user-list.php (výpis registrovaných)
http://4rau13r-svr.9e.cz/krauter.wsdl (WSDL specifikace)
http://4rau13r-svr.9e.cz/soap-server.php (serverová část)

HTML formulář zpracováván pomocí AJAXu – částečná validace vstupních dat na BE (vyplněné všechny pole, u emailu i validace email adresy), JSON nám vrací výsledek operace, vzhled částečně řešen pomocí CSS stylů, SQL injection řešeno na straně serveru při ukládání do databáze
Přidáno vzdálené logování z JS na straně klienta pro případný debuging výsledku požadavku.
