# Use official Ubuntu image as the base
FROM ubuntu:latest

# Set up a noninteractive environment for package installation
ENV DEBIAN_FRONTEND=noninteractive
 
RUN apt update 
RUN apt install –y apache2 
RUN apt install –y apache2-utils 
RUN apt clean 
RUN apt install -y php7.4-cli php7.4-common php7.4-json php7.4-opcache php7.4-mysql php7.4-zip php7.4-gd php7.4-mbstring php7.4-curl php7.4-xml php7.4-bcmath
EXPOSE 80
CMD [“apache2ctl”, “-D”, “FOREGROUND”]

# Set the working directory
WORKDIR /var/www/html

# Start the Apache service
CMD ["apachectl", "-D", "FOREGROUND"]
