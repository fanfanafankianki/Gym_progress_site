# Use official Ubuntu image as the base
FROM ubuntu:latest

# Set up a noninteractive environment for package installation
ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get update && \
    apt-get install -y apache2 && \
    apt-get install -y apache2-utils && \
    apt-get install -y php libapache2-mod-php php-mysql && \
    apt-get clean

EXPOSE 80

# Set the working directory
WORKDIR /var/www/html

RUN rm /var/www/html/index.html
COPY . /var/www/html
# Start the Apache service
CMD ["apachectl", "-D", "FOREGROUND"]
