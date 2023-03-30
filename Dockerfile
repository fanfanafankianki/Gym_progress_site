# Pobierz obraz Ubuntu
FROM ubuntu:latest
LABEL "Project"="PwrTrckr"
LABEL "Author"="fanfan"



# Aktualizacja indeksów pakietów i instalacja Apache HTTPD
RUN apt-get update && \
    apt-get install -y apache2

# Ustawienie zmiennej środowiskowej
ENV APACHE_RUN_USER www-data
ENV APACHE_RUN_GROUP www-data
ENV APACHE_LOG_DIR /var/log/apache2
ENV APACHE_PID_FILE /var/run/apache2/apache2.pid
ENV APACHE_RUN_DIR /var/run/apache2
ENV APACHE_LOCK_DIR /var/lock/apache2
ENV APACHE_SERVERADMIN admin@localhost
ENV APACHE_SERVERNAME localhost
ENV APACHE_SERVERALIAS docker.localhost
ENV APACHE_DOCUMENTROOT /var/www

# Tworzenie katalogów wymaganych przez Apache HTTPD
RUN mkdir -p $APACHE_RUN_DIR $APACHE_LOCK_DIR $APACHE_LOG_DIR

# Ustawienie portu nasłuchiwania Apache HTTPD
EXPOSE 80

# Uruchamianie Apache HTTPD w tle
CMD ["/usr/sbin/apache2", "-D", "FOREGROUND"]

