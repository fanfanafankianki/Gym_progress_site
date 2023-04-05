FROM mysql:latest
LABEL "Project"="PwrTrckr"
LABEL "Author"="fanfan"

ENV MYSQL_ROOT_PASSWORD="dbpass"
ENV MYSQL_DATABASE="accounts"

# Dodaj opcję montowania podczas uruchamiania kontenera
VOLUME /var/lib/mysql

# Skopiuj pliki backupu do kontenera
COPY gymsite_users.sql /docker-entrypoint-initdb.d/
COPY gymsite_profile.sql /docker-entrypoint-initdb.d/
# Dodaj plik z instrukcjami SQL do dodania użytkownika i przyznania uprawnień
COPY create_user.sql /docker-entrypoint-initdb.d/