FROM nginx:1.21

# COPY ssl /etc/service-ssl

COPY conf.d /etc/nginx/conf.d

WORKDIR /app
