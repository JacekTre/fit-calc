
# Zadanie rekrutacyjne GOGOmedia

## Stack technologiczny
- MySQL 5.7
- Apache 2
- PHP 8.0
- Symfony 5
- composer
- git
- git flow
- docker-compose (dla lokalnego środowiska programistycznego)

## Instalacja
- W katalogu projektu wykonaj kolejno kommendy:
```
git clone git@github.com:JacekTre/gogomedia.git
git flow init
cp docker-compose.dist.yml docker-compose.yml
```
- W kontenerze ggm_app:
```
composer install
```
## Docker
- Budowa kontenerów:
```
docker-compose build --force-rm --no-cache
```
- Podniesienie kontenerów:
```
docker-compose up -d
```
- Wyłączenie kontenerów:
```
docker-compose down
```
- Wejście do kontenera aplikacji:
```
docker exec -it ggm_app bash
```
- Wejście do kontenera bazy danych:
```
docker exec -it ggm_db bash
```

## Obsługa aplikacji

### Generowanie raportów
Do generowania raportów została utworzona komenda konsolowa: `generate:prower-station-report`.  
Do cyklicznego generowania raportów należy skonfigurwać narzędzie cron.

Przykładowa konfiguracja:
```
crontab -e
```
Należy wkleić w edytorze:
```
1 */1 * * * php /var/www/ggm-app/bin/console generate:prower-station-report
```

### Wyświetlanie raportów
Do wyświetlenia wyfiltrowanej listy raportów został stworzony route `/report/show`, aby dostać się do niego należy wypełnić formularz pod adresem route'm `/report`.
Przykłady linków:
```
https://gogomedia.local/report
https://gogomedia.local/report/show
```

### API do wgrywania informacji o mocy generatora
Do wgrywania informacji przez elektrowanię o stanie generatora został utworzony endpoint `/power-station-log`.
Przykład użycia:

| Właściwość  | Wartość                                                                                                                                                         |
|-------------|-----------------------------------------------------------------------------------------------------------------------------------------------------------------|
| URL         | `https://gogomedia.local/power-station-log`                                                                                                                     |
| METODA      | `POST`                                                                                                                                                          |
| AUTORYZACJA | `BRAK`                                                                                                                                                          |
| BODY        | {<br>&nbsp;"measurement": {<br>&nbsp;"powerStationId": 1,<br>&nbsp;"currentPower": 212.233233,<br>&nbsp;"measurementTime": "04-09-2022 22:10:12.12365"<br>&nbsp;}<br>} |
| ODPOWIEDŹ   | {<br>&nbsp;"status": "SUCCESS",<br>&nbsp;"data": {<br>&nbsp;&nbsp;"id": "6252939d0ecf626e34039de2",<br>&nbsp;&nbsp;"powerStationId": 1,<br>&nbsp;&nbsp;"currentPower": 212.233233,<br>&nbsp;&nbsp; "measurementTime": "04-09-2022 22:10:12.123650"<br>&nbsp;&nbsp;},<br>&nbsp;"context": []<br>} |