FROM mysql:8.0

ENV MYSQL_DATABASE=zaemonia-database \
  MYSQL_USER=zaemonia \
  MYSQL_PASSWORD=Masa79308R4Cpf5r \
  MYSQL_ROOT_PASSWORD=Masa79308R4Cpf5r \
  TZ=Asia/Tokyo

COPY ./my.cnf /etc/mysql/conf.d/my.cnf
RUN chmod 644 /etc/mysql/conf.d/my.cnf