# Use official Ubuntu image as the base
FROM ubuntu:latest

# Update packages and install required dependencies
RUN apt-get update -y && \
    apt-get upgrade -y && \
    apt-get install -y software-properties-common && \
    add-apt-repository ppa:ondrej/php && \
    apt-get update -y && \
    apt-get install -y apache2 && \
    apt-get install -y php7.4 libapache2-mod-php7.4 && \
    apt-get install -y php7.4-cli php7.4-common php7.4-json php7.4-opcache php7.4-mysql php7.4-zip php7.4-gd php7.4-mbstring php7.4-curl php7.4-xml php7.4-bcmath && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

# Enable Apache modules and set the default virtual host
RUN a2enmod rewrite && \
    a2enmod headers && \
    a2enmod expires && \
    a2enmod proxy && \
    a2enmod proxy_http && \
    a2enmod proxy_balancer && \
    a2enmod lbmethod_byrequests && \
    a2enmod ssl

# Set the Apache server name (to avoid warnings)
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Set the working directory
WORKDIR /var/www/html

# Expose the necessary ports
EXPOSE 80 443

# Start the Apache service
CMD ["apachectl", "-D", "FOREGROUND"]
